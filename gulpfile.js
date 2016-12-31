const elixir = require('laravel-elixir');
const path = require('path');
require('laravel-elixir-vue-2');

elixir(mix => {
    Elixir.webpack.config.module.loaders = [];

    Elixir.webpack.mergeConfig({
        // resolveLoader: {
        //     root: path.join(__dirname, 'node_modules'),
        // },
        resolve: {
            extensions: ['', '.js', '.vue'],
            fallback: [path.join(__dirname, './node_modules')],
            alias: {
                'vue$': 'vue/dist/vue.js'
            }
        },
        module: {
            loaders: [
                {
                    test: /\.vue$/,
                    loader: 'vue'
                },

                {
                    test: /\.js$/,
                    loader: 'babel?presets=es2015',
                    exclude: /node_modules/
                },
                {test: /\.scss$/, loader: 'style!css!scss'},
                {
                    test: /vux.src.*?js$/,
                    loader: 'babel'
                }
                // {
                //     test: /\.css$/,
                //     loader: 'style!css'
                // }
            ]
        },
        Favlist: {
            loaders: {
                js: 'babel'
            }
        }
    })
});
elixir((mix) => {
    // mix.sass('app.scss')
    //    .webpack('app.js');

    mix.styles([
        './node_modules/element-ui/lib/theme-default/index.css'
    ], 'public\\css\\element.css').sass('admin.scss')
        .webpack('admin.js');
});
