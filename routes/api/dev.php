<?php


Route::group([
    'prefix' => 'devs',
    'as' => 'dev.',
], function () {
    Route::get('/', fn () => response()->json([
        'name' => 'Abigail',
        'state' => 'CA',
    ]));
});
