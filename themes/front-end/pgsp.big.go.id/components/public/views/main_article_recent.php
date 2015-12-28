<?php if($model != null) {?>
<div class="main article">
	<div class="container">
		<h2><span><?php echo Phrase::trans(1531, 2);?></span></h2>
		<div class="clearfix">
			<?php 
			$i = 0;
			foreach($model as $key => $val) {
				$i++;
				if($val->media_id != 0)
					$images = Yii::app()->request->baseUrl.'/public/article/'.$val->article_id.'/'.$val->cover->media;
				else
					$images = Yii::app()->request->baseUrl.'/public/article/article_default.png';?>
				<div class="box">
					<div class="number"><?php echo '.0'.$i;?></div>
					<a class="photo" href="<?php echo Yii::app()->createUrl('article/site/view', array('id'=>$val->article_id, 't'=>Utility::getUrlTitle($val->title)))?>" title="<?php echo $val->title?>"><img src="<?php echo Utility::getTimThumb($images, 300, 200, 1)?>" alt="<?php echo $val->title?>" /></a>
					<div class="span">
						<div class="meta">
							<a href="<?php echo Yii::app()->createUrl('article/site/view', array('id'=>$val->article_id, 't'=>Utility::getUrlTitle($val->title)))?>" title="<?php echo $val->title?>"><?php echo $val->title?></a>
							<div class="date">
								<i class="fa fa-calendar-check-o"></i><?php echo Utility::dateFormat($val->published_date);?>
								<i class="fa fa-bookmark-o"></i><?php echo $val->user->displayname;?>
								<i class="fa fa-eye"></i><?php echo $val->view?>
							</div>	
						</div>
						<p><?php echo Utility::shortText(Utility::hardDecode($val->body),120);?></p>
						<a class="readmore" href="<?php echo Yii::app()->createUrl('article/site/view', array('id'=>$val->article_id, 't'=>Utility::getUrlTitle($val->title)))?>" title="<?php echo $val->title?>">Selengkapnya</a>
					</div>
				</div>
			<?php if($i == 1) {?>
				<div class="clear"></div>
			<?php }
			}?>
		</div>	
	</div>
</div>
<?php }?>