<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Assignment') }}
        </h2>
    </x-slot>

    <div class="mb-4 p-4 bg-white border rounded shadow">
        <p><strong>Student:</strong> {{ $assignment->student->name }} ({{ $assignment->student->email }})</p>
        <p><strong>Description:</strong> {{ $assignment->description ?? 'No description' }}</p>
        @if($assignment->request_file_path)
            <a href="{{ asset('storage/'.$assignment->request_file_path) }}" class="text-blue-500 underline">Download Request File</a>
        @endif
    </div>

    <form action="{{ route('admin.assignments.update', $assignment) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-medium">Upload Response File (optional)</label>
            <input type="file" name="response_file" class="w-full">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Feedback</label>
            <textarea name="feedback" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ $assignment->feedback }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="pending" {{ $assignment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="submitted" {{ $assignment->status == 'submitted' ? 'selected' : '' }}>Submitted</option>
                <option value="completed" {{ $assignment->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Assignment</button>
    </form>
</x-app-layout>
