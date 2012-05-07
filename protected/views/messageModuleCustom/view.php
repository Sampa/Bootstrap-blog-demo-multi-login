<?php $this->pageTitle=Yii::app()->name . ' - ' . MessageModule::t("Compose Message"); ?>
<?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>

<?php
	$this->breadcrumbs = array(
		($isIncomeMessage ? MessageModule::t("Inbox") : MessageModule::t("Sent")) => ($isIncomeMessage ? 'inbox' : 'sent'),
		CHtml::encode($viewedMessage->subject),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_styles') ?>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_flash') ?>

<div class="row">

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>
	<div class="span13">
		<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
			'id'=>'message-delete-form',
			'enableAjaxValidation'=>true,
			'action' => $this->createUrl('delete/', array('id' => $viewedMessage->id))
		)); ?>
		<?php $this->endWidget(); ?>

		<table class="bordered-table zebra-striped">
			<tr>
				<th>
					<?php if ($isIncomeMessage): ?>
						From: <?= $viewedMessage->getSenderName() ?>
					<?php else: ?>
						To: <?= $viewedMessage->getReceiverName() ?>
					<?php endif; ?>
				</th>
				<th>
					<?= CHtml::encode($viewedMessage->subject) ?>
				</th>
				<th>
					<?= date(Yii::app()->getModule('message')->dateFormat,
						strtotime($viewedMessage->created_at)); ?>
				</th>
			</tr>
			<tr>
				<td colspan="3">
					<?= CHtml::encode($viewedMessage->body); ?>
				</td>
			</tr>
		</table>

		<h2><?= MessageModule::t('Reply') ?></h2>

		<div class="form">
			<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
				'id'=>'message-form',
				'enableAjaxValidation'=>true,
			)); ?>

			<?= $form->errorSummary($message, null, null, array('class' => 'alert-message block-message error')); ?>

			<div class="input">
				<?= $form->hiddenField($message,'receiver_id'); ?>
				<?= $form->error($message,'receiver_id'); ?>
			</div>
			<?= $form->labelEx($message,'subject'); ?>
			<div class="input">

				<?= $form->textField($message,'subject'); ?>
				<?= $form->error($message,'subject'); ?>
			</div>

			<?= $form->labelEx($message,'body'); ?>
			<div class="input">
				<?= $form->textArea($message,'body'); ?>
				<?= $form->error($message,'body'); ?>
			</div>

			<div class="buttons">
				<button class="btn btn-primary"><i class="icon-white icon-repeat"></i> <?= MessageModule::t("Reply") ?></button>
				<button class="btn btn-danger"><i class="icon-white icon-remove"></i> <?= MessageModule::t("Delete") ?></button>

			</div>

			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
