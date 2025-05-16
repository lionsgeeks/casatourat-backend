<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Manage Submitted Forms
        </x-slot>
    </x-slot>

    <div class="p-6 bg-white">
        <div class="p-6 shadow-md bg-white rounded-lg">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold flex items-center gap-2 text-alpha">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>

                    Form Submission #{{ $form->id }}
                </h2>
                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-[#1a1a8f] text-white">
                    {{ date('Y-m-d', strtotime($form->created_at)) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-slate-500">Source</h3>
                        @foreach ($form->source as $src)
                            <p class="mt-1 capitalize">
                                {{ $src }}
                            </p>
                        @endforeach
                    </div>

                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-slate-500">Circuit</h3>
                        <p class="mt-1">{{ $form->circuit }}</p>
                    </div>

                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-slate-500">Evaluation</h3>
                        <div class="flex mt-1">
                            @for ($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="{{ $i < $form->evaluation ? '#1a1a8f' : 'none' }}"
                                    stroke="{{ $i < $form->evaluation ? 'none' : 'currentColor' }}" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            @endfor
                        </div>
                    </div>

                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-slate-500">Appreciation</h3>
                        @foreach ($form->appreciation as $apr)
                            <p class="mt-1 capitalize">
                                {{ $apr }}
                            </p>
                        @endforeach
                    </div>

                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-slate-500">Difficulty</h3>
                        <p class="mt-1">{{ $form->difficulty }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-slate-500">Interested</h3>
                        <p class="mt-1">{{ $form->interested }}</p>
                    </div>

                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-slate-500">Contact</h3>
                        @foreach ($form->contact as $cnt)
                            <p class="mt-1">
                                {{ $cnt }}
                            </p>
                        @endforeach
                    </div>

                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-slate-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m5 8 6 6" />
                                <path d="m4 14 6-6 2-3" />
                                <path d="M2 5h12" />
                                <path d="M7 2h1" />
                                <path d="m22 22-5-10-5 10" />
                                <path d="M14 18h6" />
                            </svg>
                            Language
                        </h3>
                        <p class="mt-1">{{ $form->language }}</p>
                    </div>

                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-slate-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                <line x1="16" x2="16" y1="2" y2="6" />
                                <line x1="8" x2="8" y1="2" y2="6" />
                                <line x1="3" x2="21" y1="10" y2="10" />
                            </svg>
                            Created
                        </h3>
                        <p class="mt-1">{{ $form->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
