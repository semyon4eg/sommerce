<?php

namespace app/modules/orders/models;

use Yii/db/ActiveRecord;

class Service extends ActiveRecord
{
	public static function tableName(){
		return 'services';
	}

	public function getOrders(){
		return $this->hasMany(Order::classname(), ['service_id' => 'id']);
	}
}