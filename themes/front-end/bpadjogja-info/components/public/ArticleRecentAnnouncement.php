<?php

class ArticleRecentAnnouncement extends CWidget
{

	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		$controller = strtolower(Yii::app()->controller->id);
		
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
		//$criteria->addInCondition('cat_id',array(18));
		$criteria->compare('cat_id',18);
		$criteria->limit = 3;
			
		$model = Articles::model()->findAll($criteria);

		$this->render('article_recent_announcement',array(
			'model' => $model,
		));	
	}
}
