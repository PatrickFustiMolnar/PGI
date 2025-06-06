@extends('layouts.app')

@section('title', 'Edit Discount')

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
                <h1>Mettre à jour</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('discount.index') }}">Réductions</a></div>
                    <div class="breadcrumb-item">Modifier une réduction</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Réduction</h2>

                <form action="{{ route('discount.update', $discount->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $discount->name }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $discount->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="fixed" {{ $discount->type == 'fixed' ? 'selected' : '' }}>Fixe</option>
                            <option value="percentage" {{ $discount->type == 'percentage' ? 'selected' : '' }}>Pourcentage</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="value">Valeur</label>
                        <input type="text" class="form-control" id="value" name="value" value="{{ $discount->value }}">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" {{ $discount->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $discount->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expired_date">Date d'expiration</label>
                        <input type="date" class="form-control" id="expired_date" name="expired_date" value="{{ $discount->expired_date }}">
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ url()->previous() }}'">Annuler</button>
                        <button class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
