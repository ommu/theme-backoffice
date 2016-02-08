<?php 
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
?>
<ul class="clearfix">
	<?php if($this->type == true) {?>
		<li class="responsive-lx">
			<a href="javascript:void(0);" title="Menu">Menu</a>
			<?php $this->widget('FrontHeaderMenu', array(
				'type'=>false,
			)); ?>	
		</li>
	<?php }?>
	<li class="<?php echo ($this->type == true ? (($module == null && $currentAction == 'site/index') ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="<?php echo Yii::app()->createUrl('site/index');?>" title="Home">Home</a></li>
	<li class="<?php echo ($this->type == true ? (($module == null && $controller == 'page') ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="javascript:void(0);" title="Profile">Profile</a>
		<ul>
			<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>1,'t'=>Utility::getUrlTitle(Phrase::trans(1501, 2))))?>" title="<?php echo Phrase::trans(1501, 2);?>"><?php echo Phrase::trans(1501, 2);?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>6,'t'=>Utility::getUrlTitle(Phrase::trans(1539, 2))))?>" title="<?php echo Phrase::trans(1539, 2);?>"><?php echo Phrase::trans(1539, 2);?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>5,'t'=>Utility::getUrlTitle(Phrase::trans(1509, 2))))?>" title="<?php echo Phrase::trans(1509, 2);?>"><?php echo Phrase::trans(1509, 2);?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>2,'t'=>Utility::getUrlTitle(Phrase::trans(1503, 2))))?>" title="<?php echo Phrase::trans(1503, 2);?>"><?php echo Phrase::trans(1503, 2);?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('support/contact/feedback')?>" title="Kontak Kami">Kontak Kami</a></li>
		</ul>
	</li>
	<li class="<?php echo ($this->type == true ? (($currentModule == 'album/museum') ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="<?php echo Yii::app()->createUrl('album/museum/index')?>" title="<?php echo Phrase::trans(1547, 2);?>"><?php echo Phrase::trans(1547, 2);?></a></li>
	<li class="<?php echo ($this->type == true ? ($module != null && $module == 'visit' ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="javascript:void(0);" title="Kunjungan">Kunjungan</a>
		<ul>
			<li><a href="<?php echo Yii::app()->createUrl('visit/site/index');?>" title="Jadwal Kunjungan">Jadwal (Schedule)</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('visit/request/index');?>" title="Formulir Kunjungan">Formulir</a></li>
		</ul>
	</li>
	<li class="<?php echo ($this->type == true ? (($currentModule == 'article/site' && (isset($_GET['category']) && $_GET['category'] == 1)) ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="<?php echo Yii::app()->createUrl('article/site/index', array('category'=>1,'t'=>Utility::getUrlTitle(Phrase::trans(1531, 2))))?>" title="<?php echo Phrase::trans(1531, 2);?>"><?php echo Phrase::trans(1531, 2);?></a></li>
	<li class="<?php echo ($this->type == true ? (($currentModule == 'album/site') ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="<?php echo Yii::app()->createUrl('album/site/index')?>" title="Galeri">Galeri</a></li>
	<li class="<?php echo ($this->type == true ? (($currentModule == 'article/site' && (isset($_GET['category']) && $_GET['category'] == 2)) ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="<?php echo Yii::app()->createUrl('article/site/index', array('category'=>2,'t'=>Utility::getUrlTitle(Phrase::trans(1545, 2))))?>" title="<?php echo Phrase::trans(1545, 2);?>"><?php echo Phrase::trans(1545, 2);?></a></li>
	<?php if($this->type == true) {?>
		<li class="search"><a href="javascript:void(0);" title="Cari">Cari</a></li>
	<?php }?>
</ul>