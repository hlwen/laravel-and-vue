
import C from "./conf";
import common from "./common";
import Vue from "vue";

/**
 * 时间格式化插件
 */
import moment from 'moment'
/**
 * 时间过滤器
 *
 */
Vue.filter('formatDate', function (value,format) {
  return  value?moment(value).format(format?format:'YYYY-MM-DD'):'';
});
/**
 * 字典表转化
 * js调用Vue.filter('dictionary')(value,name)
 * html调用{{value| dictionary(name)}}
 */

var M =common(Vue)
var dictionary = M.dictionary;
Vue.filter('dictionary', function (value,name) {
  return dictionary[name]&&dictionary[name][value]?dictionary[name][value]:value
});
module.exports = {
    M, C
}


