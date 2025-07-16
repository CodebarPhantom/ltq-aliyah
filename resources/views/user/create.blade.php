@extends('layouts.main')

@section('content')
    <!-- Container -->
    {{-- @include('backoffice.config.company.partials.submenu') --}}
    <!-- Container -->
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
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
                                Email
                            </label>
                            <input class="input" name="email" placeholder="Email" type="text"
                                value="{{ old('email', $data['user']['email'] ?? '') ?: '' }}" />
                        </div>
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Lokasi
                            </label>
                            <select class="select" name="location_id" required>
                                <option value="" selected>--- Silahkan Pilih ---</option>
                                @foreach ($data['locations'] as $location)
                                    <option value="{{ $location['id'] }}" @selected(old('location_id', $data['user']['location_id'] ?? '') == $location['id'])>
                                        {{ $location['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Password (Kosongkan jika tidak mengganti password)
                            </label>
                            <input class="input" name="password" placeholder="Password" id="password" type="password" />
                        </div>
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Konfirmasi Password
                            </label>
                            <input class="input" name="password_confirmation" placeholder="Konfirmasi Password"
                                id="password_confirmation" type="password" />
                        </div>
                        {{-- <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Profile Picture
                            </label>
                            <div>
                                <!-- File input field -->
                                <input class="file-input" name="url_image" type="file" />

                                <!-- Image preview (if available) -->
                                @if (!empty($data['user']['url_image']))
                                    <img class="rounded-full border-3 border-success mt-3 size-[100px] shrink-0"
                                        src="{{ url($data['user']['url_image']) }}" alt="Profile Image">
                                @endif
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End of Container -->
@endsection
