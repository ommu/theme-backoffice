<?php

class CoeRecentPost extends CWidget
{
	public $production = 0;
	
	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		
		$module = strtolower(Yii::app()->controller->module->id);
		$controller = strtolower(Yii::app()->controller->id);
		$action = strtolower(Yii::app()->controller->action->id);
		$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
		
		$server = ($_SERVER["SERVER_ADDR"]=='127.0.0.1' || $_SERVER["HTTP_HOST"]=='localhost') ? false : true;		
		if($this->production == 1)
			$urlProduction = 'http://localhost/coe/index.php/Api/index';
		else
			$urlProduction = 'http://coe.bpadjogja.info/index.php/Api/index';
		$url = (($server == true) || ($server != true && $this->production == 0)) ? $urlProduction : 'http://localhost/_client_bpadjogja_backup/bpadjogja_coe/index.php/api/index';
		//echo $url;
			
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		//curl_setopt($ch,CURLOPT_HEADER, true);
		$output=curl_exec($ch);
		curl_close($ch);
		$object = json_decode($output);

		$this->render('coe_recent_post',array(
			'model' => $object,
		));	
	}
}
