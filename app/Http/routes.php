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

Route::get('/', function () {
    return view('admin.auth.login');
});

//Ejemplo 1 de rutas
/*Route::get('articles/{nombre}',function($nombre){
	echo "El nombre que has colocado es :".$nombre;
});*/

//Ejemplo 2 de rutas
/*Route::get('articles',[
	'as'=>'articles',
	'uses'=>'UserController@index' //userController:controlador
	//index: el metodo o accion
	]);*/

//Ejemplo 3 de rutas
/*Route::group(['prefix'=>'articles'],function(){
		Route::get('view/{article?}',function($article = "Vacio"){
			echo $article;
		});
});	*/

/*Route::group(['prefix'=>'articles'],function(){
	Route::get('view/{id}',[
		'uses'=> 'TestController@view',
		'as'=>'articlesView'
		]);
});*/
Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
	#Rutas usuarios
	Route::resource('users','UsersController');
	Route::get('users/{id}/destroy',[
		'uses' => 'UsersController@destroy',
		'as'   => 'admin.users.destroy'	
	]);
	#Rutas categorias
	Route::resource('categories','CategoriesController');
	Route::get('categories/{id}/destroy',[
		'uses'=>'CategoriesController@destroy',
		'as'=>'admin.categories.destroy']);
	#Ruta entorno inicial
	Route::get('home', function () {
    	return view('admin.home.index');
	});

	
});
#Rutas del login
Route::get('admin/auth/login',[
	'uses'=> 'Auth\AuthController@getLogin',
	'as'  => 'admin.auth.login']);

Route::post('admin/auth/login',[
	'uses'=> 'Auth\AuthController@postLogin',
	'as'  => 'admin.auth.login']);

Route::get('admin/auth/logout',[
	'uses'=> 'Auth\AuthController@logout',
	'as'  => 'admin.auth.logout']);