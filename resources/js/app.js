import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

import App from './App.vue'
import {index} from './store/index'

const app = new Vue({
    render: h => h(App),
    store: index,
    vuetify: new Vuetify()
}).$mount('#app');

