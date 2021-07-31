<template>
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MTI-SAW</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link class="nav-link active" to="/">Empresas</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/propiedades">Propiedades</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/about">Quiénes Somos</router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="https://www.mti.cl" target="_blank">MTI</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>