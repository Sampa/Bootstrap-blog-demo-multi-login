<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Compose Message"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Compose"),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_styles') ?>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_flash') ?>

<div class="row">
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation'); ?>
	<div class="span13">
		<h2><?= MessageModule::t('Compose New Message'); ?></h2>

		<div class="form">
			<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
				'id'=>'message-form',
				'enableAjaxValidation'=>true,
			)); ?>

			<p class="note">
	<?= MessageModule::t('Fields with <span class="required">*</span> are required.'); ?>
			</p>

			<?= 
				$form->errorSummary($model, null, null, 
				array('class' => 'alert-message block-message error')); 
			?>

			<?= $form->labelEx($model,'receiver_id'); ?>
			<div class="input">
				<?= CHtml::textField('receiver', $receiverName) ?>
				<?= $form->hiddenField($model,'receiver_id'); ?>
				<?= $form->error($model,'receiver_id'); ?>
			</div>

			<?= $form->labelEx($model,'subject'); ?>
			<div class="input">
				<?= $form->textField($model,'subject'); ?>
				<?= $form->error($model,'subject'); ?>
			</div>

			<?= $form->labelEx($model,'body'); ?>
			<div class="input">
				<?= $form->textArea($model,'body'); ?>
				<?= $form->error($model,'body'); ?>
			</div>

			<div class="buttons">
				<button class="btn btn-primary">
					<i class="icon-envelope icon-white"></i>
					<?= MessageModule::t("Send") ?>
				</button>
			</div>

			<?php $this->endWidget(); ?>

		</div>
	</div>
</div>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
