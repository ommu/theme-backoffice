<?php
	$menuRender = 0;
	if(($module == null && in_array($controller, array('admin'))) || ($module != null && (in_array($module, array('report')) || ($module == 'support' && (!in_array($currentAction, array('o/mail/setting')) && !in_array($controller, array('o/contact','o/contactcategory','o/widget'))))))) {
		$menuRender = 1;
		$title = 'Submenu';
		
	} elseif($module == null && in_array($controller, array('page','module','globaltag','anotherdetail','author','authorcontact','translate'))) {
		$menuRender = 2;
		$title = 'Submenu';
		
	} elseif($module != null && $module == 'users') {
		$menuRender = 3;
		$title = 'Submenu';
		
	} elseif($module == null && in_array($controller, array('settings','language','phrase','theme','locale','pluginphrase','meta','template','zonecountry','zoneprovince','zonecity','zonedistrict','zonevillage')) || ($module != null && ($module == 'support' && (in_array($currentAction, array('o/mail/setting')) || in_array($controller, array('o/contact','o/contactcategory','o/widget')))))) {
		$menuRender = 4;
		$title = 'Submenu';
	}
?>

<?php //begin.Main Menu ?>
<div class="mainmenu">
	<ul class="clearfix">
		<li <?php echo $menuRender == 1 ? 'class="active"' : ''; ?>><a class="dashboard" href="<?php echo Yii::app()->createUrl('admin/index');?>" title="<?php echo Phrase::trans(132,0);?>"><?php echo Phrase::trans(132,0);?></a></li>
		<li <?php echo $menuRender == 2 ? 'class="active"' : ''; ?>><a class="content" href="<?php echo Yii::app()->createUrl('page/manage');?>" title="<?php echo Phrase::trans(136,0);?>"><?php echo Phrase::trans(136,0);?></a></li>
		<?php 
			$plugin = OmmuPlugins::getPlugin(1);
			if($plugin != null) {
				foreach($plugin as $key => $val) {
					$menu = Utility::getPluginMenu($val->folder);
					if($menu != null) {
						//attr url					
						$arrAttrParams = array();
						if($menu[0][urlPath][attr] != null) {
							$arrAttr = explode(',', $menu[0][urlPath][attr]);
							if(count($arrAttr) > 0) {
								foreach($arrAttr as $row) {
									$part = explode('=', $row);
									if(strpos($part[1], '$_GET') !== false) {								
										$list = explode('*', $part[1]);
										if(count($list) == 2)
											$arrAttrParams[$part[0]] = $_GET[$list[1]];
										elseif(count($list) == 3)
											$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
										elseif(count($list) == 4)
											$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
										elseif(count($list) == 5)
											$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
										
									} else {
										$arrAttrParams[$part[0]] = $part[1];
									}
								}
							}
						}

						$url = Yii::app()->createUrl($val->folder.'/'.$menu[0][urlPath][url], $arrAttrParams);
						//$titleApps = $val->name;
						$titleApps = Phrase::trans($val->code, 1);
						if($val->folder == $module) {
							$class = 'class="active"';
							$title = $val->name;
						} else {
							$class = '';
						}

						$item = '<li '.$class.'>';
						$item .= '<a href="'.$url.'" title="'.$titleApps.'">'.$titleApps.'</a>';
						$item .= '</li>';
						echo $item;
					}
				}
			}
		?>
		<li <?php echo $menuRender == 3 ? 'class="active"' : ''; ?>><a class="member" href="<?php echo Yii::app()->user->level != 1 ? Yii::app()->createUrl('users/o/member/manage') : Yii::app()->createUrl('users/o/admin/manage') ?>" title="<?php echo Phrase::trans(16002,1);?>"><?php echo Phrase::trans(16002,1);?></a></li>
		<li <?php echo $menuRender == 4 ? 'class="active"' : ''; ?>><a class="setting" href="<?php echo Yii::app()->user->level == 1 ? Yii::app()->createUrl('settings/general') : Yii::app()->createUrl('support/contact/manage');?>" title="<?php echo Phrase::trans(133,0);?>"><?php echo Phrase::trans(133,0);?></a></li>
	</ul>
