<?php

use App\Http\Controllers\ValidationKey\ValidationKeyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainController;

Route::get('/validation-key', [ValidationKeyController::class, 'create']);
Route::get("/domain", [DomainController::class, "checkValidation"]);
