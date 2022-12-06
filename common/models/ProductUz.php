<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "product_uz".
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $lang
 * @property string|null $codetnved
 * @property int|null $type_of_alert
 * @property int|null $type
 * @property string|null $alert_number
 * @property string|null $counterfeit
 * @property string|null $risk_type
 * @property string|null $product
 * @property string|null $name
 * @property string|null $description
 * @property string|null $brand
 * @property int|null $category
 * @property string|null $type_number_of_model
 * @property string|null $batch_number_barcode
 * @property string|null $technical_defect
 * @property string|null $products_were_found_and_measures_were_taken_also_in
 * @property string|null $barcode
 * @property string|null $batch_number
 * @property string|null $company_recall_code
 * @property string|null $production_dates
 * @property string|null $packaging_description
 * @property string|null $photo
 * @property int $status
 * @property int|null $views
 * @property int|null $company_inn
 * @property string|null $company_name
 * @property int $created_at
 * @property int $updated_at
 */



class ProductUz extends \yii\db\ActiveRecord
{
    const ALERT1 = 1;
    const ALERT2 = 2;
    const ALERT3 = 3;

    const TYPE1 = 1;
    const TYPE2 = 2;
    const TYPE3 = 3;
    const TYPE4 = 4;
    const TYPE5 = 5;
    const TYPE6 = 6;
    const TYPE7 = 7;
    const TYPE8 = 8;
    const TYPE9 = 9;
    const TYPE10 = 10;
    const TYPE11 = 11;
    const TYPE12 = 12;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_uz';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'company_inn','product','description','type_of_alert','risk_type','type','category'],'required'],
            [['parent_id','country_of_origin', 'type_of_alert', 'type', 'category', 'status', 'created_at', 'company_inn','updated_at'], 'integer'],
            [['made_company','made_company_inn','codetnved','comment', 'alert_number', 'counterfeit', 'risk_type', 'product', 'name', 'description', 'brand', 'type_number_of_model', 'batch_number_barcode', 'technical_defect', 'products_were_found_and_measures_were_taken_also_in', 'barcode', 'batch_number', 'company_recall_code', 'production_dates', 'packaging_description', 'company_name'], 'string'],
            [['lang', 'photo'], 'string', 'max' => 255],
            [['views',], 'default', 'value' => 0],
        ];
    }

    public static function getAlert($base = null)
    {
        $arr = [
            self::ALERT1 => 'Jiddiy xavfli',
            self::ALERT2 => 'Boshqa xavf darajali',
            self::ALERT3 => 'Boshqa turdagi ogohlantirishlar',
        ];

        if ($base === null) {
            return $arr;
        }

        return $arr[$base];
    }
    public static function getType($base = null)
    {
        $arr = [
            self::TYPE1 => 'Oziq-ovqat',
            self::TYPE2 => 'Yengil sanoat',
            self::TYPE3 => 'Qurilish',
            self::TYPE4 => 'Elektrotexnika',
            self::TYPE5 => 'Charmsanoat',
            self::TYPE6 => 'Neft sanoati',
            self::TYPE7 => 'Gaz sanoati',
            self::TYPE8 => 'Kimyo sanoati',
            self::TYPE9 => 'Qishloq xo\'jaligi',
            self::TYPE10 => 'Mashinasozlik',
            self::TYPE11 => 'Metalurgiya',
            self::TYPE12 => 'Boshqa sohalar',
        ];

        if ($base === null) {
            return $arr;
        }

        return $arr[$base];
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
            'company_inn' => Yii::t('app', 'ИНН компании'),
            'company_name' => Yii::t('app', 'Название компании'),
            'made_company_inn' => Yii::t('app', 'Производитель СТИР'),
            'comment' => Yii::t('app', 'Комментарий'),
            'made_company' => Yii::t('app','Производственная компания'),
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
            'created_at' => Yii::t('app', 'Создано'),
            'updated_at' => Yii::t('app', 'Обновлено'),

        ];
    }

    public function getCategoryName()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    public function getCodeTnVedName()
    {
        return $this->hasOne(Codetnved::className(), ['kod' => 'codetnved']);
    }
}
