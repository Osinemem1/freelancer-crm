@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10">
          <h1 class="text-xl font-bold mb-4">Create Invoice</h1>

          <form action="{{ route('invoices.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <select name="customer_id" class="w-full border p-2" required>
                              <option value="">-- Select Customer --</option>
                              @foreach ($customers as $customer)
                              <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                              @endforeach
                    </select>
                    <input type="number" name="amount" placeholder="Amount" class="w-full border p-2" required>
                    <input type="date" name="issue_date" class="w-full border p-2" required>
                    <input type="date" name="due_date" class="w-full border p-2" required>
                    <select name="status" class="w-full border p-2" required>
                              <option value="unpaid">Unpaid</option>
                              <option value="paid">Paid</option>
                              <option value="overdue">Overdue</option>
                    </select>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
          </form>
</div>
@endsection