<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request New Assignment') }}
        </h2>
    </x-slot>

    <a href="{{ route('student.assignments.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Request New Assignment</a>

        <form action="{{ route('student.assignments.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-medium">Title</label>
                <input type="text" name="title" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Upload File (optional)</label>
                <input type="file" name="request_file" class="w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Request</button>
        </form>
</x-app-layout>
