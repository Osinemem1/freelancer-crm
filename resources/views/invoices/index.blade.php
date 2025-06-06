@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
          <h1 class="text-2xl font-bold mb-4">Invoices</h1>
          <a href="{{ route('invoices.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create Invoice</a>

          <table class="table-auto w-full mt-4 border">
                    <thead>
                              <tr class="bg-gray-200">
                                        <!-- <th class="p-2 border">ID</th> -->
                                        <th class="p-2 border">Name</th>
                                        <th class="p-2 border">Email</th>
                                        <th class="p-2 border">Phone</th>
                                        <th class="p-2 border">Actions</th>
                              </tr>
                    </thead>
                    <tbody>
                              @foreach ($customers as $customer)
                              <tr>
                                        <td class="p-2 border">{{ $invoice->id }}</td>
                                        <td class="p-2 border">{{ $customer->name }}</td>
                                        <td class="p-2 border">₦{{ $customer->email }}</td>
                                        <td class="p-2 border">{{ $customer->phone }}</td>
                                        <td class="p-2 border">
                                                
                                                  <a href="{{ route('invoices.edit', $invoice) }}" class="text-yellow-600">Edit</a> |
                                                  <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this invoice?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600">Delete</button>
                                                  </form>
                                        </td>
                              </tr>
                              @endforeach
                    </tbody>
          </table>
</div>
@endsection