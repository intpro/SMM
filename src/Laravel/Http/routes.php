<?php

Route::group(['middleware' => 'auth', 'prefix' => 'adm'], function()
{
    Route::post('/smm/save', ['as' => 'smm_save',  'uses' => 'Interpro\SMM\Laravel\Http\SMMController@updateGlobals']);
});

