<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:inbox"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Inbox"),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>

<h2><?php echo MessageModule::t('Inbox'); ?></h2>

<?php if ($messagesAdapter->data): ?>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>

	<table class="dataGrid">
		<tr>
			<th  class="label">From</th>
			<th  class="label">Subject</th>
			<th  class="label">Date</th>
		</tr>
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr class="<?php echo $message->is_read ? 'read' : 'unread' ?>">
				<td>
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
					<?php echo $message->getSenderName(); ?>
				</td>
				<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
				<td><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
			</tr>
		<?php endforeach ?>
	</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton(MessageModule::t("Delete Selected")); ?>
	</div>

<?php $this->endWidget(); ?>
	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php endif; ?>
