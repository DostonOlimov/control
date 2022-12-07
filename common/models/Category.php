<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name_ru
 * @property string|null $name_cyrl
 * @property string|null $name_uz
 * @property string|null $name_en
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'category';
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
			[['name_cyrl'], 'required'],
			[['status', 'created_at', 'updated_at'], 'integer'],
			[['name_ru', 'name_cyrl', 'name_uz', 'name_en'], 'string', 'max' => 255],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'name_ru' => Yii::t('app', 'Наименование').'(Ру)',
			'name_cyrl' => Yii::t('app', 'Наименование').'(Ўзб)',
			'name_uz' => Yii::t('app', 'Наименование (UZ)'),
			'name_en' => Yii::t('app', 'Наименование (EN)'),
			'status' => Yii::t('app', 'Статус'),
			'created_at' => Yii::t('app', 'Создано'),
			'updated_at' => Yii::t('app', 'Обновлено'),
		];
	}
}
