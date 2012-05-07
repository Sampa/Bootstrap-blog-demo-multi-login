<?php
	if ( Yii::app()->user->id !== $id )
	{
		echo '<div id="req_res">';

		echo CHtml::ajaxLink(
			'<i class="icon-white icon-plus"></i>'.
			$reputation,          // the link body (it will NOT be HTML-encoded.)
			array('user/reputation/id/'.$id), 
			// the URL for the AJAX request. If empty, it is assumed to be the current URL.
			array(
				'update'=>'#req_res',
			),
			array('class'=>'btn btn-success')
		);
		echo '</div>';
	}
	?>