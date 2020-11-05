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
//トップページ・ログイン認証
//Route::get('/', function () {
//if (Auth::check()) {
//$user = Auth::user(); //ログイン済ならユーザー情報を取得
//} else {
//$user = json_encode(["" => []]); //未ログインなら空の連想配列を渡す
//}
//return view('index', ['user' => $user]);
//});

Route::get('/', 'DramasController@index')->name('index');
Route::post('/', 'DramasController@search')->name('dramas.search'); //セレクトボックス検索

//ログイン必要
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dramas/new', 'DramasController@new')->name('dramas.new'); //新規登録画面
    Route::post('/dramas/new', 'DramasController@create'); //新規登録内容をポスト

    Route::get('/dramas/{id}/update', 'DramasController@edit')->name('dramas.edit'); //編集画面
    Route::post('dramas/{id}/update', 'DramasController@update')->name('dramas.update'); //編集内容をポスト

    Route::post('/dramas/{id}/delete', 'DramasController@delete')->name('dramas.delete'); //ドラマ削除

    Route::get('/dramas/{id}/detail', 'DramasController@detail')->name('dramas.detail'); //ドラマ詳細画面
    //Route::post('/dramas/{id}/detail', 'DramasController@review')->name('dramas.review');

    Route::get('/dramas/{id}/review', 'DramasController@review')->name('dramas.review'); //レビュー登録画面
    Route::post('/dramas/{id}/review', 'DramasController@postReview')->name('dramas.postReview'); //レビューポスト
    Route::post('/dramas/{id}/deleteReview', 'DramasController@deleteReview')->name('dramas.deleteReview'); //レビューポスト

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
