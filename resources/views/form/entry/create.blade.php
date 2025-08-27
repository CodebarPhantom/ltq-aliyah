@extends('layouts.main')

@section('content')
    <!-- Container -->
    {{-- @include('backoffice.config.company.partials.submenu') --}}
    <!-- Container -->
    <form id="tahsin-form" action="{{ route('forms.store.rekapitulasi-kesalahan-bacaan') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" name="form_id" value="{{ $data['formData']['id'] }}">
        <div class="container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-bold leading-none text-gray-900">
                        {{ $data['pageTitle'] }}
                    </h1>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="flex items-center gap-2.5">
                        <a class="btn text-center btn-sm btn-primary" href="{{ route('users.index') }}">
                            <i class="ki-filled ki-left"></i></i>Kembali
                        </a>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <button id="submit-button" type="submit" class="btn btn-sm text-center btn-success">
                            <i class="ki-filled ki-check"></i>{{ $data['pageTitle'] }}
                        </button>
                    </div>
                </div>

            </div>
        </div>

        @include('partials.attention')

        <div class="container-fixed">
            <div class="grid gap-5 mx-auto">
                <div class="card pb-2.5">
                    <div class="card-body grid gap-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nama -->
                            <div class="flex flex-col sm:flex-row sm:items-baseline gap-2.5">
                                <label class="form-label w-full sm:w-32">
                                    Nama
                                </label>
                                <div class="relative w-full sm:flex-1 combobox" data-options='@json($data['users'])'
                                    data-multiple="false">
                                    <div
                                        class="pill-container flex items-center w-full px-2 py-2 border border-gray-300 rounded-md bg-white focus:ring-2 focus:ring-blue-500">
                                        <input type="text" placeholder="Cari Peserta"
                                            class="search-box flex-grow px-2 py-1 text-sm text-gray-700 bg-transparent border-none outline-none" />
                                    </div>
                                    <input id="user_id" type="hidden" class="selected-data" name="user_id" />
                                    <div
                                        class="dropdown-menu absolute z-10 w-full mt-2 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                                        <div class="options-container max-h-40 overflow-y-auto"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surah -->
                            <div class="flex flex-col sm:flex-row sm:items-baseline gap-2.5">
                                <label class="form-label w-full sm:w-32">
                                    Surah
                                </label>
                                <div class="relative w-full sm:flex-1 combobox" data-options='@json($data['surahs'])'
                                    data-multiple="false">
                                    <div
                                        class="pill-container flex items-center w-full px-2 py-2 border border-gray-300 rounded-md bg-white focus:ring-2 focus:ring-blue-500">
                                        <input type="text" placeholder="Cari Surat"
                                            class="search-box flex-grow px-2 py-1 text-sm text-gray-700 bg-transparent border-none outline-none" />
                                    </div>
                                    <input id="surah_id" type="hidden" class="selected-data" name="surah_id" />
                                    <div
                                        class="dropdown-menu absolute z-10 w-full mt-2 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                                        <div class="options-container max-h-40 overflow-y-auto"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <div class="flex flex-col sm:flex-row sm:items-baseline gap-2.5">
                                <label class="form-label w-full sm:w-32">
                                    Tanggal
                                </label>
                                <input class="input w-full sm:flex-1" name="entry_date" placeholder="Tanggal" type="date"
                                    value="{{ old('entry_date', $data['user']['entry_date'] ?? date('Y-m-d')) }}" />
                            </div>
                            <!-- Halaman -->
                            <div class="flex flex-col sm:flex-row sm:items-baseline gap-2.5">
                                <label class="form-label w-full sm:w-32">
                                    Halaman
                                </label>
                                <input class="input w-full sm:flex-1" name="page" placeholder="Halaman" type="number"
                                    min="1" value="{{ old('page', $data['user']['page'] ?? '') }}" />
                            </div>
                            <!-- Ayat Dari -->
                            <div class="flex flex-col sm:flex-row sm:items-baseline gap-2.5">
                                <label class="form-label w-full sm:w-32">
                                    Ayat Dari
                                </label>
                                <input class="input w-full sm:flex-1" name="verse_start" placeholder="Ayat dari"
                                    type="number" min="1"
                                    value="{{ old('verse_start', $data['user']['verse_start'] ?? '') }}" />
                            </div>
                            <!-- Ayat Sampai -->
                            <div class="flex flex-col sm:flex-row sm:items-baseline gap-2.5">
                                <label class="form-label w-full sm:w-32">
                                    Ayat Sampai
                                </label>
                                <input class="input w-full sm:flex-1" name="verse_end" placeholder="Ayat sampai"
                                    type="number" min="1"
                                    value="{{ old('verse_end', $data['user']['verse_end'] ?? '') }}" />
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-32">
                                    Catatan
                                </label>
                                <textarea class="textarea" name="notes" placeholder="Catatan Tambahan" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    @foreach ($data['formData']['sections'] as $section)
                        <details class="border border-white-200 rounded-lg">
                            <summary
                                class="cursor-pointer bg-white-100 px-6 py-4 font-semibold text-gray-800 flex justify-between items-center">
                                <span>{{ $section['title'] }}</span>
                                <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="p-4 bg-white grid grid-cols-1 gap-4">
                                @foreach ($section['questions'] as $question)
                                    <div class="flex flex-col items-center gap-3 py-2">
                                        <span class="text-gray-700 text-center w-full">{{ $question['text'] }}</span>
                                        <div class="flex items-center justify-between w-full max-w-xs">
                                            <button type="button"
                                                class="w-14 h-14 flex items-center justify-center btn-warning text-white rounded-full hover:bg-yellow-600 active:bg-yellow-700 transition-colors decrement-btn text-2xl font-bold"
                                                data-question-id="{{ $question['question_id'] }}">
                                                -
                                            </button>
                                            <input type="number" min="0" step="1"
                                                class="w-16 h-14 flex items-center justify-center text-2xl font-bold text-gray-700 count-input bg-gray-100 rounded-lg text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                data-question-id="{{ $question['question_id'] }}" value="0" />
                                            <button type="button"
                                                class="w-14 h-14 flex items-center justify-center btn-success text-white rounded-full hover:bg-green-600 active:bg-green-700 transition-colors increment-btn text-2xl font-bold"
                                                data-question-id="{{ $question['question_id'] }}">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
    <!-- End of Container -->
