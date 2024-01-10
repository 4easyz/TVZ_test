<template>
    <div id="carsInputForm">
        <h1>Добавление техники</h1>
        <p><input v-model="nameCar" placeholder="Название техники" /></p>
        
        <p></p>
        <p>{{ status }}</p>
        <button class="btn btn-primary " v-on:click="postRequest">Добавить</button>
    </div>
  </template>
  
  <script>

  import 'bootstrap/dist/css/bootstrap.css'
  import 'bootstrap-vue/dist/bootstrap-vue.css'
  import axios from 'axios'

  export default {
    name: 'addCar',
    data() {
    return {
      nameCar: '',
      success: null,
      status: ''
    }
  },
  methods:
    {
        save(){
            axios
            .post('http://localhost:80/car/add-cars-api', this.nameCar)
            .then(response => (this.nameCar = response.data.name));
        },
        postRequest() {
            axios({
                method: 'post',
                url: 'http://localhost:80/car/add-cars-api',
                data: `Car[name]=${this.nameCar}`,
                })
                .then(response => {
                    this.status = 'Ответ сервера успешно получен!';
                    this.nameCar = '';
                    // console.log('Ответ сервера успешно получен!');
                    console.log(response.data.ok);
                })
                .catch(error =>{
                    console.log(error.message);
                    this.status = 'Ошибка: ' + error.message;
                });
        }
    }
  };
  </script>
  
  <style>
  </style>