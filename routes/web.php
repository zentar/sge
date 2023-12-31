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

Route::get('/publicados', function () { 
  
    if(\Auth::User()->role_id == 1){
        $libros= \App\Libro::with(['autor','estados','coleccion'])->where('estados_id', [7])->get();
        return view('home', compact('libros'));
    }

    if(\Auth::User()->role_id == 2){
        $libros= \App\Libro::with(['autor','estados','coleccion'])->where('estados_id', [7])->get();
        return view('home', compact('libros'));
     }
    
    if(\Auth::User()->role_id == 3){
        $libros = \Auth::User()->libro()->where('estados_id', [7])->get();
        return view('home', compact('libros'));
     }

     if(\Auth::User()->role_id == 4){
         $libros = \Auth::User()->libro()->where('estados_id', [7])->get();
        return view('home', compact('libros'));
    }


})->middleware('auth');

//CRUD LIBROS
   Route::resource('libro','LibroController');
   
		Route::get('libro/{id}/delete', [
		    'as' => 'libro.delete',
		    'uses' => 'LibroController@destroy',
		]);

		Route::get('libro/{id}/consultar', [
            'as' => 'libro.show',
            'uses' => 'LibroController@show',
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


         Route::get('libro/agregar/capitulos/{id}', [
            'as' => 'libro.agregarcapitulos',
            'uses' => 'LibroController@capitulos',
        ]);

        Route::post('capitulos', [
            'as' => 'libro.capitulos',
            'uses' => 'LibroController@agregarCapitulos',
        ]);

         Route::get('capitulos/delete/{id}', [
            'as' => 'capitulo.delete',
            'uses' => 'LibroController@eliminarCapitulos',
        ]);

    //GENERA SOLICITUD DE APROBACION DE LIBRO
        Route::get('libro/{id}/solicitud', [
                'as' => 'libro.solicitudAprobacion',
                'uses' => 'LibroController@solicitudAprobacion',
        ]);

        
        Route::get('libro/{id}/restado', [
            'as' => 'libro.regresarEstado',
            'uses' => 'LibroController@regresarEstado',
    ]);


      
        Route::post('libro/mensaje', [
            'as' => 'libro.crear_mensaje',
            'uses' => 'LibroController@crearMensaje',
        ]);

        Route::post('campos/especifico', [
            'as' => 'campos.campo_especifico',
            'uses' => 'LibroController@cargar_campo_especifico',
        ]);

        
 Route::get('libro/mensajedestroy/{id}', [
    'as' => 'libro.mensajedestroy',
    'uses' => 'LibroController@mensajedestroy',
]);


    //ASIGNA EDITOR A LIBRO    
        Route::post('libro/asignar', [
            'as' => 'libro.asignar',
            'uses' => 'LibroController@asignar',
        ]);

    //CIERRE ESTADO EDICION DE LIBRO    
        Route::post('libro/cierre', [
                'as' => 'libro.cierreEdicion',
                'uses' => 'LibroController@cierreEdicion',
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


 //Estados
         Route::resource('estados','EstadosController');

         Route::post('estados/{id}/update', [
            'as' => 'estados.update',
            'uses' => 'EstadosController@update',
        ]);

          Route::get('estados/{id}/delete', [
            'as' => 'estados.destroy',
            'uses' => 'EstadosController@destroy',
        ]);

     

   

//Facultades
        Route::resource('facultad','FacultadController');

        Route::post('facultad/{id}/update', [
            'as' => 'facultad.update',
            'uses' => 'FacultadController@update',
        ]);

        Route::get('facultad/{id}/delete', [
            'as' => 'facultad.destroy',
            'uses' => 'FacultadController@destroy',
        ]);


 //caracteristicas

 Route::resource('caracteristicas','CaracteristicasController');

 Route::get('caracteristicas/{id}/edit/{tipo}', [
    'as' => 'caracteristicas.edit',
    'uses' => 'CaracteristicasController@edit',
]);

 Route::post('caracteristicas/createtamano', [
    'as' => 'caracteristicas.createtamano',
    'uses' => 'CaracteristicasController@createtamano',
]);

 Route::post('caracteristicas/createtipo', [
    'as' => 'caracteristicas.createtipo',
    'uses' => 'CaracteristicasController@createtipo',
]);

 Route::post('caracteristicas/createcolor', [
    'as' => 'caracteristicas.createcolor',
    'uses' => 'CaracteristicasController@createcolor',
]);

 Route::get('caracteristicas/destroytamano/{id}', [
    'as' => 'caracteristicas.destroytamanopapel',
    'uses' => 'CaracteristicasController@destroytamanopapel',
]);

 Route::get('caracteristicas/destroytipo/{id}', [
    'as' => 'caracteristicas.destroytipopapel',
    'uses' => 'CaracteristicasController@destroytipopapel',
]);

 Route::get('caracteristicas/destroycolor/{id}', [
    'as' => 'caracteristicas.destroycolorpapel',
    'uses' => 'CaracteristicasController@destroycolorpapel',
]); 

 //Colecciones

        Route::resource('coleccion','ColeccionController');

        Route::post('coleccion/{id}/update', [
            'as' => 'coleccion.update',
            'uses' => 'ColeccionController@update',
        ]);

        Route::get('coleccion/{id}/delete', [
            'as' => 'coleccion.destroy',
            'uses' => 'ColeccionController@destroy',
        ]);


//DOCUMENTOS

        Route::get('autor/{id}/editardocumentos', [
            'as' => 'autor.editardocumentos',
            'uses' => 'AutorController@editarDocumentos',
        ]);
        
        Route::get('libro/{id}/editardocumentos', [
            'as' => 'libro.editardocumentos',
            'uses' => 'LibroController@editarDocumentos',
        ]);
        
       //MUESTRA IMAGEN DE ARCHIVO REQUERIDO
        Route::get('image/{file}/documento', [
            'as' => 'image.documentos',
            'uses' => 'ImageController@show',
        ]);

        //CREAR Y ELIMINAR IMAGEN DE DOCUMENTOS DE AUTORES 
        Route::post('image/caut', [
            'as' => 'image.crear_autor',
            'uses' => 'ImageController@crear_autor',
        ]); 


        Route::get('image/{id}/daut', [
            'as' => 'image.delete_autor',
            'uses' => 'ImageController@delete_autor',
        ]);  


        //CREAR Y ELIMINAR IMAGEN DE DOCUMENTOS DE LIBRO
         Route::post('image/clib', [
            'as' => 'image.crear_libro',
            'uses' => 'ImageController@crear_libro',
        ]); 

        Route::get('image/{id}/dlib', [
            'as' => 'image.delete_libro',
            'uses' => 'ImageController@delete_libro',
        ]);  

        //COTIZACIONES
        Route::get('libro/{id}/agregarcotizacion', [
            'as' => 'libro.agregarcotizacion',
            'uses' => 'LibroController@agregarCotizacion',
        ]);

        Route::get('libro/{id}/editarcotizacion', [
            'as' => 'libro.editarcotizacion',
            'uses' => 'LibroController@editarCotizacion',
        ]);

        Route::get('libro/{id}/CotizacionAprobado', [
            'as' => 'libro.PasarCotizacionAprobado',
            'uses' => 'LibroController@PasarCotizacionAprobado',
        ]);

        
        

        //IMPORTA COTIZACIONES A UN ARCHIVO DOCX,PDF (PIPO)
        Route::get('libro/{id}/reporteCotizacion/{tipo}', [
            'as' => 'libro.reporteCotizacion',
            'uses' => 'LibroController@reporteCotizacion',
        ]);

        //CREAR Y ELIMINAR IMAGEN DE COTIZACIONES DEL LIBRO
         Route::post('image/ccot', [
            'as' => 'image.crear_cotizacion',
            'uses' => 'ImageController@crear_cotizacion',
        ]); 

        Route::get('image/{id}/dcot', [
            'as' => 'image.delete_cotizacion',
            'uses' => 'ImageController@delete_cotizacion',
        ]);        
        
        //CREA EL DOCUMENTO DE LA COTIZACION APROBADO
        Route::post('image/ccota', [
            'as' => 'image.crear_cotizacion_aprobado',
            'uses' => 'ImageController@crear_cotizacion_aprobado',
        ]); 
        
         //Auditoria

        Route::resource('auditoria','AuditoriaController');

         //Reportes

         Route::resource('reportes','ReportesController');

        Route::post('reportes/create', [
            'as' => 'reportes.create',
            'uses' => 'ReportesController@create',
        ]); 


          Route::post('reportes/create_general', [
            'as' => 'reportes.create_general',
            'uses' => 'ReportesController@create_general',
        ]); 

        Route::post('reportes/create_grafico', [
            'as' => 'reportes.create_grafico',
            'uses' => 'ReportesController@create_grafico',
        ]); 

        Route::resource('parametros','ParametrosController');

        Route::get('parametros', [
            'as' => 'parametros.index',
            'uses' => 'ParametrosController@index',
        ]); 

        Route::get('parametros/detallado/{id}', [
            'as' => 'parametros.indexDetallado',
            'uses' => 'ParametrosController@indexDetallado',
        ]); 

        Route::get('parametros/nuevodetallado/{id}', [
            'as' => 'parametros.nuevoDetallado',
            'uses' => 'ParametrosController@nuevoDetallado',
        ]); 

        Route::get('parametros/nuevoEspecifico/{id}', [
            'as' => 'parametros.nuevoEspecifico',
            'uses' => 'ParametrosController@nuevoEspecifico',
        ]); 

        Route::post('parametros/storeDetallado', [
            'as' => 'parametros.storeDetallado',
            'uses' => 'ParametrosController@storeDetallado',
        ]); 

        Route::post('parametros/storeEspecifico', [
            'as' => 'parametros.storeEspecifico',
            'uses' => 'ParametrosController@storeEspecifico',
        ]); 

        Route::get('parametros/editDetallado/{id}', [
            'as' => 'parametros.editDetallado',
            'uses' => 'ParametrosController@editDetallado',
        ]);

        Route::get('parametros/editEspecifico/{id}', [
            'as' => 'parametros.editEspecifico',
            'uses' => 'ParametrosController@editEspecifico',
        ]);

        Route::get('parametros/editGeneral/{id}', [
            'as' => 'parametros.editGeneral',
            'uses' => 'ParametrosController@editGeneral',
        ]);

        

        

        Route::post('parametros/updateDetallado', [
            'as' => 'parametros.updateDetallado',
            'uses' => 'ParametrosController@updateDetallado',
        ]);

        Route::post('parametros/updateEspecifico', [
            'as' => 'parametros.updateEspecifico',
            'uses' => 'ParametrosController@updateEspecifico',
        ]);

        Route::post('parametros/updateGeneral', [
            'as' => 'parametros.updateGeneral',
            'uses' => 'ParametrosController@updateGeneral',
        ]);

        Route::get('parametros/destroyDetallado/{id}', [
            'as' => 'parametros.destroyDetallado',
            'uses' => 'ParametrosController@destroyDetallado',
        ]);

        Route::get('parametros/destroyEspecifico/{id}', [
            'as' => 'parametros.destroyEspecifico',
            'uses' => 'ParametrosController@destroyEspecifico',
        ]);

        Route::get('parametros/destroy/{id}', [
            'as' => 'parametros.destroy',
            'uses' => 'ParametrosController@destroy',
        ]);


        
        
        
        

        


        

        

        
        

        
 
      

