<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<h1>Contact Us</h1>

<?php if (Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="form">

        <?php
        $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id' => 'login-form',
            'type' => 'horizontal',
            'htmlOptions' => array('class' => 'well'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
                ));
        ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'name'); ?>
        <?php echo $form->textFieldRow($model, 'email'); ?>
        <?php echo $form->textFieldRow($model, 'subject', array('class' => 'input-medium')); ?>
        <?php echo $form->textAreaRow($model, 'body', array('class' => 'span8', 'rows' => 5)); ?>

        <?php if (CCaptcha::checkRequirements()): ?>
            <?php echo $form->captchaRow($model, 'verifyCode'); ?>
        <?php endif; ?>

        <?php echo CHtml::htmlButton('<i class="icon-ok icon-white"></i> Send', array('class' => 'btn btn-primary', 'type' => 'submit')); ?>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

<?php endif; ?>