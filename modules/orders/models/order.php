<?php

namespace app\modules\orders\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
	
	public static function tableName(){
		return 'orders';
	}

	public function getService(){
		return $this->hasOne(Service::classname(), ['id' => 'service_id']);
	}
}