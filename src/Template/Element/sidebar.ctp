<div class="sidebar">
    <div class="sidebar-contents" id="side-project-name">
        <?= h($project->name) ?>
    </div>
    <div class="sidebar-contents sidebar-project-details">
        <?= h($project->customer_name == "" ? "登録なし" : $project->customer_name) ?>
    </div>
    <div class="sidebar-contents sidebar-project-details">
        <?= h($this->Number->format($project->budget)) ?>
    </div>
    <div class="sidebar-contents sidebar-project-details">
        <?= h($project->started_at->format('Y/m/d')." 〜 ".$project->finished_at->format('Y/m/d')) ?>
    </div>

    <div class="sidebar-contents">参加メンバー</div>
    <?php if (!empty($projects_users)): ?>
        <?php
            foreach ($projects_users as $projects_user) {
                $user;
                $user['name'] = $projects_user->user->last_name . " " . $projects_user->user->first_name;
                $user['role'] = $projects_user->role->name;

                echo "<p class=\"sidebar-contents sidebar-project-details\">";
                echo $user['role'];
                echo $user['name'];
                echo "</p>";
            }
        ?>
    <?php endif; ?>

    <?php if (isset($minute)): ?>
        <div class="sidebar-contents" id="side-minute-name">
            <?= h($minute->name) ?>
        </div>
        <div class="sidebar-contents sidebar-minute-details">
            <?= h($minute->holded_at->format('Y/m/d H:i')) ?>
        </div>
        <div class="sidebar-contents sidebar-minute-details">
            <?= h($minute->holded_place) ?>
        </div>
        <div class="sidebar-contents sidebar-minute-details">
            <?= h($minute->created_at->format('Y/m/d')) ?>
        </div>
        <div class="sidebar-contents sidebar-minute-details">
            <?= h($minute->updated_at->format('Y/m/d')) ?>
        </div>

        <!-- 出席情報 -->
        <div class="sidebar-contents">出席状況</div>
        <?php if (!empty($user_array)): ?>
            <?php
                foreach ($user_array as $user) {
                    echo "<p class=\"sidebar-contents sidebar-minute-details\">";
                    echo $user['participation'];
                    echo $user['name'];
                    echo "</p>";
                }
            ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
