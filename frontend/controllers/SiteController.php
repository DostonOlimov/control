<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use \yii\data\Pagination;
use common\models\RiskType;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Product;
use common\models\ProductUz;

class SiteController extends Controller
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


	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			]
		];
	}

	public function actionIndex($categoryId = null,$product=1)
	{

		
		$lang = Yii::$app->language;
		$query1 = Product::find()
			->where(['status' => 1])
			->andFilterWhere(['category' => $categoryId])
			->andFilterWhere(['lang' => $lang])
			->orderBy('created_at DESC');
	

		$pages = new Pagination(['totalCount' => $query1->count(), 'pageSize' => 15]);
		
		$models = $query1->offset($pages->offset)
		->limit($pages->limit)
		->all();

		return $this->render('index', [
			'models' => $models,
			'pages' => $pages,
			'categoryId' => $categoryId,
			'product' => $product
		]);
	}

    public function actionIndexuz($categoryId = null,$product=2)
    {


        $lang = Yii::$app->language;

        $query = ProductUz::find()
            ->where(['status' => 1])
            ->andFilterWhere(['category' => $categoryId])
            ->andFilterWhere(['lang' => $lang])
            ->orderBy('created_at DESC');

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 15]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('indexuz', [
            'models' => $models,
            'pages' => $pages,
            'categoryId' => $categoryId,
			'product' => $product
        ]);
    }

	public function actionView($productId,$product)
	{
		$lang = Yii::$app->language;
        if ($product == 1)
        {
            $model = Product::findOne(['parent_id' => $productId, 'lang' => $lang]);

            if (!$model)
            {
                $model = Product::findOne(['parent_id' => $productId, 'lang' => 'cyrl']);
            }

            $model->views = 1 * $model->views + 1;
            $model->save();
             if(is_numeric($model->type_of_alert)) $model->type_of_alert = Product::getAlert($model->type_of_alert);
            if(is_numeric($model->type)) $model->type = Product::getType($model->type);
            if(is_numeric($model->risk_type)) $model->risk_type = RiskType::find()->where(['id' => $model->risk_type])->one()->name_cyrl;

            return $this->render('view', [
                'model' => $model,
				'product' => $product
                // 'categoryId' => $categoryId,
            ]);
        }
        else
        {
            $model = ProductUz::findOne(['parent_id' => $productId, 'lang' => $lang]);

            if (!$model)
            {
                $model = ProductUz::findOne(['parent_id' => $productId, 'lang' => 'cyrl']);
            }

            $model->views = 1 * $model->views + 1;
            $model->save();

            return $this->render('view', [
                'model' => $model,
				'product' => $product
                // 'categoryId' => $categoryId,
            ]);

        }

	}

	public function actionAbout()
	{
		return $this->render('about');	
	}

	public function actionInformation()
	{
		return $this->render('information');	
	}

	public function actionContact()
	{
		return $this->render('contact');	
	}

	public function actionSearch($categoryId = null,$product=1)
	{
		$lang = Yii::$app->language;
		$q = Yii::$app->request->get('q');
		$q = strip_tags($q);
		$q = addslashes($q);
		//var_dump($q);die;
		$query = Product::find()
			->where(['status' => 1])
			->andFilterWhere(['like', 'product', $q])
			->andFilterWhere(['lang' => $lang])
			->orderBy('created_at DESC');
		if(!$query->exists()){
			$query = Product::find()
                        ->where(['status' => 1])
                        ->andFilterWhere(['lang' => $lang])
                        ->andFilterWhere(['like', 'codetnved', $q])
                        ->orderBy('created_at DESC');
		}

		$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 15]);
		
		$models = $query->offset($pages->offset)
		->limit($pages->limit)
		->all();
		
		return $this->render('index', [
			'models' => $models,
			'pages' => $pages,
			'categoryId' => $categoryId,
			'product' => $product
		]);
	}

	// public function actionLogin()
	// {
	// 	if (!Yii::$app->user->isGuest)
	// 	{
	// 		return $this->goHome();
	// 	}

	// 	$model = new LoginForm();
	// 	if ($model->load(Yii::$app->request->post()) && $model->login())
	// 	{
	// 		return $this->goBack();
	// 	}
	// 	else
	// 	{
	// 		$model->password = '';

	// 		return $this->render('login', [
	// 			'model' => $model,
	// 		]);
	// 	}
	// }

	// public function actionLogout()
	// {
	// 	Yii::$app->user->logout();

	// 	return $this->goHome();
	// }

	public function actionSignup()
	{
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post()) && $model->signup())
		{
			Yii::$app->session->setFlash('success', 'Вы зарегистрировались.');
			return $this->redirect(['/account/users']);
		}

		return $this->render('signup', [
			'model' => $model,
		]);
	}
}
