<?php

class ArticleMainNewsRecent extends CWidget
{

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
		
		//import model
		Yii::import('application.modules.article.models.Articles');
		Yii::import('application.modules.article.models.ArticleCategory');
		Yii::import('application.modules.article.models.ArticleMedia');
		
		$criteria=new CDbCriteria;
		$criteria->condition = 'publish = :publish AND published_date <= curdate()';
		$criteria->params = array(
			':publish'=>1,
		);
		$criteria->order = 'published_date DESC';
		$criteria->compare('cat_id',1);
		$criteria->limit = 3;
			
		$model = Articles::model()->findAll($criteria);

		$this->render('article_main_news_recent',array(
			'model' => $model,
		));	
	}
}
