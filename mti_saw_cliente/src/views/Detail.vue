<template>
  <div class="detail" style="background-color: #eee;">
    <Header />
    <NavBar />

    <!--INFO EMPRESA -->
    <div class="container">
      <!-- <h2>Empresa:</h2> -->

      <div class="row mt-3">
        <!--EMPRESA-->
        <div class="col-12 col-lg-6">
          <div class="card">
            <div class="card-header">
              Wikidata ID:
              <b>{{empresa.empresa_id}}</b>
            </div>
            <img :src="empresa.logo" class="card-img-top p-5 mt-2" />
            <div class="card-body">
              <h5 class="card-title">{{empresa.nombre}}</h5>
              <p class="card-text">
                <span v-if="empresa.descripcion=='Sin descripción'">
                  <small>
                    <em>{{empresa.descripcion}}</em>
                  </small>
                </span>
                <span v-else>{{empresa.descripcion}}</span>
              </p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <b>Creada en:</b>
                {{empresa.creacion}}
              </li>
              <li class="list-group-item" v-if="!empresa.aliases?.length">
                <b>También conocida como:</b>
                <br />
                <small>
                  <em>Sin alias</em>
                </small>
              </li>
              <li class="list-group-item" v-else>
                <b>También conocida como:</b>
                <ul>
                  <li v-for="(alias, index) in empresa.aliases" :key="index">{{alias}}</li>
                </ul>
              </li>
              <li class="list-group-item">
                <a :href="'https://www.wikidata.org/wiki/'+empresa.empresa_id" target="_blank">Link Wikidata</a>
              </li>
            </ul>
          </div>
        </div>
        <!--/EMPRESA-->

        <!--FUNDADORES-->
        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
          <div class="card">
            <div class="card-header">Fundadores ({{empresa.fundadores?.length}})</div>
            <div class="card-body" v-if="!empresa.fundadores?.length">
              <small>
                <em>Sin información</em>
              </small>
            </div>
            <div class="card-body" v-else>
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th class="d-none d-lg-table-cell"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(fundador, index) in empresa.fundadores" :key="index">
                    <td>
                      <img v-if="fundador.imagen==''" src="/images/persona_sin_imagen.png" width="60" :title="fundador.nombre" />
                      <img v-else :src="fundador.imagen" width="60" :title="fundador.nombre" />
                    </td>
                    <td class="d-none d-lg-table-cell align-middle">
                      <a :href="'https://www.wikidata.org/wiki/'+fundador.wikidata_id" target="_blank">{{fundador.nombre}}</a>
                      <br />
                      <small>
                        <em>{{fundador.descripcion}}</em>
                      </small>
                    </td>
                    <td class="d-table-cell d-lg-none align-middle">
                      <a :href="'https://www.wikidata.org/wiki/'+fundador.wikidata_id">{{fundador.nombre}}</a>
                      <br />
                      <small>
                        <em>{{fundador.descripcion}}</em>
                      </small>
                    </td>
                    <td class="d-none d-lg-table-cell text-end align-middle">
                      <a target="_blank" :href="'https://www.wikidata.org/wiki/'+fundador.wikidata_id" class="btn btn-secondary">Ver en Wikidata</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!--/FUNDADORES-->
      </div>

      <!--AGREGAR ANOTACION-->
      <div class="row">
        <div class="col">
          <div class="card mt-3">
            <div class="card-header">
              <b>Agregar Anotación</b>
            </div>
            <div class="card-body">
              <!-- <form v-on:submit.prevent="agregarAnotacion"> -->
              <form>
                <div :class="{'d-none':formValido}">
                  <div class="alert alert-danger mt-2 mb-0 py-2 text-center" role="alert">Complete el formulario</div>
                </div>
                <div class="row">
                  <div class="col-12 col-lg-4">
                    <div class="form-group">
                      <label for="propiedad">Propiedad</label>
                      <!-- <input type="text" class="form-control" :class="{'is-invalid':!formSelPropiedad}" id="atributo" name="atributo" v-model="sel_propiedad" aria-describedby="atributoHelp" placeholder="Nombre del atributo" /> -->
                      <select class="form-select" v-model="sel_propiedad" :class="{'is-invalid':!formSelPropiedad}" aria-describedby="atributoHelp">
                        <option value="0">Seleccione</option>
                        <option v-for="(propiedad) in propiedades" :key="propiedad.propiedad_id" :value="propiedad.propiedad_id">{{propiedad.nombre}}</option>
                      </select>
                      <small id="atributoHelp" class="d-none d-lg-inline form-text text-muted">Ejemplos: país, utilidades, rubro.</small>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6">
                    <div class="form-group mt-3 mt-lg-0">
                      <label for="valor">Valor</label>
                      <input type="text" class="form-control" :class="{'is-invalid':!formValor}" id="valor" name="valor" v-model="anotacion.valor" aria-describedby="valorHelp" placeholder="Valor del atributo" />
                      <small id="valorHelp" class="d-none d-lg-inline form-text text-muted">El valor del atributo indicado en el campo anterior.</small>
                    </div>
                  </div>
                  <div class="col-12 col-lg-2 d-flex align-items-center mt-3 mt-lg-0">
                    <button type="button" class="btn btn-primary col-12" v-on:click="agregarAnotacion">Agregar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--/AGREGAR ANOTACION-->

      <!--LISTAR ANOTACIONES-->
      <div class="row mb-5">
        <div class="col">
          <div class="card my-3">
            <div class="card-header">
              <b>Anotaciones</b>
            </div>
            <div class="card-body">
              <div v-if="!anotaciones?.length">
                <small>
                  <em>No hay anotaciones</em>
                </small>
              </div>
              <div v-else class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Nº</th>
                      <th class="d-none d-lg-table-cell">Atributo</th>
                      <th class="d-none d-lg-table-cell">Valor</th>
                      <th class="d-table-cell d-lg-none">Anotación</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(anotacion,index) in anotaciones" :key="anotacion.id">
                      <td>{{index+1}}</td>
                      <td class="d-none d-lg-table-cell">
                        <router-link :to="{name:'Propiedad',params:{propiedad_id:anotacion.propiedad.propiedad_id}}" title="Ver propiedad">
                          [{{anotacion.propiedad.propiedad_id}}]
                          {{anotacion.propiedad.nombre}}
                        </router-link>
                      </td>
                      <td class="d-none d-lg-table-cell">{{anotacion.valor}}</td>
                      <td class="d-table-cell d-lg-none">
                        <b>{{anotacion.propiedad.nombre}}:</b>
                        <br />
                        {{anotacion.valor}}
                      </td>
                      <td class="text-center">
                        <!-- <button type="button" class="btn btn-danger" title="Borrar anotación"> -->
                        <button type="button" class="btn btn-danger" title="Borrar anotación" v-on:click="borrarAnotacion(anotacion.id)">
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
      </div>
      <!--/LISTAR ANOTACIONES-->
    </div>
    <!--/INFO EMPRESA-->
    <Footer />
  </div>
