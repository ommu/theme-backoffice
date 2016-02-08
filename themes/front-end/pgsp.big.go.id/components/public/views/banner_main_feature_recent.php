<?php if($model != null) {?>
<div class="main banner-feature">
	<div class="container">
		<h2><span>Fitur</span></h2>
		<div class="table">
		<?php foreach($model as $key => $val) {
			$extension = pathinfo($val->media, PATHINFO_EXTENSION);
			if(!in_array($extension, array('bmp','gif','jpg','png')))
				$images = Yii::app()->request->baseUrl.'/public/banner/'.$val->media;
			else
				$images = Yii::app()->request->baseUrl.'/public/banner/'.$val->media;
			?>
			<div class="cell">
				<?php if($val->url != '-') {?>
					<a href="<?php echo Yii::app()->createUrl('banner/site/click', array('id'=>$val->banner_id, 't'=>Utility::getUrlTitle($val->title)))?>" title="<?php echo $val->title?>"><img src="<?php echo $images;?>" alt="<?php echo $val->title?>" /></a>
				<?php } else {?>
					<img src="<?php echo $images;?>" alt="<?php echo $val->title?>" />
				<?php }?>
			</div>
		<?php }?>		
		</div>
	</div>
</div>
<?php }?>