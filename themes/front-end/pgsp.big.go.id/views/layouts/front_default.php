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
			if($action == 'index')
				$class = 'main';
			else if($action == 'login')
				$class = 'login';
			else
				$class = $action;
		} else
			$class = $controller;
	} else {
		if($controller == 'site')
			$class = $module;
			if(in_array($currentModule, array('album/search','article/search')))
				$class = 'search';
			else if(in_array($module, array('album','article')))
				$class = 'module';
		else
			$class = $module.'-'.$controller;
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
				<?php 
				$this->widget('BannerRecent');
				if($module != 'article')
					$this->widget('ArticleRecent');
				if(($module == null && $controller != 'page') || ($module != null))
					$this->widget('ArticlePopular');
				if($module != 'album')
					$this->widget('AlbumRecents');
				?>
			</div>
		</div>
	<?php } else {
		echo $content;
	}?>
</div>

<?php $this->endContent(); ?>