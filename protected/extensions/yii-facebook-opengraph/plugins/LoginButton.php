<?php
/**
 * LoginButton class file.
 *
 * @author Evan Johnson <thaddeusmt - AT - gmail - DOT - com>
 * @author Ianaré Sévi (original author) www.digitick.net
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright Copyright &copy; 2011 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2
 *
 */

require_once 'SPluginBase.php';

/**
 * The Login Button shows profile pictures of the user's friends who have
 * already signed up for your site in addition to a login button.
 *
 * @see http://developers.facebook.com/docs/reference/plugins/login
 */
class LoginButton extends SPluginBase
{
	/**
	 * @var string The URL of the page.
	 *
	 * The plugin will display photos of users who have liked this page.
	 */
	public $show_faces;
  /**
	 * @var integer The width of the plugin in pixels. Default width: 200px.
	 */
	public $width;
	/**
	 * @var integer The maximum number of rows of profile pictures to display.
	 * Default value: 1.
	 */
	public $max_rows;
	/**
	 * @var string A comma separated list of extended permissions.
	 *
	 * By default the Login button prompts users for their public information.
	 * If your application needs to access other parts of the user's profile
	 * that may be private, your application can request extended permissions.
	 *
	 * @see http://developers.facebook.com/docs/authentication/permissions/
	 */
	public $scope;
  /**
	 * @var string registration page url. If the user has not registered for your
   * site, they will be redirected to the URL you specify in the registration-url
   * parameter.
	 */
	public $registration_url;

	public function run()
	{
		parent::run();
		$params = $this->getParams();
		$this->renderTag('login-button',$params);
	}

}
