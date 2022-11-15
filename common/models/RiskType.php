<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "risk_type".
 *
 * @property int $id
 * @property string $name_cyrl
 * @property string $name_ru
 * @property int $created_at
 * @property int $updated_at
 */
class RiskType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'risk_type';
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
            [['name_cyrl', 'name_ru',], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name_cyrl', 'name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_cyrl' => Yii::t('app', 'Наименование').'(cryl)',
            'name_ru' => Yii::t('app', 'Наименование').'(ru)',
            'created_at' => Yii::t('app', 'Создано'),
            'updated_at' => Yii::t('app', 'Обновлено'),
        ];
    }
}
