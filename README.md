
###一个基于vuejs2.0和laravel php 后台构建，网页前端应用采用的是laravel的现有构建基本不变，
###只是在后台管理段实现基于vue2.0的单页面重构

##代码下载
>git clone git@github.com:hlwen/laravel-and-vue.git

###开发环境要求有nodejs环境，php开发环境，mysql数据库
#### nodejs下载：[https://nodejs.org/en/download/](https://nodejs.org/en/download/) 下载完成直接安装，环境变量自动配置
#### php，mysql集成开发环境下载：[https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html) 下载完成直接安装，php环境变量要配置，
#### composer开发环境下载：[http://docs.phpcomposer.com/](http://docs.phpcomposer.com/) 网站有详细教程，

#### webpack 环境搭建：[http://www.cnblogs.com/sloong/p/5584684.html](http://www.cnblogs.com/sloong/p/5584684.html)
>cd laravel-and-vue && composer install && npm install || yarn ||cnpm install



###后台管理js代码编译，摒弃了laravel自带的webpack配置，采用自定义形式在根目录的webpack.config.js文件
####安装webpack
>npm install -g webpack || cnpm install -g webpack

##启动js，css代码编译
> webpack --config webpack.min.js //另一份配置文件
> webpack --display-error-details //显示异常信息
> webpack --watch   //监听变动并自动打包 一般开发是使用
> webpack -p    //压缩混淆脚本，这个非常非常重要！ 版本发布的时候，也就是生产环境
> webpack -d    //生成map映射文件，告知哪些模块被最终打包到哪里了

##php启动

>php artisan serve --port 8080

##后台管理所有功能都在/admin目录下,数据交互全部采用ajex；