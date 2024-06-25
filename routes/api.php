<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\DomainController;

Route::post('/domain', [KeyController::class, 'store']);
Route::get('/domain', [DomainController::class, 'checkValidation']);