@endsection



@include('partials.advanced-selectbox')
@push('javascript')
@endpush

@push('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize counts object
            const counts = {};

            // Get all count inputs and initialize counts
            document.querySelectorAll('.count-input').forEach(input => {
                const questionId = input.dataset.questionId;
                counts[questionId] = 0;
                input.value = 0;

                // Add event listener for manual input changes
                input.addEventListener('change', function() {
                    const value = parseInt(this.value) || 0;
                    // Ensure value is not negative
                    if (value < 0) {
                        this.value = 0;
                        counts[questionId] = 0;
                    } else {
                        counts[questionId] = value;
                    }
                });
            });

            // Handle increment buttons
            document.querySelectorAll('.increment-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const questionId = this.dataset.questionId;
                    counts[questionId]++;
                    updateCountInput(questionId);

                    // Add animation effect
                    this.classList.add('scale-90');
                    setTimeout(() => {
                        this.classList.remove('scale-90');
                    }, 100);
                });
            });

            // Handle decrement buttons
            document.querySelectorAll('.decrement-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const questionId = this.dataset.questionId;
                    if (counts[questionId] > 0) {
                        counts[questionId]--;
                        updateCountInput(questionId);

                        // Add animation effect
                        this.classList.add('scale-90');
                        setTimeout(() => {
                            this.classList.remove('scale-90');
                        }, 100);
                    }
                });
            });

            // Update count input
            function updateCountInput(questionId) {
                const input = document.querySelector(`.count-input[data-question-id="${questionId}"]`);
                if (input) {
                    input.value = counts[questionId];

                    // Add animation effect
                    input.classList.add('scale-110');
                    setTimeout(() => {
                        input.classList.remove('scale-110');
                    }, 200);
                }
            }

            // Handle form submission
            document.getElementById('tahsin-form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form data
                const formData = new FormData(this);
                const data = {};

                // Convert FormData to object
                for (let [key, value] of formData.entries()) {
                    data[key] = value;
                }

                // Add counts data
                data.counts = counts;

                // Send data using Axios
                axios.post(this.action, data, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => {
                        // Handle success
                        console.log('Success:', response.data.data);
                        // Redirect or show success message
                        //window.location.href = response.data.data.redirect || '{{ route('users.index') }}';
                    })
                    .catch(error => {
                        // Handle error
                        console.error('Error:', error.response.data);
                        // Show error messages
                        if (error.response.data.errors) {
                            // Display validation errors
                            let errorMessage = 'Validation errors:\n';
                            for (let field in error.response.data.errors) {
                                errorMessage +=
                                    `${field}: ${error.response.data.errors[field].join(', ')}\n`;
                            }
                            alert(errorMessage);
                        } else {
                            alert('An error occurred while submitting the form.');
                        }
                    });
            });
        });
    </script>
@endpush
