

<?php if ( !$model->isNewRecord ): ?>
	<div id="avatar_upload" style="">
	 <h3> Upload an avatar </h3>
<?php 

	$XUpload = new XUploadForm;
	$this->widget('xupload.XUpload', 
			array(
					'url' => Yii::app()->createUrl("file/upload", 
					array("parent_id" =>User::USER_DIR . Yii::app()->user->id ) ),
						'type'=>'avatar',
						'model' => $XUpload,
						'attribute' => 'file',
						'options'=>array(
						'completed' => 'js:function (e,data) {
						$.each(data.files, function (index, file) {
						$("#User_avatar").val(file.name);
						});
						}'),
		       ));

			   
?>

	</div>
<?php endif;?>

	<div class="form" >
<?php 
	$form = $this->beginWidget('bootstrap.widgets.BootActiveForm',
	array(
		'id'=>'user-form',
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnChange'=>true,
				'validateOnFocus'=>true,
				'validateOnType'=>true,
			),
		'htmlOptions'=>array( 'class'=>'well' ),
		)); 
?>	
	<div class="row buttons">
	<?php
		echo CHtml::htmlButton('<i class="icon-ok icon-white"></i> Save',
			array('class'=>'btn btn-primary', 'type'=>'submit') ); 
	?>
	</div>
	
	
<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->hiddenField($model,'avatar',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	
	<?php echo $form->hiddenField($model,'id', array( 'value'=>$model->id ) );?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',
			array( 'size'=>60,'maxlength'=>128 ) ); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
	<?php
		$checked = null;
		$library = User::PRIVATE_LIBRARY;
		if ( !$model->isNewRecord ) 
			{
			$library = $model->public_library;
				if ( $library == User::PUBLIC_LIBRARY )
					$checked = "checked";
			}
	?>
		<?php echo $form->labelEx($model,'public_library'); ?>
		<?php echo $form->checkBox($model,'public_library',
			array(
				'checked'=>$checked, 
				'value'=>$library,
				)); 
		?>
		<?php echo $form->error($model,'public_library'); ?>
	</div>
	
<?php 
	if ( $model->isNewRecord ) :
?>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'password2'); ?>
		<?php echo $form->passwordField($model,'password2',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password2'); ?>
	</div>
	
<?php endif;?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'presentation');?>
		<?php echo $form->textArea($model,'presentation',array('display'=>'none'));?>
		<?php echo $form->error($model,'presentation');?>
	</div>
	<?php 
		$this->widget('application.extensions.elrte.elRTE', 
		array(
			'selector'=>'#User_presentation',
			'userid'=>Yii::app()->user->id,
		));
	?>
<?php $this->endWidget(); ?>

</div><!-- form -->
