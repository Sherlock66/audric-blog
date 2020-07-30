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

// Route::get('/', function() {
//     return view('pages.index');
// });


Route::get('/settings', function() {
    return view('pages.dashboard');
});

/* start controller public */
/* Route::get('projets', 'PublicController@allProjets');
Route::get('articles', 'PublicController@allArticles');
Route::match(['get', 'post'],'contact', 'PublicController@contactMe'); */
/* end controller public */

/* start controller administrator */

Route::match(['get', 'post'],'/category_project', 'CategoryProjectController@create');
/* end controller administrator */

Route::any('{catchall}', function() {
  return view('pages.404');
})->where('catchall', '.*');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
