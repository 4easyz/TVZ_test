<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Техника';
?>
<?php echo Html::a('Добавить технику', array('car/update', 'id'=>NULL), array('class' => 'btn btn-primary pull-right')); ?>
<hr />

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название</th>
      <th scope="col">Опции</th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach ($carsList as $car) { ?>
        <tr>
            <th scope="row"><?= $car->id ?></th>
            <td><?php echo Html::a($car->name, array('car/read', 'id'=>$car->id)); ?></td>
            <td>
                <?php echo Html::a('Обновить', array('car/update', 'id'=>$car->id), array('class'=>'btn btn-primary btn-sm')); ?>
                <?php echo Html::a('Удалить', array('car/delete', 'id'=>$car->id), array('class'=>'btn btn-danger btn-sm')); ?>
            </td>
        </tr>
        
    <?php } ?>
    
  </tbody>
</table>
