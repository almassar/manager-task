<?php

/********* АВТОРИЗАЦИЯ ************************************************************************/
Route::get ('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get ('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => ['auth', 'session.init']], function(){

    Route::get('/', 'DashboardController@index' );

    Route::get('city/{city_id}', 'DashboardController@city' );

    /********* СОТРУДНИКИ ************************************************************************/
    Route::get ('users',              'UserController@all' );
    Route::get ('user-form/{user?}',  'UserController@form');
    Route::post('user-save/{user?}',  'UserController@save');
    Route::get ('user-delete/{user}', 'UserController@delete');
    Route::post ('search-users',      'UserController@search');


    /********* ДОЛЖНОСТИ *************************************************************************/
    Route::get ('roles',              'RoleController@all' );
    Route::get ('role-form/{role?}',  'RoleController@form');
    Route::post('role-save/{role?}',  'RoleController@save');
    Route::get ('role-delete/{role}', 'RoleController@delete');


    /********* ЗАДАЧИ ****************************************************************************/
    Route::get ('tasks/{slug?}',      'TaskController@all' );
    Route::get ('task-form/{task?}',  'TaskController@form');
    Route::post('task-save/{task?}',  'TaskController@save');
    Route::get ('task-delete/{task}', 'TaskController@delete');
    Route::post('task-search',        'TaskController@search');


    /********* КОММЕНТАРИЙ ***********************************************************************/
    Route::post('comment-save/{task?}',  'CommentController@save');


    /********* ТИПОВЫЕ ЗАДАЧИ ********************************************************************/
    Route::get ('task-lists',                  'TaskListController@all' );
    Route::get ('task-list-form/{taskList?}',  'TaskListController@form');
    Route::post('task-list-save/{taskList?}',  'TaskListController@save');
    Route::get ('task-list-delete/{taskList}', 'TaskListController@delete');


    /********* ОРГАНИЗАЦИИ ***********************************************************************/
    Route::get ('organizations',                      'OrganizationController@all' );
    Route::get ('organization-form/{organization?}',  'OrganizationController@form');
    Route::post('organization-save/{organization?}',  'OrganizationController@save');
    Route::get ('organization-delete/{organization}', 'OrganizationController@delete');
    Route::post('organization-user-save',    'OrganizationController@saveUser');
    Route::post('organization-search',       'OrganizationController@search');
    Route::post('organization-service-save/{organization}',             'OrganizationController@saveService');
    Route::get ('organization-service-delete/{organization}/{service}', 'OrganizationController@deleteService');
    Route::post('service-date-save/{organization }', 'OrganizationController@saveServiceDate');
    Route::post('organization-note-save/{organization}', 'OrganizationController@saveNotes');

    Route::get('organization-note-delete/{organization}/{note}', 'OrganizationController@deleteNote');


    /********* ТОВАРЫ ****************************************************************************/
    Route::get ('products',                 'ProductController@all' );
    Route::get ('product-form/{product?}',  'ProductController@form');
    Route::post('product-save/{product?}',  'ProductController@save');
    Route::get ('product-delete/{product}', 'ProductController@delete');
    Route::get ('product-group-form/{productGroup?}', 'ProductController@formGroup');
    Route::post('product-group-save/{productGroup?}', 'ProductController@saveGroup');


    /********* УСЛУГИ ****************************************************************************/
    Route::get ('services',                 'ServiceController@all' );
    Route::get ('service-form/{service?}',  'ServiceController@form');
    Route::post('service-save/{service?}',  'ServiceController@save');
    Route::get ('service-delete/{service}', 'ServiceController@delete');
    Route::get ('service-group-form/{serviceGroup?}', 'ServiceController@formGroup');
    Route::post('service-group-save/{serviceGroup?}', 'ServiceController@saveGroup');


    /********* ЖУРНАЛ ПОСЕЩЕНИЙ ******************************************************************/
    Route::get ('journals/{monthId?}/{yearId?}',    'JournalController@all' );
    Route::get ('journal-form/{user_id}/{date}',    'JournalController@form');
    Route::post('journal-save/{journal?}', 'JournalController@save');
    Route::post('journal-search', 'JournalController@search');

    Route::post('business-trip-save/{businesTrip?}', 'JournalController@saveBusinessTrip');


    /********* УВЕДОМЛЕНИЯ ***********************************************************************/
    Route::get('notification-mark-as-read/{id}', 'NotificationController@markAsRead');
});


Route::get('test', function (){
    dump(env('APP_ENV'));
});