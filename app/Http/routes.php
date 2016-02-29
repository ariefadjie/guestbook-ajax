<?php
use App\Guestbook;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/guestbook', function(){
	$guestbooks	= Guestbook::paginate(5);
	return view('guestbook', compact('guestbooks'));
});
Route::post('/guestbook', function(){
	Guestbook::create(Request::all());
	return redirect('/guestbook');
});
Route::get('/user/{name}', function($name){
	return 'This User Page. Your Username is '.$name;
});


// Laravel API
Route::get('/api/guestbooks', function(){
	$guestbooks = Guestbook::all();
	return Response::json($guestbooks);
});
Route::post('/api/guestbooks', function(){
	$guestbooks				= new Guestbook;
	$guestbooks->name		= Request::input('name');
	$guestbooks->message	= Request::input('message');
	$guestbooks->save();
});
