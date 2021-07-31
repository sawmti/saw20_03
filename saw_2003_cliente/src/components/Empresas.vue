<template>
  <div class>
    <table class="table table-striped table-bordered table-hover mt-2">
      <thead>
        <tr>
          <th>Nº</th>
          <th class="d-none d-lg-table-cell">Id Wikidata</th>
          <th class="d-none d-lg-table-cell">Nombre</th>
          <th class="d-none d-lg-table-cell">Descripción</th>
          <th class="d-none d-lg-table-cell">Link</th>
          <th class="d-none d-lg-table-cell">Detalle</th>
          <th class="d-table-cell d-lg-none">Empresa</th>
          <th class="d-table-cell d-lg-none"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(empresa, index) in empresas" :key="empresa.empresa_id">
          <td class="text-center align-middle">{{ parseInt(index) + 1 }}</td>
          <td class="d-none d-lg-table-cell align-middle">
            <b>{{ empresa.empresa_id }}</b>
          </td>
          <td class="d-none d-lg-table-cell align-middle">{{ empresa.nombre }}</td>
          <td class="d-none d-lg-table-cell align-middle">{{ empresa.descripcion }}</td>
          <td class="d-none d-lg-table-cell align-middle">
            <a v-bind:href="'https://www.wikidata.org/wiki/' +
                            empresa.empresa_id" :title="'Ver '+empresa.nombre+' en Wikidata'" target="_blank">{{ empresa.nombre }}</a>
          </td>
          <td class="d-table-cell d-lg-none align-middle">
            <small>
              <b>({{ empresa.empresa_id }})</b>
            </small>&nbsp;
            <a v-bind:href="'https://www.wikidata.org/wiki/' + empresa.empresa_id" target="_blank">{{ empresa.nombre }}</a>
            <br />
            <small>{{ empresa.descripcion }}</small>
          </td>
          <td class="align-middle">
            <router-link :to="{name:'Detail',params:{empresa_id:empresa.empresa_id}}" class="btn btn-primary btn-sm" title="Ver información de la empresa y sus anotaciones">Anotaciones</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["empresas"],
};
</script>