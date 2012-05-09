<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css"  />
		
	<?php  //helps using more jQuery stuff on same page 
		$scriptmap=Yii::app()->clientScript;
		$scriptmap->scriptMap=array(
				'jquery.min.js'=>'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',

				);
	?>
    <script src="https://browserid.org/include.js" type="text/javascript"></script>  

    </head>
    <body>
        <div id="wrapper"  style="display:block;">
            <div id="header" class="container-fluid">
                <div id="logo"><h1><?php echo CHtml::encode(Yii::app()->name); ?></h1></div>
				<?php if ( Yii::app()->user->isGuest ): ?>
				<!-- facebook login-->
				<div style="border: 0px solid black; position:absolute; left:88%; top:0px;">
				<a  id="fb-login">
				<img src="http://worldthissecond.com/wp-content/themes/tribune/images/icons/facebook.png" alt="facebook"/>
				</a>
				<!-- browserID aka Mozilla persona login -->
				<a href="#" id="browserid" title="Sign-in with BrowserID">  
				<!--red/orange/green/blue/grey -->
				<img src="/images/sign_in_red.png" alt="Sign in">  
				</a>  
				</div>
				<?php endif; ?>
            </div><!-- header -->

            <div id="mainmenu">
			<?php 
			$facebookid=true;
			if ( Yii::app()->facebook->getUser() == 0){
				$facebookid=false;
			}
			if ( Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->id) > 0 )
				{
				$unreadCount = '<span class="badge badge-success">' . Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->id) . '</span>'; 
				}else{
					$unreadCount = false;
				}

                $this->widget('bootstrap.widgets.BootNavbar', array(
                    'brand' => false,
                    'fixed' => false,
                    'fluid' => true,
                    'collapse' => true,
                    'items' => array(
                        array(
                            'class' => 'bootstrap.widgets.BootMenu',
                            'items' => array(
                                array('label' => 'Home', 'url' => array('/post/index')),
                                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                                array('label' => 'Two Columns', 'url' => array('/site/twoColumns')),
                                array('label' => 'Contact', 'url' => array('/site/contact')),
                                array('label' => 'Blog admin', 'url' => array('/post/admin')),

                            ),
                        ),
					array(
					'class' => 'bootstrap.widgets.BootMenu',
					'htmlOptions' => array('class' => 'pull-right'),
					'items' => array(
						array('label' => 'Login', 
						'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
						array(
							'label' => 'Welcome ' . Yii::app()->user->name,
							'url' =>'#',
							'visible' => !Yii::app()->user->isGuest,
							'items' => array(
							array('label'=>'<i class="icon-envelope"></i>'.$unreadCount,
							'encodeLabel'=>false,
							'url'=>Yii::app()->getModule('message')->inboxUrl,
							'visible' => !Yii::app()->user->isGuest),
							array('label'=>'<i class="icon-envelope"></i>Sent', 
							'encodeLabel'=>false,
							'url'=>Yii::app()->getModule('message')->sentUrl),
							array('label'=>'<i class="icon-envelope"></i>New',
							'url'=>Yii::app()->getModule('message')->composeUrl,
							'encodeLabel'=>false),
							array('label'=>'Profile',
								'url'=>array(  User::getUserUrl( Yii::app()->user->name ) )),
							array('label'=>'Update',
								'url'=>array( '//user/update/id/' . Yii::app()->user->id ) ), 
							array('label'=>'Logout', 'url'=>array('/site/logout')), 
							array('label'=>'Logout from facebook',
	'url'=>'https://www.facebook.com/logout.php?access_token='.Yii::app()->facebook->getAccessToken().'&amp;confirm=1&amp;next=http://ENTER YOUR REGISTRED FB URL/site/logout','visible'=>$facebookid,
									),
                                 ),
                               ),
                            ),
                        ),
                    )));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs) && !empty($this->breadcrumbs)): ?>
                <div id="breadcrumbs-container">
                    <?php
                    $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?>
                    <div class="clear"></div>
                </div>
            <?php endif ?>
            <div id="content">
                <div class="container-fluid">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="container-fluid">
                Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </div>
        </div><!-- footer -->
			<script type="text/javascript">

			jQuery(function($) {  
			  var loggedIn = function(res) {

				if (res.returnURI) {
				  window.location.assign(res.returnURI);
				} else {
				  window.location.reload(true);
				}
			  };
			  var loggedOut = function(res) {
			  };

			  var gotAssertion = function(assertion) {
				// got an assertion, now send it up to the server for verification
				if (assertion) {
				  $.ajax({
					type: 'POST',
					url: '/user/persona',
					data: { assertion: assertion },
					success: function(res, status, xhr) {
					  if (res === null) {
						loggedOut();
					  }
					  else {
						loggedIn(res);
					  }
					},
					error: function(res, status, xhr) {
					  alert("Whoops, I failed to authenticate you! " + res.responseText);
					}
				  });
				} else {
				  loggedOut();
				}
			  }

			  $('#browserid').click(function() {
				navigator.id.get(gotAssertion, {allowPersistent: true});
				return false;
			  });

			  // Query persistent login.
			  var login = $('head').attr('data-logged-in');
			  if (login === "false") {
				navigator.id.get(gotAssertion, {silent: true});
			  }
			});
			</script>
				<script type="text/javascript">
			 $("#fb-login").click(function(){
			 FB.login(function(response) {
			   if (response.authResponse) {
				 $("#conf").html('Welcome!  Fetching your information.... ');
				 FB.api('/me', function(response) {
				   $("#conf").append('Good to see you, ' + response.name + '.');
				  
				   window.location.replace('/user/addUser');
				 });
			   } else {
			  /*   console.log('User cancelled login or did not fully authorize.');*/
			   }
			 });
			 });
			 </script>
    </body>
</html>
