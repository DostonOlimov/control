<?php


namespace frontend\modules\api\controllers;

use Yii;
use yii\web\Response;
use common\models\Product;
use yii\httpclient\Client;
use yii\helpers\VarDumper;

class ApiController extends \yii\rest\Controller
{
	public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_HTML;
        return $behaviors;
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $product = Product::find()->where(['>', 'id', 2144])->count();
	VarDumper::dump($product);
    
    die;

$client = new Client();
$response = $client->createRequest()
    ->setMethod('POST')
    ->setFormat(Client::FORMAT_JSON)
    ->setUrl('http://10.190.0.118:9093/RestUzSstatus/rest/serviceControlTov/getCONTROLTOV')
    ->setData(['product' => $product])
    ->send();
if ($response->isOk) {
    $newUserId = $response->data;
    return $newUserId;
}

        // return [
        //     'yuq'=>'yuq',
        //     'parent_id' => '',
        //     'lang' => '',
        //     'codetnved' => '',
        //     'type_of_alert' => '',
        // ];
    }
}
