<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BanjarController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\VotingController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function() {
    
    Route::get ('/',            [VotingController::class, 'index'     ])->name('index');
    Route::post('/',            [VotingController::class, 'check_code'])->name('check-code');
    Route::get ('/user/{code}', [VotingController::class, 'voting'    ])->name('voting');
    Route::post('/vote/{id}',   [VotingController::class, 'vote'      ])->name('vote');

});


Route::prefix('admin')->group(function() {

    Route::name('admin.')->group(function() {
        
        Route::middleware('guest')->group(function() {

            Route::get ('/',             [AdminController::class, 'login'       ])->name('login');
            Route::post('/',             [AdminController::class, 'authenticate'])->name('authenticate');
            
        });
        
        Route::middleware('auth')->group(function() {
            
            Route::get ('/dashboard',    [AdminController::class, 'dashboard'   ])->name('dashboard');
            Route::get ('/index',        [AdminController::class, 'index'       ])->name('index');
            Route::post('/store',        [AdminController::class, 'store'       ])->name('store');
            Route::post('/update/{id}',  [AdminController::class, 'update'      ])->name('update');
            Route::post('/destroy/{id}', [AdminController::class, 'destroy'     ])->name('destroy');
            Route::post('/logout',       [AdminController::class, 'logout'      ])->name('logout');
            
        });
    });

    Route::middleware('auth')->group(function() {

        Route::prefix('banjar')->name('banjar.')->group(function() {
            Route::get ('/index',        [BanjarController::class, 'index'  ])->name('index');
            Route::post('/store',        [BanjarController::class, 'store'  ])->name('store');
            Route::post('/update/{id}',  [BanjarController::class, 'update' ])->name('update');
            Route::post('/destroy/{id}', [BanjarController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('penduduk')->name('penduduk.')->group(function() {
            Route::get ('/index',        [PendudukController::class, 'index'  ])->name('index');
            Route::get ('/pemilih',      [PendudukController::class, 'pemilih'])->name('pemilih');
            Route::post('/store',        [PendudukController::class, 'store'  ])->name('store');
            Route::post('/update/{id}',  [PendudukController::class, 'update' ])->name('update');
            Route::post('/destroy/{id}', [PendudukController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('token')->name('token.')->group(function() {
            Route::get ('/index',        [TokenController::class, 'index'  ])->name('index');
            Route::post('/store',        [TokenController::class, 'store'  ])->name('store');
            Route::post('/destroy/{id}', [TokenController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('kandidat')->name('kandidat.')->group(function() {
            Route::get ('/index',        [KandidatController::class, 'index'  ])->name('index');
            Route::post('/store',        [KandidatController::class, 'store'  ])->name('store');
            Route::post('/update/{id}',  [KandidatController::class, 'update' ])->name('update');
            Route::post('/destroy/{id}', [KandidatController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('hasil-voting')->group(function() {
            Route::get ('/', [VotingController::class, 'hasil_voting'])->name('hasil-voting');
        });

    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');