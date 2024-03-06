import { createRouter, createWebHistory } from 'vue-router'

import Main from '@/layouts/Main.vue'
const PageNotFound = () => import("@/pages/404.vue");

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Main,
      children: [
        {
          name: "home",
          path: "",
          component: import('@/pages/Home.vue'),
        },
        {
          path: '/formdata',
          name: 'formdata',
          component: () => import('@/pages/formdata/Formdata.vue'),
        },
        {
          path: 'formdata/new',
          name: 'createformdata',
          component: () => import('@/pages/formdata/CreateFormdata.vue'),
        },
        {
          path: 'formdata/edit/:nik?',
          name: 'editformdata',
          component: () => import('@/pages/formdata/EditFormdata.vue'),
        },
      ]
    },
    { 
        name: 'pagenotfound',
        path: '/:pathMatch(.*)*', 
        component: PageNotFound,
        // meta:{
        //   transition: 'slide-right' 
        // }
    },
  ]
})

export default router
