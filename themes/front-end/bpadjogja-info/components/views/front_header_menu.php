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
	<li class="<?php echo ($this->type == true ? (($module != null && ($module == 'article' && $controller == 'news/site')) ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="<?php echo Yii::app()->createUrl('article/news/site/index');?>" title="<?php echo Phrase::trans(1531, 2)?>"><?php echo Phrase::trans(1531, 2)?></a>
		<ul>
			<li><a href="<?php echo Yii::app()->createUrl('article/news/site/index', array('category'=>7,'t'=>Utility::getUrlTitle(Phrase::trans(1543, 2))));?>" title="<?php echo Phrase::trans(1543, 2)?>"><?php echo Phrase::trans(1543, 2)?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('article/news/site/index', array('category'=>18,'t'=>Utility::getUrlTitle(Phrase::trans(1573, 2))));?>" title="<?php echo Phrase::trans(1573, 2)?>"><?php echo Phrase::trans(1573, 2)?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('article/news/site/index', array('category'=>3,'t'=>Utility::getUrlTitle(Phrase::trans(1535, 2))));?>" title="<?php echo Phrase::trans(1535, 2)?>"><?php echo Phrase::trans(1535, 2)?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('article/news/site/index', array('category'=>2,'t'=>Utility::getUrlTitle(Phrase::trans(1533, 2))));?>" title="<?php echo Phrase::trans(1533, 2)?>"><?php echo Phrase::trans(1533, 2)?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('article/news/site/index', array('category'=>5,'t'=>Utility::getUrlTitle(Phrase::trans(1539, 2))));?>" title="<?php echo Phrase::trans(1539, 2)?>"><?php echo Phrase::trans(1539, 2)?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('article/news/site/index', array('category'=>6,'t'=>Utility::getUrlTitle(Phrase::trans(1541, 2))));?>" title="<?php echo Phrase::trans(1541, 2)?>"><?php echo Phrase::trans(1541, 2)?></a></li>
			<?php /*
			<li><a href="<?php echo Yii::app()->createUrl('article/news/site/index', array('category'=>4,'t'=>Utility::getUrlTitle(Phrase::trans(1537, 2))));?>" title="<?php echo Phrase::trans(1537, 2)?>"><?php echo Phrase::trans(1537, 2)?></a></li>
			*/?>
		</ul>
	</li>
	<li class="<?php echo ($this->type == true ? (($module != null && (in_array($currentModule, array('article/site','book/review','book/request')))) || ($module == null && $controller == 'page' && (isset($_GET['id']) && in_array($_GET['id'], array(10,11)))) ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="<?php echo Yii::app()->createUrl('article/site/index', array('t'=>Utility::getUrlTitle(Phrase::trans(1547, 2))));?>" title="<?php echo Phrase::trans(1545, 2)?>"><?php echo Phrase::trans(1545, 2)?></a>
		<ul>
			<li><a href="<?php echo Yii::app()->createUrl('article/site/index', array('t'=>Utility::getUrlTitle(Phrase::trans(1547, 2))));?>" title="<?php echo Phrase::trans(1547, 2);?>">Artikel</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('book/review/index')?>" title="Resensi Buku">Resensi Buku</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('book/request/index')?>" title="Usulan Buku">Usulan Buku</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>11,'t'=>Utility::getUrlTitle(Phrase::trans(1591, 2))))?>" title="<?php echo Phrase::trans(1591, 2);?>">Informasi Layanan</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>10,'t'=>Utility::getUrlTitle(Phrase::trans(1589, 2))))?>" title="<?php echo Phrase::trans(1589, 2);?>"><?php echo Phrase::trans(1589, 2);?></a></li>
		</ul>
	</li>
	<li class="<?php echo ($this->type == true ? ((($module != null && (in_array($currentModule, array('article/archive/site')))) || ($module == null && $controller == 'page' && (isset($_GET['id']) && $_GET['id'] == 12))) ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="<?php echo Yii::app()->createUrl('article/archive/site/index');?>" title="<?php echo Phrase::trans(1551, 2)?>"><?php echo Phrase::trans(1551, 2)?></a>
		<ul>
			<li><a href="<?php echo Yii::app()->createUrl('article/archive/site/index', array('category'=>10,'t'=>Utility::getUrlTitle(Phrase::trans(1549, 2))));?>" title="<?php echo Phrase::trans(1549, 2);?>">Artikel</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('article/archive/site/index', array('category'=>15,'t'=>Utility::getUrlTitle(Phrase::trans(1567, 2))));?>" title="<?php echo Phrase::trans(1567, 2)?>"><?php echo Phrase::trans(1567, 2)?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('article/archive/site/index', array('category'=>16,'t'=>Utility::getUrlTitle(Phrase::trans(1569, 2))));?>" title="<?php echo Phrase::trans(1569, 2)?>"><?php echo Phrase::trans(1569, 2)?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>12,'t'=>Utility::getUrlTitle(Phrase::trans(1593, 2))))?>" title="<?php echo Phrase::trans(1593, 2);?>">Informasi Layanan</a></li>
		</ul>
	</li>
	<li class="<?php echo ($this->type == true ? (($module != null && (in_array($currentModule, array('album/site','video/site','article/announcement/site')))) ? 'responsive-ls active' : 'responsive-ls') : '');?>"><a href="<?php echo Yii::app()->createUrl('album/site/index');?>" title="Galeri">Galeri</a>
		<ul>
			<li><a href="<?php echo Yii::app()->createUrl('album/site/index', array('type'=>'photo'));?>" title="Photo BPAD Jogja">Photo</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('video/site/index');?>" title="Video BPAD Jogja">Video</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('article/newspaper/site/index');?>" title="<?php echo Phrase::trans(1595, 2);?>"><?php echo Phrase::trans(1595, 2);?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('article/announcement/site/index');?>" title="<?php echo Phrase::trans(1577, 2);?>"><?php echo Phrase::trans(1577, 2);?></a></li>
		</ul>
	</li>
</ul>