<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("/projects")->group(function () {
    Route::get("/",[ProjectController::class,"getProjectsWithMembers"]);
    Route::post("/",[ProjectController::class,"createProject"]);
    Route::post("/update",[ProjectController::class,"updateProject"]);
    Route::delete("/{id}",[ProjectController::class,"deleteProject"]);
});