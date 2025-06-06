@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10">
          <h1 class="text-xl font-bold mb-4">Edit Invoice</h1>

          <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <label>Customer:</label>
                    <select name="customer_id" class="w-full border p-2">
                              @foreach ($customers as $customer)
                              <option value="{{ $customer->id }}" {{ $customer->id == $invoice->customer_id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                              </option>
                              @endforeach
                    </select>

                    <input type="number" name="amount" class="w-full border p-2" value="{{ $invoice->amount }}" required>
                    <input type="date" name="issue_date" class="w-full border p-2" value="{{ $invoice->issue_date }}" required>
                    <input type="date" name="due_date" class="w-full border p-2" value="{{ $invoice->due_date }}" required>

                    <select name="status" class="w-full border p-2" required>
                              <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                              <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                              <option value="overdue" {{ $invoice->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>

                    <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
          </form>
</div>
@endsection