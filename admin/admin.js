
import C from "./assets/conf";
import M from "./assets/common";
import Vue from "vue";
import 'element-ui/lib/theme-default/index.css'
import './styles/admin.scss'

import VueRouter from 'vue-router'
import components from 'components'
import VueResource from "vue-resource";
import routerConfig from "./router"
import App from "./module/app.vue"

import ElementUI,{Message} from 'element-ui'
Vue.use(VueResource)
Vue.use(ElementUI)
Vue.use(VueRouter)
Vue.use(components)
const router = new VueRouter(routerConfig);

/**
 * 字典表转化
 * js调用Vue.filter('dictionary')(value,name)
 * html调用{{value| dictionary(name)}}
 */
var dictionary = M.dictionary;
Vue.filter('dictionary', function (value,name) {
    return dictionary[name]&&dictionary[name][value]?dictionary[name][value]:value
});


Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);
    request.credentials = true;
    if (request.url.indexOf('http://') < 0) {//判断是否加入服务器地址
        request.url = C.serverURI + request.url
    }
    next((response) => {
        if (!response.ok) {//判断是否请求发送失败
            Message({
                type: 'error',
                message: '请求失败'
            });
        }

        return response
    });
});


// Vue.component('example', require('./components/Example.vue'));

//启动应用
var app = new Vue({
    el:'#app',
    router,
    render: h => h(App)
});
