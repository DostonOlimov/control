<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\Codetnved;
use common\models\Model;
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
	public function actionImage()
	{
		$model = new ImageUpdate();

		$product = new ProductSearch();

		foreach ( $product->searchCategoryId() as $item ) {
			$category_id [] = $item->parent_id;

		}
        $category_id_unique = array_unique($category_id);

		return $this->render('image',['model'=>$model,'category_id'=>$category_id_unique]);
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
					else
					{
						$productNewNew->save();
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
                if($item->Share()){
                    $item->share_status = 1;
                    $item->save();
                    return $this->redirect(['index']);
                }
              else{
                  $item->share_status = 2;
                  $item->save();
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
