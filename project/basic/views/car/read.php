<?php use yii\helpers\Html; ?>
<div class="pull-right btn-group">
    <?php echo Html::a('<i class="bi bi-arrow-counterclockwise"></i>', array('car/update', 'id' => $model->id), array('class' => 'btn btn-primary')); ?>
    <?php echo Html::a('<i class="bi bi-trash"></i>', array('car/delete', 'id' => $model->id), array('class' => 'btn btn-danger')); ?>
</div>
<hr />
<h1 class="display-4"><?php echo $model->id . " - " . $model->name;?></h1>
<hr>
<p class="lead">Список операторов допущенных на машину</p>
<p></p>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Имя</th>
    </tr>
  </thead>
  <tbody>
        
        <?php if(is_array($operatorsOnCar)) foreach ($operatorsOnCar as $id => $name) { ?>
            <tr>
                <td scope="row">
                  <?php echo Html::a($name, array('operator/read', 'id'=>$id)); ?>
                </td>
            </tr>
        <?php } ?>
    
  </tbody>
</table>


<hr />