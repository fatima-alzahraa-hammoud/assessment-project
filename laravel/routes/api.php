<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("/products")->group(function () {
    Route::get("/",[ProjectController::class,"getProjectsWithMembers"]);
    Route::post("/",[ProjectController::class,"createProject"]);
});