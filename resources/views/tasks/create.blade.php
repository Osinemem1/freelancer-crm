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

          <h1>Create Task</h1>

          <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <input type="text" name="title" placeholder="Task Title" required>
                    <textarea name="description" placeholder="Description"></textarea>
                    <select name="priority">
                              <option value="low">Low</option>
                              <option value="medium" selected>Medium</option>
                              <option value="high">High</option>
                    </select>
                    <input type="date" name="deadline">
                    <select name="customer_id">
                              <option value="">Unassigned</option>
                              @foreach ($customers as $customer)
                              <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                              @endforeach
                    </select>
                    <button type="submit">Create Task</button>
          </form>

</body>

</html>