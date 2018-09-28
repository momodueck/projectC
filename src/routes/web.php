<?php

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
    return view('start');
});

Route::get('/add', function () {
    return view('add');
});

Route::get('/update/{song_id}', function ($song_id) {
    return view('update');
});

Route::get('/play/{song_id}/{position?}', function ($song_id, $position=0) {
    return view('play', ['position' => $position, 'song'=>App\Song::where('id', $song_id)->first()]);
});

Route::get('/edit/{song_id}/{position?}', function ($song_id,$position=0) {
    return view('edit', ['position' => $position, 'song'=>App\Song::where('id', $song_id)->first()]);
});


Route::post('/addSong', 'SongController@addSong');

Route::get('/search/{term}', 'SearchController@search');

Route::get('/list', 'SearchController@list');

Route::post('/save', 'SongController@save');
