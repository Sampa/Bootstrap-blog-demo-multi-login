<?php // This is the file library shown on User profile
	$dir = new File; 
	$path = User::USER_DIR . $model->id;
	$files = $dir->getFiles( $path , 1 );
	$count = 0;
	$imgExtentions = array('jpeg' , '.png' , '.jpg' , '.gif' , '.png' );
	$ignore = array('.tmb','.dll');
	$items = array();
	foreach( $files as $file )
	{	

		$fileExt = strtolower( substr( $file , -4 , 4 ) );
		if ( !is_dir( '.' . $path .'/'. $file ) )
		{ 
		$fileName = $file;
		
			if ( in_array( $fileExt , $imgExtentions ) )
			{
				//$fileName = '<img  style="min-width: 150px; min-height="100px" src="' . $path .'/'. $file . '" alt="picture"/>';
				$items[] = array('image'=>$path .'/'. $file, 'label'=>$file,'caption'=>'');
			}
			if ( !in_array( $fileExt , $ignore ) )
			{
				/*echo '<li class="span2" style="display:inline">';
					echo CHtml::link( $fileName, array( $path . '/' . $file ),array( 'class'=>'filename thumbnail', 'rel'=>'fancybox' ) );
				echo '</li>';*/
			}
		$count++;
		}
	}
?>
<?php $this->widget('bootstrap.widgets.BootCarousel', array(
    'items'=>$items,
    'events'=>array(
        'slide'=>"js:function() { console.log('Carousel slide.'); }",
        'slid'=>"js:function() { console.log('Carousel slid.'); }",
    ),
)); ?>