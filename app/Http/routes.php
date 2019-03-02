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

Route::get('/',[
	'uses'=> 'HomeController@index',
	'as' => 'home'
]);

Route::get('app',[
	'uses'=> 'HomeController@app',
	'as' => 'app'

]);

Route::get('login',[
		'uses'=> 'Auth\AuthController@getLogin',
		'as' => 'auth.login'
]);
Route::post('login',[
		'uses'=> 'Auth\AuthController@postLogin',
		'as' => 'auth.login'
]);
Route::get('logout',[
		'uses'=> 'Auth\AuthController@getLogout',
		'as' => 'auth.logout'
]);


Route::get('register',[
		'uses'=> 'Auth\AuthController@getRegister',
		'as' => 'auth.register'
]);
Route::post('register',[
		'uses'=> 'Auth\AuthController@postRegister',
		'as' => 'auth.register'
]);


Route::group(['prefix' => 'admin','middleware' => ['auth','admin']], function () {

	Route::get('/',[
		'uses'=> 'AdminController@index',
		'as' => 'admin.home'
	]);

	Route::resource('users','UsersController');
	Route::get('users/{users}/destroy',[
		'uses'=> 'UsersController@destroy',
		'as' => 'admin.users.destroy'
	]);
	Route::get('users/destroy/all',[
		'uses'=> 'UsersController@destroyall',
		'as' => 'admin.users.all'
	]);

	Route::delete('users/destroy/allselect',[
		'uses'=> 'UsersController@destroyselect',
		'as' => 'admin.users.allselect'
	]);

	Route::get('users/{users}/articles',[
		'uses'=> 'UsersController@articles',
		'as' => 'admin.users.articles'
	]);
	
	Route::get('users/{users}/articles/{articles}/destroy',[
		'uses'=> 'UsersController@destroy_articles',
		'as' => 'admin.users.articles.destroy'
	]);

	Route::get('users/{users}/articles/destroy',[
		'uses'=> 'UsersController@userarticlesdestroy',
		'as' => 'admin.users.articles.destroyall'
	]);

	Route::resource('categories','CategoriesController');
	Route::get('categories/{categories}/destroy',[
		'uses'=> 'CategoriesController@destroy',
		'as' => 'admin.categories.destroy'
	]);
	Route::get('categories/destroy/all',[
		'uses'=> 'CategoriesController@destroyall',
		'as' => 'admin.categories.all'
	]);


	Route::resource('tags','TagsController');
	Route::get('tags/{tags}/destroy',[
		'uses'=> 'TagsController@destroy',
		'as' => 'admin.tags.destroy'
	]);
	Route::get('tags/destroy/all',[
		'uses'=> 'TagsController@destroyall',
		'as' => 'admin.tags.all'
	]);


	Route::resource('articles','ArticlesController');
	Route::get('articles/{articles}/destroy',[
		'uses'=> 'ArticlesController@destroy',
		'as' => 'admin.articles.destroy'
	]);
		
	Route::get('article/{slug}',[
		'uses'=> 'ArticlesController@showslug',
		'as' => 'admin.article.showslug'
	]);
	Route::get('articles/destroy/all',[
		'uses'=> 'ArticlesController@destroyall',
		'as' => 'admin.articles.all'
	]);

	Route::get('image',[
		'uses'=> 'ImagesController@index',
		'as' => 'admin.img.index'
	]);

});


Route::group(['prefix' => 'member','middleware' => ['auth','superadmin']], function ($router) {

	Route::resource('profiel','MembersController');

	Route::get('/',[
		'uses'=> 'MembersController@index',
		'as' => 'member.index'
	]);

	Route::get('dashboard/{users}',[
		'uses'=> 'MembersController@dashboard',
		'as' => 'member.dashboard'
	]);

	Route::get('profiel/public/{users}',[
		'uses'=> 'MembersController@profielpublic',
		'as' => 'member.profielpublic'
	]);

	Route::PUT('photo/{profiel}',[
		'uses'=> 'MembersController@photoupdate',
		'as' => 'member.photo.update'
	]);

	Route::PUT('photobio/{profiel}',[
		'uses'=> 'MembersController@photobioupdate',
		'as' => 'member.photobio.update'
	]);

	Route::PUT('biodescription/{profiel}',[
		'uses'=> 'MembersController@biodescriptionupdate',
		'as' => 'member.biodescription.update'
	]);

	Route::get('config/{users}',[
		'uses'=> 'MembersController@config',
		'as' => 'member.config'
	]);


	Route::resource('articles','MemberArticlesController');

	Route::resource('coments','MemberComentsController', ['except' => ['store','destroy','update']]);


	Route::get('article/{slug}',[
		'uses'=> 'MemberArticlesController@showarticles',
		'as' => 'member.article.showarticles'
	]);

	Route::resource('categories','MemberCategoriesController');

	Route::resource('tags','MemberTagsController');


	Route::get('categorie/{name}',[
			'uses'=> 'MembersController@searchcategories',
			'as' => 'member.categorie.search'
	]);

	Route::get('tag/{name}',[
			'uses'=> 'MembersController@searchtags',
			'as' => 'member.tag.search'
	]);


});



Route::get('post/{id}/islikedbyme',[
	'uses'	=>	'MembersController@isLikedByMe',

]);

Route::get('post/{articles}/like/',[
	'uses' => 'MembersController@like',
	'as'	=> 'likes',

]);


Route::POST('member/coments', [
	'middleware' => 'auth',
	'uses' => 'MemberComentsController@store',
	'as'	=>	'member.coments.store'
]);

Route::DELETE('member/coments/{coments}', [
	'middleware' => 'auth',
	'uses' => 'MemberComentsController@destroy',
	'as'	=>	'member.coments.destroy'
]);

Route::PUT('member/coments/{coments}', [
	'middleware' => 'auth',
	'uses' => 'MemberComentsController@update',
	'as'	=>	'member.coments.update'
]);

Route::get('member/coments/destroy/all',[
	'uses'=> 'MemberComentsController@destroyall',
	'as' => 'member.coments.all'
]);

Route::get('article/{articles}/image/{images}/destroy',[
	'middleware' => 'auth',
	'uses'=> 'MemberArticlesController@destroy_articles_images',
	'as' => 'member.articles.images.destroy'
]);