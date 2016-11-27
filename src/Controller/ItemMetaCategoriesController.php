<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemMetaCategories Controller
 *
 * @property \App\Model\Table\ItemMetaCategoriesTable $ItemMetaCategories
 */
class ItemMetaCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $itemMetaCategories = $this->paginate($this->ItemMetaCategories);

        $this->set(compact('itemMetaCategories'));
        $this->set('_serialize', ['itemMetaCategories']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemMetaCategory = $this->ItemMetaCategories->newEntity();
        if ($this->request->is('post')) {
            $itemMetaCategory = $this->ItemMetaCategories->patchEntity($itemMetaCategory, $this->request->data);
            if ($this->ItemMetaCategories->save($itemMetaCategory)) {
                $this->Flash->success(__('The item meta category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item meta category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('itemMetaCategory'));
        $this->set('_serialize', ['itemMetaCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Meta Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemMetaCategory = $this->ItemMetaCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemMetaCategory = $this->ItemMetaCategories->patchEntity($itemMetaCategory, $this->request->data);
            if ($this->ItemMetaCategories->save($itemMetaCategory)) {
                $this->Flash->success(__('The item meta category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item meta category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('itemMetaCategory'));
        $this->set('_serialize', ['itemMetaCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Meta Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemMetaCategory = $this->ItemMetaCategories->get($id);
        if ($this->ItemMetaCategories->delete($itemMetaCategory)) {
            $this->Flash->success(__('The item meta category has been deleted.'));
        } else {
            $this->Flash->error(__('The item meta category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
