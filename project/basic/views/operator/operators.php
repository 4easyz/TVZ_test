<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Операторы';
// $this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Html::a('Добавить оператора', array('operator/update'), array('class' => 'btn btn-primary pull-right')); ?>
<hr />
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Имя</th>
      <th scope="col">Опции</th>
    </tr>
  </thead>
  <tbody>
    
  <?php foreach ($operatorList as $operator) { ?>
        <tr>
            <th scope="row"><?= $operator->id ?></th>
            <td><?php echo Html::a($operator->name, array('operator/read', 'id'=>$operator->id)); ?></td>
            <td>
                <?php echo Html::a('Обновить', array('operator/update', 'id'=>$operator->id), array('class'=>'btn btn-primary btn-sm')); ?>
                <?php echo Html::a('Удалить', array('operator/delete', 'id'=>$operator->id), array('class'=>'btn btn-danger btn-sm')); ?>
            </td>
        </tr>
        
    <?php } ?>
    
  </tbody>
</table>

