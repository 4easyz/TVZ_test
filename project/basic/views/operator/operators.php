<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Операторы';
?>
<?php echo Html::a('Добавить оператора', array('operator/update'), array('class' => 'btn btn-primary pull-right')); ?>
<hr />

<table id="table-operators" class="table table-striped table-bordered">
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
    new DataTable('#table-operators', {
        ajax: 'http://localhost/operator/get-operators-json',
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


