@php use App\Models\SystemSetting; @endphp
<x-base-layout>
    
    @php
        $company = App\Models\SystemSetting::first() ?? new SystemSetting();
    @endphp
    
    <div class="p-2 max-w-none lg:p-20 prose prose-teal prose-sm lg:prose-xl">
        <div class="grid grid-cols-1 gap-4 mx-auto lg:grid-cols-2">
            <div class="p-6 bg-white rounded-lg border">
                <livewire:pages.contact.form />
            </div>
            
            <div class="w-full">
                <div class="px-4 border-b border-gray-900">
                    <h1 class="text-teal-400">Contact us</h1>
                </div>
                <div class="overflow-hidden relative p-4 bg-gradient-to-br from-black via-black to-teal-500 rounded-lg shadow">
                    <div class="z-20">
                        <h4 class="text-white">Phone</h4>
                        <p class="font-semibold text-white">{{ $company->phone }}</p>
                    </div>
                    <div class="absolute right-0 bottom-0 z-10 lg:-bottom-10">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            class="w-20 h-20 text-white rotate-45 lg:w-64 lg:h-full drop-shadow"
                        >
                            <path d="M8 16.25a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75z" />
                            <path
                                fill-rule="evenodd"
                                d="M4 4a3 3 0 013-3h6a3 3 0 013 3v12a3 3 0 01-3 3H7a3 3 0 01-3-3V4zm4-1.5v.75c0 .414.336.75.75.75h2.5a.75.75 0 00.75-.75V2.5h1A1.5 1.5 0 0114.5 4v12a1.5 1.5 0 01-1.5 1.5H7A1.5 1.5 0 015.5 16V4A1.5 1.5 0 017 2.5h1z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                </div>
                
                <div class="overflow-hidden relative p-4 mt-4 bg-gradient-to-br from-black via-black to-teal-500 rounded-lg shadow">
                    <div>
                        <h4 class="text-white">Email</h4>
                        <p class="font-semibold text-white">{{ $company->email_address }}</p>
                    </div>
                    <div class="absolute right-0 bottom-0 z-10 lg:-bottom-10">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-20 h-20 text-white rotate-45 lg:w-64 lg:h-full drop-shadow"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-base-layout>
