<?php

namespace backend\controllers;

use Yii;
use common\models\ProductUz;
use backend\models\ProductUzSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\CategorySearch;
use backend\models\CountrySearch;
use backend\models\CodetnvedSearch;
use backend\models\ProductSearch;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;

/**
 * ProductUzController implements the CRUD actions for ProductUz model.
 */
class ProductUzController extends Controller
{
    /**
     * {@inheritdoc}
     */
   /* public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/
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
     * Lists all ProductUz models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductUzSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductUz model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = ProductUz::findOne(['id' => $id]);
        $modelRu = ProductUz::findOne(['parent_id' => $id, 'lang' => 'ru']);

        if ($model === null) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $this->render('view', [
            'model' => $model,
            'modelRu' => $modelRu,
        ]);
    }




    public function actionCreate($id = null)
    {

        $model = ProductUz::findOne(['id' => $id]);
        $models = [];
        $error = [];

        if ($model === null)
        {
            $isNewRecord = true;

            $model = new ProductUz();
            $model->lang = 'cyrl';
            $models[0] = $model;

            $modelRu = new ProductUz();
            $modelRu->lang = 'ru';
            $models[1] = $modelRu;

            $photo = null;
        }
        else
        {
            $isNewRecord = false;
            $models[0] = $model;

            $modelRu = ProductUz::findOne(['parent_id' => $model->id, 'lang' => 'ru']);
            if ($modelRu)
            {
                $models[1] = $modelRu;
            }
            else
            {
                $modelRu = new ProductUz();
                $modelRu->lang = 'ru';
                $models[1] = $modelRu;
            }

            $photo = $model->photo;
        }

        if ($model->load(Yii::$app->request->post()))
        {
            $products = Yii::$app->request->post('ProductUz');

            $transaction = \Yii::$app->db->beginTransaction();

            $parentId = 0;
            $productsNew = [];

            if (!empty($products) and is_array($products))
            {
                foreach ($products as $key => $product)
                {

                    if (!is_array($product) and empty($product))
                    {

                        continue;
                    }
                    $idNew = (isset($product['id']) and 1 * $product['id'] > 0) ? $product['id'] : null;
                    $productNew = ProductUz::findOne(['id' => $idNew]);

                    if (!$productNew)
                    {
                        $productNew = new ProductUz();
                    }

                    $productNew->load(['ProductUz' => $product]);

                 //   VarDumper::dump(,12,true);die;
                    if (!($valid = $productNew->validate()))
                    {
                        $transaction->rollBack();
                        break;
                    }
                    else
                    {

                        $productNew->save();
                        if ($productNew->lang == 'cyrl')
                        {
                            $parentId = $productNew->id;
                            $categoryId = $productNew->category;
                            $typeId = $productNew->type;
                            $companyINN = $productNew->company_inn;
                            $alertTypeId = $productNew->type_of_alert;
                            $riskTypeId = $productNew->risk_type;
                            $codetnved = $productNew->codetnved;

                        }
                        $productsNew[] = $productNew;
                    }
                }
            }

            $image = UploadedFile::getInstance($model, 'photo');
            if (!is_null($image))
            {
                $folder = Yii::getAlias('@frontend') . '/web/productuzPhotos';
                if(!is_dir($folder))
                {
                    mkdir($folder, 0777);
                }
                //$ext = end((explode(".", $image->name)));
                $tmp = explode('.', $image->name);
                $ext = end($tmp);
                $model->photo = date('Y-m-d') . '-' . Yii::$app->security->generateRandomString().".{$ext}";
                $path = $folder . '/' . $model->photo;
                $image->saveAs($path);
            }
            else
            {
                $model->photo = $photo;
            }


            if ($valid)
            {
                foreach ($productsNew as $key => $productNewNew)
                {
                    $productNewNew->photo = $model->photo;
                    $productNewNew->parent_id = $parentId;


                    if (!($valid = $productNewNew->validate()))
                    {
                        $transaction->rollBack();
                        break;
                    }
                    elseif($productNewNew->codetnved == $codetnved && $productNewNew->type == $typeId && $productNewNew->type_of_alert == $alertTypeId &&
                        $productNewNew->category == $categoryId && $productNewNew->company_inn == $companyINN && $productNewNew->risk_type == $riskTypeId )
                    {
                       $productNewNew->save();
                    }
                    else
                    {
                       if($productNewNew->codetnved != $codetnved) $error[] = 'Kode TnVed bir xil bo\'lishi kerak</br>';
                        if($productNewNew->type != $typeId ) $error[] = 'Mahsulot turi bir xil bo\'lishi kerak</br>';
                        if($productNewNew->category != $categoryId ) $error[] =  'Kategoriya bir xil bo\'lishi kerak</br>';
                        if($productNewNew->type_of_alert != $alertTypeId ) $error[] =  'Ogohlantirish turi bir xil bo\'lishi kerak</br>';
                        if($productNewNew->company_inn != $companyINN) $error[] =  'Kompaniya SITR bir xil bo\'lishi kerak</br>';
                        if($productNewNew->risk_type != $riskTypeId) $error[] =  'Xavf turi bir xil bo\'lishi kerak</br>';

                        return $this->render('_form', [
                            'model' => $model,
                            'models' => $productsNew,
                            'errors' => $error,

                        ]);
                        $transaction->rollBack();
                        break;
                    }
                }
            }

            if ($valid)
            {
                $transaction->commit();
                return $this->redirect(['view', 'id' => $parentId]);
            }
        }

        return $this->render('_form', [
            'model' => $model,
            'models' => $models,
            'errors' => $error,

        ]);
    }


    /**
     * Deletes an existing ProductUz model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = ProductUz::findAll(['parent_id' => $id]);

        foreach($model as $item)
        {
            if ($item->photo)
            {
                $folder = Yii::getAlias('@frontend') . '/web/productuzPhotos';
                @unlink($folder.'/'.$item->photo);
                $item->delete();
            }
            $item->delete();
        }

        return $this->redirect(['index']);
    }
    /**
     * Finds the ProductUz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductUz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductUz::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
