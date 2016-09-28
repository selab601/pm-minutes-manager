<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class SaveDiffComponent extends Component
{
    public function save(
        $id,
        $table_name,
        $find_clause,
        $where_clause,
        $projects_users_ids,
        $save_callback,
        $delete_callback)
    {
        // 編集前の参加者
        $users_selected_old = TableRegistry::get($table_name)
            ->find('all', $find_clause)
            ->where($where_clause)
            ->all()->toArray();
        $old_selected_user_ids = [];
        foreach ($users_selected_old as $user) {
            array_push($old_selected_user_ids, (string)$user->projects_user_id);
        }
        if (empty($old_selected_user_ids)){ $old_selected_user_ids = []; }

        // 編集後の参加者
        $new_selected_user_ids = $projects_users_ids;
        if (empty($new_selected_user_ids)){ $new_selected_user_ids = []; }

        // 前2つの担当者の差分を比較し，追加/削除を行う
        $registry = TableRegistry::get($table_name);
        $deleted_user_ids = array_diff($old_selected_user_ids, $new_selected_user_ids);
        $added_user_ids = array_diff($new_selected_user_ids, $old_selected_user_ids);

        if (!empty($deleted_user_ids)) {
            foreach($deleted_user_ids as $user_id) {
                $delete_callback($user_id, $id);
            }
        }

        if (!empty($added_user_ids)) {
            foreach($added_user_ids as $user_id) {
                $save_callback($added_user_ids, $user_id, $id);
            }
        }
    }
}
