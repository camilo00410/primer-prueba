<template>
    <div id="App">
    <nav class="navbar navbar-expand navbar-dark bg-dark p-2">
      <router-link to="/" class="navbar-brand">Primer Prueba </router-link>
      <div class="navbar-nav mr-auto">
        <li class="nav-item">
          <router-link to="/products" class="nav-link">Productos</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/add" class="nav-link">Agregar Producto</router-link>
        </li>
      </div>
    </nav>

    <div class="container mt-3">
      <router-view />
    </div>
  </div>
</template>

<script>

export default {
  name: 'app',
  components: {
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
  background-color: #eee;
}
</style>
