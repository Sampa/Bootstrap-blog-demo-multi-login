<?php if(Yii::app()->user->hasFlash('success')): ?>
	<div class="alert-message success">
<?= Yii::app()->user->setFlash('success', 
	Yii::app()->user->getFlash('success') );
?>
	</div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php endif; ?>
