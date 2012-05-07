<div class="well">

<?php 
	$this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
    array('label'=>'Create New Post','icon'=>'pencil', 'url'=>array('post/create'),),
	array('label'=>'Manage Posts','icon'=>'edit', 'url'=>array('post/admin')),
	array('label'=>'Approve Comments','icon'=>'ok', 'url'=>array('comment/index'). ' (' . Comment::model()->pendingCommentCount . ')')
	))); 
?>

</div>