<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use common\models\Product;
use common\models\Codetnved;
use common\models\RiskType;
use common\models\Category;
use backend\models\GetData;
use backend\models\CategorySearch;
use backend\models\CountrySearch;
use backend\models\CodetnvedSearch;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\ImportFile;
use backend\models\ImageUpdate;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use function React\Promise\all;
use function Symfony\Component\String\s;


class ProductController extends Controller
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
		$searchModel = new ProductSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}
	/* update images for products which id is null */
	public function actionGetdata()
	{
        $data = [];
		$t=false;
		$model = new GetData();
        if ($model->load(Yii::$app->request->post()) )
        {
            $myArray = json_decode(json_encode($model), true);
            $format_date_from = date('Y-m-d H:i:s',strtotime($myArray['date_from']));
            $format_date_to = date('Y-m-d H:i:s',strtotime($myArray['date_to']));
            $date_to = strtotime($format_date_to.'+ 1 day');
            $date_from = strtotime($format_date_from);

          if($myArray['lang'] == 0)
		  {
			$rows = Product::find()
			->where(['between', 'created_at', $date_from, $date_to])
			->all();
		   }
		   elseif($myArray['lang'] == 2)
		   {
			$rows = Product::find()
			->where(['between', 'created_at', $date_from, $date_to])
			->andWhere(['lang' => 'cyrl'])
			->all();
		   }
		   else
		   {
			$rows = Product::find()
			->where(['between', 'created_at', $date_from, $date_to])
			->andWhere(['lang' => 'ru'])
			->all();
		   }
			
          if($rows)
          {
              $spreadsheet = new Spreadsheet();
              $spreadsheet->getSheet(0);
              $sheet = $spreadsheet->getActiveSheet();
              $sheet->setCellValueByColumnAndRow(1,1,'id');
              $sheet->setCellValueByColumnAndRow(2,1,'parent_id');
              $sheet->setCellValueByColumnAndRow(3,1,'language');

              $j =4;
              foreach($myArray as $key => $x_value) {
                if($x_value and $key != 'lang' and  $key != 'date_from' and $key != 'date_to')
                {
                    $sheet->setCellValueByColumnAndRow($j,1,$key);
                    $j=$j+1;
                }
              }
              $sheet->setCellValueByColumnAndRow($j,1,'created_at');
              $sheet->setCellValueByColumnAndRow($j+1,1,'updated_at');

              $j=2;
              foreach($rows as $key => $row)
              {

                              $sheet->setCellValueByColumnAndRow(1,$j,$row['id']);
                              $sheet->setCellValueByColumnAndRow(2,$j,$row['parent_id']);
                              $sheet->setCellValueByColumnAndRow(3,$j,$row['lang']);
                               $i=4;
                              foreach($myArray as $k => $x_value)
                              {
                               
                                  if($x_value and $k != 'lang' and  $k != 'date_from' and $k != 'date_to')
                                  {
                                      if($k == 'category')
                                      {
                                          $category = Category::find()
                                              ->where(['id' => $row[$k]])
                                              ->one();
                                          $row['lang'] == 'cyrl'?$row[$k] = $category->name_cyrl:$row[$k] = $category->name_ru;
                                      }

                                      if($k == 'type' and is_numeric($row[$k]))
                                      {
                                          $type =Product::getType($row[$k]);
                                          $row[$k] = $type;
							
                                      }
									 

                                      if($k == 'risk_type' and is_numeric($row[$k]))
                                      {
                                          $risk_type = RiskType::find()
                                              ->where(['id' => $row[$k]])
                                              ->one();
                                          $row['lang'] == 'cyrl'?$row[$k] = $risk_type->name_cyrl:$row[$k] = $risk_type->name_ru;
                                      }
                                      $sheet->setCellValueByColumnAndRow($i,$j,$row[$k]);
                                      $i++;
                                  }

                              }
                  $sheet->setCellValueByColumnAndRow($i,$j,date('Y-m-d H:i:s',$row['created_at']));
                  $sheet->setCellValueByColumnAndRow($i+1,$j,date('Y-m-d H:i:s',$row['updated_at']));
                  $j++;

              }
		
              $writer = new Xlsx($spreadsheet);

              // Save .xlsx file to the files directory
              $writer->save('../../uploads/products.xlsx');

			 $t=true;

          }
		  else
		  {
			echo '<div class="alert alert-danger ">Tanlangan vaqt oralig\'ida malumotlar yo\'q</div>';
		  }

        }
        return $this->render('getdata', [
            'model' => $model,
			't' =>$t,
        ]);
	}


	/* excel file upload by doston*/
	public $dataArray;

	public $dataArrayru;

    public function actionImport()
    {
        $model = new ImportFile();

		$category = new CategorySearch();

		$country = new CountrySearch();

		$kode = new CodetnvedSearch();

		$arrayCondition = [false, false, false, false, false, false];


        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstance($model, 'excelFile');
            if ($model->upload()) 
			{
               if($model->readData())
			   {

				$arr = $model->readData();

				$exsamle = $model->exsamleMenu;
				
				// Creates New Spreadsheet 
				$spreadsheet = new Spreadsheet();
				$spreadsheet1 = new Spreadsheet();
				$spreadsheet2 = new Spreadsheet();
				$spreadsheet3 = new Spreadsheet();
				$spreadsheet4 = new Spreadsheet();
				$spreadsheet5 = new Spreadsheet();	
				// Get the first sheet in the workbook 
				$spreadsheet->getSheet(0);
				$spreadsheet1->getSheet(0);
				$spreadsheet2->getSheet(0);
				$spreadsheet3->getSheet(0);
				$spreadsheet4->getSheet(0);
				$spreadsheet5->getSheet(0);
				// Retrieve the current active worksheet 
				$sheet = $spreadsheet->getActiveSheet();
				$sheet1 = $spreadsheet1->getActiveSheet();
				$sheet2 = $spreadsheet2->getActiveSheet();
				$sheet3 = $spreadsheet3->getActiveSheet();
				$sheet4 = $spreadsheet4->getActiveSheet();
				$sheet5 = $spreadsheet5->getActiveSheet();
				//check is not empty product
				$exclude_products = [];
				$required_columns = [
						'Категория',
						'Код ТН-ВЭД',
						'Маҳсулот',
						'Тавсифи',
						'Огоҳлантирувчи томонидан юборилган',
						'Таъминотчи мамлакат',
						'Маҳсулот(р)',
						'Тавсифи(р)'			
				];
				//
				foreach($arr as $key => $column){
					foreach($column as $k => $item){
						
						if(in_array($key, $required_columns)){
							if(!$item){
								 $exclude_products[$key] = $k;
							 }	
						}
					}
				}
			
				foreach($arr as $key => $column){
					
					foreach($column as $k => $item){
							if(in_array($k, $exclude_products))
							{
								$exclude_products_row[$k][]=$item;
								unset($arr[$key][$k]);
								$arrayCondition[1] = true;

							}
						}	
				}
				$row_index =2;
				foreach($exclude_products_row as $key => $column)
				{
					foreach($column as $k => $item)
					{
						$sheet1->setCellValueByColumnAndRow($k+1,$row_index,$item);
					}
					$row_index++;
				}
				//category, kode ,country_of_origin, country_of_allert
					$exclude_category = [];
					$exclude_kode = [];
					$exclude_allert_country = [];
					$exclude_made_country = [];
					$category_id = [];
					
					foreach($arr as $key => $column){
						foreach($column as $k => $item){
							if($required_columns[0]==$key and !$category->searchbyName(trim($item)))
							{
								$exclude_category[] = $k;
							}
							if($required_columns[1]==$key and !$kode->searchbyName(trim($item)))
							{
								$exclude_kode[] = $k;
					   		}
							if($required_columns[4]==$key and !$country->searchbyName(trim($item)))
							{
								$exclude_allert_country[] = $k;
							}
							if($required_columns[5]==$key and !$country->searchbyName(trim($item)))
							{
								$exclude_made_country[] = $k;
					   		}
						
						}
					}
				
					// get from category table not exist
					$exclude_category_rows =[];
					foreach($arr as $key => $column){
							foreach($column as $k => $item){
								if(in_array($k, $exclude_category))
								{
									$exclude_category_rows[$k][]=$item;
									unset($arr[$key][$k]);
									$arrayCondition[2] = true;
										
								}
								
							}
						}
					$row_index =2;
					foreach($exclude_category_rows as $key => $column){
							foreach($column as $k => $item){
								$sheet2->setCellValueByColumnAndRow($k+1,$row_index,$item);
								}
								$row_index++;

							}
					// get from code table not exist
					$exclude_kode_rows =[];
					foreach($arr as $key => $column){
						foreach($column as $k => $item){
							if(in_array($k, $exclude_kode))
							{
								$exclude_kode_rows[$k][]=$item;
								unset($arr[$key][$k]);
								$arrayCondition[3] = true;
									
							}
						}
					}
							$row_index =2;
				foreach($exclude_kode_rows as $key => $column){
						foreach($column as $k => $item){
							$sheet3->setCellValueByColumnAndRow($k+1,$row_index,$item);
							}
							$row_index++;

						}
						// get from allert country table not exist
						$exclude_allert_country_rows = [];
					foreach($arr as $key => $column){
						foreach($column as $k => $item){
							if(in_array($k, $exclude_allert_country))
							{
								$exclude_allert_country_rows[$k][]=$item;
								unset($arr[$key][$k]);
								$arrayCondition[4] = true;
									
							}
						}
					}
				$row_index =2;
				foreach($exclude_allert_country_rows as $key => $column){
						foreach($column as $k => $item){
							$sheet4->setCellValueByColumnAndRow($k+1,$row_index,$item);
							}
							$row_index++;

						}
						// get from made country table not exist
					$exclude_made_country_rows =[];
					foreach($arr as $key => $column){
						foreach($column as $k => $item){
							if(in_array($k, $exclude_made_country))
							{
								$exclude_made_country_rows[$k][]=$item;
								unset($arr[$key][$k]);
								$arrayCondition[5] = true;
									
							}
				$row_index =2;
						}
					}
				foreach($exclude_made_country_rows as $key => $column)
				{
						foreach($column as $k => $item){
							$sheet5->setCellValueByColumnAndRow($k+1,$row_index,$item);
							}
							$row_index++;

						}
	
					$header = []; 
				//set value row
				for ($i=0;$i<count($exsamle);$i++) 
				{

					$j=2;
					$new = array_push($header,$exsamle[$i]);
				}
				
				$j=1;
				foreach($header as $x_value) {
				$sheet1->setCellValueByColumnAndRow($j,1,$x_value);
				$sheet2->setCellValueByColumnAndRow($j,1,$x_value);
				$sheet3->setCellValueByColumnAndRow($j,1,$x_value);
				$sheet4->setCellValueByColumnAndRow($j,1,$x_value);
				$sheet5->setCellValueByColumnAndRow($j,1,$x_value);
				$j=$j+1;
  		
				}


                   foreach ($arr['Категория'] as $i =>$item)
                   {
				$this->dataArray['category'] = strval($category->searchbyName(trim($arr['Категория'][$i]))->id);
				$this->dataArray['codetnved'] = $kode->searchByName(trim($arr['Код ТН-ВЭД'][$i]))->kod;
				$this->dataArray['product'] = $arr['Маҳсулот'][$i];
				$this->dataArray['type_of_alert'] = $arr['Огоҳлантириш тури'][$i];
				$this->dataArray['type'] = $arr['Тури'][$i];
				$this->dataArray['alert_number'] = $arr['Огоҳлантириш рақами'][$i];
				$this->dataArray['alert_submitted_by'] =trim($arr['Огоҳлантирувчи томонидан юборилган'][$i]);
				$this->dataArray['country_of_origin'] = trim($arr['Таъминотчи мамлакат'][$i]);
				$this->dataArray['counterfeit'] ='';
				$this->dataArray['risk_type'] = $arr['Хавф тури'][$i];
				$this->dataArray['name'] = $arr['Номи'][$i];
				$this->dataArray['description'] = $arr['Тавсифи'][$i];
				$this->dataArray['brand'] = $arr['Марка'][$i];
				$this->dataArray['type_number_of_model'] = $arr['Тури / модел рақами'][$i];
				$this->dataArray['batch_number_barcode'] = $arr['Партияси / штрих-коди'][$i];
				$this->dataArray['oecd_portal_category'] = $arr['OECD'][$i];
				$this->dataArray['risk'] = $arr['Хавф'][$i];
				$this->dataArray['technical_defect'] = $arr['Техник нуқсон'][$i];
				$this->dataArray['measures_adopted_by_notifying_country'] = $arr['Огоҳлантирувчи давлатлар томонидан кўрилган чоралар'][$i];
				$this->dataArray['products_were_found_and_measures_were_taken_also_in'] = $arr['Маҳсулотлар топилди ва уларга чоралар кўрилди'][$i];
				$this->dataArray['company_recall_page'] = $arr['Компания чақириш саҳифаси'][$i];
				$this->dataArray['url_of_case'] = $arr['URL манзили'][$i];
				$this->dataArray['barcode'] = $arr['Штрих-код'][$i];
				$this->dataArray['batch_number'] = $arr['Партияси'][$i];
				$this->dataArray['company_recall_code'] = $arr['Компания чақириш коди  (**)'][$i];
				$this->dataArray['production_dates'] = $arr['Ишлаб чиқарилган санаси (**)'][$i];
				$this->dataArray['packaging_description'] = $arr['Қадоқлаш тавсифи'][$i];
				$this->dataArray['photo'] = null;
				$this->dataArray['status'] = 1;

				// get data from arr to dataArray ru
				$this->dataArrayru['category'] = strval($category->searchbyName(trim($arr[$exsamle[0]][$i]))->id);
				$this->dataArrayru['codetnved'] = $kode->searchByName(trim($arr[$exsamle[1]][$i]))->kod;
				$this->dataArrayru['product'] = $arr['Маҳсулот(р)'][$i];
				$this->dataArrayru['type_of_alert'] = $arr['Огоҳлантириш тури(р)'][$i];
				$this->dataArrayru['type'] = $arr['Тури(р)'][$i];
				$this->dataArrayru['alert_number'] = $arr['Огоҳлантириш рақами'][$i];
				$this->dataArrayru['alert_submitted_by'] = trim($arr['Огоҳлантирувчи томонидан юборилган'][$i]);
				$this->dataArrayru['country_of_origin'] = trim($arr['Таъминотчи мамлакат'][$i]);
				$this->dataArrayru['counterfeit'] = '';
				$this->dataArrayru['risk_type'] = $arr['Хавф тури(р)'][$i];
				$this->dataArrayru['name'] = $arr['Номи'][$i];
				$this->dataArrayru['description'] = $arr['Тавсифи(р)'][$i];
				$this->dataArrayru['brand'] = $arr['Марка'][$i];
				$this->dataArrayru['type_number_of_model'] = $arr['Тури / модел рақами'][$i];
				$this->dataArrayru['batch_number_barcode'] = $arr['Партияси / штрих-коди'][$i];
				$this->dataArrayru['oecd_portal_category'] = $arr['OECD'][$i];
				$this->dataArrayru['risk'] = $arr['Хавф(р)'][$i];
				$this->dataArrayru['technical_defect'] = $arr['Техник нуқсон(р)'][$i];
				$this->dataArrayru['measures_adopted_by_notifying_country'] = $arr['Огоҳлантирувчи давлатлар томонидан кўрилган чоралар(р)'][$i];
				$this->dataArrayru['products_were_found_and_measures_were_taken_also_in'] = $arr['Маҳсулотлар топилди ва уларга чоралар кўрилди(р)'][$i];
				$this->dataArrayru['company_recall_page'] = $arr['Компания чақириш саҳифаси'][$i];
				$this->dataArrayru['url_of_case'] = $arr['URL манзили'][$i];
				$this->dataArrayru['barcode'] = $arr['Штрих-код'][$i];
				$this->dataArrayru['batch_number'] = $arr['Партияси'][$i];
				$this->dataArrayru['company_recall_code'] = $arr['Компания чақириш коди  (**)'][$i];
				$this->dataArrayru['production_dates'] = $arr['Ишлаб чиқарилган санаси (**)'][$i];
				$this->dataArrayru['packaging_description'] = $arr['Қадоқлаш тавсифи(р)'][$i];
				$this->dataArrayru['photo'] = null;
				$this->dataArrayru['status'] = 1;

				$model1 = new Product();
				$model1->lang = 'cyrl';
				$model2 = new Product();
				$model2->lang = 'ru';
		// save data for cyrl model
			$model1 ->load($this->dataArray,'');
			$model1->parent_id = $model1->id;
			$model1->save();
			$parentId = $model1->id;
			$model1 = Product::FindOne(['id' => $parentId]);
			$model1->parent_id = $parentId;
			$model1->save();
		// save data for ru model
			$model2 ->load($this->dataArrayru,'');
			$model2->parent_id = $parentId;
			$model2->save();
		   $arrayId[] = $parentId;

			}

			// create  excel file for saved dataArrayru
		$sheet->setCellValueByColumnAndRow(1,1,'id');
		$j=2;
		foreach($header as $x_value) {
		$sheet->setCellValueByColumnAndRow($j,1,$x_value);
		$j=$j+1;
		}
		$col = 2;

		if(!empty($arr) ){
			$arrayCondition[0] = true;
			foreach($arr as $key => $column)
			{
                $row = 0;
				foreach($column as $k => $item)
				{
                    $row++;
                    $sheet->setCellValueByColumnAndRow($col,$row+1,$item);
				}
                $col++;
			}

			$row = 2;
			foreach ($arrayId as $key => $item)
			{
			$sheet->setCellValueByColumnAndRow(1,$key+2,strval($item));
			$row++;
			}
		}	
		
	// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet); 
		$writer1 = new Xlsx($spreadsheet1); 
		$writer2 = new Xlsx($spreadsheet2); 
		$writer3 = new Xlsx($spreadsheet3); 
		$writer4 = new Xlsx($spreadsheet4); 
		$writer5 = new Xlsx($spreadsheet5); 


	// Save .xlsx file to the files directory 
		$writer->save('../../uploads/succes.xlsx'); 
		$writer1->save('../../uploads/error_name.xlsx'); 
		$writer2->save('../../uploads/error_category.xlsx'); 
		$writer3->save('../../uploads/error_kode.xlsx'); 
		$writer4->save('../../uploads/error_allert_country.xlsx'); 
		$writer5->save('../../uploads/error_made_country.xlsx'); 
			   }
			  else
			   {
   
				   @unlink(Yii::$app->basePath . '/uploads/' . $model->excelFile);
				   echo '<div class="alert alert-danger ">Namunaga mos fayl yuklang!!!</div>';
			   }
            }
			else
			{
				echo '<div class="alert alert-danger">Faylni o\'qishda muammo yuzaga keldi.
				Faylni tekshirib qayta yuklang';
			}

        }

		@unlink(Yii::$app->basePath . '/uploads/'.$model->excelFile);
        return $this->render('import', ['model' => $model,'arrayCondition' => $arrayCondition]);
    }
			
	public function actionView($id)
	{
		$model = Product::findOne(['id' => $id]);
		$modelRu = Product::findOne(['parent_id' => $id, 'lang' => 'ru']);

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
		$model = Product::findOne(['id' => $id]);
		$models = [];
        $error = [];
		
		if ($model === null)
		{
			$isNewRecord = true;
			
			$model = new Product();
			$model->lang = 'cyrl';
			$models[0] = $model;

			$modelRu = new Product();
			$modelRu->lang = 'ru';
			$models[1] = $modelRu;
			
			$photo = null;
			
		}
		else
		{
			$isNewRecord = false;
			$models[0] = $model;

			$modelRu = Product::findOne(['parent_id' => $model->id, 'lang' => 'ru']);
			if ($modelRu)
			{
				$models[1] = $modelRu;
			}
			else
			{
				$modelRu = new Product();
				$modelRu->lang = 'ru';
				$models[1] = $modelRu;
			}
			$photo = $model->photo;
			
		}
		if ($model->load(Yii::$app->request->post()))
		{
			$products = Yii::$app->request->post('Product');

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
					$productNew = Product::findOne(['id' => $idNew]);
					
					if (!$productNew)
					{
						$productNew = new Product();
					}

					$productNew->load(['Product' => $product]);
					
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
                            $alertTypeId = $productNew->type_of_alert;
                            $riskTypeId = $productNew->risk_type;
                            $codetnved = $productNew->codetnved;
                            $origin_country = $productNew->country_of_origin;
                            $alert_country = $productNew->alert_submitted_by;
							$status = $productNew->status;
						}
						$productsNew[] = $productNew;
					}
				}				
			}


			$image = UploadedFile::getInstance($model, 'photo');
			if (!is_null($image))
			{
				$folder = Yii::getAlias('@frontend') . '/web/productPhotos';
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
                        $productNewNew->category == $categoryId  && $productNewNew->risk_type == $riskTypeId && $productNewNew->status == $status &&
						$productNewNew->alert_submitted_by == $alert_country && $productNewNew->country_of_origin == $origin_country)
                    {
						$productNewNew->save();
						if(!$isNewRecord && $productNew->share_status == 1 && $productNewNew->share_status == 1)
						{
							if ($productNew->type_of_alert && is_numeric($productNew->type_of_alert))
							{
								$productNew->type_of_alert =  Product::getAlert($productNew->type_of_alert);
								$productNewNew->type_of_alert =  Product::getAlert($productNewNew->type_of_alert);	
							}
							if ($productNew->type && is_numeric($productNew->type))
							{
								$productNew->type =  Product::getType($productNew->type);
								$productNewNew->type =  Product::getType($productNewNew->type);	
							}
							if ($productNew->risk_type && is_numeric($productNew->risk_type))
							{
								$risk1 = RiskType::find()->where(['id' => $productNew->risk_type])->one()->name_cyrl;
								$risk2 = RiskType::find()->where(['id' => $productNew->risk_type])->one()->name_cyrl;	
								$productNew->risk_type = $risk1;
								$productNewNew->risk_type = $risk2; 
							}								
							$productNew->share();
							$productNewNew->share();
							
						}
                      
                    }
                    else
                    {
                        if($productNewNew->codetnved != $codetnved) $error[] = 'Kode TnVed bir xil bo\'lishi kerak</br>';
                        if($productNewNew->type != $typeId ) $error[] = 'Mahsulot turi bir xil bo\'lishi kerak</br>';
                        if($productNewNew->category != $categoryId ) $error[] =  'Kategoriya bir xil bo\'lishi kerak</br>';
                        if($productNewNew->type_of_alert != $alertTypeId ) $error[] =  'Ogohlantirish turi bir xil bo\'lishi kerak</br>';
                        if($productNewNew->risk_type != $riskTypeId) $error[] =  'Xavf turi bir xil bo\'lishi kerak</br>';
                        if($productNewNew->alert_submitted_by != $alert_country ) $error[] =  'Ogohlantiruvchi davlat bir xil bo\'lishi kerak</br>';
                        if($productNewNew->country_of_origin != $origin_country) $error[] =  'Taminotchi mamlakat bir xil bo\'lishi kerak</br>';
						if($productNewNew->status != $status) $error[] =  'Status bir xil bo\'lishi kerak</br>';

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

	public function actionDelete($id)
    {
        $model = Product::findAll(['parent_id' => $id]);
       // if ($model->photo){
           // $model -> deleteImage();
          //  $model->delete();
      //  }

	  foreach($model as $item)
	  {
        if ($item->photo)
        {
            $folder = Yii::getAlias('@frontend') . '/web/productPhotos';
            @unlink($folder.'/'.$item->photo);
            $item->delete();
        }
		$item->delete();
	  }
  
        return $this->redirect(['index']);
    }
    // share with customs
    public function actionShares($id)
    {

        $model = Product::findAll(['parent_id' => $id]);
        foreach($model as $item)
        {
            try {
				if ($item->type_of_alert && is_numeric($item->type_of_alert))
							{
								$item->type_of_alert =  Product::getAlert($item->type_of_alert);
							}
							if ($item->type && is_numeric($item->type))
							{
								$item->type =  Product::getType($item->type);
							}
							if ($item->risk_type && is_numeric($item->risk_type))
							{
								$risk1 = RiskType::find()->where(['id' => $item->risk_type])->one()->name_cyrl;
								$risk2 = RiskType::find()->where(['id' => $item->risk_type])->one()->name_cyrl;	
								$item->risk_type = $risk1;
								$item->risk_type = $risk2; 
							}		
                if($item->Share())
				{
					$item2 = Product::findOne(['id' => $item->id]);
                    $item2->share_status = 1;
                    $item2->save();
                    return $this->redirect(['index']);
                }
              else{
				$item2 = Product::findOne(['id' => $item->id]);
				$item2->share_status = 2;
				$item2->save();
				return $this->redirect(['index']);
              }
            }
            catch (\Exception $e)
            {
                echo $e->getMessage();
            }

        }
      //  return $this->redirect(['index']);
    }

	public function actionCodeTnVed($term)
	{
		$kodtnved = Codetnved::find()->select(['kod as id', 'concat(kod, " - ", name) as text'])->where('kod like "%'.$term.'%" or name like "%'.$term.'%"')->asArray()->all();
		return json_encode($kodtnved);
	}
}