</template>

<script>
import Header from "@/components/Header.vue";
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";

export default {
  inject: ["spinner1"],
  components: {
    Header,
    NavBar,
    Footer,
  },
  data() {
    return {
      empresa: {},
      anotaciones: [],
      anotacion: {},
      propiedades: [],
      sel_propiedad: 0,
      formSelPropiedad: true,
      formValor: true,
      formValido: true,
      // api: "http://localhost:8000/",
      api: "https://mti-saw-api.herokuapp.com/",
    };
  },
  created: function () {
    this.spinner1.val = true;
    this.getEmpresa();
    this.getAnotaciones();
    this.getPropiedades();
  },
  methods: {
    getEmpresa() {
      fetch(this.api + "api/empresas/" + this.$route.params.empresa_id)
        .then((response) => response.json())
        .then((responseData) => {
          this.empresa = responseData;
        })
        .catch(console.log)
        .finally(() => {
          this.spinner1.val = false;
        });
    },

    getPropiedades() {
      fetch(this.api + "api/propiedades")
        .then((response) => response.json())
        .then((responseData) => {
          this.propiedades = responseData;
        })
        .catch(console.log)
        .finally(() => {
          this.spinner1.val = false;
        });
    },

    agregarAnotacion() {
      this.formSelPropiedad = true;
      this.formValor = true;
      this.formValido = true;
      if (
        this.sel_propiedad == null ||
        this.sel_propiedad == "" ||
        this.sel_propiedad == "0"
      ) {
        this.formSelPropiedad = false;
      }

      if (this.anotacion.valor == null || this.anotacion.valor == "") {
        this.formValor = false;
      }

      if (!this.formSelPropiedad || !this.formValor) {
        this.formValido = false;
        return;
      }

      var data = {
        empresa: this.empresa.empresa_id,
        propiedad: this.sel_propiedad,
        valor: this.anotacion.valor,
      };

      fetch(this.api + "api/anotaciones", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((responseData) => {
          console.log(responseData);
          this.getAnotaciones();
          this.sel_propiedad = "0";
          this.anotacion.valor = "";
        })
        .catch(console.log());
    },

    getAnotaciones() {
      fetch(
        this.api +
          "api/empresas/" +
          this.$route.params.empresa_id +
          "/anotaciones"
      )
        .then((response) => response.json())
        .then((responseData) => {
          this.anotaciones = responseData;
        });
    },

    borrarAnotacion(anotacion_id) {
      console.log(anotacion_id);
      var options = {
        method: "DELETE",
      };
      // var api = 'http://localhost:8000/';
      // var api = "https://mti-saw-api.herokuapp.com/";
      fetch(this.api + "api/anotaciones/" + anotacion_id, options)
        .then((response) => {
          console.log(response);
          this.getAnotaciones();
        })
        .catch(console.log);
    },
  },
};
</script>