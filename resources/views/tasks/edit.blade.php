<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Edit Task</title>
          <style>
                    body {
                              font-family: Arial, sans-serif;
                              background-color: #f2f4f7;
                              padding: 40px;
                    }

                    h1 {
                              color: #333;
                              text-align: center;
                              margin-bottom: 30px;
                    }

                    form {
                              background-color: #fff;
                              padding: 25px 30px;
                              max-width: 500px;
                              margin: 0 auto;
                              border-radius: 8px;
                              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }

                    input[type="text"],
                    input[type="date"],
                    textarea,
                    select {
                              width: 100%;
                              padding: 10px;
                              margin-top: 12px;
                              margin-bottom: 20px;
                              border: 1px solid #ccc;
                              border-radius: 5px;
                              font-size: 14px;
                    }

                    textarea {
                              resize: vertical;
                              height: 100px;
                    }

                    button[type="submit"] {
                              width: 100%;
                              padding: 12px;
                              background-color: #2d89ef;
                              color: white;
                              font-size: 16px;
                              border: none;
                              border-radius: 5px;
                              cursor: pointer;
                              transition: background-color 0.3s ease;
                    }

                    button[type="submit"]:hover {
                              background-color: #1b6dc1;
                    }
          </style>
</head>

<body>
          <h1>Edit Task</h1>

          <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PUT')

                    <input type="text" name="title" value="{{ $task->title }}" required>

                    <textarea name="description">{{ $task->description }}</textarea>

                    <select name="priority">
                              <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                              <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                              <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                    </select>

                    <input type="date" name="deadline" value="{{ $task->deadline }}">

                    <select name="customer_id">
                              <option value="">Unassigned</option>
                              @foreach ($customers as $customer)
                              <option value="{{ $customer->id }}" {{ $task->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                              </option>
                              @endforeach
                    </select>

                    <select name="status">
                              <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                              <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                              <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>

                    <button type="submit">Update Task</button>
          </form>
</body>

</html>