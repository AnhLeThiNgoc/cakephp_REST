<!-- File: /app/View/Phones/edit.ctp -->

<h1>Edit Phone</h1>
<?php
echo $this->Form->create('Phone');
echo $this->Form->input('name');
echo $this->Form->input('manufacturer');
echo $this->Form->input('description', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Phone');
?>