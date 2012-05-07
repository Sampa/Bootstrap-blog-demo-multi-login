<?php
/**
 * LikeBox class file.
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
 * The Like Box is a social plugin that enables Facebook Page owners to
 * attract and gain Likes from their own website.
 *
 * The Like Box enables users to:
 * <ul>
 * <li>See how many users already like this page, and which of their friends like it too
 * <li>Read recent posts from the page
 * <li>Like the page with one click, without needing to visit the page
 * </ul>
 *
 * @see http://developers.facebook.com/docs/reference/plugins/like
 */
class SendButton extends SPluginBase
{
	/**
	 * @var string The URL of the Facebook page for this Like Box.
	 */
	public $href;
  /**
	 * @var string the font to display in the button. Options: 'arial',
   * 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
	 */
	public $font;
  /**
	 * @var string The color scheme for the plugin. Options: 'light', 'dark'
	 */
	public $colorscheme;
  /**
	 * @var string a label for tracking referrals; must be less than 50 characters
   * and can contain alphanumeric characters and some punctuation (currently +/=-.:_).
   * The ref attribute causes two parameters to be added to the referrer URL when
   * a user clicks a link from a stream story about a Send action:
   * fb_ref and fb_source
	 */
	public $ref;

	public function run()
	{
		parent::run();
		if (!isset($this->profile_id)) {
			$this->profile_id = Yii::app()->facebook->appId;
		}
		$params = $this->getParams();
		$this->renderTag('send',$params);
	}
}
