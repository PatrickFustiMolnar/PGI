@extends('layouts.app')

@section('title', 'Advanced Forms')

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
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ajouter un employé</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employés</a></div>
                    <div class="breadcrumb-item">Ajouter un employé</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Nouvel employé</h2>



                <div class="card">
                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Ajouter</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="text" class="form-control @error('phone')
                                is-invalid
                            @enderror"
                                name="phone" >
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="Position" class="form-control @error('position')
                                is-invalid
                            @enderror"
                                    name="position" >
                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Salaire</label>
                                <input type="text" class="form-control @error('salary')
                                is-invalid
                            @enderror"
                                name="salary" >
                                @error('salary')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Date de naissance</label>
                                <input type="date" class="form-control @error('date_of_birth')
                                is-invalid
                            @enderror"
                                name="date_of_birth" >
                                @error('date_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Entrée</label>
                                <input type="date" class="form-control @error('joining_date')
                                is-invalid
                            @enderror"
                                name="joining_date" >
                                @error('joining_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Adresse</label>
                                <input type="text" class="form-control @error('address')
                                is-invalid
                            @enderror"
                                name="address" > @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ url()->previous() }}'">Annuler</button>
                            <button class="btn btn-primary">Créer</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
