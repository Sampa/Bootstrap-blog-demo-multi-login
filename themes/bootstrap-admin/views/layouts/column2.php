<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
    <div id="sidebar" class="span3">
		
        <div class="well" style="padding: 8px 0;">
            <?php
            $this->widget('bootstrap.widgets.BootMenu', array(
                'type' => 'list',
                'items' => $this->menu,
            ));
            ?>
        </div>
		<?php if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); ?>

			<?php $this->widget('TagCloud', array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			)); ?>

			<?php $this->widget('RecentComments', array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			)); ?>
    </div>
    <div id="content" class="span9">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>