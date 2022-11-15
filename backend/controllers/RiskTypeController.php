<?php

namespace backend\controllers;

use Yii;
use common\models\RiskType;
use backend\models\RiskTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RiskTypeController implements the CRUD actions for RiskType model.
 */
class RiskTypeController extends Controller
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
     * Lists all RiskType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RiskTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate($id = null)
    {
        $model = RiskType::findOne(['id' => $id]);
        if ($model === null)
        {
            $model = new RiskType();
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
     * Deletes an existing RiskType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $item = RiskType::find()->where(['id'=> $id])->one();
        $item->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the RiskType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RiskType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RiskType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
