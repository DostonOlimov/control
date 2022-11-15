<?php
namespace api\controllers;

use yii\rest\ActiveController;

class productController extends ActiveController
{
    public $modelClass = 'common\models\Product';
}