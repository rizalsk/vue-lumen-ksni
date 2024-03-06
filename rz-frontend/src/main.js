// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { aliases, mdi } from 'vuetify/iconsets/mdi'

import './assets/bootstrap'
import './assets/main.css'
import './assets/custom.scss'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'



const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi,
        },
    },
})

const app = createApp(App)

app.use(router)
app.use(vuetify)

app.mount('#app')
