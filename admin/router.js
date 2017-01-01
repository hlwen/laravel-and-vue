/**
 * Created by hlwen on 2016/12/31.
 */
import home from './module/home.vue'
import articleType from './module/article/articleType.vue'
import article from './module/article/article.vue'
import base from './module/base/base.vue'
import menu from './module/base/menu.vue'
import system from './module/system/system.vue'
export default {
    routes: [
        { path: '/', redirect: '/home' },
        {
            path: '/home',
            component:  home
        },
        {
            path: '/menu',
            component:  menu
        },
        {
            path: '/article',
            component:  article
        },
        {
            path: '/articleType',
            component:  articleType
        },
        {
            path: '/base',
            component: base
        },
        {
            path: '/system',
            component: system
        }
    ]
}