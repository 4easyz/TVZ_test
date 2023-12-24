<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class OperatorCar extends ActiveRecord
{
    
    public $tmp;
    public $operators_on_car_id;
    public $cars_on_opearator_id;
    public static function tableName()
    {
        return 'operator_car';
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
            [['car_id'], 'required'],
            [['operator_id'], 'required'],
            [['operators_on_car_id'], 'boolean'],
            [['cars_on_opearator_id'], 'boolean']
        ];
    }

    public function setOperatorsOnCar($operatorsOnCar, $carID) {

        foreach($operatorsOnCar as $key => $value)
        {
            $operatorCarId = $this->findOne([
                'car_id' => $carID,
                'operator_id' => $key,
            ]);

            if($operatorCarId === NULL) {
                $this->car_id = $carID;
                $this->operator_id = $key;
                if($value == 1)
                    $this->save();
            } else {
                if($value == 0){
                    $operatorCarId->delete();
                }
            }            
        }
    }
    public function setCarsOnOperator($carsOnopeartor, $operatorID) {

        foreach($carsOnopeartor as $key => $value)
        {
            $operatorCarId = $this->findOne([
                'car_id' => $key,
                'operator_id' => $operatorID,
            ]);

            if($operatorCarId === NULL) {
                $this->car_id = $key;
                $this->operator_id = $operatorID;
                if($value == 1)
                    $this->save();
            } else {
                if($value == 0) {
                    $operatorCarId->delete();
                }
            }            
        }
    }
}