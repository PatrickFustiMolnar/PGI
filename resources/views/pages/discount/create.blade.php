@extends('layouts.app')

@section('title', 'Create Discount')

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
                <h1>Créer une réduction</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('discount.index') }}">Réductions</a></div>
                    <div class="breadcrumb-item">Créer une réduction</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Réductions</h2>

                <form action="{{ route('discount.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="fixed">Fixe</option>
                            <option value="percentage" selected>Pourcentage</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="value">Valeur</label>
                        <input type="text" class="form-control" id="value" name="value">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expired_date">Date d'expiration</label>
                        <input type="date" class="form-control" id="expired_date" name="expired_date">
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ url()->previous() }}'">Annuler</button>
                        <button class="btn btn-primary">Créer</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
