<?php

class AlbumRecents extends CWidget
{

	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		$controller = strtolower(Yii::app()->controller->id);
		
		//import model
		Yii::import('application.modules.album.models.AlbumPhoto');
		Yii::import('application.modules.album.models.Albums');
		
		$criteria=new CDbCriteria;
		$criteria->condition = 'publish = :publish';
		$criteria->params = array(
			':publish'=>1,
		);
		$criteria->order = 'creation_date DESC';
		$criteria->limit = 3;
			
		$model = Albums::model()->findAll($criteria);

		$this->render('album_recents',array(
			'model' => $model,
		));	
	}
}
