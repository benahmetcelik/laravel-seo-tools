<?php
/*
Route::group([
    'prefix' => 'seo', 'as' => 'seo::',
    'namespace' => '\Seo\Http\Controllers'], function () {

    Route::get('/{theme_select?}', ['uses' => 'SiteMapController@index', 'as' => 'sitemap.index']);

});
*/

Route::group([
    'prefix' => 'sitemap', 'as' => 'sitemap::',
    'namespace' => '\Seo\Http\Controllers'], function () {

    Route::get('/{model?}', ['uses' => 'SiteMapController@index', 'as' => 'sitemap.index']);

});