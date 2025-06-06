<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VoiceCommandController;
use App\Http\Controllers\WelcomeController;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

    $customers = Customer::latest()->paginate(10);
    $invoices = Invoice::with('customer')->get();
    return view('welcome', compact('customers', 'invoices'));
});;

Route::get('/', [WelcomeController::class, 'index'])->name('index');


// / my customer routes
Route::get('/customers', [CustomerController::class, 'view'])->name('view');
Route::post('/customers', [CustomerController::class, 'store'])->name('store');
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::get('/customers/{id}', [CustomerController::class, 'update_view'])->name('update_view');
Route::post('/customers/{id}',[CustomerController::class, 'customer_update'])->name('customer_update');
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customer_destroy');

// my task routes
Route::resource('tasks', TaskController::class);

// end

// my invoice routes

Route::resource('invoices', InvoiceController::class);

//end

Route::post('/voice-command', [VoiceCommandController::class, 'handle']);
