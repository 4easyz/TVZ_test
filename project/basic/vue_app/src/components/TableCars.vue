<template>
    <div id="carsTable">
        <h1 v-if=!addnewFlag>Техника</h1>
        <p></p>
        <table class="table table-striped table-hover"  v-if="carsData">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Наименование техники</th>
            </tr>
        </thead>
        <tbody>
                <tr v-for="car in carsData" :key="car.id">
                    <td > {{ car.id }}   </td>
                    <td > {{ car.name }} </td>
                </tr>
        </tbody>
        </table>

    </div>
  </template>
  
  <script>
  
  import axios from 'axios'
  export default {
    name: 'carsTable',
    data() {
      return {
        carsData: null,
      };
    },
    created() {
        axios
        .get('http://localhost:80/index.php?r=car%2Fcars-api')
        .then(response => (this.carsData = response.data));
    },
  };
  
  </script>
  
  <style>
  </style>