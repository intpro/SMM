<?php

Route::group(['middleware' => 'auth', 'prefix' => 'adm'], function()
{
    Route::post('/smm/saveglobal',   ['as' => 'smm_saveglobal',  'uses' => 'Interpro\SMM\Laravel\Http\SMMController@updateGlobals']);
    Route::post('/smm/delete',       ['as' => 'smm_delete',      'uses' => 'Interpro\SMM\Laravel\Http\SMMController@deleteField']);
});

