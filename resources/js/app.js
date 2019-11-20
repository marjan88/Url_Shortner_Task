require('./bootstrap');


import Vue from 'vue';
import { router } from './router'
import { store } from './store/index'

import App from './components/App'

new Vue({
    router,
    store,
    render: (h) => h(App)
}).$mount('#app');
