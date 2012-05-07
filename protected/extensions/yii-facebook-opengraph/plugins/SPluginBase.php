<?php
/**
 * Registration class file.
 *
 * @author Evan Johnson <thaddeusmt - AT - gmail - DOT - com>
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright Copyright &copy; 2011 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2
 *
 */

/**
 * Base class for all facebook widgets.
 *
 * Initializes required properties for widgets and sets opengraph properties.
 *
 * @see http://developers.facebook.com/plugins
 * @see http://developers.facebook.com/docs/opengraph
 *
 */
abstract class SPluginBase extends CWidget
{
    /**
     * @return void Make sure that the JS SDK is enabled
     */
    public function init() {
        parent::init();
        if (!Yii::app()->facebook->jsSdk)
            throw new CException('Facebook JS SDK not enabled.');
    }


    /**
     * @param $name the name of the Facebook Social Plugin
     * @param $params the parameters for the Facebook Social Plugin
     * @return void
     */
    protected function renderTag($name, $params) {
        if (Yii::app()->facebook->html5) {
            $this->makeHtml5Tag('fb-'.$name,$params);
        } else {
            $this->makeXfbmlTag('fb:'.$name,$params);
        }
    }

    /**
     * @param $class the name of the Facebook Social Plugin
     * @param $params the parameters for the Facebook Social Plugin
     * @return void
     */
    protected function makeHtml5Tag($class, $params) {
        $newParams = array();
        foreach($params as $key=>$data) {
            $newParams["data-".$key] = $data;
        }
        $newParams['class'] = $class;
        echo CHtml::openTag('div', $newParams), CHtml::closeTag('div');
    }

    /**
     * @param $tagName the name of the Facebook Social Plugin
     * @param $params the parameters for the Facebook Social Plugin
     * @return void
     */
    protected function makeXfbmlTag($tagName, $params) {
        echo CHtml::openTag($tagName, $params), CHtml::closeTag($tagName);
    }

	/**
	 * Grabs public properties of the class for passing to the plugin creator.
	 * @return array Associative array
	 */
	protected function getParams()
	{
		$ref = new ReflectionObject($this);
		$props = $ref->getProperties(ReflectionProperty::IS_PUBLIC);

		$params = array();
		foreach ($props as $k => $v) {
			$name = $v->name;
			if ($this->$name !== null && !is_array($this->$name)) {
				if (is_bool($this->$name)) {
					$value = ($this->$name === true) ? 'true' : 'false';
				}
				else {
					$value = $this->$name;
				}
				$params[$name] = $value;
			}
		}
		return $params;
	}

}
