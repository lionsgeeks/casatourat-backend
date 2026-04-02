<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            CasaMemoire Events
        </x-slot>

        <a class="no-underline" href="{{ route('cmevents.create') }}">
            <button
                class="md:block hidden bg-alpha text-white font-semibold rounded-lg text-sm px-5 py-2.5 text-center border border-transparent "
                type="button">
                Add Event
            </button>
        </a>
    </x-slot>

    <div class="w-full h-full p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col gap-4">
            @if (session('success'))
                <div class="bg-red-500 border border-gray-200 rounded-xl p-4 sm:p-5">
                    <div class="mb-4 rounded-lg bg-green-100 text-green-700 px-3 py-2">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if ($cmevents->isEmpty())
                <div class="text-center py-12 border border-dashed border-gray-300 rounded-xl">
                    <p class="text-gray-700 text-lg font-semibold m-0">No events yet</p>
                    <p class="text-gray-500 mt-1 mb-4">Create your first CasaMemoire event to get started.</p>
                    <a href="{{ route('cmevents.create') }}"
                        class="no-underline inline-flex items-center justify-center px-4 py-2 rounded-lg bg-alpha text-white border border-transparent ">
                        Create Event
                    </a>
                </div>
            @else
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="py-3 px-3 text-xs font-medium uppercase tracking-wide text-gray-600">
                                        Title
                                    </th>
                                    <th class="py-3 px-3 text-xs font-medium uppercase tracking-wide text-gray-600">
                                        Start
                                        Date
                                    </th>
                                    <th class="py-3 px-3 text-xs font-medium uppercase tracking-wide text-gray-600">End
                                        Date
                                    </th>
                                    <th class="py-3 px-3 text-xs font-medium uppercase tracking-wide text-gray-600">
                                        Capacity
                                    </th>
                                    <th class="py-3 px-3 text-xs font-medium uppercase tracking-wide text-gray-600">
                                        Location
                                    </th>
                                    <th class="py-3 px-3 text-xs font-medium uppercase tracking-wide text-gray-600">
                                        Visibility
                                    </th>
                                    <th class="py-3 px-3 text-xs font-medium uppercase tracking-wide text-gray-600">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cmevents as $event)
                                    <tr class="border-b hover:bg-gray-50/80 transition-colors">
                                        <td class="py-2 px-3 font-medium text-gray-900 truncate max-w-xs">
                                            {{ $event->name }}</td>
                                        <td class="py-2 px-3 text-gray-700">
                                            {{ $event->start_date?->format('Y-m-d H:i') }}
                                        </td>
                                        <td class="py-2 px-3 text-gray-700">{{ $event->end_date?->format('Y-m-d H:i') }}
                                        </td>
                                        <td class="py-2 px-3 text-gray-700">{{ $event->capacity ?? '-' }}</td>
                                        <td class="py-2 px-3 text-gray-700">{{ $event->location ?? '-' }}</td>
                                        <td class="py-2 px-3">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $event->is_private ? 'bg-gray-200 text-gray-800' : 'bg-alpha/10 text-alpha' }}">
                                                {{ $event->is_private ? 'Private' : 'Public' }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-3">
                                            <div class="flex flex-wrap gap-2">
                                                <a href="{{ route('cmevents.participants.index', $event) }}"
                                                    class="px-3 py-1.5 rounded-md border border-gray-300 text-gray-700 no-underline hover:bg-gray-100 transition-colors">
                                                    Participants
                                                    {{ $event->participants_count ? '(' . $event->participants_count . ')' : '' }}
                                                </a>
                                                <a href="{{ route('cmevents.edit', $event) }}"
                                                    class="px-3 py-1.5 rounded-md border border-alpha/20 text-alpha no-underline hover:bg-alpha/5 transition-colors">Edit</a>
                                                <form action="{{ route('cmevents.destroy', $event) }}" method="post"
                                                    onsubmit="return confirm('Delete this event?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1.5 rounded-md border border-red-200 text-red-600 hover:bg-red-50 transition-colors">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>




    </div>
</x-app-layout>
