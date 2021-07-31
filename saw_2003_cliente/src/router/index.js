import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Detail from '../views/Detail.vue'
import Propiedades from '../views/Propiedades.vue'
import Propiedad from '../views/Propiedad.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    component: About
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    // component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/detail/:empresa_id',
    name: 'Detail',
    component: Detail
  },
  {
    path: '/propiedades',
    name: 'Propiedades',
    component: Propiedades
  },
  {
    path: '/propiedades/:propiedad_id',
    name: 'Propiedad',
    component: Propiedad
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
