<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Album;
use Illuminate\Http\Request;

/**
 * Display albums list
 */
Route::get('/', function () {
    $albums = Album::orderBy('created_at', 'desc')->get();
    return view('albums', [
        'albums' => $albums
    ]);
});

/**
 * Add new album
 */
Route::post('/album', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'album_name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $album = new Album();
    $album->name = $request->album_name;
    $album->save();

    return redirect('/');
});

/**
 * Delete album
 */
Route::delete('/album/{album}', function (Album $album) {
    $album->delete();
    return redirect('/');
});