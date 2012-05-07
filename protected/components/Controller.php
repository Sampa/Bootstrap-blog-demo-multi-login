<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
			/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $clip = "system.web.widgets.CClipWidget";
	public function init()
    {
	parent::init();

	if ( !isset($_GET['logout']) )
		{
			
				$this->facebookCheck();
		}else
		{
			if( isset($_GET['logout']) && $_GET['logout'] == "true" )
			{

			}
		}
	}
	protected function afterRender($view, &$output)
	{
		parent::afterRender($view,$output);
		//Yii::app()->facebook->addJsCallback($js); // use this if you are registering any $js code you want to run asyc
		Yii::app()->facebook->initJs($output); // this initializes the Facebook JS SDK on all pages
		Yii::app()->facebook->renderOGMetaTags(); // this renders the OG tags
		return true;
	}
	public function facebookCheck()
	{

		if ( Yii::app()->user->isGuest )
		{

			$userid = Yii::app()->facebook->getUser();
			if ( $userid > 0) //if the user is logged in vya facebook
			{
				$user = User::model()->find('facebook='.$userid); 

				if( $user )
					$this->autoLogin($user); 
			}
		}
	}
	
	public function autoLogin($user)
	{
	$identity=new UserIdentity($user->username, "");
	$identity->authenticate();
	$identity->social($user->username);
	if ( $identity->errorCode == UserIdentity::ERROR_NONE )
		{
			$duration= 3600*24*30; // 30 days
			Yii::app()->user->login($identity,$duration);
			$this->redirect("/profile/u/".$user->username);
		}
		else
		{
		 echo $identity->errorCode;
		}
	
	}
	public function ajaxDelete( $id , $model )
	{
		if ( Yii::app()->request->isAjaxRequest )
		{
			
				if ( $model::loadModel( $id )->delete() )
				{
					echo CJSON::encode(
						array(
							'status'=>'success', 
							'div'=>'Deleted...',	
							));
					exit;
				}
			
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

	}
	protected function performAjaxValidation( $model , $form)
	{
		if ( isset ( $_POST['ajax'] ) && $_POST['ajax']===$form )
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
	}
	
	public function actionMakePdf()
	{
		
	$mPDF1 = Yii::app()->ePdf->mpdf();
 
        // You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        // render (full page)
       
 
        // Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        // renderPartial (only 'view' of current controller)
 
        // Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.png' ));
 
        // Outputs ready PDF
       return  $mPDF1;


	}
}