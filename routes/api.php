<?php


use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('cars', [MainController::class, 'index']);
