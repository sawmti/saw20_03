<template>
  <Header />
  <NavBar />
  <div class="about bg-white" style="height:100vh">
    <div class="row pt-5">
      <div class="col text-center">
        <img src="/images/logo_mti.jpg" class="img-fluid" />
        <br />
        <h3>Sistemas y Aplicaciones Web</h3>
        <h4>MTI-476</h4>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col text-center">
        <p>Tarea nº1: Desarrollo de aplicación web que consume datos de Wikidata</p>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col text-center">
        <h5 class="mb-3">Estudiantes</h5>
      </div>
    </div>
    <div class="row mt-1 d-block d-lg-none">
      <div class="col d-flex justify-content-center">
        <ul>
          <li>Carlos Alten</li>
          <li>Paola Espinoza</li>
          <li>Miguel Estefanía</li>
          <li>Patricio Fuenzalida</li>
        </ul>
      </div>
    </div>
    <div class="row mt-5 d-none d-lg-block">
      <div class="col text-center">
        <div class="row d-flex align-items-stretch">
          <div class="col-lg-2 offset-lg-2">
            <div class="card h-100">
              <img src="/images/integrantes/Carlos.png" class="card-img-top" alt="Carlos" />
              <div class="card-body">
                <h6 class="card-title text-start">Carlos Alten</h6>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card h-100">
              <img src="/images/integrantes/Paola.jpg" class="card-img-top" alt="Carlos" />
              <div class="card-body">
                <h6 class="card-title text-start">Paola Espinoza</h6>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card h-100">
              <img src="/images/integrantes/Miguel.jpeg" class="card-img-top" alt="Carlos" />
              <div class="card-body">
                <h6 class="card-title text-start">Miguel Estefanía</h6>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card h-100">
              <img src="/images/integrantes/Patricio.jpeg" class="card-img-top" alt="Carlos" />
              <div class="card-body">
                <h6 class="card-title text-start">Patricio Fuenzalida</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col text-center">
        <span>
          <a href="https://www.usm.cl" target="_blank">UTFSM</a>
        </span>&nbsp;
        <span>
          <a href="https://www.mti.cl" target="_blank">MTI</a>
        </span>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script>
import Header from "@/components/Header.vue";
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";

export default {
  components: {
    Header,
    NavBar,
    Footer,
  },
};
</script>
