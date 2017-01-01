/**
 * Created by hlwen on 2016/12/31.
 */
// nodejs 中的path模块
var path = require('path');

// 将样式提取到单独的css文件中，而不是打包到js文件或使用style标签插入在head标签中
var ExtractTextPlugin = require('extract-text-webpack-plugin');
module.exports = {
    // 入口文件，path.resolve()方法，可以结合我们给定的两个参数最后生成绝对路径，最终指向的就是我们的index.js文件
    entry: path.resolve(__dirname, './admin/admin.js'),
    // 输出配置
    output: {
        // 输出路径是 myProject/output/static
        path: path.resolve(__dirname, './public/'),
        publicPath: './public',
        filename: 'js/admin.js',
        // chunkFilename: '[id].[chunkhash].js'
    },
    resolve: {
        extensions: ['', '.js', '.vue'],
        alias: {
            'conf':path.resolve(__dirname, './admin/assets/conf.js'),
            'components': path.resolve(__dirname, './admin/components/components.js'),
            'Lib': path.resolve(__dirname, './admin/assets/Lib.js'),
            'vue$': 'vue/dist/vue.js'
        }
    },
    module: {
        loaders: [
            // 使用vue-loader 加载 .vue 结尾的文件
            {
                test: /\.vue$/,
                loader: 'vue'
            },
            {
                test: /\.js$/,
                loader: 'babel?presets=es2015',
                exclude: /node_modules/
            },
            {
                test: /\.css$/,
                loader: 'style!css'
            },
            {
                test: /\.scss$/,
                loader: 'style!css!sass'
            }, //字体
            {
                test: /\.((ttf|eot|woff|svg)(\?t=[0-9]\.[0-9]\.[0-9]))|(ttf|eot|woff|svg)\??.*$/,
                loader: 'url?limit=10000&name=fonts/[name].[ext]'
            },
            {
                test: /\.(png|jpe?g|gif)(\?.*)?$/,
                loader: 'url',
                query: {
                    limit: 100,
                    name: 'img/[name].[ext]?[hash:10]'
                }
            },
            {
                test: /vux.src.*?js$/,
                loader: 'babel'
            }
        ]
    },
    devtool: 'source-map',
    plugins: [
        // 配置提取出的样式文件
        // new ExtractTextPlugin('css/admin.css'),

    ]
}
