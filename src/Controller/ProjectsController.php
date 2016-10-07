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
            ->find('all', ['contain'=>['Users', 'Roles']])
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

            $project = $this->Projects->patchEntity($project, $this->request->data);
            $project->created_at = $now->format('Y-m-d H:i:s');
            $project->updated_at = $now->format('Y-m-d H:i:s');

            foreach ($project->users as &$user) {
                $user->_joinData = TableRegistry::get('ProjectsUsers')->newEntity();
                $user->_joinData->role_id = $data["roles"][$user->id];
            }

            if ($this->Projects->save($project, ['associated' => ['Users']])) {
                $this->Flash->success('プロジェクトを追加しました');
                $user_id = $this->request->session()->read('Auth.User.id');
                return $this->redirect(['controller' => 'users', 'action' => 'projectsView', $user_id]);
            } else {
                $this->Flash->error('プロジェクトの追加に失敗しました');
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

            $project = $this->Projects->patchEntity($project, $this->request->data);
            foreach ($project->users as &$user) {
                $projects_user = TableRegistry::get('ProjectsUsers')->find('all')
                    ->where([
                        'ProjectsUsers.project_id = '.$id,
                        'ProjectsUsers.user_id = '.$user->id
                    ]);
                if ($projects_user->count() > 0) {
                    $user->_joinData = $projects_user->first();
                } else {
                    $user->_joinData = TableRegistry::get('ProjectsUsers')->newEntity();
                }
                $user->_joinData->role_id = $data["roles"][$user->id][0];
            }

            if ($this->Projects->save($project)) {
                $this->Flash->success('プロジェクトを更新しました');
                return $this->redirect(['action' => 'view', $id]);
            } else {
                $this->Flash->error('プロジェクトの更新に失敗しました');
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
