@extends('layouts.main')

@section('content')
    <!-- Container -->
    {{-- @include('backoffice.config.company.partials.submenu') --}}
    <!-- Container -->

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
                    <a class="btn btn-sm text-center btn-warning" href="{{ route('users.edit', $data['user']['id']) }}">
                        <i class="ki-filled ki-notepad-edit"></i>{{ $data['editPageTitle'] }}
                    </a>
                </div>
            </div>

        </div>
    </div>

    @include('partials.attention')

    <div class="container-fixed">
        <div class="grid gap-5 mx-auto">
            <div class="card pb-2.5">
                <div class="card-body grid gap-5">

                    <!-- Nama -->
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">Nama</label>
                        <input class="input" name="name" placeholder="Nama" type="text"
                            value="{{ $data['user']['name'] ?? '' }}" disabled />
                    </div>

                    <!-- Email -->
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">Email</label>
                        <input class="input" name="email" placeholder="Email" type="text"
                            value="{{ $data['user']['email'] ?? '' }}" disabled />
                    </div>

                    <!-- Lokasi -->
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">Lokasi</label>
                        <select class="select" name="location_id" disabled>
                            <option value="">--- Silahkan Pilih ---</option>
                            @foreach ($data['locations'] as $location)
                                <option value="{{ $location['id'] }}" @selected(($data['user']['location_id'] ?? '') == $location['id'])>
                                    {{ $location['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Role
                        </label>
                        <select class="select" name="role_id" disabled>
                            <option value="" selected>--- Silahkan Pilih ---</option>
                            @foreach ($data['roles'] as $role)
                                <option value="{{ $role['id'] }}" @selected(($data['user']['role_id'] ?? '') == $role['id'])>
                                    {{ $role['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">Status</label>
                        <div class="flex gap-12">
                            <label class="form-label flex items-center gap-2.5 text-nowrap">
                                <input class="radio" type="radio" value="1" disabled
                                    {{ $data['user']['is_active'] ?? false ? 'checked' : '' }} />
                                Aktif
                            </label>
                            <label class="form-label flex items-center gap-2.5 text-nowrap">
                                <input class="radio" type="radio" value="0" disabled
                                    {{ !($data['user']['is_active'] ?? false) ? 'checked' : '' }} />
                                Tidak Aktif
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
@endsection
