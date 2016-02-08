<?php

class SupportSosMedWidget extends CWidget
{
	public $socialmedia=null;

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
		Yii::import('application.modules.support.models.SupportContactCategory');
		Yii::import('application.modules.support.models.SupportWidget');
		
		$criteria=new CDbCriteria;		
		if($this->socialmedia != null) {
			$criteria->with = array(
				'cat_TO' => array(
					'alias'=>'a',
				),
				'cat_TO.view_cat' => array(
					'alias'=>'b',
				),
			);
			$criteria->condition = 't.publish = :publish AND b.category_name = :category';
			$criteria->params = array(
				':publish'=>1,
				':category'=>strtolower($this->socialmedia),
			);
			$criteria->order = 't.creation_date DESC';
				
			$model = SupportWidget::model()->find($criteria);

			$this->render('support_sosmed_widget',array(
				'module'=>$module,
				'controller'=>$controller,
				'action'=>$action,
				'currentAction'=>$currentAction,
				'currentModule'=>$currentModule,
				'currentModuleAction'=>$currentModuleAction,
				'model' => $model,
			));	
			
		} else 
			return false;
	}
}
