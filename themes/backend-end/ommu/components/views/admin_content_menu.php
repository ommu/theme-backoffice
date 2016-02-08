<?php
// Left Position
if($model != null) {
	echo '<ul class="left clearfix">';
	foreach($model as $val) {		
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
						
					}else
						$arrAttrParams[$part[0]] = $part[1];
				}
			}
		}

		$link = $val[urlPath][url] != null ? Yii::app()->controller->createUrl($val[urlPath][url], $arrAttrParams) : 'javascript:void(0);';
		$icons = $val[urlPath][icon] != null ? $val[urlPath][icon] : 'C';
		
		echo '<li><a href="'.$link.'" title="'.$val[urlTitle].'"><span class="icons">'.$icons.'</span>'.$val[urlTitle].'</a></li>';
	}
	echo '</ul>';
} ?>