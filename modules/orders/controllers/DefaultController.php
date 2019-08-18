<?php

namespace app\modules\orders\controllers;

use yii\web\Controller;
use Yii;
use app\modules\orders\models\Order;
use app\modules\orders\models\Service;

/**
 * Default controller for the `orders` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	$orders = Order::find()->orderBy(['id' => SORT_DESC])->with('service')->all();
    	// $services = Service::find()->asArray()->all();
        return $this->render('index', compact('orders', 'services'));
    }
}
