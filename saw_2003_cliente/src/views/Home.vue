<template>
  <div class="home">
    <Header />
    <NavBar />

    <div class="container bg-white mt-3 mb-5 py-lg-3 px-lg-5">
      <!--TITULO-->
      <h1>Empresas TI</h1>
      <!--/TITULO-->

      <!-- DESCRIPCION-->
      <div class="row">
        <div class="col text-small">
          Listado de principales empresas de la industria de las tecnologías de la
          información.
        </div>
      </div>
      <!--/DESCRIPCION-->

      <!--EMPRESAS-->
      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <empresas :empresas="empresas" />
          </div>
        </div>
      </div>
      <!--/EMPRESAS-->
    </div>

    <Footer />
  </div>
</template>

<script>
// @ is an alias to /src
import Header from "@/components/Header.vue";
import NavBar from "@/components/NavBar.vue";
import Empresas from "@/components/Empresas.vue";
import Footer from "@/components/Footer.vue";

export default {
  name: "Home",
  inject: ["spinner1"],
  components: {
    Header,
    NavBar,
    Empresas,
    Footer,
  },
  data() {
    return {
      empresas: [],
    };
  },
  created: function () {
    this.spinner1.val = true;
    this.getEmpresas();
  },
  methods: {
    getEmpresas() {
      // var api = "http://localhost:8000/";
      var api = "https://mti-saw-api.herokuapp.com/";
      fetch(api + "api/empresas")
        .then((response) => response.json())
        .then((responseData) => {
          this.empresas = responseData;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.spinner1.val = false;
        });
    },
  },
};
</script>
