require('./bootstrap');


import Vue from 'vue';
import { router } from './router'
import { store } from './store/index'

import App from './components/App'

new Vue({
    router,
    store,
    render: (h) => h(App),
    created: function () {
        window.axios.interceptors.response.use(undefined, function (err) {
            return new Promise(function (resolve, reject) {

                let {response, status} = err

                if (status === 401 && err.config && !err.config.__isRetryRequest) {
                    store.dispatch('logout')
                }

                if(response.status === 401) {
                    store.dispatch('logout')
                }

                throw err;
            });
        });
    }
}).$mount('#app');
