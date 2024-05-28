<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationKeyController;

Route::post('/validation-key/{domain}', [ValidationKeyController::class, 'create']);



