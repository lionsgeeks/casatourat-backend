<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            {{ $cmevent->name }} Participants
        </x-slot>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col gap-4">
            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
                    role="status">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5">
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 m-0">Participants List</h3>
                    <span class="text-sm text-gray-500">{{ $participants->count() }} total</span>
                </div>

                @if ($participants->isEmpty())
                    <div class="text-center py-10 border border-dashed border-gray-300 rounded-xl">
                        <p class="text-gray-700 m-0 font-medium">No participants yet</p>
                        <p class="text-gray-500 text-sm mt-1 mb-0">Participants will appear here after registration.</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="w-full text-left border-collapse min-w-[760px]">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="py-3 px-3 text-xs font-semibold uppercase tracking-wide text-gray-600">
                                        Full Name</th>
                                    <th class="py-3 px-3 text-xs font-semibold uppercase tracking-wide text-gray-600">
                                        Email</th>
                                    <th class="py-3 px-3 text-xs font-semibold uppercase tracking-wide text-gray-600">
                                        Phone Number</th>
                                    <th class="py-3 px-3 text-xs font-semibold uppercase tracking-wide text-gray-600">
                                        Registered At</th>
                                    <th class="py-3 px-3 text-xs font-semibold uppercase tracking-wide text-gray-600 w-[100px] text-right">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participants as $participant)
                                    <tr class="border-b hover:bg-gray-50/80 transition-colors">
                                        <td class="py-2 px-3 font-medium text-gray-900">{{ $participant->full_name }}
                                        </td>
                                        <td class="py-2 px-3 text-gray-700">{{ $participant->email }}</td>
                                        <td class="py-2 px-3 text-gray-700">{{ $participant->phone_number }}</td>
                                        <td class="py-2 px-3 text-gray-700">
                                            {{ $participant->created_at?->format('Y-m-d H:i') }}</td>
                                        <td class="py-2 px-3 text-right whitespace-nowrap">
                                            <form
                                                action="{{ route('cmevents.participants.destroy', [$cmevent, $participant]) }}"
                                                method="post" class="inline"
                                                onsubmit="return confirm('Remove this participant from the event? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-sm font-medium text-red-600 hover:text-red-800 hover:underline focus:outline-none focus:ring-2 focus:ring-red-500/30 rounded px-1">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
