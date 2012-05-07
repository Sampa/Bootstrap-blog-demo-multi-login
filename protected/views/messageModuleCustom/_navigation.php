<div class="span2">
<?php 
	$this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Messages'),
        array('label'=>'Inbox', 'icon'=>'envelope', 'url'=>$this->createUrl('inbox/'),
				'active'=>true),
        array('label'=>'Sent', 'icon'=>'folder-close', 'url'=>$this->createUrl('sent/') ),
        array('label'=>'New Message', 'icon'=>'pencil', 'url'=>$this->createUrl('compose/') ),
		),
	)); 
?>

</div>
