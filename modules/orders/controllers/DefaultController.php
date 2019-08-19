<?php

namespace app\modules\orders\controllers;

use yii\web\Controller;
use Yii;
use app\modules\orders\models\Order;
use app\modules\orders\models\Service;
use yii\data\Pagination;

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
    	// $orders = Order::find()->orderBy(['id' => SORT_DESC])->with('service')->all();
    	// $services = Service::find()->asArray()->all(); #For Array-version query
    	$query = Order::find()->orderBy(['id' => SORT_DESC])->with('service');
    	$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 100, 'forcePageParam' => false, 'pageSizeParam' => false]);
    	$orders = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('orders', 'pages')); # $services in case of Array-version
    }
}
