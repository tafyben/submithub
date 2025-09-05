<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Assignment Requests') }}
        </h2>
    </x-slot>

    <a href="{{ route('student.assignments.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Request New Assignment</a>

        @if($assignments->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($assignments as $assignment)
                    <div class="border rounded p-4 shadow-sm bg-white">
                        <h2 class="font-semibold text-lg">{{ $assignment->title }}</h2>
                        <p class="text-gray-600">{{ $assignment->description ?? 'No description' }}</p>
                        <p class="mt-2 text-sm">
                            Status:
                            <span class="font-medium
                    {{ $assignment->status == 'pending' ? 'text-yellow-500' : ($assignment->status == 'submitted' ? 'text-blue-500' : 'text-green-500') }}">
                    {{ ucfirst($assignment->status) }}
                </span>
                        </p>
                        @if($assignment->feedback)
                            <p class="mt-2 text-gray-700">Feedback: {{ $assignment->feedback }}</p>
                        @endif
                        @if($assignment->response_file_path)
                            <a href="{{ asset('storage/'.$assignment->response_file_path) }}" class="text-blue-500 underline mt-2 block">Download Response File</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">You have not requested any assignments yet.</p>
    @endif
</x-app-layout>
