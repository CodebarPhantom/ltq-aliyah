@extends('layouts.main')

@section('content')
    <!-- Container -->
    @include('backoffice.config.company.partials.submenu')
    <!-- Container -->
    <form action="{{ route('company.update',$data['company']['id']) }}" method="post">
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
                        <a class="btn text-center btn-sm btn-primary" href="{{ route('company.index') }}">
                            <i class="ki-filled ki-left"></i></i>Kembali
                        </a>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <button type="submit" class="btn btn-sm text-center btn-success">
                            <i class="ki-filled ki-check"></i>{{ $data['pageTitle'] }}
                        </button>
                    </div>
                </div>

            </div>
        </div>

        @include('partials.attention')

        <div class="container-fixed">
            <div class="grid gap-5  mx-auto">
                <div class="card pb-2.5">
                    <div class="card-body grid gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Entitas
                            </label>
                            <select class="select" name="entity_id">
                                @foreach ($data['entities'] as $entity)
                                    <option value="{{ $entity['id'] }}"
                                        {{ $data['company']['entity_id'] == $entity['id'] ? 'selected' : '' }}>
                                        {{ $entity['name'] }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Nama Kantor
                            </label>
                            <input class="input" name="name" placeholder="Nama Kantor" type="text"
                                value="{{ $data['company']['name'] }}" />
                        </div>
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Address
                            </label>
                            <input class="input" name="address" placeholder="Alamat" type="text"
                                value="{{ $data['company']['address'] }}" />
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">
                                    Phone
                                </label>
                                <input class="input" name="phone" placeholder="Phone" type="text"
                                    value="{{ old('phone',$data['company']['phone']) }}" />

                            </div>
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">
                                    Radius (Meter)
                                </label>
                                <input class="input" name="radius" placeholder="Radius" type="number"
                                    value="{{ old('radius',$data['company']['radius']) }}" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">
                                    Longitude
                                </label>
                                <input id="longitude" class="input" name="longitude" placeholder="Longitude" type="text"
                                    value="{{ old('longitude',$data['company']['longitude']) }}" />
                            </div>
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">
                                    Latitude
                                </label>
                                <input id="latitude" class="input" name="latitude" placeholder="Latitude" type="text"
                                    value="{{ old('latitude',$data['company']['latitude']) }}" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">
                                    Status
                                </label>
                                <div class="flex gap-12">
                                    <label class="form-label flex items-center gap-2.5 text-nowrap">
                                        <input class="radio" name="status" type="radio" value="1"
                                            {{ old('status',  $data['company']['status']) == '1' ? 'checked' : '' }} />
                                        Active
                                    </label>
                                    <label class="form-label flex items-center gap-2.5 text-nowrap">
                                        <input class="radio" name="status" type="radio" value="0"
                                            {{ old('status', $data['company']['status']) == '0' ? 'checked' : '' }} />
                                        Inactive
                                    </label>
                                </div>
                            </div>
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">
                                    Lokasi Otomatis
                                </label>
                                <button class="btn btn-sm text-center btn-info" >
                                    <i class="ki-filled ki-map"></i>Ambil Lokasi Saat ini
                                </button>
                            </div>
                        </div>

                        <!-- Leaflet Map -->
                        <div id="map" style="height: 400px;"></div>


                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- End of Container -->
@endsection
@include('backoffice.config.company.location.include.location-crud-js')
