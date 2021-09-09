<template>
<div class="row cont">
<h3 class="text-center text-uppercase">Producto {{currentProduct.name}}</h3>
<hr>
<br><br>
  <div v-if="currentProduct" >
    <form>
        <div class="row">
        <div class="mb-3 col-4">
                <label for="title" class="form-label  ">Producto</label>
                <input type="text" class="form-control" id="title"
                v-model="currentProduct.name"
                />
            </div>
            
            <div class="mb-3 col-4">
                <label for="price" class="form-label">Precio</label>
                <input type="number" class="form-control" id="price"
                v-model="currentProduct.price"
                />
            </div>

            <div class="mb-3 col-4">
                <label for="garantia" class="form-label">Meses de garantia</label>
                <input type="number" class="form-control" id="garantia"
                v-model="currentProduct.garantia"
                />
            </div>
        </div>
     

        <div class="form-group mt-3 mb-5">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" id="" cols="10" rows="5"
                  v-model="currentProduct.descripcion"
            >
            </textarea>
        </div>

      
    </form>

  
    <div class="row">

    <div class="col-1">
        <button class="btn btn-danger "
        @click="deleteProduct" 
        >
        Eliminar
        </button>

    </div>

    <div class="col-1">

    <button type="submit" class="btn btn-success "
      @click="updateProduct"
    >
        Actualizar
    </button>
    </div>
    <div v-if='message' class='alert alert-success mt-3'>{{ message }}</div>

    </div>
  </div>

  <div v-else>
    <br />
    <p> Por favor haga click en un producto...</p>
  </div>
</div>
</template>

<script>
import ProductDataService from "../services/ProductDataService";

export default {
  name: "product",
  data() {
    return {
      currentProduct: null,
      message: ''
    };
  },
  methods: {
    getProduct(id) {
      ProductDataService.get(id)
        .then(response => {
          this.currentProduct = response.data.data;
          console.log(response.data.data);
        })
        .catch(e => {
          console.log(e);
        });
    },


    updateProduct() {
      ProductDataService.update(this.currentProduct.id, this.currentProduct)
        .then(response => {
          console.log(response.data.data);
          this.message = 'El producto fue actualizado satisfactoriamente!';
        })
        .catch(e => {
          console.log(e);
        });
    },

    deleteProduct() {
      ProductDataService.delete(this.currentProduct.id)
        .then(response => {
          console.log(response.data.data);
          this.$router.push({ name: "products" });
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.message = '';
    this.getProduct(this.$route.params.id);
  }
};
</script>

<style>
.edit-form {
  max-width: 300px;
  margin: auto;
}
.cont{
     box-shadow: 1px 1px 6px 1px #999;
     border-radius: 5px;
     padding: 45px;
}


</style>