<h2>Edit post</h2>

<?php
echo $this->Form->create('Post',array('action'=>'edit')); //Formヘルパー inputタグを作成し連想配列として入力されれる
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save ');
?>