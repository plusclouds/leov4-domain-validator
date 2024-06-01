<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\DomainController;

Route::get('/validation-key', [KeyController::class, 'create']);
Route::get("/domain", [DomainController::class, "checkValidation"]);
