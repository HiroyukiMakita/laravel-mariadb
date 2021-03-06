const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .ts('resources/js/**/*', 'public/js/**/*')
    // ソースマップ作成
    .sourceMaps()
    // バージョニングを有効化
    .version()
    // 変更検知でブラウザをホットリロード
    .browserSync(
        {
            // コンテナ内で実行してホストからアクセスするため、host を 0.0.0.0 にする
            host: '0.0.0.0',
            proxy: '127.0.0.1:8000',
            files: [
                './config/adminlte.php',
                './resources/**/*',
                './public/**/*'
            ]
        }
    );
