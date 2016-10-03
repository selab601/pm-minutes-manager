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
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Delete');
        $this->loadComponent('SaveDiff');
    }

    public function isAuthorized($user)
    {
        // 案件の追加は誰でも可能
        if ($this->request->action === 'add') {
            return true;
        }

        // 自分の参加しているプロジェクトの議事録の案件であれば編集，閲覧が可能
        if (in_array($this->request->action, ['edit', 'view', 'delete', 'follow'])) {
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
    public function add($minute_id)
    {
        $item = $this->Items->newEntity();
        $minute = $this->Items->Minutes->get($minute_id);

        if ($this->request->is('post')) {
            $now = new \DateTime();
            $item = $this->Items->patchEntity($item, $this->request->data);
            $item->order_in_minute = $this->getMaxItemOrderNo($minute_id);
            $item->minute_id = $minute->id;
            $item->updated_at = $now->format('Y-m-d H:i:s');
            $item->created_at = $now->format('Y-m-d H:i:s');

            if ($this->Items->save($item)) {

                if (!empty($this->request->data["projects_users"]["_ids"])) {
                    $responsibilities_registry = TableRegistry::get("Responsibilities");

                    foreach($this->request->data["projects_users"]["_ids"] as $user_id) {
                        $responsibilities = $responsibilities_registry->newEntity();
                        $responsibilities->item_id = $item->id;
                        $responsibilities->projects_user_id = $user_id;
                        if (!$responsibilities_registry->save($responsibilities)) {
                            throw new \Exception('Failed to save responsibilities entity');
                        }
                    }
                }

                $this->Flash->success('案件を追加しました');
                return $this->redirect(['controller' => 'minutes', 'action' => 'view', $minute->id]);
            } else {
                $this->Flash->error('案件の追加に失敗しました');
            }
        }

        $itemMetaCategories = $this->Items->ItemMetaCategories->find('all', [
            'contain' => ['itemCategories']
        ]);
        $itemCategories = $this->Items->ItemCategories->find('all', [
            'where' =< ['ItemCategories.item_']
        ])
        $users = $this->getUsersWithResponsibility(NULL, $minute->project_id);

        $this->set(compact('item', 'minute', 'itemMetaCategories', 'users'));
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
        $item = $this->Items->get($id);
        $minute = $this->Items->Minutes->get($item->minute_id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->data);
            if ($this->Items->save($item)) {
                $this->SaveDiff->save(
                    $item->id,
                    "Responsibilities",
                    ['fields'=>'Responsibilities.projects_user_id'],
                    ['Responsibilities.item_id = '.$item->id],
                    $this->request->data["projects_users"]["_ids"],
                    [new ItemsController(), "saveResponsibility"],
                    [new ItemsController(), "deleteResponsibility"]
                );
                $this->Flash->success('案件を更新しました');
                return $this->redirect(['controller' => 'minutes', 'action' => 'view', $minute->id]);
            } else {
                $this->Flash->error('案件の追加に失敗しました');
            }
        }

        $itemCategories = $this->Items->ItemCategories->find('list', ['limit' => 200]);
        $users = $this->getUsersWithResponsibility($item->id, $minute->project_id);

        $this->set(compact('item', 'itemCategories', 'users'));
        $this->set('_serialize', ['item']);
    }

    public function follow($id = null) {
        $item = $this->Items->get($id);
        $minute = $this->Items->Minutes->get($item->minute_id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $now = new \DateTime();
            $user_id = $this->request->session()->read('Auth.User.id');
            $user_name = $this->request->session()->read('Auth.User.last_name')
                . " " . $this->request->session()->read('Auth.User.first_name');
            $item->followed_by = $user_id;
            $item->followed_user_name = $user_name;
            $item->is_followed = true;
            $item->followed_at = $now->format('Y-m-d H:i:s');
            if (!$this->Items->save($item)) {
                throw new \Exception('Failed to follow item');
            }

            $this->Flash->success('案件をフォローしました');
        }

        return $this->redirect(['controller'=>'minutes', 'action'=>'view', $minute->id]);
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
        $item = TableRegistry::get("Items")->get($id, ['id']);
        $minute_id = $item->minute_id;
        $delete_order = $item->order_in_minute;

        $this->Delete->Item($id);

        // 順番要素を更新する
        $ordered_items = TableRegistry::get('Items')
            ->find('all', [
                'order' => ['Items.order_in_minute' => 'ASC']
            ])
            ->where([
                'Items.minute_id = '.$minute_id,
                'Items.order_in_minute > '.$delete_order,
            ]);
        foreach ($ordered_items as $item) {
            $item->order_in_minute = $item->order_in_minute - 1;
            if (!$this->Items->save($item)) {
                throw new \Exception('Failed to update item order');
            }
        }

        $this->Flash->success('案件を削除しました');

        return $this->redirect(['controller' => 'minutes', 'action' => 'view', $minute_id]);
    }

    public static function saveResponsibility($added_user_ids, $user_id, $item_id) {
        $responsibility = TableRegistry::get("Responsibilities")->newEntity();
        $responsibility->item_id = $item_id;
        $responsibility->projects_user_id = $user_id;
        if (!TableRegistry::get("Responsibilities")->save($responsibility)) {
            throw new \Exception('Failed to save responsibility entity');
        }
    }

    public static function deleteResponsibility($user_id, $item_id) {
        $responsibility = TableRegistry::get("Responsibilities")
            ->find('all')
            ->where(['responsibilities.item_id = '.$item_id,
                    'responsibilities.projects_user_id = '.$user_id])
            ->first();
        if (!TableRegistry::get("Responsibilities")->delete($responsibility)) {
            throw new \Exception('Failed to delete responsibility entity');
        }
    }

    private function getMaxItemOrderNo($minute_id) {
        $max_no = 0;
        $items_num = $this->Items->find('all')
            ->where('Items.minute_id = '.$minute_id)
            ->count();
        if ($items_num != 0){
            $max_no = $items_num;
        }
        return $max_no+1;
    }

    private function getUsersWithResponsibility($item_id, $project_id) {
        $users = TableRegistry::get('Users')
            ->find('all')
            ->innerJoin('projects_users', 'Users.id = projects_users.user_id')
            ->where('projects_users.project_id = '.$project_id)
            ->all()
            ->toArray();

        foreach($users as $key => $user) {
            $projects_user = TableRegistry::get("ProjectsUsers")
                ->find('all')
                ->where([
                    'ProjectsUsers.user_id = '.$user->id,
                    'ProjectsUsers.project_id = '. $project_id
                ])
                ->first();
            $users[$key]->projects_user_id = $projects_user->id;

            if ($item_id != NULL) {
                $responsibility = TableRegistry::get('Responsibilities')
                    ->find('all')
                    ->where(['responsibilities.item_id = '.$item_id])
                    ->innerJoin('projects_users', 'projects_users.id = Responsibilities.projects_user_id')
                    ->where(['projects_users.user_id = '.$user->id])
                    ->all()
                    ->toArray();

                $users[$key]->has_responsibility = count($responsibility)>0 ? true : false;
            }
        }

        return $users;
    }

}
