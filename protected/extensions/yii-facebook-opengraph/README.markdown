### This is mainly a wrapper for the Facebook PHP SDK class.

### You can also use it to include the Facebook JS SDK on your pages, and easily set Open Graph meta tags.

### Also included are helper widgets for all of the Facebook Social Plugins.

Facebook PHP SDK:
http://developers.facebook.com/docs/reference/php/
https://github.com/facebook/php-sdk

Facebook JS SDK:
http://developers.facebook.com/docs/reference/javascript/

Facebook Social Plugins:
http://developers.facebook.com/docs/reference/plugins

Open Graph Protocol:
http://developers.facebook.com/docs/opengraph/

A lot of this comes from forking ianare's faceplugs Yii extension:
http://www.yiiframework.com/extension/faceplugs
https://github.com/digitick/yii-faceplugs

* * *

INSTALLATION:
---------------------------------------------------------------------------

Copy the file "facebook-channel.php" to your project root.

Copy the rest of this extension in to your project's protected/extensions directory.

Include the extension in your Yii config:

    'components'=>array(
      'facebook'=>array(
        'class' => 'ext.yii-facebook-opengraph.SFacebook',
        'appId'=>'YOUR_FACEBOOK_APP_ID', // needed for JS SDK, Social Plugins and PHP SDK
        'secret'=>'YOUR_FACEBOOK_APP_SECRET', // needed for the PHP SDK
        //'locale'=>'en_US', // override locale setting (defaults to en_US)
        //'jsSdk'=>true, // don't include JS SDK
        //'async'=>true, // load JS SDK asynchronously
        //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
        //'status'=>true, // JS SDK - check login status
        //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
        //'oauth'=>true,  // JS SDK -enable OAuth 2.0
        //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
        //'html5'=>true,  // use html5 Social Plugins instead of XFBML
        //'ogTags'=>array(  // set default OG tags
            //'title'=>'MY_WEBSITE_NAME',
            //'description'=>'MY_WEBSITE_DESCRIPTION',
            //'image'=>'URL_TO_WEBSITE_LOGO',
        //),
      ),
    ),

Then, in your base Controller, add this function to override the afterRender callback:

    protected function afterRender($view, &$output) {
      parent::afterRender($view,$output);
      //Yii::app()->facebook->addJsCallback($js); // use this if you are registering any $js code you want to run asyc
      Yii::app()->facebook->initJs($output); // this initializes the Facebook JS SDK on all pages
      Yii::app()->facebook->renderOGMetaTags(); // this renders the OG tags
      return true;
    }

* * *

USAGE:
---------------------------------------------------------------------------

Setting OG tags on a page (in view or action):

    <?php Yii::app()->facebook->ogTags['title'] = "My Page Title"; ?>

Render Facebook Social Plugins using helper Yii widgets:

    <?php $this->widget('ext.yii-facebook-opengraph.plugins.LikeButton', array(
       //'href' => 'YOUR_URL', // if omitted Facebook will use the OG meta tag
       'show_faces'=>true,
       'send' => true
    )); ?>

You can, of course, just use the code for this as well if loading the JS SDK on all pages
using the initJs() call in afterRender():

    <div class="fb-like" data-send="true" data-width="450" data-show-faces="true"></div>

To use the PHP SDK anywhere in your application, just call it like so (there pass-through the Facebook class):

    <?php $userid = Yii::app()->facebook->getUser() ?>
    <?php $loginUrl = Yii::app()->facebook->getLoginUrl() ?>
    <?php $results = Yii::app()->facebook->api('/me') ?>

I also created a couple of little helper functions:

    <?php $userinfo = Yii::app()->facebook->getInfo() // gets the Graph info of the current user ?>
    <?php $imageUrl = Yii::app()->facebook->getProfilePicture($size) // gets the Facebook picture URL of the current user ?>
    <?php $userinfo = Yii::app()->facebook->getInfoById($openGraphId) // gets the Graph info of a given OG entity ?>
    <?php $imageUrl = Yii::app()->facebook->getProfilePictureById($openGraphId) // gets the Facebook picture URL of a given OG entity ?>

* * *

I plan on continuing to update and bugfix this extension as needed.

Please log bugs to the GitHub tracker here.

Extension is posted on Yii website also:
http://www.yiiframework.com/extension/facebook-opengraph/

Updated 01/04/2012 by Evan Johnson
http://splashlabsocial.com
