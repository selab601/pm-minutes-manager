<?php if (!empty($this->request->session()->read('Flash'))): ?>
    <div class="messageBox">
        <?php echo $this->Flash->render('flash'); ?>
    </div>
<?php endif; ?>
