<?php


Route::group(['prefix' => 'ajtarragona/charts'], function () {
    Route::post('chart','Ajtarragona\Charts\Controllers\ChartsController@loadChart')->name('charts.chart');

    // Samples routes
    Route::get('samples','Ajtarragona\Charts\Controllers\ChartsController@samples')->middleware(['chart-samples','web'])->name('charts.samples');
});