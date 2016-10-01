<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Table\ProjectsUsersTable;
use App\Model\Table\Roles;
use Cake\Controller\Component\DeleteComponent;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Delete');
    }

    public function isAuthorized($user)
    {
        // プロジェクトの追加は誰でも可能
        if ($this->request->action === 'add') {
            return true;
        }

        // 自分の参加しているプロジェクトであれば編集，閲覧が可能
        // プロジェクトの削除は管理者でなければ行えない
        if (in_array($this->request->action, ['edit', 'view'])) {
            $project_id = $this->request->params['pass'][0];
            $user_id = $this->request->session()->read('Auth.User.id');
            $projects_users = TableRegistry::get("projects_users")
                ->find('all')
                ->where([
                    'projects_users.project_id = '.$project_id,
                    'projects_users.user_id = '.$user_id,
                ])
                ->all();

            if (count($projects_users) != 0) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $projects = $this->paginate($this->Projects);

        $this->set(compact('projects'));
        $this->set('_serialize', ['projects']);
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Minutes']
        ]);

        $projects_users = TableRegistry::get('ProjectsUsers')
            ->find('all', ['contain'=>['Users']])
            ->where([
                'ProjectsUsers.project_id = '.$id,
                'ProjectsUsers.is_deleted = 0'
            ]);

        $this->set(compact('project', 'projects_users'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEntity();

        if ($this->request->is('post')) {

            $now = new \DateTime();
            $data= $this->request->data;

            $project = $this->insertDataToProjectObject($project, $this->request->data);
            $project->created_at = $now->format('Y-m-d H:i:s');
            $project->updated_at = $now->format('Y-m-d H:i:s');

            if ($this->Projects->save($project)) {
                $projects_users_registry = TableRegistry::get('ProjectsUsers');

                $project_id = $project->id;
                $user_ids = $data["users"]["_ids"];

                foreach($user_ids as $user_id) {
                    $projects_users = $projects_users_registry->newEntity();
                    $projects_users->project_id = $project_id;
                    $projects_users->user_id = $user_id;
                    $projects_users->role_id = $data["roles"][$user_id][0];

                    if (!$projects_users_registry->save($projects_users)) {
                        throw new \Exception('Failed to save projects_users entity');
                    }
                }

                $user_id = $this->request->session()->read('Auth.User.id');
                $this->Flash->success('プロジェクトを追加しました');
                return $this->redirect([
                    'controller' => 'users',
                    'action' => 'projectsView',
                    $user_id
                ]);
            } else {
                throw new \Exception('Failed to save project entity');
            }
        }

        $users = $this->Projects->Users->find()->select(['id', 'last_name', 'first_name']);
        $roles = json_encode(TableRegistry::get('Roles')->find()->select(['id', 'name'])
            ->all()->toArray());
        $auth_user = [];
        $auth_user["user_id"] = $this->request->session()->read('Auth.User.id');
        $auth_user = "[".json_encode($auth_user)."]";
        $this->set(compact('project', 'users', 'roles', 'auth_user'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data= $this->request->data;

            // プロジェクト内容の変更を保存する
            $project = $this->insertDataToProjectObject($project, $this->request->data);

            if ($this->Projects->save($project)) {
                // 参加者の変更を保存する

                // 既存の参加者を取得
                $old_project_members = TableRegistry::get('ProjectsUsers')
                    ->find('all', ['id'])
                    ->where(['ProjectsUsers.project_id = '.$id])
                    ->all()->toArray();
                $old_project_member_ids = [];
                foreach ($old_project_members as $old_project_member) {
                    if (!$old_project_member->is_deleted) {
                        array_push($old_project_member_ids, $old_project_member->user_id);
                    }
                }
                if (empty($old_selected_user_ids)){ $old_project_member_ids = []; }

                // 新規の参加者を取得
                $new_project_member_ids = $this->request->data["users"]["_ids"];
                if (empty($new_project_member_ids)){ $new_project_member_ids = []; }

                // 前2つの担当者の差分を比較し，追加/削除を行う
                $responsibilities_registry = TableRegistry::get("Responsibilities");
                $delete_member_ids = array_diff($old_project_member_ids, $new_project_member_ids);
                $add_member_ids = array_diff($new_project_member_ids, $old_project_member_ids);

                if (!empty($delete_member_ids)) {
                    foreach ($delete_member_ids as $delete_member_id) {
                        $this->deleteProjectsUsers($project->id,$delete_member_id);
                    }
                }

                if (!empty($add_member_ids)) {
                    foreach ($add_member_ids as $add_member_id) {
                        $role_id = $this->request->data["roles"][$add_member_id][0];
                        $this->saveProjectsUsers($project->id,$add_member_id,$role_id);
                    }
                }

                $this->Flash->success('プロジェクトを更新しました');

                return $this->redirect(['action' => 'view', $id]);
            } else {
                throw new \Exception('Failed to edit project entity');
            }
        }

        $users = $this->Projects->Users->find()->select(['id', 'last_name', 'first_name']);
        $members = TableRegistry::get('ProjectsUsers')
            ->find('all', ['contain'=>['Users', 'Roles']])
            ->where(['ProjectsUsers.project_id='.$id, 'ProjectsUsers.is_deleted=0']);
        $roles = json_encode(TableRegistry::get('Roles')->find()->select(['id', 'name'])
            ->all()->toArray());
        $this->set(compact('project', 'members', 'users', 'roles'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);

        $this->Delete->Project($id);

        $this->Flash->success('プロジェクトを削除しました');

        return $this->redirect(['controller' => 'projects', 'action' => 'index']);
    }

    private function insertDataToProjectObject($project, $data) {
        $project->name = $data["name"];
        $project->budget = $data["budget"];
        $project->customer_name = $data["customer_name"];
        $project->started_at = $data["started_at"];
        $project->finished_at = $data["finished_at"];

        return $project;
    }

    private function saveProjectsUsers($project_id, $member_id, $role_id) {
        // 過去に削除済みであるか確認
        $member = TableRegistry::get('ProjectsUsers')
            ->find('all')
            ->where(['ProjectsUsers.project_id='.$project_id, 'ProjectsUsers.user_id='.$member_id])
            ->first();
        if (!empty($member)) {
            $member->is_deleted = false;
            $member->role_id = $role_id;
            if (!TableRegistry::get('ProjectsUsers')->save($member)) {
                throw new \Exception('Failed to save projects_users entity');
            }
        } else {
            $member = TableRegistry::get('ProjectsUsers')->newEntity();
            $member->project_id = $project_id;
            $member->user_id = $member_id;
            $member->role_id = $role_id;
            if (!TableRegistry::get('ProjectsUsers')->save($member)) {
                throw new \Exception('Failed to save projects_users entity');
            }
        }
    }

    private function deleteProjectsUsers($project_id, $member_id) {
        $member = TableRegistry::get('ProjectsUsers')
            ->find('all')
            ->where(['ProjectsUsers.user_id='.$member_id,
                    'ProjectsUsers.project_id='.$project_id])
            ->first();
        $member->is_deleted = true;
        if (!TableRegistry::get('ProjectsUsers')->save($member)) {
            throw new \Exception('Failed to update(delete) projects_users entity');
        }
    }
}
