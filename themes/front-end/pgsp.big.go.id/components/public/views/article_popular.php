<?php if($model != null) {?>
<div class="box">
	<h3>Artikel Terpopuler</h3>
	<ul>
		<?php 
		foreach($model as $key => $val) {?>
			<li><a href="<?php echo Yii::app()->createUrl('article/site/view', array('id'=>$val->article_id, 't'=>Utility::getUrlTitle($val->title)))?>" title="<?php echo $val->title?>"><span><i class="fa fa-eye"></i><?php echo $val->view?></span><?php echo $val->title?></a></li>
		<?php }?>
	</ul>
</div>
<?php }?>