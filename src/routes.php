<?php


	#==================================================================================
	#==================================================================================
    Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'web', 'localize',  'localeSessionRedirect', 'localizationRedirect' ]
    ],
    function()
    {
    #==================================================================================
    #==================================================================================
		
		//***********
		Route::group( 
			[
				'prefix' => 'backend/pagina', 
				'as' => 'pagina.', 
				'namespace' => 'Sztukmistrz\Pagina\Controllers',
				'middleware' => ['auth']
			], 
			function() {
		//***********
			Route::get( '/', 
					['as' => 'start', 
					'uses' => 'PaginaController@start']);

		//***********
			});
		//***********


		Route::get( 'page/{page}', 
            [ 'as' => 'page', 'uses' => '\Sztukmistrz\Pagina\Controllers\PaginaController@getPage']
            );

		//***********
		Route::group( 
			[
				'prefix' => '', 
				'as' => 'pagina.', 
				'namespace' => 'Sztukmistrz\Pagina\Controllers'
			], 
			function() {
		//***********
	        Route::get( LaravelLocalization::transRoute('pagina::routes.about_us'), 
	            [ 'as' => 'about_us', 'uses' => 'PaginaController@getPage']
	            );
	        Route::get( LaravelLocalization::transRoute('pagina::routes.in_media'), 
	            [ 'as' => 'in_media', 'uses' => 'PaginaController@getPage']
	            );

	        Route::get( LaravelLocalization::transRoute('pagina::routes.contact'), 
	            [ 'as' => 'contact', 'uses' => 'PaginaController@getPage']
	            );
	        
        //***********
			});
		//***********


    	$c = Config::get('appEntities.entitiesConfiguration');
		//dd($c);
		foreach ($c as $keyName => $valuesRouteX) {
			
			if($valuesRouteX['realm']['name'] == 'pagina' && $valuesRouteX['realmTenet'] != true){
			
				$valuesRoute = $valuesRouteX['route'];
			//***********
			Route::group( 
				[
					'prefix' => $valuesRoute['prefix'], 
					'as' => $valuesRoute['as'], 
					'namespace' => $valuesRoute['namespace'],
					'middleware' => ['auth']
				], 
				function() use($keyName, $valuesRoute) {
			//***********


				Route::get( LaravelLocalization::transRoute('pagina::routes.'.$keyName.'.index'), 
					['as' => 'index', 
					'uses' => $valuesRoute['uses'].'@index']);
				Route::get( LaravelLocalization::transRoute('pagina::routes.'.$keyName.'.create'), 
					['as' => 'create', 
					'uses' => $valuesRoute['uses'].'@create']);
				Route::get( LaravelLocalization::transRoute('pagina::routes.'.$keyName.'.show'), 
					['as' => 'show', 
					'uses' => $valuesRoute['uses'].'@show']);
				Route::get( LaravelLocalization::transRoute('pagina::routes.'.$keyName.'.edit'), 
					['as' => 'edit', 
					'uses' => $valuesRoute['uses'].'@edit']);

				Route::post( LaravelLocalization::transRoute('pagina::routes.'.$keyName.'.store'), 
					['as' => 'store', 
					'uses' => $valuesRoute['uses'].'@store']);

				Route::delete( LaravelLocalization::transRoute('pagina::routes.'.$keyName.'.destroy'), 
					['as' => 'destroy', 
					'uses' => $valuesRoute['uses'].'@destroy']);

				Route::put( LaravelLocalization::transRoute('pagina::routes.'.$keyName.'.update'), 
					['as' => 'update', 
					'uses' => $valuesRoute['uses'].'@update']);

			//***********
			});
			//***********
		
			};//end if


		}

		




	#==================================================================================
	#==================================================================================
	});
	#==================================================================================
	#==================================================================================