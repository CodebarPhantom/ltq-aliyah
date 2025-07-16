@extends('layouts.main')

@section('content')
    <!-- Container -->
    {{-- @include('backoffice.config.company.partials.submenu') --}}
    <!-- Container -->
    <form action="{{ route('users.update', $data['user']['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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

                        <!-- Nama -->
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Nama</label>
                            <input class="input" name="name" placeholder="Nama" type="text"
                                value="{{ old('name', $data['user']['name'] ?? '') }}" />
                        </div>

                        <!-- Email -->
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Email</label>
                            <input class="input" name="email" placeholder="Email" type="text"
                                value="{{ old('email', $data['user']['email'] ?? '') }}" />
                        </div>

                        <!-- Lokasi -->
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Lokasi</label>
                            <select class="select" name="location_id">
                                <option value="">--- Silahkan Pilih ---</option>
                                @foreach ($data['locations'] as $location)
                                    <option value="{{ $location['id'] }}" @selected(old('location_id', $data['user']['location_id'] ?? '') == $location['id'])>
                                        {{ $location['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Role -->
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Role</label>
                            <select class="select" name="role_id">
                                <option value="">--- Silahkan Pilih ---</option>
                                @foreach ($data['roles'] as $role)
                                    <option value="{{ $role['id'] }}" @selected(old('role_id', $data['user']['role_id'] ?? '') == $role['id'])>
                                        {{ $role['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Password (Kosongkan jika tidak mengganti password)
                            </label>
                            <input class="input" name="password" placeholder="Password" id="password" type="password" />
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Konfirmasi Password</label>
                            <input class="input" name="password_confirmation" placeholder="Konfirmasi Password"
                                id="password_confirmation" type="password" />
                        </div>

                        <!-- Status -->
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Status</label>
                            <div class="flex gap-12">
                                <label class="form-label flex items-center gap-2.5 text-nowrap">
                                    <input class="radio" type="radio" name="is_active" value="1"
                                        {{ old('is_active', $data['user']['is_active'] ?? false) == 1 ? 'checked' : '' }} />
                                    Aktif
                                </label>
                                <label class="form-label flex items-center gap-2.5 text-nowrap">
                                    <input class="radio" type="radio" name="is_active" value="0"
                                        {{ old('is_active', $data['user']['is_active'] ?? false) == 0 ? 'checked' : '' }} />
                                    Tidak Aktif
                                </label>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- End of Container -->
@endsection
