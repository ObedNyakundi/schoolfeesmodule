<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

//define routes to take inputs of student requests
Route::get('/guest/request', [HomeController::class, 'requestfrm']) 
        -> name('guest.request');


//route for generating receipt of payment
Route::get('/feepayment/invoice/{payment}', [InvoiceController::class, 'invoice']) 
        -> name('feepayment.invoice.download');


