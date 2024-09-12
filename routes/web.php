<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});

//route for generating receipt of payment
Route::get('/feepayment/invoice/{payment}', [InvoiceController::class, 'invoice']) 
        -> name('feepayment.invoice.download');


