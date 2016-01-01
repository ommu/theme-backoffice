<?php if($model != null) {?>
	<ul>
		<?php 
		foreach($model as $key => $val) {?>
			<li><a href="<?php echo Yii::app()->createUrl('article/site/view', array('id'=>$val->article_id, 't'=>Utility::getUrlTitle($val->title)))?>" title="<?php echo $val->title?>"><?php echo $val->title?></a></li>
		<?php }?>
	</ul>
<?php }?>