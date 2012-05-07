<div class="well">
	<?php foreach($this->getRecentComments() as $comment): ?>
	<?php echo $comment->authorLink; ?> on
		<?php echo CHtml::link(CHtml::encode($comment->post->title), $comment->getUrl()); ?>
		<br/>
	<?php endforeach; ?>
</div>