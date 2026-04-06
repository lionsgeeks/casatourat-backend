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
        <div class="flex flex-col gap-6 max-w-[100rem] mx-auto">
            @if (session('success'))
                <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($cmevents->isEmpty())
                <div class="text-center py-16 border border-dashed border-gray-200 rounded-2xl bg-gray-50/50">
                    <p class="text-gray-800 text-lg font-semibold m-0">No events yet</p>
                    <p class="text-gray-500 mt-2 mb-6 text-sm">Create your first CasaMemoire event to get started.</p>
                    <a href="{{ route('cmevents.create') }}"
                        class="no-underline inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-alpha text-white text-sm font-medium border border-transparent hover:opacity-95 transition-opacity">
                        Create Event
                    </a>
                </div>
            @else
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[56rem] table-fixed border-collapse text-left text-sm">
                            <colgroup>
                                <col class="w-[18%]">
                                <col class="w-[12%]">
                                <col class="w-[12%]">
                                <col class="w-[8%]">
                                <col class="w-[24%]">
                                <col class="w-[10%]">
                                <col class="w-[16%]">
                            </colgroup>
                            <thead>
                                <tr class="border-b border-gray-200 bg-gray-50/90">
                                    <th scope="col" class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Event
                                    </th>
                                    <th scope="col" class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Start
                                    </th>
                                    <th scope="col" class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        End
                                    </th>
                                    <th scope="col" class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">
                                        Cap.
                                    </th>
                                    <th scope="col" class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Location
                                    </th>
                                    <th scope="col" class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Share
                                    </th>
                                    <th scope="col" class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($cmevents as $event)
                                    @php
                                        $registrationShareUrl = route('welcome', ['event' => $event->id]) . '#inscription';
                                        $participantsUrl = route('cmevents.participants.index', $event);
                                        $locationText = $event->location ? trim($event->location) : null;
                                    @endphp
                                    <tr
                                        class="transition-colors hover:bg-gray-50/80 cursor-pointer group"
                                        role="link"
                                        tabindex="0"
                                        title="Open participants"
                                        onclick="window.location='{{ $participantsUrl }}'"
                                        onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); window.location='{{ $participantsUrl }}'; }">
                                        <td class="py-3 px-4 align-middle">
                                            <span class="font-medium text-gray-900 line-clamp-2" title="{{ $event->name }}">{{ $event->name }}</span>
                                            {{-- @if ($event->participants_count)
                                                <span class="block text-xs text-gray-500 mt-0.5 tabular-nums">{{ $event->participants_count }} {{ Str::plural('participant', $event->participants_count) }}</span>
                                            @endif --}}
                                        </td>
                                        <td class="py-3 px-4 align-middle text-gray-700 whitespace-nowrap text-xs sm:text-sm">
                                            {{ $event->start_date?->format('d M Y, H:i') }}
                                        </td>
                                        <td class="py-3 px-4 align-middle text-gray-700 whitespace-nowrap text-xs sm:text-sm">
                                            {{ $event->end_date?->format('d M Y, H:i') }}
                                        </td>
                                        <td class="py-3 px-4 align-middle text-gray-800 text-right tabular-nums font-medium">
                                            {{ $event->capacity ?? '—' }}
                                        </td>
                                        <td class="py-3 px-4 align-middle text-gray-700 max-w-0">
                                            @if ($locationText)
                                                <span class="block truncate text-xs sm:text-sm" title="{{ $locationText }}">{{ $locationText }}</span>
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 align-middle" onclick="event.stopPropagation()">
                                            @if ($event->is_private)
                                                <span class="text-xs text-gray-400">—</span>
                                            @else
                                                <button type="button"
                                                    class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-md border border-gray-200 text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors"
                                                    data-copy-url="{{ $registrationShareUrl }}"
                                                    title="Copy registration link"
                                                    onclick="event.stopPropagation(); navigator.clipboard.writeText(this.dataset.copyUrl).then(() => { var b = this; var t = b.textContent; b.textContent = 'Copied!'; setTimeout(function () { b.textContent = t; }, 2000); })">
                                                    Copy link
                                                </button>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 align-middle text-right" onclick="event.stopPropagation()">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('cmevents.edit', $event) }}"
                                                    class="inline-flex px-2.5 py-1.5 rounded-md border border-alpha/25 text-xs font-medium text-alpha no-underline hover:bg-alpha/5 transition-colors">
                                                    Edit
                                                </a>
                                                <form action="{{ route('cmevents.destroy', $event) }}" method="post" class="inline m-0"
                                                    onsubmit="return confirm('Delete this event?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex px-2.5 py-1.5 rounded-md border border-red-100 text-xs font-medium text-red-600 bg-white hover:bg-red-50 transition-colors">
                                                        Delete
                                                    </button>
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
