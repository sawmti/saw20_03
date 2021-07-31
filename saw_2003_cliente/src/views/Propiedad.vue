<template>
  <div class="propiedad">
    <Header />
    <NavBar />

    <!--INFO PROPIEDAD -->
    <div class="container bg-white mt-3 mb-5 py-lg-3 px-lg-5">
      <h2>Detalle de Propiedad</h2>
      <div class="row">
        <div class="col-8 offset-2">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{propiedad.nombre}}</h5>
              <ul>
                <li>
                  <b>Código:</b>
                  {{propiedad.propiedad_id}}
                </li>
                <li>
                  <b>Nombre:</b>
                  {{propiedad.nombre}}
                </li>
                <li>
                  <b>Descripción:</b>
                  {{propiedad.descripcion}}
                </li>
                <li>
                  <b>Cantidad de anotaciones:</b>
                  {{typeof(propiedad.anotaciones)==='undefined'?0:propiedad.anotaciones.length}}
                </li>
              </ul>
            </div>
            <div class="card-footer text-end">
              <router-link :to="{name:'Propiedades'}" class="btn btn-primary btn-sm" title="Volver a vista de propiedades">Volver a Propiedades</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

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
      propiedad: {},
      // api: "http://localhost:8000/",
      api: "https://mti-saw-api.herokuapp.com/",
    };
  },

  created: function () {
    this.spinner1.val = true;
    this.getPropiedad();
  },

  methods: {
    getPropiedad() {
      fetch(this.api + "api/propiedades/" + this.$route.params.propiedad_id)
        .then((response) => response.json())
        .then((responseData) => {
          this.propiedad = responseData;
        })
        .catch(console.log)
        .finally(() => {
          this.spinner1.val = false;
        });
    },
  },
};
</script>