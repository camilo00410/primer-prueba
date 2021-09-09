<template>
  <div class="row  cont">
  
    <div class="col-md-4">
      <h4 class="mb-5">Lista de productos</h4>
      <ul class="list-group">
        <li class="list-group-item " style="cursor:pointer" 
          :class="{ active: index == currentIndex }"
          v-for="(product, index) in products"
          :key="index"
          @click="setActiveProduct(product, index)"
        >
          {{ product.name }}
        </li>
      </ul>

      <button class="mt-3 btn btn-sm btn-danger" @click="removeAllProducts" >
        Eliminar todos
      </button>
    </div>
    <div class="col-md-8">
      <div v-if="currentProduct">
       
        <h4 class="mb-5">Producto</h4>
                      <div class="card">
                          <div class=" card-body">
                                <div class="d-flex justify-content-between card-title">
                                  <h4>{{currentProduct.name}}</h4>
                                  <small class="text-muted"><strong>${{currentProduct.price}}</strong></small>                                
                                </div>
                                <div class="card-info" style="min-height: 100px;">
                                    <p>{{currentProduct.descripcion}}</p>
                                </div>
                                <br>
                                <div class="card-info  ">
                                   <small class="text-muted"><strong>{{currentProduct.garantia}} meses de garantia</strong></small>    
                                    <div class="d-flex flex-row-reverse">
                                        <a class="btn btn-warning color-white "
                                        :href="'/product/' + currentProduct.id"
                                        >
                                        Editar producto
                                        </a>
                                    </div>
                                 
                                </div>

                                  
                          </div>
                      </div>
                  </div>
      <div v-else>
        <br />
        <p>Por favor dar click en un Producto...</p>
      </div>
    </div>
  </div>
</template>

<script>
import ProductDataService from "../services/ProductDataService";

export default {
  name: "products-list",
  data() {
    return {
      products: [],
      currentProduct: null,
      currentIndex: -1,
      title: ""
    };
  },
  methods: {
    retrieveProducts() {
        ProductDataService.getAll()
        .then(response => {
          this.products = response.data.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },

    refreshList() {
      this.retrieveProducts();
      this.currentProduct = null;
      this.currentIndex = -1;
    },

    setActiveProduct(Product, index) {
      this.currentProduct = Product;
      this.currentIndex = index;
    },

    removeAllProducts() {
      ProductDataService.deleteAll()
        .then(response => {
          console.log(response.data.data);
          this.refreshList();
        })
        .catch(e => {
          console.log(e);
        });
    },        
  },
  mounted() {
    this.retrieveProducts();
  }
};
</script>

<style>
.list {
  text-align: left;
  max-width: 750px;
  margin: auto;
}
.cont{
     box-shadow: 1px 1px 6px 1px #999;
     border-radius: 5px;
     padding: 45px;
}

</style>