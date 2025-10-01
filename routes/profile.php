<?php

use Illuminate\Support\Facades\Route;

Route::get('/ghg', function() {
    echo(response()->json(request()->all));
});