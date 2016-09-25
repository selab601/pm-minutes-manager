<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Table\ProjectsUsersTable;
use App\Model\Table\Roles;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{
    public function isAuthorized($user)
    {
        // プロジェクトの追加は誰でも可能
        if ($this->request->action === 'add') {
            return true;
        }

        // 自分の参加しているプロジェクトであれば編集，閲覧が可能
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
            'contain' => ['Users', 'Minutes']
        ]);

        $this->set('project', $project);
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

            $project->name = $data["name"];
            $project->budget = $data["budget"];
            $project->customer_name = $data["customer_name"];
            $started_at_date = $data["started_at"]["year"] . "-" . $data["started_at"]["month"] . "-" . $data["started_at"]["day"];
            $project->started_at = $started_at_date;
            $finished_at_date = $data["finished_at"]["year"] . "-" . $data["finished_at"]["month"] . "-" . $data["finished_at"]["day"];
            $project->finished_at = $finished_at_date;
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

                return $this->redirect(['controller' => 'users', 'action' => 'projectsView']);
            } else {
                throw new \Exception('Failed to save project entity');
            }
        }

        $users = $this->Projects->Users->find()->select(['id', 'last_name', 'first_name']);
        $roles = TableRegistry::get('Roles')->find()->select(['id', 'name']);
        $this->set(compact('project', 'users', 'roles'));
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
        $project = $this->Projects->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project could not be saved. Please, try again.'));
            }
        }
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $this->set(compact('project', 'users'));
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
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
