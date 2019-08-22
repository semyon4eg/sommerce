<?php

namespace app\modules\orders\controllers;

use yii\web\Controller;
use Yii;
use app\modules\orders\models\Order;
use app\modules\orders\models\Service;
// use app\modules\orders\models\OrderSearch;
use yii\data\Pagination;

/**
 * Default controller for the `orders` module
 */
class DefaultController extends Controller
{
    public function actionIndex() {
    	// $orders = Order::find()->orderBy(['id' => SORT_DESC])->with('service')->all();
    	// $services = Service::find()->asArray()->all(); #For Array-version query

    	$searchRequest = trim(Yii::$app->request->get('search'));
    	// if (!$searchRequest)
    	// 	return $this->render('index');
    	$searchType = Yii::$app->request->get('search-type');

    	switch ($searchType) {
    		case '1':
    			$searchColumn = 'id';
    			break;
    		case '2':
    			$searchColumn = 'link';
    			break;
    		case '3':
    			$searchColumn = 'user';
    			break;
    	}

    	$query = Order::find()->orderBy(['id' => SORT_DESC])->andFilterWhere(['like', $searchColumn, $searchRequest])->with('service');

  //   	$searchModel = new OrderSearch();
		// $dataProvider = $searchModel->search(Yii::$app->request->get());

    	$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 100, 'forcePageParam' => false, 'pageSizeParam' => false]);

    	$orders = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('orders', 'pages')); # +'services' in case of Array-version
    }

    // public function actionSearch() {
    // 	$searchRequest = trim(Yii::$app->request->get('search'));
    // 	if (!$searchRequest)
    // 		return $this->render('index');
    // 	$searchType = Yii::$app->request->get('search-type');

    // 	switch ($searchType) {
    // 		case '1':
    // 			$searchColumn = 'id';
    // 			break;
    // 		case '2':
    // 			$searchColumn = 'link';
    // 			break;
    // 		case '3':
    // 			$searchColumn = 'user';
    // 			break;
    // 	}
    	 
    // 	$query = Order::find()->where(['like', $searchColumn, $searchRequest])->with('service');
    // 	$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 100]);
    // 	$orders = $query->offset($pages->offset)->limit($pages->limit)->all();
    // 	return $this->render('search', compact('orders', 'pages', 'searchRequest'));
    // }
}
