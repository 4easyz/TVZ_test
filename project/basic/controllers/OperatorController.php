<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\OperatorCar;
use app\models\Operator;
use app\models\Car;

class OperatorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionOperators()
    {
        $operatorList = Operator::find()->all();
        $model = new Operator;

		return $this->render('operators', [
            'operatorList' => $operatorList,
        ] );
    }

    public function actionRead($id=NULL)
    {
        $model = Operator::find()->where(['id' => $id])->one();
        $cars = Car::find()->all();

        if ($model === NULL){
            return 'error'; 
        }

        $operatorsCar = OperatorCar::find()->where(['operator_id' => $model->id])->indexBy('car_id')->asArray()->all(); // Выводит всех операторов на машине по $model->id
        
        foreach ($cars as $car) {
            if(in_array($car->id, array_keys($operatorsCar)))
                $carsOnOperator[$car->id] = $car->name;
        }

        return $this->render('read', array(
            'model' => $model,
            'carsOnOperator' => $carsOnOperator,
        ));

    }

    public function actionDelete($id=NULL)
    {
        if ($id === NULL)
        {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('operator/operators'));
        }
    
        $operator = Operator::find()->where(['id' => $id])->one();;
    
    
        if ($operator === NULL)
        {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('operator/operators'));
        }
    
        $operator->delete();
    
        Yii::$app->session->setFlash('PostDeleted');
        Yii::$app->getResponse()->redirect(array('operator/operators'));
    }

    public function actionUpdate($id=NULL)
    {
        if ($id === NULL)// если $id === NULL то создадим нового оператора в таблице operator
        {
            $model = new Operator();
            $cars = Car::find()->all();
            $title = 'Create operator';
        } else { // иначе обновим значения для существующей
            $model = Operator::find()->where(['id' => $id])->one();
            $cars = Car::find()->all();
            $title = 'Update opearator';
        }

        $modeOperatorCar = new OperatorCar; //

        if ($model->load($_POST)) { // Получаем значения из textInput car/create
            $model->save(); // Обновляем или добавляем значение в таблицу car

            $modeOperatorCar->load($_POST); // Получаем значения checkBox из car/create
            if($modeOperatorCar->cars_on_opearator_id !== NULL){ //Если были нажаты checkbox 
                $operatorsCar = new OperatorCar();
                $operatorsCar -> setCarsOnOperator($modeOperatorCar->cars_on_opearator_id, $model->id);//заполним таблицу operato_car для машины из $model->id
            }
            
            $operatorList = Operator::find()->all();
            return $this->render('operators', [
                'operatorList' => $operatorList,
            ] );
        }

        $carsOnOperator = OperatorCar::find()->where(['operator_id' => $model->id])->indexBy('car_id')->asArray()->all(); // Выводит всех операторов на машине по $model->id

        return $this->render('create', array(
            'model' => $model,
            'cars' => $cars,
            'carsOnOperator' => $carsOnOperator,
            'modeOperatorCar' => $modeOperatorCar,
            'title' => $title,
        ));
    }

    public function actionCarsApi()
    {
        $model = Car::find()->asArray()->all();
        
        return json_encode($model);
    }

    public function actionAddCarsApi()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Car;

        if ($model->load($_POST)) { // Получаем значения из textInput car/create
            $model->save(); // Обновляем или добавляем значение в таблицу car
            return ['ok'=>"true"];
        }
        
        return ['ok'=>"false"];
    }

    public function actionGetOperatorsJson()
    {
        $length = $_GET['length'];
        $start = $_GET['start'];

        $db = Operator::find()->asArray()->limit($length)->offset($start)->all();
        
        foreach($db as $row)
        {
            $result[] = [$row['id'], 
                "<a href='".$row['id']."'>".$row['name']."</a>",
                "<a class=\"btn btn-primary btn-sm\" href='update?id=".$row['id']."'>
                    <i class=\"bi bi-arrow-counterclockwise\"></i>
                </a>
                <a class=\"btn btn-danger btn-sm\" href='delete?id=".$row['id']."''>
                    <i class=\"bi bi-trash\"></i>
                </a>"];
        }

        $totalRecords = count(Operator::find()->asArray()->all());
        
        return json_encode([
            'draw' => $_GET['draw'],
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $result,
        ]);
    }
}