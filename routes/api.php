<?php

use App\Http\Controllers\ValidationKey\ValidationKeyController;
use Illuminate\Support\Facades\Route;

Route::get('/validation-key', [ValidationKeyController::class, 'create']);



