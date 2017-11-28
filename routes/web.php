<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

//RUTAS CON MIDDLEWARE DE AUTENTICACION Y ROLES 
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
});

//CRUD LIBROS
   Route::resource('libro','LibroController');


		Route::get('libro/{id}/delete', [
		    'as' => 'libro.delete',
		    'uses' => 'LibroController@destroy',
		]);

		Route::get('libro/{id}/consultar', [
            'as' => 'libro.consultar',
            'uses' => 'LibroController@consultar',
        ]);

            Route::post('libro/{id}/update', [
            'as' => 'libro.update',
            'uses' => 'LibroController@update',
        ]);

        Route::get('libro/{id}/editar', [
            'as' => 'libro.editar',
            'uses' => 'LibroController@edit',
        ]);

        Route::get('libro/store', [
            'as' => 'libro.store',
            'uses' => 'LibroController@store',
        ]);

        Route::post('libro/store', [
            'as' => 'libro.store',
            'uses' => 'LibroController@store',
        ]);


        Route::get('libro/create', [
            'as' => 'libro.create',
            'uses' => 'LibroController@create',
        ]);

//CRUD AUTORES
         Route::resource('autor','AutorController');

         Route::get('autor/{id}/delete', [
            'as' => 'autor.delete',
            'uses' => 'AutorController@destroy',
        ]);

        Route::get('autor/{id}/consultar', [
            'as' => 'autor.consultar',
            'uses' => 'AutorController@consultar',
        ]);

        Route::post('autor/{id}/update', [
            'as' => 'autor.update',
            'uses' => 'AutorController@update',
        ]);

        Route::get('autor/{id}/editar', [
            'as' => 'autor.editar',
            'uses' => 'AutorController@edit',
        ]);

        Route::get('autor/store', [
            'as' => 'autor.store',
            'uses' => 'AutorController@store',
        ]);

        Route::post('autor/store', [
            'as' => 'autor.store',
            'uses' => 'AutorController@store',
        ]);


        Route::get('autor/create', [
            'as' => 'autor.create',
            'uses' => 'AutorController@create',
        ]);


         Route::get('capitulos', [
            'as' => 'libro.capitulos',
            'uses' => 'LibroController@capitulos',
        ]);




      

