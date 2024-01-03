<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\Cors;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Car;
use app\models\OperatorCar;
use app\models\Operator;

class CarController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public static function allowedDomains() 
    {
        return [
            // '*',                        // star allows all domains
            'http://localhost:8080',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['http://localhost:8080'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Allow-Headers' => ['*'],
            ],
        ];

        return $behaviors;
    }
    public function beforeAction($action)
    {            
        if ($action->id == 'add-cars-api') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['logout'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

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

    public function actionTest()
    {
        $carsList = Car::find()->all();
		return $this->render('cars', [
            'carsList' => $carsList,
        ] );
        //return $this->render('test', compact(carsList) );
    }
    
    public function actionCars()
    {
        $carsList = Car::find()->all();
		return $this->render('cars', [
            'carsList' => $carsList,
        ] );
    }

    public function actionRead($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        $operators = Operator::find()->all();

        if ($model === NULL){
            return 'error'; 
        }

        $operatorsCar = OperatorCar::find()->where(['car_id' => $model->id])->indexBy('operator_id')->asArray()->all(); // Выводит всех операторов на машине по $model->id
        
        $operatorsOnCar;
        
        foreach ($operators as $operator) {
            if(in_array($operator->id, array_keys($operatorsCar)))
                $operatorsOnCar[$operator->id] = $operator->name;
        }

        return $this->render('read', array(
            'model' => $model,
            'operatorsOnCar' => $operatorsOnCar,
        ));
    }

    public function actionDelete($id=NULL)
    {
        if ($id === NULL)
        {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('car/cars'));
        }
    
        $car = Car::find()->where(['id' => $id])->one();;
    
    
        if ($car === NULL)
        {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('car/cars'));
        }
    
        $car->delete();
    
        Yii::$app->session->setFlash('PostDeleted');
        Yii::$app->getResponse()->redirect(array('car/cars'));
    }

    public function actionCreate()
    {
        $model = new Car();
        
        if ($model->load($_POST) ) {
            $model->save();
            Yii::$app->response->redirect(array('car/read', 'id' => $model->id));
        }

        $operators = Operator::find()->all();

        return $this->render('create', array(
            'model' => $model,
            'operators' => $operators
        ));
    }

    public function actionUpdate($id=NULL)
    {
        
        if ($id === NULL) { // если $id === NULL то создадим новую машину в таблице car
            $model = new Car();
            $operators = Operator::find()->all();
            $title = 'Create car';
        } else { // иначе обновим значения для существующей
            $model = Car::find()->where(['id' => $id])->one();
            $operators = Operator::find()->all();
            $title = 'Update car';
        }

        $modeOperatorCar = new OperatorCar; //

        if ($model->load($_POST)) { // Получаем значения из textInput car/create
            $model->save(); // Обновляем или добавляем значение в таблицу car

            $modeOperatorCar->load($_POST); // Получаем значения checkBox из car/create
            if($modeOperatorCar->operators_on_car_id !== NULL){ //Если были нажаты checkbox 
                $operatorsCar = new OperatorCar();
                $operatorsCar -> setOperatorsOnCar($modeOperatorCar->operators_on_car_id, $model->id);//заполним таблицу operato_car для машины из $model->id
            }
            
            $carsList = Car::find()->all();
            return $this->render('cars', [
                'carsList' => $carsList,
            ] );
        }

        $operatorsCar = OperatorCar::find()->where(['car_id' => $model->id])->indexBy('operator_id')->asArray()->all(); // Выводит всех операторов на машине по $model->id

        return $this->render('create', array(
            'model' => $model,
            'operators' => $operators,
            'operatorsCar' => $operatorsCar,
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
}