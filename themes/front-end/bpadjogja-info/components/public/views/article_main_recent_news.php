<?php
/**
 * @var $this SiteController
 * @var $dataProvider CActiveDataProvider
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 */
?>

<?php if($model != null) {?>
<div class="box">
	<div class="title clearfix">
		<h2><?php echo Phrase::trans(1531, 2)?></h2>
		<a href="<?php echo Yii::app()->createUrl('article/news/site/index');?>" title="View <?php echo Phrase::trans(1531, 2)?>">More</a>
	</div>
	
	<?php if($model[0]->media_id != 0)
		$images = Yii::app()->request->baseUrl.'/public/article/'.$model[0]->article_id.'/'.$model[0]->cover->media;
	else
		$images = Yii::app()->request->baseUrl.'/public/article/article_default.png'; ?>
	<div class="sep full">
		<a class="images" href="<?php echo Yii::app()->createUrl('article/news/site/view', array('id'=>$model[0]->article_id,'t'=>Utility::getUrlTitle($model[0]->title)));?>" title="<?php echo $model[0]->title;?>">
			<img src="<?php echo Utility::getTimThumb($images, 600, 250, 1);?>" alt="<?php echo $model[0]->title;?>" />
		</a>
		<a class="title" href="<?php echo Yii::app()->createUrl('article/news/site/view', array('id'=>$model[0]->article_id,'t'=>Utility::getUrlTitle($model[0]->title)));?>" title="<?php echo $model[0]->title;?>"><?php echo $model[0]->title;?></a>
		<div class="meta-date clearfix">
			<span class="date"><i class="fa fa-calendar"></i>&nbsp;<?php echo Utility::dateFormat($model[0]->published_date, true);?></span>
			<span class="view"><i class="fa fa-eye"></i>&nbsp;<?php echo $model[0]->view;?></span>
		</div>
		<p><?php echo Utility::shortText(Utility::hardDecode($model[0]->body),250);?></p>
	</div>
	
	<div class="list-view clearfix">
		<?php 
		$j=0;
		foreach($model as $key => $row) {
		$j++;
			if($row->media_id != 0)
				$images = Yii::app()->request->baseUrl.'/public/article/'.$row->article_id.'/'.$row->cover->media;
			else
				$images = Yii::app()->request->baseUrl.'/public/article/article_default.png';
			if($j >= 2) {?>
			<div class="sep">
				<a class="images" href="<?php echo Yii::app()->createUrl('article/news/site/view', array('id'=>$row->article_id,'t'=>Utility::getUrlTitle($row->title)));?>" title="<?php echo $row->title;?>">
					<img src="<?php echo Utility::getTimThumb($images, 300, 150, 1);?>" alt="<?php echo $row->title;?>" />
				</a>
				<a class="title" href="<?php echo Yii::app()->createUrl('article/news/site/view', array('id'=>$row->article_id,'t'=>Utility::getUrlTitle($row->title)));?>" title="<?php echo $row->title;?>"><?php echo Utility::shortText(Utility::hardDecode($row->title),40);?></a>
				<div class="meta-date clearfix">
					<span class="date"><i class="fa fa-calendar"></i>&nbsp;<?php echo Utility::dateFormat($row->published_date, true);?></span>
					<span class="view"><i class="fa fa-eye"></i>&nbsp;<?php echo $row->view;?></span>
				</div>
				<p><?php echo Utility::shortText(Utility::hardDecode($row->body),100);?></p>
			</div>
			<?php }
		}?>
	</div>
</div>		
<?php }?>