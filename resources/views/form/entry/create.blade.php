@extends('layouts.main')

@section('content')
    <!-- Container -->
    {{-- @include('backoffice.config.company.partials.submenu') --}}
    <!-- Container -->
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
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
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Nama
                            </label>
                            <input class="input" name="name" placeholder="Nama" type="text"
                                value="{{ old('name', $data['user']['name'] ?? '') ?: '' }}" />
                        </div>
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Surah
                            </label>
                            <select class="select" name="surah_id" required>
                                <option value="" selected>--- Silahkan Pilih ---</option>
                                @foreach ($data['surahs'] as $surah)
                                    <option value="{{ $surah['id'] }}" @selected(old('surah_id', $data['user']['surah_id'] ?? '') == $surah['id'])>
                                        {{ $surah['name_latin'] . ' - ' . $surah['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                            @foreach ($data['formData']['sections'] as $section)
                                <details class="border border-gray-200 rounded-lg">
                                    <summary
                                        class="cursor-pointer bg-gray-100 px-4 py-2 font-semibold text-gray-800 flex justify-between items-center">
                                        <span>{{ $section['title'] }}</span>
                                        <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </summary>

                                    <div class="p-4 bg-white grid grid-cols-1 gap-4">
                                        @foreach ($section['questions'] as $question)
                                            <div class="flex items-center justify-between">
                                                <span class="text-gray-700">{{ $question['text'] }}</span>
                                                <div class="flex items-center space-x-2">
                                                    <button type="button"
                                                        class="px-2 py-1 bg-red-100 text-red-600 rounded-lg hover:bg-red-200"
                                                        @click="decrement('{{ $question['question_id'] }}')">
                                                        -
                                                    </button>
                                                    <span class="w-6 text-center text-gray-800"
                                                        x-text="counts['q' + {{ $question['question_id'] }}] || 0">0</span>
                                                    <button type="button"
                                                        class="px-2 py-1 bg-green-100 text-green-600 rounded-lg hover:bg-green-200"
                                                        @click="increment('{{ $question['question_id'] }}')">
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
        </div>
    </form>
    <!-- End of Container -->
@endsection

@push('javascript')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tahsinForm', () => ({
                counts: {},
                increment(id) {
                    if (!this.counts['q' + id]) this.counts['q' + id] = 0;
                    this.counts['q' + id]++;
                },
                decrement(id) {
                    if (this.counts['q' + id] > 0) this.counts['q' + id]--;
                }
            }));
        });
    </script>
@endpush
