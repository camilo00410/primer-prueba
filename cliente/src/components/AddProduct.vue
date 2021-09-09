<template>

<div class="row cont">
    <h3 class="text-center text-uppercase">Agregar Producto </h3>
    <hr>
    <br><br>
            <div v-if="!submitted">
                <div class="row">
                    <div class="mb-3 col-4"> 
                        <label for="title">Producto</label>
                        <input
                        type="text"
                        class="form-control"
                        id="name"
                        required
                        v-model="producto.name"
                        name="name"
                        placeholder="Escriba el producto"
                        />
                    </div>

                <div class="mb-3 col-3">
                    <label for="title">Fabricante</label>
                    <input
                    type="text"
                    class="form-control"
                    id="fabricante"
                    required
                    v-model="producto.fabricante"
                    name="fabricante"
                    placeholder="Fabricante"
                    />
                </div>

                    <div class="mb-3 col-2">
                        <label for="title">Price</label>
                        <input
                        type="text"
                        class="form-control"
                        id="price"
                        required
                        v-model="producto.price"
                        name="price"
                        placeholder="Precio"

                        />
                    </div>
                    <div class="mb-3 col-3">
                        <label for="title">Garantia</label>
                        <input
                        type="text"
                        class="form-control"
                        id="garantia"
                        required
                        v-model="producto.garantia"
                        name="garantia"
                        placeholder="Meses de garantia"

                        />
                    </div>
             
                 </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="5" 
                         v-model="producto.descripcion" required
                        placeholder="Describe el producto"
                         ></textarea>
                    
                </div>

                <button @click="saveProduct" class="btn btn-success mt-4">Guardar</button>
                </div>

                <div v-else>
                <br>
                <h4>Producto Guardado satisfactoriamente!</h4>
                <br>
                <button class="btn btn-success" @click="newProduct">Agregar nuevo</button>
            </div>

</div>
</template>

<script>
import ProductDataService from "../services/ProductDataService";

export default {
  name: "add-product",
  data() {
    return {
      producto: {
        id: null,
        name: "",
        descripcion: "",
        fabricante: "",
        price: "",
        garantia: "",
        published: false
      },
      submitted: false
    };
  },
  methods: {
    saveProduct() {
      var data = {
        name: this.producto.name,
        descripcion: this.producto.descripcion,
        fabricante: this.producto.fabricante,
        price: this.producto.price,
        garantia: this.producto.garantia
      };

      ProductDataService.create(data)
        .then(response => {
          this.producto.id = response.data.data.id;
          console.log(response.data.data);
          this.submitted = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    newProduct() {
      this.submitted = false;
      this.producto = {};
    }
  }
};
</script>

<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
.cont{
     box-shadow: 1px 1px 6px 1px #999;
     border-radius: 5px;
     padding: 45px;
}
</style>