@extends('layouts.app')

@section('title', 'Product Create')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <style>
        .img-holder img {
            max-width: 150px;
            max-height: 150px;
        }
    </style>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mettre à jour</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('customer.index') }}">Clients</a></div>
                    <div class="breadcrumb-item">Modifier un client</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Client</h2>
                <div class="card">
                    <form action="{{ route('customer.update', $customer) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Modifer</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ $customer->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                    class="form-control @error('email')
                                is-invalid
                            @enderror"
                                    name="email" value="{{ $customer->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="number" class="form-control" name="phone_number" value="{{ $customer->phone_number }}">
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ url()->previous() }}'">Annuler</button>
                            <button class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsectionn

@push('scripts')
    <script>
        function previewImageUpdate(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview_image_up');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
