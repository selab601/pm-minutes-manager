<?php
namespace App\Controller;

use App\Controller\AppController;

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

        $this->set('minute', $minute);
        $this->set('_serialize', ['minute']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $minute = $this->Minutes->newEntity();
        if ($this->request->is('post')) {
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
