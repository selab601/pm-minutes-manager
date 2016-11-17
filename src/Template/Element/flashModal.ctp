<?php if (!empty($this->request->session()->read('Flash'))): ?>
    <?php echo $this->Flash->render('flash'); ?>
<?php endif; ?>
