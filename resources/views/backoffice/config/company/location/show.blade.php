@extends('layouts.main')

@section('content')
    <!-- Container -->
    @include('backoffice.config.company.partials.submenu')
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
                    <a class="btn text-center btn-sm btn-primary" href="{{ route('company.index') }}">
                        <i class="ki-filled ki-left"></i></i>Kembali
                    </a>
                </div>
                <div class="flex items-center gap-2.5">
                    <a class="btn btn-sm text-center btn-warning" href="{{ route('company.edit', $data['company']['id']) }}">
                        <i class="ki-filled ki-notepad-edit"></i>{{ $data['editPageTitle'] }}
                    </a>
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
                        <select class="select" name="entity_id" disabled>
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
                        <input class="input" name="name" placeholder="Nama Kantor" type="text" disabled=""
                            value="{{ $data['company']['name'] }}" />
                    </div>
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Address
                        </label>
                        <input class="input" name="address" placeholder="Alamat" type="text" disabled=""
                            value="{{ $data['company']['address'] }}" />
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Phone
                            </label>
                            <input class="input" name="phone" placeholder="Phone" type="text" disabled=""
                                value="{{ old('phone',$data['company']['phone']) }}" />

                        </div>
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Radius (Meter)
                            </label>
                            <input class="input" name="radius" placeholder="Radius" type="number" disabled=""
                                value="{{ old('radius',$data['company']['radius']) }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Longitude
                            </label>
                            <input id="longitude" class="input" name="longitude" placeholder="Longitude" type="text" disabled=""
                                value="{{ old('longitude',$data['company']['longitude']) }}" />
                        </div>
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Latitude
                            </label>
                            <input id="latitude" class="input" name="latitude" placeholder="Latitude" type="text" disabled=""
                                value="{{ old('latitude',$data['company']['latitude']) }}" />
                        </div>
                    </div>
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Status
                        </label>
                        <div class="flex gap-12">
                            <label class="form-label flex items-center gap-2.5 text-nowrap">
                                <input class="radio" name="status" type="radio" value="1" disabled=""
                                    {{ $data['company']['status'] == true ? 'checked' : '' }} />
                                Active
                            </label>
                            <label class="form-label flex items-center gap-2.5 text-nowrap">
                                <input class="radio" name="status" type="radio" value="0" disabled=""
                                    {{ $data['company']['status'] == false ? 'checked' : '' }} />
                                Inactive
                            </label>
                        </div>
                    </div>
                    <div id="map" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- End of Container -->
@endsection

@include('backoffice.config.company.location.include.location-crud-js')

