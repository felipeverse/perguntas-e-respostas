<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    /**
     * Home routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Temas rotas
         */
        Route::get('/temas', 'TemasController@index')->name('temas.index');
        Route::get('/temas/create', 'TemasController@create')->name('temas.create');
        Route::get('/temas/{tema}', 'TemasController@show')->name('temas.show');
        Route::post('/temas', 'TemasController@store')->name('temas.store');
        Route::get('temas/edit/{tema}', 'TemasController@edit')->name('temas.edit');
        Route::put('/temas/{tema}', 'TemasController@update')->name('temas.update');
        Route::delete('/temas/{tema}', 'TemasController@destroy')->name('temas.destroy');
        Route::post('/temas-por-nivel-partial-view/{nivel}', 'TemasController@temasPartialView')->name('temas-por-nivel-partial-view');

        /**
         * Niveis rotas
         */
        Route::get('/niveis', 'NiveisController@index')->name('niveis.index');
        Route::get('/niveis/create', 'NiveisController@create')->name('niveis.create');
        Route::get('/niveis/{nivel}', 'NiveisController@show')->name('niveis.show');
        Route::post('/niveis', 'NiveisController@store')->name('niveis.store');
        Route::get('/niveis/edit/{nivel}', 'NiveisController@edit')->name('niveis.edit');
        Route::put('/niveis/{nivel}', 'NiveisController@update')->name('niveis.update');
        Route::delete('/niveis/{nivel}', 'NiveisController@destroy')->name('niveis.destroy');

        /**
         * Perguntas rotas
         */
        Route::get('/perguntas', 'PerguntasController@index')->name('perguntas.index');
        Route::get('/perguntas/create', 'PerguntasController@create')->name('perguntas.create');
        Route::get('perguntas/show/{pergunta}', 'PerguntasController@show')->name('perguntas.show');
        Route::post('/perguntas', 'PerguntasController@store')->name('perguntas.store');
        Route::get('/perguntas/edit/{pergunta}', 'PerguntasController@edit')->name('perguntas.edit');
        Route::put('/perguntas/{pergunta}', 'PerguntasController@update')->name('perguntas.update');
        Route::delete('/perguntas/{pergunta}', 'PerguntasController@destroy')->name('perguntas.destroy');

        /**
         * Gincana rotas
         */
        Route::group(['prefix' => 'gincanas', 'as' => 'gincanas.'], function () {
            // Gincanas
            Route::get('/', 'GincanasController@index')->name('index');
            Route::get('/create', 'GincanasController@create')->name('create');
            Route::post('/gincanas', 'GincanasController@store')->name('store');
            Route::get('/edit/{gincana}', 'GincanasController@edit')->name('edit');
            Route::put('/{gincana}', 'GincanasController@update')->name('update');
            Route::delete('/{gincana}', 'GincanasController@destroy')->name('destroy');

            // Grupos
            Route::get('/grupos/create/{gincana}', 'GincanaGruposController@create')->name('grupos.create');
            Route::post('/grupos/{gincana}', 'GincanaGruposController@store')->name('grupos.store');
            Route::get('/grupos/delete/{gincanaGrupo}', 'GincanaGruposController@destroy')->name('grupos.destroy');

            // Fases
            Route::get('/fases/create/{gincana}', 'GincanaFasesController@create')->name('fases.create');
            Route::post('/fases/{gincana}', 'GincanaFasesController@store')->name('fases.store');
            Route::get('/fases/delete/{gincanaFase}', 'GincanaFasesController@destroy')->name('fases.destroy');
        });

        /**
         * Partidas rotas
         */
        Route::group(['prefix' => 'partidas', 'as' => 'partidas.'], function () {
            Route::get('/', 'PartidasController@index')->name('index');
            Route::get('create', 'PartidasController@create')->name('create');
            Route::get('play/{partida}', 'PartidasController@play')->name('play');
            Route::post('store', 'PartidasController@store')->name('store');
            Route::post('store-response/{partida}', 'PartidasController@storeResponse')->name('store-response');
            Route::delete('/{partida}', 'PartidasController@destroy')->name('destroy');
        });

        /**
         * Logout Route
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
