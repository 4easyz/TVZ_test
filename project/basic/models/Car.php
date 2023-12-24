<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Car extends ActiveRecord
{
    public $carId;
    public $carName;
    // public $operator_id;

    public static function tableName()
    {
        return 'cars';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'Car id',
            'name' => 'Name',
        );
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['name'], 'required'],
            // [['operator_id'], 'boolean','skipOnEmpty' => true, 'skipOnError' => true],
        ];
    }

    
}