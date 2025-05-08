@extends('layouts.app')

@section('title', 'Reservation Create')

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
                <h1>Ajouter une réservation</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('reservation.index') }}">Réservations</a></div>
                    <div class="breadcrumb-item">Créer une réservation</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Réservation</h2>
                <div class="card">
                    <form action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Ajouter</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nom du client</label>
                                <input type="text"
                                    class="form-control @error('customer_name')
                                is-invalid
                            @enderror"
                                    name="customer_name">
                                @error('cusomer_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Telephone client</label>
                                <input type="text"
                                    class="form-control @error('customer_phone')
                                is-invalid
                            @enderror"
                                    name="customer_phone">
                                @error('customer_phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Date de réservation</label>
                                <input class="form-control" type="date" id="reservation_date" name="reservation_date" required>
                                @error('reservation_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Heure de réservation</label>
                                <input class="form-control" type="time" id="reservation_time" name="reservation_time" required>
                                @error('reservation_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Numéro de table</label>
                                <input type="text"
                                    class="form-control @error('table_number')
                                is-invalid
                            @enderror"
                                    name="table_number">
                                @error('table_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status de réservation</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="pending">Attente</option>
                                    <option value="confirmed">Confirmé</option>
                                    <option value="seated">À table</option>
                                    <option value="cancelled">Annulé</option>
                                    <option value="completed">Fini</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Notes</label>
                                <input type="text"
                                    class="form-control @error('notes')
                                is-invalid
                            @enderror"
                                    name="notes">
                                @error('notes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ url()->previous() }}'">Annuler</button>
                            <button class="btn btn-primary" type="submit">Créer</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

