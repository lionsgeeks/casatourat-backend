<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Edit CasaMemoire Event
        </x-slot>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-5xl">
            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 m-0">Edit Event</h2>
                    <p class="text-sm text-gray-500 mt-1 mb-0">Update event information and cover image.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-50 text-red-700 px-4 py-3 border border-red-200">
                        <ul class="m-0 pl-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('cmevents.update', $cmevent) }}" method="post" enctype="multipart/form-data"
                    class="flex flex-col gap-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5 sm:col-span-2">
                            <label for="name" class="text-sm font-medium text-gray-700">Name</label>
                            <input id="name" name="name" type="text"
                                class="rounded-lg border-gray-300 focus:border-alpha focus:ring-alpha"
                                value="{{ old('name', $cmevent->name) }}" required>
                        </div>

                        <div class="flex flex-col gap-1.5 sm:col-span-2">
                            <label for="description" class="text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="5"
                                class="rounded-lg border-gray-300 focus:border-alpha focus:ring-alpha" required>{{ old('description', $cmevent->description) }}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label for="start_date" class="text-sm font-medium text-gray-700">Start Date</label>
                            <input id="start_date" name="start_date" type="datetime-local"
                                class="rounded-lg border-gray-300 focus:border-alpha focus:ring-alpha"
                                value="{{ old('start_date', $cmevent->start_date?->format('Y-m-d\\TH:i')) }}" required>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="end_date" class="text-sm font-medium text-gray-700">End Date</label>
                            <input id="end_date" name="end_date" type="datetime-local"
                                class="rounded-lg border-gray-300 focus:border-alpha focus:ring-alpha"
                                value="{{ old('end_date', $cmevent->end_date?->format('Y-m-d\\TH:i')) }}" required>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label for="capacity" class="text-sm font-medium text-gray-700">Capacity</label>
                            <input id="capacity" name="capacity" type="number"
                                class="rounded-lg border-gray-300 focus:border-alpha focus:ring-alpha"
                                value="{{ old('capacity', $cmevent->capacity) }}">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="location" class="text-sm font-medium text-gray-700">Location</label>
                            <input id="location" name="location" type="text"
                                class="rounded-lg border-gray-300 focus:border-alpha focus:ring-alpha"
                                value="{{ old('location', $cmevent->location) }}">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label for="cover" class="text-sm font-medium text-gray-700">Cover</label>
                            @if ($cmevent->cover)
                                <img src="{{ asset('storage/images/' . $cmevent->cover) }}" alt="cover"
                                    class="h-32 w-48 object-cover rounded-lg border border-gray-200 mb-2">
                            @endif
                            <input id="cover" name="cover" type="file" accept="image/*"
                                class="rounded-lg border-gray-300 focus:border-alpha focus:ring-alpha file:mr-3 file:px-3 file:py-2 file:rounded file:border-0 file:bg-gray-100 file:text-gray-700">
                        </div>
                        <div class="flex items-end">
                            <label
                                class="inline-flex items-center gap-2 cursor-pointer px-3 py-2 rounded-lg border border-gray-300">
                                <input type="checkbox" name="is_private" value="1"
                                    class="rounded border-gray-300 text-alpha focus:ring-alpha"
                                    {{ old('is_private', $cmevent->is_private) ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-gray-700">Private event</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2 pt-2">
                        <button type="submit"
                            class="bg-alpha text-white px-4 py-2 rounded-lg border border-transparent">
                            Save Changes
                        </button>
                        <a href="{{ route('cmevents.index') }}"
                            class="px-4 py-2 rounded-lg border border-gray-300 no-underline text-gray-700 hover:bg-gray-100 transition-colors text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
