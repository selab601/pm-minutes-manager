<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class DeleteComponent extends Component
{
    public function Item($id) {
        $item = TableRegistry::get("Items")->get($id);
        $minute_id = $item->minute_id;

        $responsibilities = TableRegistry::get('Responsibilities')
            ->find('all')
            ->where(['responsibilities.item_id = '.$id]);
        if (!empty($responsibilities)){
            foreach($responsibilities as $responsibility) {
                if (!TableRegistry::get("Responsibilities")->delete($responsibility)) {
                    throw new \Exception('Failed to delete responsibility entity');
                }
            }
        }

        if (!TableRegistry::get("Items")->delete($item)) {
            throw new \Exception('Failed to delete responsibility entity');
        }
    }

    public function Minute($id)
    {
        $minute = TableRegistry::get('Minutes')->get($id, [
            'contain' => ['Participations', 'Items'],
        ]);
        $project_id = $minute->project_id;

        if (!empty($minute->participations)) {
            foreach ($minute->participations as $participation) {
                if (!TableRegistry::get('Participations')->delete($participation)) {
                    throw new \Exception('Failed to delete participation entity');
                }
            }
        }

        if (!empty($minute->items)) {
            foreach ($minute->items as $item) {
                $this->Item($item->id);
            }
        }

        if (!TableRegistry::get('Minutes')->delete($minute)) {
            throw new \Exception('Failed to delete minute entity');
        }
    }

    public function Project($id)
    {
        $project = TableRegistry::get('Projects')->get($id, [
            'contain' => ['Minutes'],
        ]);
        $members = TableRegistry::get('ProjectsUsers')
            ->find('all')
            ->where(['ProjectsUsers.project_id='.$id]);

        if (!empty($project->minutes)) {
            foreach ($project->minutes as $minute) {
                $this->Minute($minute->id);
            }
        }

        if (!empty($members)) {
            foreach ($members as $member) {
                if (!TableRegistry::get('ProjectsUsers')->delete($member)) {
                    throw new \Exception('Failed to delete projects_minutes entity');
                }
            }
        }

        if (!TableRegistry::get('Projects')->delete($project)) {
            throw new \Exception('Failed to delete project entity');
        }
    }
}
