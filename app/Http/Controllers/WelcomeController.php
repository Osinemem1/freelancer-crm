<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\TaskBot;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //

    public function index()
    {
        $tasks = TaskBot::with('customer')->latest()->paginate(10);
        $totalCustomer = customer::count();
        $totalInvoice = Invoice::with('status')->where('status', 'unpaid')->count();
        $invoices = Invoice::with('customer')->get();
        $totalTask = TaskBot::with('status')->where('status', 'pending')->count();
        $customers = Customer::latest()->paginate(10);
        return view('welcome', compact('customers','totalCustomer','tasks', 'invoices', 'totalInvoice', 'totalTask'));
    }
}
