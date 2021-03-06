<?php
use Illuminate\Support\Facades\Route;
//后台
//prefix 指定路由前缀
Route::prefix('admin')->group(function (){
    //登录
    Route::get('/adminlogin','\App\Admin\Controllers\LoginController@index');
    Route::post('/adminlogin','\App\Admin\Controllers\LoginController@login');
    //登出
    Route::get('/adminlogout','\App\Admin\Controllers\LoginController@logout');

    Route::group(['middleware'=>'auth:admin'],function (){
        //首页
        Route::get('/home','\App\Admin\Controllers\HomeController@index');

        /**
         * 权限控制
         */
        Route::group(['middleware'=>'can:system'],function (){
            //管理员模块
            Route::get('/users','\App\Admin\Controllers\UserController@index');
            Route::get('/users/create','\App\Admin\Controllers\UserController@create');
            Route::post('/users/store','\App\Admin\Controllers\UserController@store');
            //角色用户关联
            Route::get('/users/{user}/role','\App\Admin\Controllers\UserController@role');
            Route::post('/users/{user}/role','\App\Admin\Controllers\UserController@storeRole');

            //角色
            Route::get('/roles','\App\Admin\Controllers\RoleController@index');
            Route::get('/roles/create','\App\Admin\Controllers\RoleController@create');
            Route::post('/roles/store','\App\Admin\Controllers\RoleController@store');
            Route::get('/roles/{role}/permission','\App\Admin\Controllers\RoleController@permission');
            Route::post('/roles/{role}/permission','\App\Admin\Controllers\RoleController@storePermission');

            //权限
            Route::get('/permissions','\App\Admin\Controllers\PermissionController@index');
            Route::get('/permissions/create','\App\Admin\Controllers\PermissionController@create');
            Route::post('/permissions/store','\App\Admin\Controllers\PermissionController@store');

        });


        Route::group(['middleware'=>'can:posts'],function (){
        //文章管理审核模块
        Route::get('/posts','\App\Admin\Controllers\PostController@index');
        Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');
            /**
             *专题模块
             */
            Route::resource('topics','\App\Admin\Controllers\TopicController',['only'=>['index','create','store','destroy']]);

        });

        Route::group(['middleware'=>'can:notice'],function (){

            /**
             * 消息通知模块
             */
            Route::resource('notices','\App\Admin\Controllers\NoticeController',['only'=>['index','create','store']]);
        });
    });
});
