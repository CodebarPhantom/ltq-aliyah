@extends('layouts.main')

@section('content')
    <div class="container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-bold leading-none text-gray-900">
                    {{ $data['pageTitle'] }}
                </h1>
                {{-- <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                Central Hub for Personal Customization
            </div> --}}
            </div>
        </div>
    </div>
    <div class="container-fixed">
        <!-- Welcome Section -->
        <div class="flex flex-col justify-center gap-1 rounded-lg p-4 bg-primary-light pb-7.5 mb-6">
            <h3 class="text-md leading-none font-semibold text-gray-900">
                Welcome !
            </h3>
            <p class="text-gray-700 text-2sm font-normal">
                Selamat Datang {{ Auth::User()->name }}
            </p>
            <div class="mt-2 flex items-center text-sm text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span>{{ count($data['forms']) }} Form Tersedia</span>
            </div>
        </div>

        <!-- Forms Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Form Tersedia</h2>
            <div class="text-sm text-gray-500">
                <span class="hidden sm:inline">Klik pada form untuk mengisi</span>
                <span class="sm:hidden">Klik untuk mengisi</span>
            </div>
        </div>

        <!-- Forms Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($data['forms'] as $form)
                <a href="#" class="group block">
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 h-full flex flex-col transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <!-- Card Header with Icon -->
                        <div class="p-5 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 bg-white rounded-lg shadow-sm mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                                        {{ $form->name }}</h3>
                                    <div class="mt-1 flex items-center text-xs text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        <span>Kode: {{ $form->form_code }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-grow">
                            <div class="flex items-center text-sm text-gray-600 mb-0">
                                <i class="ki-filled ki-time mr-1.5 text-gray-700"></i>
                                <span>
                                    Data Terakhir:
                                    {{ $form->lastEntryHeader?->created_at
                                        ? \Carbon\Carbon::parse($form->lastEntryHeader->created_at)->format('d M Y H:i')
                                        : 'Tidak Ada' }}
                                </span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="ki-filled ki-user-tick mr-1.5 text-gray-700"></i>
                                <span>Diperiksa Musyrif: {{ $form->lastEntryHeader?->approver?->name ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs font-medium text-gray-500">Form #{{ $form->id }}</span>
                            <span
                                class="inline-flex items-center text-xs font-medium text-blue-600 group-hover:text-blue-800">
                                Lihat Ringkasan
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Empty State (if needed) -->
        @if (empty($data['forms']))
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada form tersedia</h3>
                <p class="mt-1 text-gray-500">Silakan hubungi administrator untuk informasi lebih lanjut.</p>
            </div>
        @endif
    </div>

    {{-- <div class="container-fixed flex flex-col items-center justify-center h-1/2 mt-2">
        <img src="{{ asset('assets/media/illustrations/22.svg') }}" alt="Dashboard Coming Soon" class="w-1/2 h-1/2">
        <h3 class="text-lg font-semibold text-gray-900 mt-4">
            Coming Soon!
        </h3>
    </div> --}}
@endsection

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/plugin/isBetween.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endpush