</div>
<?php //end.Main Menu ?>

<?php //begin.Submenu ?>
<div class="submenu">
	<h3><?php echo $title;?></h3>
	<ul>
	<?php if($menuRender == 1) { //Begin.Dashboard ?>
		<li <?php echo $currentAction == 'admin/dashboard' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('admin/dashboard');?>" title="<?php echo Phrase::trans(330,0);?>"><?php echo Phrase::trans(330,0);?></a></li>
		<?php 
		$core = OmmuPlugins::getPlugin(2);
		if($core != null) {
			foreach($core as $key => $val) {
				$menu = Utility::getPluginMenu($val->folder);
				if($menu != null) {
					if(count($menu) == 1) {
						$url = Yii::app()->createUrl($val->folder.'/'.$menu[0][urlPath][url]);
						$titleApps = $val->name;
						$urlArray = explode('/', $menu[0][urlPath][url]);
						if(count($urlArray) == 3)
							$class = $controller == $urlArray[0].'/'.$urlArray[1] ? 'class="selected"' : '';
						else
							$class = $controller == $urlArray[0] ? 'class="selected"' : '';
					} else {
						if($val->folder == $module) {
							$class = 'class="submenu-show"';
							$url = 'javascript:void(0);';
						} else {
							$class = '';
							$url = Yii::app()->createUrl($val->folder.'/'.$menu[0][urlPath][url]);
						}
						$titleApps = $val->name;
					}

					$item = '<li '.$class.'>';
					$item .= '<a href="'.$url.'" title="'.$titleApps.'">'.$titleApps.'</a>';
					if(count($menu) > 1) {
						$item .= '<ul>';
						foreach($menu as $key => $data) {
							$liClass = '';
							if($data[urlPath][url] != null) {
								$urlArray = explode('/', $data[urlPath][url]);
								if(count($urlArray) == 3)
									$liClass = $controller == $urlArray[0].'/'.$urlArray[1] ? 'class="selected"' : '';
								else
									$liClass = $controller == $urlArray[0] ? 'class="selected"' : '';
							}
							$icons = $data[urlPath][icon] != null ? $data[urlPath][icon] : 'C';
							$url = $data[urlPath][url] != null ? Yii::app()->createUrl($val->folder.'/'.$data[urlPath][url]) : 'javascript:void(0)';

							$item .= '<li '.$liClass.'><a href="'.$url.'" title="'.$data[urlTitle].'"><span class="icons">'.$icons.'</span>'.$data[urlTitle].'</a></li>';
						}	
						$item .= '</ul>';
					}
					$item .= '</li>';
					echo $item;
				}
			}
		}?>
		<li><a href="<?php echo Yii::app()->createUrl('users/o/admin/edit')?>" title="<?php echo Phrase::trans(16222,1).': '.Yii::app()->user->displayname;?>"><?php echo Phrase::trans(16222,1);?></a></li>
		<li><a href="<?php echo Yii::app()->createUrl('users/o/admin/password')?>" title="<?php echo Phrase::trans(16122,1).': '.Yii::app()->user->displayname;?>"><?php echo Phrase::trans(16122,1);?></a></li>

	<?php } elseif($menuRender == 2) { //Begin.Content ?>
		<li <?php echo $controller == 'page' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('page/manage');?>" title="<?php echo Phrase::trans(134,0);?>"><?php echo Phrase::trans(134,0);?></a></li>
		<?php if(Yii::app()->user->level == 1 && $setting->site_admin == 1) {?>
			<li <?php echo $controller == 'module' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('module/manage');?>" title="<?php echo Phrase::trans(135,0);?>"><?php echo Phrase::trans(135,0);?></a></li>
		<?php }?>
		<li <?php echo $controller == 'globaltag' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('globaltag/manage');?>" title="<?php echo Phrase::trans(494,0);?>"><?php echo Phrase::trans(494,0);?></a></li>		
		<?php if($setting->site_type == 1) {?>
			<li <?php echo $controller == 'anotherdetail' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('anotherdetail/manage');?>" title="<?php echo Phrase::trans(360,0);?>"><?php echo Phrase::trans(360,0);?></a></li>
			<li <?php echo ($module == null && in_array($controller, array('author','authorcontact'))) ? 'class="submenu-show"' : '';?>>
				<a href="<?php echo ($module == null && in_array($controller, array('author','authorcontact'))) ? 'javascript:void(0);' : Yii::app()->createUrl('author/manage');?>" title="<?php echo Phrase::trans(385,0);?>"><?php echo Phrase::trans(385,0);?></a>
				<?php if($module == null && in_array($controller, array('author','authorcontact'))) {?>
				<ul>
					<li <?php echo $controller == 'author' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('author/manage');?>" title="Author"><span class="icons">C</span>Author</a></li>
					<li <?php echo $controller == 'authorcontact' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('authorcontact/manage');?>" title="Author Contact"><span class="icons">C</span>Author Contact</a></li>
				</ul>
				<?php }?>
			</li>
		<?php }?>
		<li <?php echo $controller == 'translate' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('translate/manage');?>" title="<?php echo Phrase::trans(351,0);?>"><?php echo Phrase::trans(351,0);?></a></li>

	<?php } elseif($module != null && !in_array($module, array('users','report','support'))) {
		$menu = Utility::getPluginMenu($module);
		if($menu != null) {
			foreach($menu as $key => $val) {
				$siteType = explode(',', $val[urlRules][siteType]);
				$userLevel = explode(',', $val[urlRules][userLevel]);
				if(in_array(OmmuSettings::getInfo('site_type'), $siteType) && in_array(Yii::app()->user->level, $userLevel)) {
					$aClass = '';
					if($val[urlPath][url] != null) {
						$urlArray = explode('/', $val[urlPath][url]);
						if(count($urlArray) == 3)
							$aClass = $controller == $urlArray[0].'/'.$urlArray[1] ? 'class="active"' : '';
						else
							$aClass = $controller == $urlArray[0] ? 'class="active"' : '';
					}					
					$icons = $val[urlPath][icon] != null ? $val[urlPath][icon] : 'C';

					//attr url					
					$arrAttrParams = array();
					if($val[urlPath][attr] != null) {
						$arrAttr = explode(',', $val[urlPath][attr]);
						if(count($arrAttr) > 0) {
							foreach($arrAttr as $row) {
								$part = explode('=', $row);
								if(strpos($part[1], '$_GET') !== false) {								
									$list = explode('*', $part[1]);
									if(count($list) == 2)
										$arrAttrParams[$part[0]] = $_GET[$list[1]];
									elseif(count($list) == 3)
										$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
									elseif(count($list) == 4)
										$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
									elseif(count($list) == 5)
										$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
									
								} else {
									$arrAttrParams[$part[0]] = $part[1];
								}
							}
						}
					}				
					$submenu = $val[submenu];
					$class = $submenu != null ? 'class="submenu-show"' : '';
					$url = $val[urlPath][url] != null ? Yii::app()->createUrl($module.'/'.$val[urlPath][url], $arrAttrParams) : 'javascript:void(0)';
					
					echo '<li '.$class.'>';
					echo '<a '.$aClass.' href="'.$url.'" title="'.$val[urlTitle].'">'.$val[urlTitle].'</a>';
					if($submenu != null) {
						echo '<ul>';
						foreach($submenu as $key => $data) {
							$siteType = explode(',', $data[urlRules][siteType]);
							$userLevel = explode(',', $data[urlRules][userLevel]);
							if(in_array(OmmuSettings::getInfo('site_type'), $siteType) && in_array(Yii::app()->user->level, $userLevel)) {
								$subLiClass = '';
								if($data[urlPath][url] != null) {
									$urlArray = explode('/', $data[urlPath][url]);
									if(count($urlArray) == 3)
										$subLiClass = $controller == $urlArray[0].'/'.$urlArray[1] ? 'class="selected"' : '';
									else
										$subLiClass = $controller == $urlArray[0] ? 'class="selected"' : '';
								}
								$subIcons = $data[urlPath][icon] != null ? $data[urlPath][icon] : 'C';

								//attr url					
								$arrAttrParams = array();
								if($data[urlPath][attr] != null) {
									$arrAttr = explode(',', $data[urlPath][attr]);
									if(count($arrAttr) > 0) {
										foreach($arrAttr as $row) {
											$part = explode('=', $row);
											if(strpos($part[1], '$_GET') !== false) {								
												$list = explode('*', $part[1]);
												if(count($list) == 2)
													$arrAttrParams[$part[0]] = $_GET[$list[1]];
												elseif(count($list) == 3)
													$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
												elseif(count($list) == 4)
													$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
												elseif(count($list) == 5)
													$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
												
											} else {
												$arrAttrParams[$part[0]] = $part[1];
											}
										}
									}
								}
								$url = $val[urlPath][url] != null ? Yii::app()->createUrl($module.'/'.$data[urlPath][url], $arrAttrParams) : 'javascript:void(0)';
								echo '<li '.$subLiClass.'><a href="'.$url.'" title="'.$data[urlTitle].'"><span class="icons">'.$subIcons.'</span>'.$data[urlTitle].'</a></li>';
							}								
						}
						echo '</ul>';
					}						
					echo '</li>';					
				}
			}
		}
		
	} elseif($menuRender == 3) { //Begin.Member 
		$menu = Utility::getPluginMenu('users');
		if($menu != null) {
			foreach($menu as $key => $val) {
				$siteType = explode(',', $val[urlRules][siteType]);
				$userLevel = explode(',', $val[urlRules][userLevel]);
				if(in_array(OmmuSettings::getInfo('site_type'), $siteType) && in_array(Yii::app()->user->level, $userLevel)) {
					$aClass = '';
					if($val[urlPath][url] != null) {
						$urlArray = explode('/', $val[urlPath][url]);
						if(count($urlArray) == 3)
							$aClass = $controller == $urlArray[0].'/'.$urlArray[1] ? 'class="active"' : '';
						else
							$aClass = $controller == $urlArray[0] ? 'class="active"' : '';					
					}					
					$icons = $val[urlPath][icon] != null ? $val[urlPath][icon] : 'C';

					//attr url					
					$arrAttrParams = array();
					if($val[urlPath][attr] != null) {
						$arrAttr = explode(',', $val[urlPath][attr]);
						if(count($arrAttr) > 0) {
							foreach($arrAttr as $row) {
								$part = explode('=', $row);
								if(strpos($part[1], '$_GET') !== false) {								
									$list = explode('*', $part[1]);
									if(count($list) == 2)
										$arrAttrParams[$part[0]] = $_GET[$list[1]];
									elseif(count($list) == 3)
										$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
									elseif(count($list) == 4)
										$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
									elseif(count($list) == 5)
										$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
									
								} else {
									$arrAttrParams[$part[0]] = $part[1];
								}
							}
						}
					}				
					$submenu = $val[submenu];
					$class = $submenu != null ? 'class="submenu-show"' : '';
					$url = $val[urlPath][url] != null ? Yii::app()->createUrl($module.'/'.$val[urlPath][url], $arrAttrParams) : 'javascript:void(0)';
					
					echo '<li '.$class.'>';
					echo '<a '.$aClass.' href="'.$url.'" title="'.$val[urlTitle].'">'.$val[urlTitle].'</a>';
					if($submenu != null) {
						echo '<ul>';
						foreach($submenu as $key => $data) {
							$siteType = explode(',', $data[urlRules][siteType]);
							$userLevel = explode(',', $data[urlRules][userLevel]);
							if(in_array(OmmuSettings::getInfo('site_type'), $siteType) && in_array(Yii::app()->user->level, $userLevel)) {
								$subLiClass = '';
								if($data[urlPath][url] != null) {
									$urlArray = explode('/', $data[urlPath][url]);
									if(in_array($controller, array('o/history'))) {
										if(count($urlArray) == 3)
											$subLiClass = $controller == $urlArray[0].'/'.$urlArray[1] && $action == $urlArray[2] ? 'class="selected"' : '';
										else
											$subLiClass = $controller == $urlArray[0] && $action == $urlArray[1]  ? 'class="selected"' : '';								
									} else {
										if(count($urlArray) == 3)
											$subLiClass = $controller == $urlArray[0].'/'.$urlArray[1] ? 'class="selected"' : '';
										else
											$subLiClass = $controller == $urlArray[0] ? 'class="selected"' : '';
									}
								}
								$subIcons = $data[urlPath][icon] != null ? $data[urlPath][icon] : 'C';

								//attr url					
								$arrAttrParams = array();
								if($data[urlPath][attr] != null) {
									$arrAttr = explode(',', $data[urlPath][attr]);
									if(count($arrAttr) > 0) {
										foreach($arrAttr as $row) {
											$part = explode('=', $row);
											if(strpos($part[1], '$_GET') !== false) {								
												$list = explode('*', $part[1]);
												if(count($list) == 2)
													$arrAttrParams[$part[0]] = $_GET[$list[1]];
												elseif(count($list) == 3)
													$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
												elseif(count($list) == 4)
													$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
												elseif(count($list) == 5)
													$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
												
											} else {
												$arrAttrParams[$part[0]] = $part[1];
											}
										}
									}
								}
								$url = $val[urlPath][url] != null ? Yii::app()->createUrl($module.'/'.$data[urlPath][url], $arrAttrParams) : 'javascript:void(0)';
								echo '<li '.$subLiClass.'><a href="'.$url.'" title="'.$data[urlTitle].'"><span class="icons">'.$subIcons.'</span>'.$data[urlTitle].'</a></li>';
							}
						}
						echo '</ul>';
					}						
					echo '</li>';
					
				}
			}
		}
	
	} elseif($menuRender == 4) { //Begin.Setting ?>
		<?php if(Yii::app()->user->level == 1) {?>
			<li <?php echo $currentAction == 'settings/general' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/general');?>" title="<?php echo Phrase::trans(94,0);?>"><?php echo Phrase::trans(94,0);?></a></li>
			<?php if($setting->site_type == 1) {?>
				<li <?php echo $currentAction == 'settings/banned' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/banned');?>" title="<?php echo Phrase::trans(63,0);?>"><?php echo Phrase::trans(63,0);?></a></li>
				<li <?php echo $currentAction == 'settings/signup' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/signup');?>" title="<?php echo Phrase::trans(5,0);?>"><?php echo Phrase::trans(5,0);?></a></li>
			<?php }?>
			<li <?php echo $controller == 'meta' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('meta/edit');?>" title="<?php echo Phrase::trans(551,0);?>"><?php echo Phrase::trans(551,0);?></a></li>
			<li <?php echo in_array($controller, array('locale','zonecountry','zoneprovince','zonecity','zonedistrict','zonevillage')) ? 'class="submenu-show"' : '' ?>>
				<a <?php echo $controller == 'locale' ? 'class="active"' : '' ?> href="<?php echo Yii::app()->createUrl('locale/setting');?>" title="<?php echo Phrase::trans(241,0);?>"><?php echo Phrase::trans(241,0);?></a>
				<ul>
					<li <?php echo $controller == 'zonecountry' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('zonecountry/manage');?>" title="<?php echo Phrase::trans(422,0);?>"><span class="icons">C</span><?php echo Phrase::trans(422,0);?></a></li>
					<li <?php echo $controller == 'zoneprovince' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('zoneprovince/manage');?>" title="<?php echo Phrase::trans(421,0);?>"><span class="icons">C</span><?php echo Phrase::trans(421,0);?></a></li>
					<li <?php echo $controller == 'zonecity' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('zonecity/manage');?>" title="<?php echo Phrase::trans(424,0);?>"><span class="icons">C</span><?php echo Phrase::trans(424,0);?></a></li>
					<li <?php echo $controller == 'zonedistrict' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('zonedistrict/manage');?>" title="<?php echo 'Districts';?>"><span class="icons">C</span><?php echo 'Districts';?></a></li>
					<li <?php echo $controller == 'zonevillage' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('zonevillage/manage');?>" title="<?php echo 'Village';?>"><span class="icons">C</span><?php echo 'Village';?></a></li>
				</ul>
			</li>
			<li <?php echo ($currentAction == 'o/mail/setting' || $controller == 'template') ? 'class="submenu-show"' : '' ?>>
				<a <?php echo $currentAction == 'o/mail/setting' ? 'class="active"' : '' ?> href="<?php echo Yii::app()->createUrl('support/o/mail/setting');?>" title="<?php echo Phrase::trans(23002,1);?>"><?php echo Phrase::trans(23002,1);?></a>
				<ul>
					<li <?php echo $controller == 'template' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('template/manage');?>" title="<?php echo Phrase::trans(602,0);?>"><span class="icons">C</span><?php echo Phrase::trans(602,0);?></a></li>
				</ul>
			</li>
			<li <?php echo in_array($controller, array('o/contact','o/contactcategory','o/widget')) ? 'class="submenu-show"' : '' ?>>
				<a href="<?php echo Yii::app()->createUrl('support/o/contact/manage');?>" title="<?php echo Phrase::trans(23061,1);?>"><?php echo Phrase::trans(23061,1);?></a>
				<ul>
					<li <?php echo $controller == 'o/contact' && $action != 'setting' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('support/o/contact/manage');?>" title="Manage Contact"><span class="icons">C</span>Manage Contact</a></li>
					<li <?php echo $controller == 'o/contactcategory' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('support/o/contactcategory/manage');?>" title="Contact Categories"><span class="icons">C</span>Contact Categories</a></li>
					<li <?php echo $controller == 'o/contact' && $action == 'setting' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('support/o/contact/setting');?>" title="Address Settings"><span class="icons">C</span>Address Settings</a></li>
					<li <?php echo $controller == 'o/widget' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('support/o/widget/manage');?>" title="Social Media Widget"><span class="icons">C</span>SosMed Widget</a></li>
				</ul>				
			</li>
			<li <?php echo in_array($controller, array('language','phrase','pluginphrase')) ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('language/manage');?>" title="<?php echo Phrase::trans(137,0);?>"><?php echo Phrase::trans(137,0);?></a></li>
			<li <?php echo $controller == 'theme' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('theme/manage');?>" title="<?php echo Phrase::trans(240,0);?>"><?php echo Phrase::trans(240,0);?></a></li>
			<li <?php echo $currentAction == 'settings/analytic' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/analytic');?>" title="<?php echo Phrase::trans(58,0);?>"><?php echo Phrase::trans(58,0);?></a></li>		
		<?php } else {?>
			<li <?php echo in_array($controller, array('o/contact','o/contactcategory')) ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('support/o/contact/manage');?>" title="<?php echo Phrase::trans(23061,1);?>"><?php echo Phrase::trans(23061,1);?></a></li>
			<li <?php echo $controller == 'template' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('template/manage');?>" title="<?php echo Phrase::trans(602,0);?>"><?php echo Phrase::trans(602,0);?></a></li>
		<?php }?> 
	<?php }?>
	</ul>
</div>
<?php //end.Submenu ?>