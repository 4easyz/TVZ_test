<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Техника';
?>
<?php echo Html::a('Добавить технику', array('car/update', 'id'=>NULL), array('class' => 'btn btn-primary pull-right')); ?>
<hr />

<table id="table-cars" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название</th>
      <th scope="col">Опции</th>
    </tr>
  </thead>
</table>

<script>
  $( document ).ready(function() {
    new DataTable('#table-cars', {
        ajax: 'http://localhost/index.php?r=car%2Fget-cars-json',
        processing: true,
        serverSide: true,
        searching: false,
        ordering: false,
        buttons: ['excel', 'print', 'colvis'],
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/ru.json'
        }
      });
  });
  </script>

