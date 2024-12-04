<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .search-box {
            padding: 5px;
        }
        .search-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #0056b3;
        }
        .add-form {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .button {
            padding: 5px 10px;
            cursor: pointer;
        }
        .blue-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 15px;
        }
        .blue-button:hover {
            background-color: #0056b3;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>List</h1>
            <div>
                <form action="{{ route('tasks.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Search tasks..." class="search-box" value="{{ request('search') }}">
                    <button type="submit" class="search-button">Search</button>
                </form>
            </div>
        </div>

        <div style="text-align: center; margin: 20px 0;">
            <button onclick="toggleForm()" class="button blue-button">Create New List</button>
        </div>

        <div id="taskForm" class="add-form" style="display: none;">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Title:</label>
                    <input type="text" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Description:</label>
                    <input type="text" name="description" value="{{ old('description') }}">
                    @error('description')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Status:</label>
                    <select name="status">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    @error('status')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="button">Save Task</button>
                <button type="button" onclick="toggleForm()" class="button">Cancel</button>
            </form>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="button">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $tasks->links() }}
        </div>
    </div>

    <script>
        function toggleForm() {
            var form = document.getElementById('taskForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html> 