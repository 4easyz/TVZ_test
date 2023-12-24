<template>
  <nav id="w0" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand text-blue" href="https://техновизор.рф/">Техновизор</a>
      
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div id="w0-collapse" class="collapse navbar-collapse">
        <ul id="w1" class="navbar-nav nav">
          <li class="nav-item">
            <button class="nav-link active" v-on:click="updateForm('Table')">Техника</button>
          </li>
          <li class="nav-item">
            <button class="nav-link active" v-on:click="updateForm('AddCar')">Добавление технки</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container">
    <div v-if="currForm === 'Table'"> <TableCars/> </div>
    <div v-else-if="currForm === 'AddCar'">  <AddCar/> </div>
  </div>

  <footer class="footer mt-auto py-3 text-muted fixed-bottom">
    <div class="container">
        <p class="float-left"> Тестовое задание для Техновизора</p>
    </div>
</footer>
 
</template>

<script>
import TableCars from './components/TableCars.vue'
import AddCar from './components/AddCar.vue'

export default {
  name: 'App',
  components: {
    TableCars,
    AddCar
  },
  
  data(){
    return {
        currForm: 'Table'
    }
  },
  methods:{
    updateForm: function(name){
      this.currForm = name;
    }
  },
  props:{
    form: String,
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.footer {
    background-color: #f5f5f5;
    font-size: .9em;
    height: 60px;
}

.footer > .container {
    padding-right: 15px;
    padding-left: 15px;
}

</style>
