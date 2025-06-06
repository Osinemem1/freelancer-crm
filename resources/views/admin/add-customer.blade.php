<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Add New Customer</title>
          <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

          <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
                    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Add New Customer</h2>

                    <a href="{{ route('index') }}" class="inline-block mb-4 text-sm text-blue-600 hover:underline">
                              ← Back to Home
                    </a>

                    @if(session('success'))
                    <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
                              {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('store') }}" method="POST" class="space-y-4">
                              @csrf

                              <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                              </div>

                              <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                              </div>

                              <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="text" name="phone" id="phone" required value="{{ old('phone') }}"
                                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                              </div>

                              <button type="submit"
                                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Add Customer</button>
                    </form>
          </div>

</body>

</html>