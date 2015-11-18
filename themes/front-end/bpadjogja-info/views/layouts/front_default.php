<?php $this->beginContent('//layouts/default');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.*');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.public.*');
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	if($module == null) {
		if($controller == 'site') {
			if($action == 'index') {
				$class = 'main';
			} else if($action == 'login') {
				$class = 'login';
			} else {
				$class = $action;
			}
		} else {
			$class = $controller;
		}
	} else {
		if(in_array($currentModule, array('album/search','article/search','video/search'))) {
			$class = 'search';
		} else if(in_array($module, array('album','video')) || (in_array($currentModule, array('book/review')))) {
			$class = 'article';
		} else if(in_array($controller, array('site','news/site','archive/site','newspaper/site'))) {
			$class = $module;
		} else if(in_array($controller, array('announcement/site','regulation/site'))) {
			$class = $module.'-download';
		} else {
			$class = $module.'-'.$controller;
		}
	}
?>
<?php //echo $this->dialogDetail == true ? (empty($this->dialogWidth) ? 'class="boxed clearfix"' : 'class="clearfix"') : 'class="clearfix"';?>

<?php if($this->dialogDetail == false && $this->pageTitleShow == true) {?>
	<h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
<?php }?>

<div id="<?php echo $class;?>" class="box-wrap <?php echo $this->adsSidebar == true ? 'ads-on' : '';?>">
	
	<?php if($this->adsSidebar == true) {?>
		<div class="content <?php echo $action;?> <?php echo isset($_GET['category']) ? 'category-'.$_GET['category'] : '';?>">
			<div class="boxed clearfix">
				<?php echo $content;?>
			</div>
		</div>
		<div class="sidebar">
			<div class="boxed clearfix">
				<?php /*
				<div class="box banner-event">
					<a href="" title=""><img src="<?php echo Yii::app()->request->baseUrl;?>/public/main/event_calendar.png" alt="" /></a>
				</div>
				*/?>
				
				<?php if(!($module == 'article' && $controller == 'news/site')) {
					$this->widget('application.modules.article.components.FrontArticleRecentNews');
					$this->widget('application.modules.article.components.FrontArticleRecentAnnouncement');
				}
				if($module != 'album')
					$this->widget('application.modules.album.components.FrontAlbumRecents');
				if($module != 'video')
					$this->widget('application.modules.video.components.FrontVideoRecents');
				if($module != 'article' || ($module == 'article' && !in_array($controller, array('site','archive/site'))))
					$this->widget('application.modules.article.components.FrontArticleRecentArticle');
				?>
			</div>
		</div>
	<?php } else {
		if($this->dialogDetail == true) {
			if(!empty($this->dialogWidth)) {?>
				<?php //begin.Notifier Header ?>
				<div class="dialog-header">
					<?php echo CHtml::encode($this->pageTitle); ?>
				</div>
				<?php echo $content?>

			<?php } else {
				if($this->dialogFixed == true) {?>
					<?php //begin.Dialog Header?>
					<h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
					<?php if(!empty($this->pageDescription)) {?>
					<div class="intro">
						<?php echo $this->pageDescription;?>
					</div>
					<?php }
					// begin.render Content
					echo $content;
					?>
					
					<?php //begin.Button Close ?>
					<div class="button">
						<?php $this->widget(
							'FrontOtherDialogClosed', array(
							'links' => Yii::app()->controller->dialogFixedClosed,
						)); ?>
					</div>
					<?php //end.Button Close ?>
				<?php } else {
					echo $content;
				}
			}			
		} else {
			echo $content;
		}?>
	<?php }?>
</div>

<?php if($this->adsSidebar == false) {?>
<div class="main article clearfix">
	<?php $this->widget('application.modules.article.components.FrontArticleRecentNews');
	$this->widget('application.modules.album.components.FrontAlbumRecents');
	echo '<div class="clear"></div>';
	$this->widget('application.modules.video.components.FrontVideoRecents');
	?>
</div>

<div class="main article clearfix">
	<?php $this->widget('CoeRecentPost', array(
		'production'=>0,
	));?>
	<div class="clear"></div>
</div>
<?php }?>

<?php $this->endContent(); ?>