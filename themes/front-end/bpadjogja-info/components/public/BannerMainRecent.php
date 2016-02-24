<?php

class BannerMainRecent extends CWidget
{
	public $category=null;

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
		$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
		$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
		
		//import model
		Yii::import('application.modules.banner.models.Banners');
		Yii::import('application.modules.banner.models.BannerCategory');

		$criteria=new CDbCriteria;
		$criteria->condition = 'publish = :publish AND ((expired_date >= curdate() OR published_date >= curdate()) OR ((expired_date = :date OR expired_date = :datestr) OR published_date >= curdate()))';
		$criteria->params = array(
			':publish'=>1,
			':date'=>'0000-00-00', 
			':datestr'=>'1970-01-01', 
		);
		$criteria->order = 'expired_date DESC';
		if($this->category != null) {
			$criteria->compare('cat_id',$this->category);
			$criteria->limit = BannerCategory::model()->findByPk($this->category)->limit;
		}
		
		$model = Banners::model()->findAll($criteria);

		$this->render('banner_main_recent',array(
			'model' => $model,
			'category' => $category,
		));
	}
}
