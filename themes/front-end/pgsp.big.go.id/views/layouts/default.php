<?php
if(isset($_GET['protocol']) && $_GET['protocol'] == 'script') {
	echo $cs=Yii::app()->getClientScript()->getScripts();
	
} else {
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.*');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.public.*');
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);

	/**
	 * = Global condition
	 ** Construction condition
	 */
	$setting = OmmuSettings::model()->findByPk(1,array(
		'select' => 'online, site_type, site_url, site_title, construction_date, signup_inviteonly, general_include',
	));
	$construction = (($setting->online == 0 && date('Y-m-d', strtotime($setting->construction_date)) > date('Y-m-d')) && (Yii::app()->user->isGuest || (!Yii::app()->user->isGuest && in_array(!Yii::app()->user->level, array(1,2))))) ? 1 : 0 ;

	/**
	 * = Dialog Condition
	 * $construction = 1 (construction active)
	 */
	if($construction == 1)
		$dialogWidth = !empty($this->dialogWidth) ? ($this->dialogFixed == false ? $this->dialogWidth.'px' : '600px') : '900px';
	else {
		if($this->dialogDetail == true)
			$dialogWidth = !empty($this->dialogWidth) ? ($this->dialogFixed == false ? $this->dialogWidth.'px' : '600px') : '700px';
		else
			$dialogWidth = '';
	}
	$display = ($this->dialogDetail == true && !Yii::app()->request->isAjaxRequest) ? 'style="display: block;"' : '';
	
	/**
	 * = pushState condition
	 */
	$title = CHtml::encode($this->pageTitle).' | '.$setting->site_title;
	$description = $this->pageDescription;
	$keywords = $this->pageMeta;
	$urlAddress = Utility::getProtocol().'://'.Yii::app()->request->serverName.Yii::app()->request->requestUri;
	$apps = $this->dialogDetail == true ? ($this->dialogFixed == false ? 'apps' : 'module') : '';

	if(Yii::app()->request->isAjaxRequest && !isset($_GET['ajax'])) {
		if(Yii::app()->session['theme_active'] != Yii::app()->theme->name) {
			$return = array(
				'redirect' => $urlAddress,		
			);

		} else {
			$page = $this->contentOther == true ? 1 : 0;
			$dialog = $this->dialogDetail == true ? (empty($this->dialogWidth) ? 1 : 2) : 0;		// 0 = static, 1 = dialog, 2 = notifier
			$header = /* $this->widget('SidebarAccountMenu', array(), true) */'';
			
			if($this->contentOther == true) {
				$render = array(
					'content' => $content, 
					'other' => $this->contentAttribute,
				);
			} else
				$render = $content;
			
			$return = array(
				'partial' => 'off',
				'titledoc' => CHtml::encode($this->pageTitle),
				'title' => $title,
				'description' => $description,
				'keywords' => $keywords,
				'address' => $urlAddress,
				'dialogWidth' => $dialogWidth,			
			);
			$return['page'] = $page;
			$return['dialog'] = $dialog;
			$return['apps'] = $apps;
			$return['header'] = $this->dialogDetail != true ? $header : '';
			$return['render'] = $render;
			$return['script'] = $cs=Yii::app()->getClientScript()->getOmmuScript();
		}
		echo CJSON::encode($return);

	} else {
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/general.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/form.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/typography.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/layout.css');
		$cs->registerCssFile(Yii::app()->request->baseUrl.'/externals/content.css');
		$cs->registerCoreScript('jquery', CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/custom/custom.js', CClientScript::POS_END);
		
		//Javascript Attribute
		$jsAttribute = array(
			'baseUrl'=>BASEURL,
			'lastTitle'=>$title,
			'lastDescription'=>$description,
			'lastKeywords'=>$keywords,
			'lastUrl'=>$urlAddress,
			'dialogConstruction'=>$construction == 1 ? 1 : 0,
			'dialogGroundUrl'=>$this->dialogDetail == true ? ($this->dialogGroundUrl != '' ? $this->dialogGroundUrl : '') : '',
		);
		if($this->contentOther == true)
			$jsAttribute['contentOther'] = $this->contentAttribute;
	?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8" />
  <title><?php echo $title;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="author" content="Ommu Platform (support@ommu.co)" />
  <script type="text/javascript">
	var globals = '<?php echo CJSON::encode($jsAttribute);?>';
  </script>
  <?php echo $setting->general_include != '' ? $setting->general_include : ''?>
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl?>/favicon.ico" />
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
  <style type="text/css"></style>
 </head>
 <body <?php echo $this->dialogDetail == true ? 'style="overflow-y: hidden;"' : '';?>>
 
	<?php //begin.Header ?>
	<header>
	
	</header>
	<?php //end.Header ?>

	<?php //begin.BodyContent ?>
	<div class="body">		
		<div class="container">
			<div class="wrapper"><?php echo $this->dialogDetail == false ? $content : '';?></div>
			<?php $this->widget('ContactMetaInformation'); //begin.Meta Information ?>
		</div>
	</div>
	<?php //end.BodyContent ?>
	
	<div id="mapView"></div>

	<?php //begin.Footer ?>
	<footer class="clearfix">
		<div class="menu">
			<div class="container clearfix">
				<div class="box logo">
					<a href="<?php echo Yii::app()->createUrl('site/index');?>" title="<?php echo $setting->site_title;?>"><img src="<?php echo Yii::app()->request->baseUrl;?>/public/main/logo_footer.png" alt="<?php echo $setting->site_title;?>" /></a>
				</div>
				<div class="clear"></div>
				<div class="box about">	
					<h3>Tentang PGSP</h3>
					<ul>
						<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>1,'t'=>Utility::getUrlTitle(Phrase::trans(1501, 2))))?>" title="<?php echo Phrase::trans(1501, 2);?>"><?php echo Phrase::trans(1501, 2);?></a></li>
						<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>6,'t'=>Utility::getUrlTitle(Phrase::trans(1539, 2))))?>" title="<?php echo Phrase::trans(1539, 2);?>">Sejarah PGSP</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>5,'t'=>Utility::getUrlTitle(Phrase::trans(1509, 2))))?>" title="<?php echo Phrase::trans(1509, 2);?>">Visi dan Misi</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>7,'t'=>Utility::getUrlTitle(Phrase::trans(1541, 2))))?>" title="<?php echo Phrase::trans(1541, 2);?>"><?php echo Phrase::trans(1541, 2);?></a></li>
						<li><a href="<?php echo Yii::app()->createUrl('page/view', array('id'=>8,'t'=>Utility::getUrlTitle(Phrase::trans(1543, 2))))?>" title="<?php echo Phrase::trans(1543, 2);?>"><?php echo Phrase::trans(1543, 2);?></a></li>
						<li><a href="<?php echo Yii::app()->createUrl('support/contact/feedback')?>" title="Kontak Kami">Kontak Kami</a></li>
					</ul>
				</div>
				<div class="clear nth-child"></div>
				<div class="box link">
					<h3>Link Terkait</h3>
					<ul>
						<li><a target="_blank" href="http://big.go.id/" title="Badan Informasi Geospasial">Badan Informasi Geospasial</a></li>
						<li><a target="_blank" href="http://tanahair.indonesia.go.id/" title="Geospasial Untuk Negeri">Geospasial Untuk Negeri</a></li>
					</ul>
				</div>
				<div class="box another">
					<h3>Link Terkait</h3>
					3
				</div>
			</div>
		</div>
		<div class="container copyright">
			<?php $this->widget('FrontFooterCopyright'); ?>
		</div>
	</footer>
	<?php //end.Footer ?>
	
	<?php $this->widget('FrontGoogleAnalytics'); ?>
 </body>
</html>
<?php }
}?>