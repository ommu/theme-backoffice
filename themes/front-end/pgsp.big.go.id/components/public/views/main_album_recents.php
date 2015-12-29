<?php if($model != null) {?>
<div class="main albums">
	<div class="container">
		<h2><span>Photo Album</span></h2>
		<div class="clearfix">
			<?php
			//for($i=1;$i<=4;$i++) {
			foreach($model as $key => $val) {
				if($val->media_id != 0)
					$images = Yii::app()->request->baseUrl.'/public/album/'.$val->album_id.'/'.$val->cover->media;
				else					
					$images = Yii::app()->request->baseUrl.'/public/album/album_default.png';?>
				<div class="box">
					<a class="photo" href="<?php echo Yii::app()->createUrl('album/view', array('id'=>$val->album_id, 't'=>Utility::getUrlTitle($val->title)))?>" title="<?php echo $val->title?>"><img src="<?php echo Utility::getTimThumb($images, 180, 220, 1)?>" alt="<?php echo $val->title?>" /></a>
					<div class="span">
						<div class="meta">
							<a href="<?php echo Yii::app()->createUrl('album/view', array('id'=>$val->album_id, 't'=>Utility::getUrlTitle($val->title)))?>" title="<?php echo $val->title?>"><?php echo $val->title?><?php echo $val->title?><?php echo $val->title?></a>
							<div class="date">
								<i class="fa fa-calendar-check-o"></i><?php echo Utility::dateFormat($val->creation_date);?>
								<i class="fa fa-bookmark-o"></i><?php echo $val->user->displayname;?>
								<i class="fa fa-eye"></i><?php echo $val->view?>
							</div>
						</div>
						<p><?php echo Utility::shortText(Utility::hardDecode($val->body),60);?></p>
						<a class="readmore" href="<?php echo Yii::app()->createUrl('album/view', array('id'=>$val->album_id, 't'=>Utility::getUrlTitle($val->title)))?>" title="<?php echo $val->title?>">Selengkapnya</a>
					</div>
				</div>
			<?php }
			//}?>
		</div>
	</div>
</div>
<?php }?>