<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Minutes Controller
 *
 * @property \App\Model\Table\MinutesTable $Minutes
 */
class MinutesController extends AppController
{

    /**
     * Index method
    *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects']
        ];
        $minutes = $this->paginate($this->Minutes);

        $this->set(compact('minutes'));
        $this->set('_serialize', ['minutes']);
    }

    /**
     * View method
     *
     * @param string|null $id Minute id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $minute = $this->Minutes->get($id, [
            'contain' => ['Projects', 'Items', 'Participations']
        ]);
        $usernames_participations = [];
        $users_registry = TableRegistry::get('Users');
        $projects_users_registry = TableRegistry::get('ProjectsUsers');
        $participations = $minute->participations;
        foreach ($participations as $participate) {
            $projects_user = $projects_users_registry->get($participate->projects_user_id);
            $user = $users_registry->get($projects_user->user_id);
            $usernames_participations[$user->last_name." ".$user->first_name] = $participate->is_participated;
        }

        $this->set(compact('minute', 'usernames_participations'));
        $this->set('_serialize', ['minute']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $minute = $this->Minutes->newEntity();
        $project = $this->Minutes->Projects->get($id,[
            'contain' => ['Users'],
        ]);

        if ($this->request->is('post')) {

            $data= $this->request->data;

            $minute->project_id = $data['project_id'][0];
            $minute->name = $data['name'];
            $minute->holded_place = $data['holded_place'];
            $holded_at_date = $data["holded_at"]["year"] . "-" . $data["holded_at"]["month"] . "-" . $data["holded_at"]["day"];
            $minute->holded_at = $holded_at_date;
            $minute->set('created_at', time());
            $minute->set('updated_at', time());

            if ($this->Minutes->save($minute)) {
                $participations_registry = TableRegistry::get('Participations');

                $project_id = $minute->project_id;
                $checked_user_ids = $data["users"]["_ids"];

                foreach($project->users as $user) {
                    $projects_users_registry = TableRegistry::get('ProjectsUsers');
                    $projects_users = $projects_users_registry
                        ->find('all')
                        ->where([
                            'ProjectsUsers.project_id = ' . $project_id,
                            'ProjectsUsers.user_id = ' . $user['id'],
                        ])
                        ->first();

                    $participations = $participations_registry->newEntity();
                    $participations->projects_user_id = $projects_users->id;
                    $participations->minute_id = $minute->id;
                    if (in_array($user['id'], $checked_user_ids)) {
                        $participations->is_participated = 1;
                    } else {
                        $participations->is_participated = 0;
                    }

                    if (!$participations_registry->save($participations)) {
                        throw new \Exception('Failed to save participations entity');
                    }
                }
                return $this->redirect(['action' => 'index']);
            } else {
                throw new \Exception('Failed to save minute entity');
            }
        }

        $this->set(compact('minute', 'project'));
        $this->set('_serialize', ['minute']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Minute id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $minute = $this->Minutes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $minute = $this->Minutes->patchEntity($minute, $this->request->data);
            if ($this->Minutes->save($minute)) {
                $this->Flash->success(__('The minute has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The minute could not be saved. Please, try again.'));
            }
        }
        $projects = $this->Minutes->Projects->find('list', ['limit' => 200]);
        $this->set(compact('minute', 'projects'));
        $this->set('_serialize', ['minute']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Minute id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $minute = $this->Minutes->get($id);
        if ($this->Minutes->delete($minute)) {
            $this->Flash->success(__('The minute has been deleted.'));
        } else {
            $this->Flash->error(__('The minute could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
