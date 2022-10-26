<?php

namespace backend\controllers;

use Yii;
use common\models\Codetnved;
use backend\models\CodetnvedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CodetnvedController extends Controller
{
	public function __construct($id, $module, $config = array()) {

		
		
		$session = Yii::$app->session;
		$language = $session->get('language');
		$defaultLang = Yii::$app->language;
		
		if ($language) {
			Yii::$app->language = $language;
		}
		else {
			$session->set('language', $defaultLang);
			Yii::$app->language = $defaultLang;
		}

		$get = Yii::$app->request->get();
		if (!empty($get) and isset($get['language'])) {
			$session->set('language', $get['language']);
			Yii::$app->language = $get['language'];
		}
		
		parent::__construct($id, $module, $config);

		
	}
	
	public function actionIndex()
	{
		$searchModel = new CodetnvedSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionCreate($id = null)
	{
		$model = Codetnved::findOne(['id' => $id]);
		if ($model === null)
		{
			$model = new Codetnved();
		}

		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['index']);
		}

		return $this->render('_form', [
			'model' => $model,
		]);
	}
}
