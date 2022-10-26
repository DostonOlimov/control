<?php
namespace backend\controllers;

use backend\models\Organ;
use common\models\Product;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\UserSearch;
use common\models\User;

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
			],
		];
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			$model->password = '';

			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	public function actionUsers()
	{
		$searchModel = new UserSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('user', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}


	public function actionStatusUpdate($id)
	{
		$model = User::findOne(['id' => $id]);
		
		if ($model === null)
		{
			throw new \yii\web\ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
		}

		// if ($model->id == 1)
		// {
		// 	throw new \yii\web\ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
		// }

		if ($model->load(Yii::$app->request->post()))
		{
			if ($model->validate() and $model->save())
			{
				return $this->redirect(['users']);
			}
		}

		return $this->render('_form-user', [
			'model' => $model,
		]);
	}

	
	public function actionPasswordUpdate($id)
	{
		$model = User::findOne(['id' => $id]);
		
		if ($model === null)
		{
			throw new \yii\web\ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
		}

		// if ($model->id == 1)
		// {
		// 	throw new \yii\web\ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
		// }
		
		$model->password = '';

		if ($model->load(Yii::$app->request->post()))
		{
			if ($model->validate())
			{
				$model->setPassword($model->password);
				$model->save(false);
				return $this->redirect(['users']);
			}
		}

		return $this->render('_form-user-pass', [
			'model' => $model,
		]);
	}
    public function actionExport()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $styleArray = ['font' => ['bold' => true]];
        $sheet->getStyle('A1:X1')->applyFromArray($styleArray);

        $sheet->setCellValue('A1', 'Тип оповещения');
        $sheet->setCellValue('B1', 'Тип');
        $sheet->setCellValue('C1', 'Номер оповещения');
        $sheet->setCellValue('D1', 'Оповещение отправлено');
        $sheet->setCellValue('E1', 'Страна происхождения');
        $sheet->setCellValue('F1', 'Подделка');
        $sheet->setCellValue('G1', 'Тип риска');
        $sheet->setCellValue('H1', 'Товар');
        $sheet->setCellValue('I1', 'Наименование');
        $sheet->setCellValue('J1', 'Описание');
        $sheet->setCellValue('K1', 'Бранд');
        $sheet->setCellValue('L1', 'Категория');
        $sheet->setCellValue('M1', 'Типовой номер модели');
        $sheet->setCellValue('N1', 'Штрих-код номера партии');
        $sheet->setCellValue('O1', 'Категория портала OECD');
        $sheet->setCellValue('P1', 'Риск');
        $sheet->setCellValue('Q1', 'Технический дефект');
        $sheet->setCellValue('R1', 'Серийный номер');
        $sheet->setCellValue('S1', 'Код отзыва компании');
        $sheet->setCellValue('T1', 'Дата изготовления');
        $sheet->setCellValue('U1', 'Описание упаковки');
        $sheet->setCellValue('V1', 'Код ТН-ВЭД');
        $sheet->setCellValue('X1', 'Статус');

        $products = Product::find()->where(['lang' => 'cyrl']) ->all();

        $i = 2;
        foreach ($products as $product) {
            /* @var $product Product*/

            $sheet->setCellValue('A' . $i, $product->type_of_alert);
            $sheet->setCellValue('B' . $i, $product->type);
            $sheet->setCellValue('C' . $i, $product->alert_number);
            $sheet->setCellValue('D' . $i, $product->alert_submitted_by);
            $sheet->setCellValue('E' . $i, $product->country_of_origin);
            $sheet->setCellValue('F' . $i, $product->counterfeit);
            $sheet->setCellValue('G' . $i, $product->risk_type);
            $sheet->setCellValue('H' . $i, $product->product);
            $sheet->setCellValue('I' . $i, $product->name);
            $sheet->setCellValue('J' . $i, $product->description);
            $sheet->setCellValue('K' . $i, $product->brand);
            $sheet->setCellValue('L' . $i, $product->category);
            $sheet->setCellValue('M' . $i, $product->type_number_of_model);
            $sheet->setCellValue('N' . $i, $product->batch_number_barcode);
            $sheet->setCellValue('O' . $i, $product->oecd_portal_category);
            $sheet->setCellValue('P' . $i, $product->risk);
            $sheet->setCellValue('Q' . $i, $product->technical_defect);
            $sheet->setCellValue('R' . $i, $product->batch_number);
            $sheet->setCellValue('S' . $i, $product->company_recall_code);
            $sheet->setCellValue('T' . $i, $product->production_dates);
            $sheet->setCellValue('U' . $i, $product->packaging_description);
            $sheet->setCellValue('V' . $i, $product->codetnved);
            $sheet->setCellValue('X' . $i, $product->status);
            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = '7.7.2021.xlsx';
        $writer->save('../../frontend/web/excel/' . $filename);
        $this->redirect('/excel/' . $filename);

    }
}