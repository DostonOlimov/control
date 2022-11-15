<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\httpclient\Client;
use yii\web\Response;
use yii\Exception;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $lang
 * @property string|null $codetnved
 * @property string|null $type_of_alert
 * @property string|null $type
 * @property string|null $alert_number
 * @property string|null $alert_submitted_by
 * @property string|null $country_of_origin
 * @property string|null $counterfeit
 * @property string|null $risk_type
 * @property string|null $product
 * @property string|null $name
 * @property string|null $description
 * @property string|null $brand
 * @property string|null $category
 * @property string|null $type_number_of_model
 * @property string|null $batch_number_barcode
 * @property string|null $oecd_portal_category
 * @property string|null $risk
 * @property string|null $technical_defect
 * @property string|null $measures_adopted_by_notifying_country
 * @property string|null $products_were_found_and_measures_were_taken_also_in
 * @property string|null $company_recall_page
 * @property string|null $url_of_case
 * @property string|null $barcode
 * @property string|null $batch_number
 * @property string|null $company_recall_code
 * @property string|null $production_dates
 * @property string|null $packaging_description
 * @property string|null $photo
 * @property int $status
 * @property int|null $views
 * @property int $created_at
 * @property int $updated_at
 */



class GetData extends \yii\db\ActiveRecord
{

  public $parent_id;
  public $product;
  public $name;
  public $description;
  public $type_of_alert;
  public $share_status;
  public $codetnved;
  public $type;
  public $alert_number;
  public $alert_submitted_by;
  public $country_of_origin;
  public $counterfeit;
  public $risk_type;
  public $brand;
  public $category;
  public $batch_number_barcode;
  public $oecd_portal_category;
  public $risk;
  public $technical_defect;
  public $measures_adopted_by_notifying_country;
  public $products_were_found_and_measures_were_taken_also_in;
  public $company_recall_page;
  public $url_of_case;
  public $barcode;
  public $batch_number;
  public $company_recall_code;
  public $production_dates;
  public $packaging_description;
  public $type_number_of_model;
  public $lang;
  public $status;
  public $views;
  public $created_at;
  public $updated_at;
  public $date_from;
  public $date_to;


    /**
     * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['parent_id', 'status', 'views','share_status', 'created_at', 'updated_at'], 'integer'],
            [['codetnved', 'type_of_alert', 'type', 'alert_number', 'alert_submitted_by', 'country_of_origin', 'counterfeit', 'risk_type', 'product', 'name',
                'description', 'brand', 'category', 'type_number_of_model', 'batch_number_barcode', 'oecd_portal_category', 'risk', 'technical_defect',
                'measures_adopted_by_notifying_country', 'products_were_found_and_measures_were_taken_also_in', 'company_recall_page', 'url_of_case', 'barcode',
                'batch_number', 'company_recall_code', 'production_dates', 'packaging_description'], 'integer'],
            [['date_to','date_from'], 'string'],
            [['product', 'category', 'description','date_to','date_from'], 'required'],
            [['lang', 'photo'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
*/
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'lang' => Yii::t('app', 'Lang'),
            'codetnved' => Yii::t('app', 'Код ТН-ВЭД'),
            'type_of_alert' => Yii::t('app', 'Тип оповещения'),
            'type' => Yii::t('app', 'Тип'),
            'alert_number' => Yii::t('app', 'Номер оповещения'),
            'alert_submitted_by' => Yii::t('app', 'Оповещение отправлено'),
            'country_of_origin' => Yii::t('app', 'Страна происхождения'),
            'counterfeit' => Yii::t('app', 'Подделка'),
            'risk_type' => Yii::t('app', 'Тип риска'),
            'product' => Yii::t('app', 'Товар'),
            'name' => Yii::t('app', 'Наименование'),
            'description' => Yii::t('app', 'Описание'),
            'brand' => Yii::t('app', 'Бранд'),
            'category' => Yii::t('app', 'Категория'),
            'type_number_of_model' => Yii::t('app', 'Типовой номер модели'),
            'batch_number_barcode' => Yii::t('app', 'Штрих-код номера партии'),
            'oecd_portal_category' => Yii::t('app', 'Категория портала OECD'),
            'risk' => Yii::t('app', 'Риск'),
            'technical_defect' => Yii::t('app', 'Технический дефект'),
            'measures_adopted_by_notifying_country' => Yii::t('app', 'Меры, принятые уведомляющей страной'),
            'products_were_found_and_measures_were_taken_also_in' => Yii::t('app', 'Были найдены продукты и приняты меры в'),
            'company_recall_page' => Yii::t('app', 'Страница отзыва компании'),
            'url_of_case' => Yii::t('app', 'Ссылка обращения'),
            'barcode' => Yii::t('app', 'Штрих-код'),
            'batch_number' => Yii::t('app', 'Серийный номер'),
            'company_recall_code' => Yii::t('app', 'Код отзыва компании'),
            'production_dates' => Yii::t('app', 'Дата изготовления'),
            'packaging_description' => Yii::t('app', 'Описание упаковки'),
            'photo' => Yii::t('app', 'Фотография товара'),
            'views' => Yii::t('app', 'Количество просмотров'),
            'status' => Yii::t('app', 'Статус'),
            'views' => Yii::t('app', 'Views'),
            'date_to' => Yii::t('app', ''),
            'date_from' => Yii::t('app','С тех пор как'),
            'date_to' => Yii::t('app','До тех пор, пока не'),
            'created_at' => Yii::t('app', 'Создано'),
            'updated_at' => Yii::t('app', 'Обновлено'),
        ];
    }



}
