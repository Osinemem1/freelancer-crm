<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Add New Customer</title>
          <style>
                    * {
                              box-sizing: border-box;
                              font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    }

                    body {
                              background-color: #f4f6f8;
                              padding: 0;
                              margin: 0;
                              display: flex;
                              align-items: center;
                              justify-content: center;
                              min-height: 100vh;
                    }

                    .container {
                              background-color: #ffffff;
                              padding: 2rem;
                              border-radius: 10px;
                              box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                              width: 100%;
                              max-width: 500px;
                    }

                    h2 {
                              text-align: center;
                              margin-bottom: 1.5rem;
                              color: #333;
                    }

                    .mb-3 {
                              margin-bottom: 1.2rem;
                    }

                    label {
                              display: block;
                              margin-bottom: 0.5rem;
                              font-weight: 600;
                              color: #444;
                    }

                    input[type="text"],
                    input[type="email"] {
                              width: 100%;
                              padding: 0.75rem;
                              border: 1px solid #ccc;
                              border-radius: 6px;
                              font-size: 1rem;
                              transition: border-color 0.3s;
                    }

                    input[type="text"]:focus,
                    input[type="email"]:focus {
                              border-color: #007bff;
                              outline: none;
                    }

                    .btn {
                              display: block;
                              width: 100%;
                              background-color: #007bff;
                              color: white;
                              padding: 0.75rem;
                              border: none;
                              border-radius: 6px;
                              font-size: 1rem;
                              cursor: pointer;
                              transition: background-color 0.3s;
                    }

                    .btn:hover {
                              background-color: #0056b3;
                    }

                    .alert {
                              padding: 0.75rem;
                              background-color: #d4edda;
                              color: #155724;
                              border: 1px solid #c3e6cb;
                              border-radius: 6px;
                              margin-bottom: 1rem;
                    }
          </style>
</head>

<body>
          <div class="container">
                    <h2>Add New Customer</h2>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('store') }}" method="POST">
                              @csrf

                              <div class="mb-3">
                                        <label for="name">Full Name:</label>
                                        <input type="text" name="name" required value="{{ old('name') }}">
                              </div>

                              <div class="mb-3">
                                        <label for="email">Email Address:</label>
                                        <input type="email" name="email" required value="{{ old('email') }}">
                              </div>

                              <div class="mb-3">
                                        <label for="phone">Phone Number:</label>
                                        <input type="text" name="phone" required value="{{ old('phone') }}">
                              </div>

                              <button type="submit" class="btn">Add Customer</button>
                    </form>
          </div>
</body>

</html>


<!-- for customer new -->
<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Create Task</title>

          <style>
                    body {
                              font-family: Arial, sans-serif;
                              background-color: #f4f4f4;
                              padding: 40px;
                    }

                    h1 {
                              text-align: center;
                              color: #333;
                    }

                    form {
                              background: white;
                              max-width: 500px;
                              margin: 0 auto;
                              padding: 30px;
                              border-radius: 10px;
                              box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                    }

                    input[type="text"],
                    textarea,
                    select,
                    input[type="date"] {
                              display: block;
                              width: 100%;
                              margin-bottom: 20px;
                              padding: 10px;
                              border: 1px solid #ccc;
                              border-radius: 5px;
                              font-size: 16px;
                    }

                    button[type="submit"] {
                              background-color: #28a745;
                              color: white;
                              padding: 10px 15px;
                              border: none;
                              border-radius: 5px;
                              cursor: pointer;
                              font-size: 16px;
                    }

                    button[type="submit"]:hover {
                              background-color: #218838;
                    }
          </style>
</head>

<body>



</body>

</html>