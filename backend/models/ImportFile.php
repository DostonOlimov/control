<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Yii;

/**
 * CountrySearch represents the model behind the search form of `common\models\Country`.
 */
class ImportFile extends Model
{
       /**
     * @var UploadedFile
     */
    public $excelFile;

    public $exsamleMenu = ['Категория', 'Код ТН-ВЭД','Маҳсулот' , 'Тавсифи','Огоҳлантириш тури',
    'Тури','Огоҳлантириш рақами','Огоҳлантирувчи томонидан юборилган','Таъминотчи мамлакат','Хавф тури',
    'Номи','Марка','Тури / модел рақами','Партияси / штрих-коди','OECD','Хавф','Техник нуқсон','Огоҳлантирувчи давлатлар томонидан кўрилган чоралар',
    'Маҳсулотлар топилди ва уларга чоралар кўрилди','Компания чақириш саҳифаси','Штрих-код','Партияси','Компания чақириш коди  (**)','Ишлаб чиқарилган санаси (**)',
    'Қадоқлаш тавсифи','URL манзили','Маҳсулот(р)','Тавсифи(р)','Огоҳлантириш тури(р)','Тури(р)','Хавф тури(р)','Хавф(р)',
    'Техник нуқсон(р)','Огоҳлантирувчи давлатлар томонидан кўрилган чоралар(р)','Маҳсулотлар топилди ва уларга чоралар кўрилди(р)','Қадоқлаш тавсифи(р)'];

    public $baseData = array();
    public function rules()
    {
        return [
            [['excelFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xsl, xlsx,xls,odl'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
  
            $this->excelFile->saveAs('../uploads/' . $this->excelFile->baseName . '.' . $this->excelFile->extension);
            return true;
        } else {
            return false;
        }
    }

    Public function readData()
    {
        $inputFileName = realpath(Yii::$app->basePath ).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$this->excelFile;

  
        try
        {
            $extension = $this->excelFile->extension;

            if ($extension == 'xls')
            {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }
            else
            {
              
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
          

            $spreadsheet = $reader->load($inputFileName);
    
            $data = $spreadsheet->getSheet(0)->toArray();
    
         
           for ($i=0; $i < count($this->exsamleMenu); $i++) 
           {
              if ($this->exsamleMenu[$i] == trim($data[0][$i]))
              {
                  $arr = [];
               
                foreach ($data as $row)
                {
                 $new = array_push($arr,  strval($row[$i]));   
                 
                }
                unset($arr[0]);
            
               $this->baseData[$this->exsamleMenu[$i]] = $arr ;
              } 
              else
              {
                 return false;
                 
              }
           }
           return $this->baseData;
              exit();
        } catch (\Exception $exception) {
            print_r($exception->getMessage() . $exception->getFile());
            exit();
        }
    }
}