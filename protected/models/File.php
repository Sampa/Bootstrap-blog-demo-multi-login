<?php class File {


public function getFiles($dir, $order=""){
		$dir = Yii::app()->getBasePath()."/../".$dir;
		if ( !is_dir( $dir ) )
				mkdir($dir,0777,true); 
		$files = array_diff(scandir($dir,$order), array('..', '.'));

		return $files;
	
	}


}