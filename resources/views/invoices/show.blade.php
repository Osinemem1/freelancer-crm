@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
          <h1 class="text-xl font-bold mb-4">Invoice Details</h1>

          <p><strong>ID:</strong> {{ $invoice->id }}</p>
          <p><strong>Customer:</strong> {{ $invoice->customer->name ?? 'N/A' }}</p>
          <p><strong>Amount:</strong> ₦{{ $invoice->amount }}</p>
          <p><strong>Issue Date:</strong> {{ $invoice->issue_date }}</p>
          <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p>
          <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>

          <a href="{{ route('invoices.index') }}" class="inline-block mt-4 text-blue-600">← Back to Invoices</a>
</div>
@endsection