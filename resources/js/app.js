import Vue from 'vue'
import Vuetify from 'vuetify'
import VueI18n from 'vue-i18n'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
Vue.use(VueI18n)

import App from './App.vue'
import store from './store/index'
import router from './router/index'

Vue.component('Notification', require('./components/Notification.vue').default)

const app = new Vue({
    render: h => h(App),
    store,
    router,
    i18n: new VueI18n({ locale: 'ru' }),
    vuetify: new Vuetify()
}).$mount('#app');

