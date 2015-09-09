<h1>Blog posts</h1>
<?php echo $this->Html->link(
    'Add Post',
    array('controller' => 'posts', 'action' => 'add')
); ?>
<table>
<tr>
	<th>Id</th>
	<th>Title</th>
	<th>Created</th>
<?php foreach ($posts as $post): ?>
</tr>
<!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->
	<td><?php echo $post['Post']['id']; ?></td>
	<td>
		<?php echo $this->HTml ->link($post['Post']['title'],//htmlヘルパータグ　htmlのリンクをつけいる（htmlでいう、<a>タグと同じ役割。１個目の引数にリンクを貼り付ける。２個目の引数でURLを指定している。
		array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
		<?php echo $this->Html->link('編集', array('action'=>'edit',$post['Post']['id'])); ?>
		
		<?php echo $this->Form->postLink('削除',array('action'=>'delete',$post['Post']['id']),array('confirm'=>'sure?')); ?>
    </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>　　<!-- 終わったらリセットして綺麗にする。つけてもつけなくてもOK -->

</table></td>
</tr>
</table>