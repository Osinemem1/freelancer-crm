<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Task List</title>
          <style>
                    body {
                              font-family: Arial, sans-serif;
                              background-color: #f4f6f8;
                              padding: 40px;
                    }

                    h1 {
                              text-align: center;
                              color: #333;
                    }

                    a {
                              display: inline-block;
                              margin: 20px 0;
                              text-decoration: none;
                              background-color: #2d89ef;
                              color: white;
                              padding: 10px 16px;
                              border-radius: 4px;
                              font-size: 14px;
                              transition: background-color 0.3s ease;
                    }

                    a:hover {
                              background-color: #1a68c2;
                    }

                    table {
                              width: 100%;
                              border-collapse: collapse;
                              margin-top: 20px;
                              background-color: #fff;
                              box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                    }

                    th,
                    td {
                              padding: 14px;
                              text-align: left;
                              border-bottom: 1px solid #ddd;
                              font-size: 14px;
                    }

                    th {
                              background-color: #f0f0f0;
                              color: #333;
                    }

                    tr:hover {
                              background-color: #f9f9f9;
                    }

                    td a {
                              background-color: #ffa500;
                              color: white;
                              padding: 6px 10px;
                              border-radius: 3px;
                              text-decoration: none;
                              font-size: 13px;
                    }

                    td a:hover {
                              background-color: #e69500;
                    }
          </style>
</head>


<body>

          <h1>Task List</h1>
          <a href="{{ route('tasks.create') }}">+ New Task</a>

          <table>
                    <thead>
                              <tr>
                                        <th>Title</th>
                                        <th>Assigned To</th>
                                        <th>Status</th>
                                        <th>Deadline</th>
                                        <th>Actions</th>
                              </tr>
                    </thead>
                    <tbody>
                              @foreach ($tasks as $task)
                              <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->customer->name ?? 'Unassigned' }}</td>
                                        <td>{{ ucfirst($task->status) }}</td>
                                        <td>{{ $task->deadline }}</td>
                                        <td>
                                                  <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                                        </td>
                              </tr>
                              @endforeach
                    </tbody>
          </table>

</body>

</html>