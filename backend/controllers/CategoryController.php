<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CategoryController extends Controller
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

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all RiskType models.
     * @return mixed
     */
	public function actionIndex()
	{
		$searchModel = new CategorySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionCreate($id = null)
	{
		$model = Category::findOne(['id' => $id]);
		if ($model === null)
		{
			$model = new Category();
		}
        
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['index']);
		}

		return $this->render('_form', [
			'model' => $model,
		]);
	}
    /**
     * Finds the RiskType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
