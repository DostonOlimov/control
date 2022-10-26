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
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Product;

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

	public function actionIndex($categoryId = null)
	{

		
		$lang = Yii::$app->language;
		$query = Product::find()
			->where(['status' => 1])
			->andFilterWhere(['category' => $categoryId])
			->andFilterWhere(['lang' => $lang])
			->orderBy('created_at DESC');

		$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 15]);
		
		$models = $query->offset($pages->offset)
		->limit($pages->limit)
		->all();
		
		return $this->render('index', [
			'models' => $models,
			'pages' => $pages,
			'categoryId' => $categoryId,
		]);
	}

	public function actionView($productId)
	{
		$lang = Yii::$app->language;
		$model = Product::findOne(['parent_id' => $productId, 'lang' => $lang]);

		if (!$model)
		{
			$model = Product::findOne(['parent_id' => $productId, 'lang' => 'cyrl']);
		}

		$model->views = 1 * $model->views + 1;
		$model->save();

		return $this->render('view', [
			'model' => $model,
			// 'categoryId' => $categoryId,
		]);
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

	public function actionSearch($categoryId = null)
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
