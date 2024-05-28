<?php

use App\Http\Controllers\ValidationKey\ValidationKeyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationDomain\ValidationDomainController;

Route::get('/validation-key', [ValidationKeyController::class, 'create']);
Route::get("/domain", [ValidationDomainController::class, "checkValidation"]);
