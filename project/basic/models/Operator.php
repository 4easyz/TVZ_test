<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Operator extends ActiveRecord
{
    public static function tableName()
    {
        return 'operator';
    }

    public static function primaryKey()
    {
        return array('id');
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'Operator id',
            'name' => 'Name',
        );
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['name'], 'required'],
        ];
    }
}