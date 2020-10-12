<?php

use Dzorogh\OptimizedImage\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('{path}', [ImageController::class, 'getOptimized'])->where('path', '.*');