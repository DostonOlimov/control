<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string|null $id_country
 * @property string|null $name_country
 * @property string|null $code_country
 * @property int $active
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['id_country', 'name_country', 'code_country'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_country' => Yii::t('app', 'Цифровой код'),
            'name_country' => Yii::t('app', 'Наименование'),
            'code_country' => Yii::t('app', 'Буквенный код'),
            'active' => Yii::t('app', 'Статус'),
        ];
    }
}
