import './assets/main.css'
//import 'material-design-icons-iconfont/dist/material-design-icons.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import BreadcrumbsHead from './components/Breadcrumbs.vue'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.component('breadcrumbs-head', BreadcrumbsHead);


// Vuetify
import Vuetify from './plugins/vuetify'



app.use(Vuetify).mount('#app')
