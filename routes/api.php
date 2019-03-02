
<?php
use Illuminate\Http\Request;
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');

        Route::post('create-loan', 'LoanController@create');
        Route::get('get-my-loan', 'LoanController@get');
        Route::get('get-my-schedule/{id}', 'LoanController@schedule');

        Route::get('repayment/{id}', 'RepaymentController@index');
        Route::post('repay/{id}', 'RepaymentController@pay');
    });
});

