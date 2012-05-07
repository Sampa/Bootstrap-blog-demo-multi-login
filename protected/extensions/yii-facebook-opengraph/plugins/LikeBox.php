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
class LikeBox extends SPluginBase
{
	/**
	 * @var string The URL of the Facebook page for this Like Box.
	 */
	public $href;
  /**
	 * @var integer The width of the plugin in pixels. Default width: 300px.
	 */
	public $width;
	/**
	 * @var integer The height of the plugin in pixels.
	 */
	public $height;
  /**
	 * @var string The color scheme for the plugin. Options: 'light', 'dark'
	 */
	public $colorscheme;
	/**
	 * @var boolean Display profile photos in the plugin.
	 */
	public $show_faces;
	/**
	 * @var boolean Specifies whether to display a stream of the latest posts
	 * from the page's wall.
	 */
	public $stream;
	/**
	 * @var boolean Specifies whether to display the Facebook header at the
	 * top of the plugin.
	 */
	public $header;
  /**
	 * @var string The border color of the plugin.
	 */
	public $border_color;
	/**
	 * @var boolean for Places, specifies whether the stream contains posts
	 * from the Place's wall or just checkins from friends. Default value: false.
	 */
	public $force_wall;

	public function run()
	{
		parent::run();
		if (!isset($this->profile_id)) {
			$this->profile_id = Yii::app()->facebook->appId;
		}
		$params = $this->getParams();
		$this->renderTag('like-box',$params);
	}
}
