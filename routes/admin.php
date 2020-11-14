<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['prefix' => 'admin', 'namespace' => 'Dashboard', 'middleware' => 'auth:admin'], function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::get('/logout', 'LoginController@logout')->name('admin.logout');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingsController@editShippingMethods')->name('edit.shippings.methods');
            Route::put('shipping-methods/{id}', 'SettingsController@updateShippingMethods')->name('update.shippings.methods');
        });

        ### Begin Main Categories Routes
        route::group(['prefix' => 'profile'], function () {
            Route::get('edit', 'ProfileController@editProfile')->name('edit.profile');
            Route::put('update', 'ProfileController@updateProfile')->name('update.profile');
        });
        ### End Main Categories Routes

        ### Begin Categories Routes
        route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoriesContrloller@index')->name('admin.categories');
            Route::get('create', 'CategoriesContrloller@create')->name('admin.categories.create');
            Route::post('store', 'CategoriesContrloller@store')->name('admin.categories.store');
            Route::get('edit/{id}', 'CategoriesContrloller@edit')->name('admin.categories.edit');
            Route::post('update/{id}', 'CategoriesContrloller@update')->name('admin.categories.update');
            Route::get('delete/{id}', 'CategoriesContrloller@destroy')->name('admin.categories.delete');
            Route::get('changeStatus/{id}', 'CategoriesContrloller@changeStatus')->name('admin.categories.changeStatus');
            Route::get('/activeCategories', 'CategoriesContrloller@activeCategories')->name('admin.categories.activeCategories');
        });
        ### End Categories Routes

        ### Begin Main Categories Routes
        route::group(['prefix' => 'main_categories'], function () {
            Route::get('/', 'MainCategoriesContrloller@index')->name('admin.maincategories');
            Route::get('create', 'MainCategoriesContrloller@create')->name('admin.maincategories.create');
            Route::post('store', 'MainCategoriesContrloller@store')->name('admin.maincategories.store');
            Route::get('edit/{id}', 'MainCategoriesContrloller@edit')->name('admin.maincategories.edit');
            Route::post('update/{id}', 'MainCategoriesContrloller@update')->name('admin.maincategories.update');
            Route::get('delete/{id}', 'MainCategoriesContrloller@destroy')->name('admin.maincategories.delete');
            Route::get('changeStatus/{id}', 'MainCategoriesContrloller@changeStatus')->name('admin.maincategories.changeStatus');
            Route::get('/activeCategories', 'MainCategoriesContrloller@activeCategories')->name('admin.maincategories.activeCategories');
        });
        ### End Main Categories Routes

        ### Begin Sub Categories Routes
        route::group(['prefix' => 'sub_categories'], function () {
            Route::get('/', 'SubCategoriesContrloller@index')->name('admin.subcategories');
            Route::get('create', 'SubCategoriesContrloller@create')->name('admin.subcategories.create');
            Route::post('store', 'SubCategoriesContrloller@store')->name('admin.subcategories.store');
            Route::get('edit/{id}', 'SubCategoriesContrloller@edit')->name('admin.subcategories.edit');
            Route::post('update/{id}', 'SubCategoriesContrloller@update')->name('admin.subcategories.update');
            Route::get('delete/{id}', 'SubCategoriesContrloller@destroy')->name('admin.subcategories.delete');
            Route::get('changeStatus/{id}', 'SubCategoriesContrloller@changeStatus')->name('admin.subcategories.changeStatus');
            Route::get('/activeCategories', 'SubCategoriesContrloller@activeCategories')->name('admin.subcategories.activeCategories');
        });
        ### End Sub Categories Routes

        # Begin Brands Routes
        route::group(['prefix' => 'brands'], function () {
            Route::get('/', 'BrandsController@index')->name('admin.brands');
            Route::get('create', 'BrandsController@create')->name('admin.brands.create');
            Route::post('store', 'BrandsController@store')->name('admin.brands.store');
            Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
            Route::post('update/{id}', 'BrandsController@update')->name('admin.brands.update');
            Route::get('delete/{id}', 'BrandsController@destroy')->name('admin.brands.delete');
            Route::get('changeStatus/{id}', 'BrandsController@changeStatus')->name('admin.brands.changeStatus');
            Route::get('/active', 'BrandsController@active')->name('admin.brands.active');
        });
        ### End Brands Routes

        # Begin Brands Routes
        route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagsController@index')->name('admin.tags');
            Route::get('create', 'TagsController@create')->name('admin.tags.create');
            Route::post('store', 'TagsController@store')->name('admin.tags.store');
            Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
            Route::post('update/{id}', 'TagsController@update')->name('admin.tags.update');
            Route::get('delete/{id}', 'TagsController@destroy')->name('admin.tags.delete');
           // Route::get('changeStatus/{id}', 'TagsController@changeStatus')->name('admin.tags.changeStatus');
           // Route::get('/active', 'TagsController@active')->name('admin.tags.active');
        });
        ### End Brands Routes

        # Begin Products Routes
        route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductsController@index')->name('admin.products');
            Route::get('general-information', 'ProductsController@create')->name('admin.products.general.create');
            Route::post('store-general-information', 'ProductsController@store')->name('admin.products.general.store');
            Route::get('edit-general-information/{id}', 'ProductsController@edit')->name('admin.products.general.edit');
            Route::post('update-general-information/{id}', 'ProductsController@update')->name('admin.products.general.update');
            Route::get('delete-general-information/{id}', 'ProductsController@destroy')->name('admin.products.general.delete');

            Route::get('price/{id}', 'ProductsController@getPrice')->name('admin.products.price');
            Route::post('price', 'ProductsController@saveProductPrice')->name('admin.products.price.store');

            Route::get('stock/{id}', 'ProductsController@getStock')->name('admin.products.stock');
            Route::post('stock', 'ProductsController@saveProductStock')->name('admin.products.stock.store');

            Route::get('images/{id}', 'ProductsController@addImages')->name('admin.products.images');
            Route::post('images', 'ProductsController@saveProductImages')->name('admin.products.images.store');
            Route::post('images/db', 'ProductsController@saveProductImagesDB')->name('admin.products.images.store.db');

        });
        ### End Products Routes

        # Begin ِAttributes Routes
        route::group(['prefix' => 'attributes'], function () {
            Route::get('/', 'AttributesController@index')->name('admin.attributes');
            Route::get('create', 'AttributesController@create')->name('admin.attributes.create');
            Route::post('store', 'AttributesController@store')->name('admin.attributes.store');
            Route::get('edit/{id}', 'AttributesController@edit')->name('admin.attributes.edit');
            Route::post('update/{id}', 'AttributesController@update')->name('admin.attributes.update');
            Route::get('delete/{id}', 'AttributesController@destroy')->name('admin.attributes.delete');
            // Route::get('changeStatus/{id}', 'TagsController@changeStatus')->name('admin.tags.changeStatus');
            // Route::get('/active', 'TagsController@active')->name('admin.tags.active');
        });
        ### End ِAttributes Routes

        # Begin Options Routes
        route::group(['prefix' => 'options'], function () {
            Route::get('/', 'OptionsController@index')->name('admin.options');
            Route::get('create', 'OptionsController@create')->name('admin.options.create');
            Route::post('store', 'OptionsController@store')->name('admin.options.store');
            Route::get('edit/{id}', 'OptionsController@edit')->name('admin.options.edit');
            Route::post('update/{id}', 'OptionsController@update')->name('admin.options.update');
            Route::get('delete/{id}', 'OptionsController@destroy')->name('admin.options.delete');
        });
        ### End Options Routes


    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Dashboard', 'middleware' => 'guest:admin'], function () {

        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@postLogin')->name('admin.post.login');

    });

});
