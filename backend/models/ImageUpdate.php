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
class ImageUpdate extends Model
{
       /**
     * @var UploadedFile
     */
    public $image;
    public $id;

    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png,jpeg'],
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

    
}