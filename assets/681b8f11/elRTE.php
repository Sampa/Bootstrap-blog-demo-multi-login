<?php

/**
 * elRTE is an input widget based on elRTE editor http://elrte.org
 * @author luxurydab (Anton Logvinenko)
 * 
 */
class elRTE extends CInputWidget
{
    public $doctype = '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">';
    public $cssClass = 'el-rte';
    public $absoluteURLs = 'false';
    public $allowSource = 'false';
    public $lang;
    public $styleWithCSS = 'true';
    public $height = '100px';
    public $width  = '500px';
    public $fmAllow = 'true';
    public $toolbar = 'maxi';
    public $baseUrl;
    public $selector;
    public $userid;
    public function init()
    {            
        $dir = dirname(__FILE__).DIRECTORY_SEPARATOR;                       
        $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);

        $ClientScript = Yii::app()->getClientScript();        
        $ClientScript->registerCoreScript('jquery');               
        $ClientScript->registerScriptFile("{$this->baseUrl}/js/jquery-ui-1.8.13.custom.min.js");
        $ClientScript->registerScriptFile("{$this->baseUrl}/js/elrte.full.js");             
        $ClientScript->registerCssFile("{$this->baseUrl}/css/smoothness/jquery-ui-1.8.13.custom.css");
        $ClientScript->registerCssFile("{$this->baseUrl}/css/elrte.min.css");
        $ClientScript->registerCssFile("{$this->baseUrl}/css/elrte-inner.css");       
        $ClientScript->registerCssFile("{$this->baseUrl}/css/elfinder.css");          
        $ClientScript->registerScriptFile("{$this->baseUrl}/js/elfinder.min.js");

        if ( isset($this->lang) && $this->lang != 'en')
        {
            $ClientScript->registerScriptFile("{$this->baseUrl}/js/i18n/elrte.$this->lang.js");
            $ClientScript->registerScriptFile("{$this->baseUrl}/js/i18n/elfinder.$this->lang.js");
        }
        
  
    }
         
    public function generateOptions()
    {
        $options = "{ \n";
        $options .= "  'doctype': '$this->doctype', \n";
        $options .= "  'cssClass':'$this->cssClass', \n";
        if ( isset($this->height))
        {
            $options .= "  'height': '$this->height', \n";
        }        
        if ( isset($this->width))
        {
            $options .= "  'width': '$this->width', \n";
        }        
        $options .= "  'toolbar': '$this->toolbar', \n";
        if ( isset($this->lang) && $this->lang != 'en')
        {
            $options .= "  'lang': '$this->lang', \n";
        }        
        $options .= "  'absoluteURLs': $this->absoluteURLs, \n";
        $options .= "  'allowSource': $this->allowSource, \n";
        $options .= "  'styleWithCSS': $this->styleWithCSS, \n";
        $options .= "  'fmAllow': $this->fmAllow, \n";
        $options .= "  'cssfiles':['{$this->baseUrl}/css/elrte-inner.css'], \n";
        $options .= "  'fmOpen' : function(callback) { \n";
        $options .= "      $('<div id=\"$this->selector\" />').elfinder({ \n";
        $options .= "         'url' : '{$this->baseUrl}/connectors/php/connector.php?userid={$this->userid}', \n";
        $options .= "         'dialog' : { width : 900, modal : true, title : 'Files' }, \n";
        if ( isset($this->lang) && $this->lang != 'en')
        {
            $options .= "         'lang': '$this->lang', \n";
        } 
        $options .= "         'closeOnEditorCallback' : true, \n";
        $options .= "         'editorCallback' : callback \n";
        $options .= "      })";
        $options .= "  }";
        $options .= "} ";

        return $options;     
    }
    
    private function initEditor()
    {                
        $options = $this->generateOptions();
                
        $js = "$().ready(function() { \n";
        $js .= "elRTE.prototype.options.panels.myToolbar = ['bold', 'italic', 'underline',
            'strikethrough','justifyleft','justifyright', 'justifycenter', 'justifyfull',
            'insertorderedlist', 'insertunorderedlist', 'docstructure','paste','removeformat','link','unlink', 'elfinder', 'image', 'fullscreen']; \n";
        $js .= "elRTE.prototype.options.toolbars.myToolbar = ['myToolbar']; \n";
        $js .= "var opts = $options";
        $js .= "; \n";    
        $js .= "$('".$this->selector."').elrte(opts);";
        $js .= "});";

        Yii::app()->clientScript->registerScript("Yii.elRTE_.$this->selector.",$js,CClientScript::POS_BEGIN);
    }
    
    public function run()
    {
        $this->initEditor();
    }
}

?>

