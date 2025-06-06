<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function index()
    {
        $invoices = Invoice::with('customer')->get();
        return view('invoices.index', compact('invoices'));
    }

  
    public function create()
    {
        $customers = Customer::all();
        return view('invoices.create', compact('customers'));
    }


    public function store(Request $request)
    {
        Invoice::create($request->only(['customer_id', 'amount', 'issue_date', 'due_date', 'status']));
        return redirect()->route('invoices.index')->with('success', 'Invoice created');
    }



    public function show($id)
    {
        $invoice = Invoice::with('customer')->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $customers = Customer::all();
        return view('invoices.edit', compact('invoice', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->only(['amount','due_date','status']));
        return response()->json($invoice);
    }

    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();
        return response()->json(['message'=>'Invoice deleted']);
    }
}
