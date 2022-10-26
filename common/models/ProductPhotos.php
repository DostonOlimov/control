<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_photos".
 *
 * @property int $id
 * @property string|null $product_id
 * @property string|null $photo
 * @property int $created_at
 * @property int $updated_at
 */
class ProductPhotos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_photos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['product_id', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'photo' => Yii::t('app', 'Photo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
