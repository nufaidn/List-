<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Edit Task</h1>

            <form action="{{ route('tasks.update', $task) }}" method="POST" class="bg-white rounded-lg shadow p-6">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" class="w-full border rounded px-3 py-2" 
                           value="{{ old('title', $task->title) }}">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Description</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2" 
                              rows="4">{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('tasks.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 