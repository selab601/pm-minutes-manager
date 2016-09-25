<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 */
class ItemsController extends AppController
{
    public function isAuthorized($user)
    {
        // 案件の追加は誰でも可能
        if ($this->request->action === 'add') {
            return true;
        }

        // 自分の参加しているプロジェクトの議事録の案件であれば編集，閲覧が可能
        if (in_array($this->request->action, ['edit', 'view'])) {
            $item_id = $this->request->params['pass'][0];
            $item = $this->Items->get($item_id);
            $minute = TableRegistry::get('Minutes')->get($item->minute_id);
            $user_id = $this->request->session()->read('Auth.User.id');
            $projects_users = TableRegistry::get("projects_users")
                ->find('all')
                ->where([
                    'projects_users.project_id = '.$minute->project_id,
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
        $this->paginate = [
            'contain' => ['Minutes', 'ItemCategories']
        ];
        $items = $this->paginate($this->Items);

        $this->set(compact('items'));
        $this->set('_serialize', ['items']);
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => ['Minutes', 'ItemCategories', 'Responsibilities']
        ]);

        $this->set('item', $item);
        $this->set('_serialize', ['item']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $item = $this->Items->newEntity();

        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->data);
            $item->set('created_at', time());
            $item->set('updated_at', time());

            if ($this->Items->save($item)) {
                $responsibilities_registry = TableRegistry::get("Responsibilities");

                foreach($this->request->data["users"]["_ids"] as $user_id) {
                    $responsibilities = $responsibilities_registry->newEntity();
                    $responsibilities->item_id = $item->id;
                    $responsibilities->projects_user_id = $user_id;

                    if (!$responsibilities_registry->save($responsibilities)) {
                        throw new \Exception('Failed to save responsibilities entity');
                    }
                }

                return $this->redirect(['action' => 'index']);
            } else {
                throw new \Exception('Failed to save item entity');
            }
        }

        $minute = $this->Items->Minutes->get($id);
        $itemCategories = $this->Items->ItemCategories->find('list', ['limit' => 200]);
        $users = TableRegistry::get('Users')
            ->find('all')
            ->innerJoin('projects_users', 'Users.id = projects_users.user_id')
            ->where('projects_users.project_id = '.$minute->project_id)
            ->all();

        foreach($users as $user) {
            $projects_user = TableRegistry::get("ProjectsUsers")
                ->find('all')
                ->where([
                    'ProjectsUsers.user_id = '.$user->id,
                    'ProjectsUsers.project_id = '. $minute->project_id
                ])
                ->first();
            $user->projects_user_id = $projects_user->id;
        }
        unset($user);

        $this->set(compact('item', 'minute', 'itemCategories', 'users'));
        $this->set('_serialize', ['item']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->data);
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item could not be saved. Please, try again.'));
            }
        }
        $minutes = $this->Items->Minutes->find('list', ['limit' => 200]);
        $itemCategories = $this->Items->ItemCategories->find('list', ['limit' => 200]);
        $this->set(compact('item', 'minutes', 'itemCategories'));
        $this->set('_serialize', ['item']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
