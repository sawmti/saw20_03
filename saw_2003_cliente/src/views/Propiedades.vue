<template>
  <div class="home">
    <Header />
    <NavBar />

    <div class="container bg-white mt-3 mb-5 py-lg-3 px-lg-5">
      <!--TITULO-->
      <h1>Propiedades</h1>
      <!--/TITULO-->

      <!-- DESCRIPCION-->
      <div class="row">
        <div class="col text-small">Propiedades que se utilizan para hacer anotaciones.</div>
      </div>
      <!--/DESCRIPCION-->

      <!--AGREGAR PROPIEDAD-->
      <div class="row">
        <div class="col">
          <div class="card mt-3">
            <div class="card-header">
              <b>Agregar Propiedad</b>
            </div>
            <div class="card-body">
              <!-- <form v-on:submit.prevent="agregarAnotacion"> -->
              <form>
                <div :class="{'d-none':formValido}">
                  <div class="alert alert-danger mt-2 mb-0 py-2 text-center" role="alert">Complete el formulario</div>
                </div>
                <div class="row">
                  <div class="col-12 col-lg-3">
                    <div class="form-group">
                      <label for="codigo">Código</label>
                      <input type="text" class="form-control" :class="{'is-invalid':!formCodigo}" v-model="propiedad.codigo" />
                    </div>
                  </div>
                  <div class="col-12 col-lg-3">
                    <div class="form-group mt-3 mt-lg-0">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" :class="{'is-invalid':!formNombre}" v-model="propiedad.nombre" />
                    </div>
                  </div>
                  <div class="col-12 col-lg-4">
                    <div class="form-group mt-3 mt-lg-0">
                      <label for="descripcion">Descripción</label>
                      <input type="text" class="form-control" :class="{'is-invalid':!formDescripcion}" v-model="propiedad.descripcion" />
                    </div>
                  </div>
                  <div class="col-12 col-lg-2 d-flex align-items-end mt-3 mt-lg-0">
                    <button type="button" class="btn btn-primary col-12" v-on:click="agregarPropiedad">Agregar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--/AGREGAR PROPIEDAD-->

      <!--PROPIEDADES-->
      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <div class>
              <table class="table table-striped table-bordered table-hover mt-2">
                <thead>
                  <tr>
                    <th>Nº</th>
                    <th class="d-none d-lg-table-cell">Código</th>
                    <th class="d-none d-lg-table-cell">Nombre</th>
                    <th class="d-none d-lg-table-cell">Descripción</th>
                    <th class="d-none d-lg-table-cell">Detalle</th>
                    <th class="d-table-cell d-lg-none">Propiedad</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(propiedad, index) in propiedades" :key="propiedad.propiedad_id">
                    <td class="text-center align-middle">{{ parseInt(index) + 1 }}</td>
                    <td class="d-none d-lg-table-cell align-middle">
                      <b>{{ propiedad.propiedad_id }}</b>
                    </td>
                    <td class="d-none d-lg-table-cell align-middle">{{ propiedad.nombre }}</td>
                    <td class="d-none d-lg-table-cell align-middle">{{ propiedad.descripcion }}</td>
                    <td class="d-table-cell d-lg-none align-middle">
                      <small>
                        <b>({{ propiedad.propiedad_id }})</b>
                      </small>&nbsp;
                      <router-link :to="{name:'Propiedad',params:{propiedad_id:propiedad.propiedad_id}}">{{ propiedad.nombre }}</router-link>
                      <br />
                      <small>{{ propiedad.descripcion }}</small>
                    </td>
                    <td class="align-middle d-none d-lg-table-cell">
                      <router-link :to="{name:'Propiedad',params:{propiedad_id:propiedad.propiedad_id}}" class="btn btn-primary btn-sm" title="Ver información de la propiedad y cantidad de anotaciones">Detalle Propiedad</router-link>
                    </td>
                    <td class="text-center">
                      <button type="button" class="btn btn-danger" title="Borrar propiedad" v-on:click="borrarPropiedad(propiedad.propiedad_id)">
                        <font-awesome-icon :icon="['fas', 'trash']" />
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--/PROPIEDADES-->
    </div>

    <Footer />
  </div>
</template>

<script>
// @ is an alias to /src
import Header from "@/components/Header.vue";
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";

export default {
  // name: "Propiedades",
  inject: ["spinner1"],
  components: {
    Header,
    NavBar,
    Footer,
  },
  data() {
    return {
      propiedades: [],
      propiedad: {},
      formCodigo: true,
      formNombre: true,
      formDescripcion: true,
      formValido: true,
      // api: "http://localhost:8000/",
      api: "https://mti-saw-api.herokuapp.com/",
    };
  },
  created: function () {
    this.spinner1.val = true;
    this.getPropiedades();
  },
  methods: {
    getPropiedades() {
      fetch(this.api + "api/propiedades")
        .then((response) => response.json())
        .then((responseData) => {
          this.propiedades = responseData;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.spinner1.val = false;
        });
    },
    agregarPropiedad() {
      this.formCodigo = true;
      this.formNombre = true;
      this.formDescripcion = true;

      if (this.propiedad.codigo == null || this.propiedad.codigo == "") {
        this.formCodigo = false;
      }

      if (this.propiedad.nombre == null || this.propiedad.nombre == "") {
        this.formNombre = false;
      }

      if (
        this.propiedad.descripcion == null ||
        this.propiedad.descripcion == ""
      ) {
        this.formDescripcion = false;
      }

      if (!this.formCodigo || !this.formNombre || !this.formDescripcion) {
        this.formValido = false;
        return;
      }

      var data = {
        codigo: this.propiedad.codigo,
        nombre: this.propiedad.nombre,
        descripcion: this.propiedad.descripcion,
      };

      fetch(this.api + "api/propiedades", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((responseData) => {
          console.log(responseData);
          this.getPropiedades();
          this.propiedad.codigo = "";
          this.propiedad.nombre = "";
          this.propiedad.descripcion = "";
          this.formValido = true;
        })
        .catch(console.log());
    },
    borrarPropiedad(propiedad_id) {
      var options = {
        method: "DELETE",
      };
      fetch(this.api + "api/propiedades/" + propiedad_id, options)
        .then((response) => {
          console.log(response);
          this.getPropiedades();
        })
        .catch(console.log);
    },
  },
};
</script>
