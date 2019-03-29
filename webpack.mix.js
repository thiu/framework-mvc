let mix = require('laravel-mix');

mix.combine([
	'resources/assets/js/app.js',
	], 'public/js/app.js');

mix.combine([
	'resources/assets/css/app.css',
	], 'public/css/app.css');