<!--
 * Ajax Crud Administration Form
 * Post *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
<div id="post_form_con" class="client-val-form well">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header">Create New Post</h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header">Update Post <?php  echo
        $model->id;  ?>  </h3>
    <?php   endif;  ?>
    <?php      $val_error_msg = 'Error.Post was not saved.';
    $val_success_message = ($model->isNewRecord) ?
            'Post was created successfuly.' :
            'Post  was updated successfuly.';
  ?>

    <div id="success-note" class="notification success png_bg"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png';  ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php   echo $val_success_message;  ?>        </div>
    </div>

    <div id="error-note" class="notification errorshow png_bg"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png';  ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php   echo $val_error_msg;  ?>        </div>
    </div>

    <div id="ajax-form"  class='form'>
<?php   
	$formId='post-form';
	$actionUrl =
   ($model->isNewRecord)?CController::createUrl('post/ajax_create')
                                                                 :CController::createUrl('post/ajax_update');

	
	$js_afterValidate = null;
    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'post-form',
    //  'htmlOptions' => array('enctype' => 'multipart/form-data'),
         'action' => $actionUrl,
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
		'focus'=>array($model,'name'),
		'errorMessageCssClass' => 'input-notification-error  error-simple png_bg',
		'clientOptions'=>array('
						validateOnSubmit'=>true,
						'validateOnType'=>true,
						'afterValidate'=>$js_afterValidate,
						'errorCssClass' => 'err',
						'successCssClass' => 'suc',
						'afterValidate' => 'js:function(form,data,hasError){ $.js_afterValidate(form,data,hasError);  }',
						 'errorCssClass' => 'err',
						'successCssClass' => 'suc',
						'afterValidateAttribute' => 'js:function(form, attribute, data, hasError){
                                                                                                 $.js_afterValidateAttribute(form, attribute, data, hasError);
                                                                                                                            }'
                                                                             ),
));

     ?>
    <?php echo $form->errorSummary($model, '
    <div style="font-weight:bold">Please correct these errors:</div>
    ', NULL, array('class' => 'errorsum notification errorshow png_bg')); ?>    <p class="note">Fields with <span class="required">*</span> are required.</p>


    <div class="row-fluid">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
        <span id="success-Post_title"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'title'); ?>
    </div>

        <div class="row-fluid">
            <?php echo $form->labelEx($model,'content'); ?>
            <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
        <span id="success-Post_content"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'content'); ?>
    </div>

        <div class="row-fluid">
            <?php echo $form->labelEx($model,'tags'); ?>
        <?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'tags',
			'url'=>array('suggestTags'),
			'multiple'=>true,
			'htmlOptions'=>array('size'=>50),
		)); ?>
		<p class="hint">Please separate different tags with commas.</p>
        <span id="success-Post_tags"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'tags'); ?>
    </div>

    <div class="row-fluid">
            <?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->dropDownList($model,'status',Lookup::items('PostStatus')); ?>

        <span id="success-Post_status"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'status'); ?>
    </div>

        

       

       

    
    <input type="hidden" name="YII_CSRF_TOKEN"
           value="<?php echo Yii::app()->request->csrfToken; ?>"/>

    <?php  if (!$model->isNewRecord): ?>    <input type="hidden" name="update_id"
           value=" <?php echo $model->id; ?>"/>
    <?php endif; ?>
    <div class="row-fluid">
        <?php   echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',array('class' =>
        'btn btn-primary ')); ?>    </div>

  <?php  $this->endWidget(); ?></div>
    <!-- form -->

</div>
<script type="text/javascript">

    //Close button:

    $(".close").click(
            function () {
                $(this).parent().fadeTo(400, 0, function () { // Links with the class "close" will close parent
                    $(this).slideUp(600);
                });
                return false;
            }
    );


</script>


