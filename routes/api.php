<?php

use App\Http\Controllers\HandSetController;
use Illuminate\Support\Facades\Route;

Route::get('/v1/handsets', [
    HandSetController::class, 'index'
]);
