@extends('layouts.app')

@section('title', 'Profil')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profil</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profil</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Votre Profil</h4>
                            </div>
                            <div class="card-body text-center">
                                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle" width="150">
                                <h5 class="mt-3">{{ auth()->user()->name }}</h5>
                                <p class="text-muted">{{ auth()->user()->email }}</p>
                                <span class="badge badge-info">{{ ucfirst(auth()->user()->role) }}</span>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Modifier le profil</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Informations</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Nom
                                        <span>{{ auth()->user()->name }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Email
                                        <span>{{ auth()->user()->email }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Rôle
                                        <span>{{ ucfirst(auth()->user()->role) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Inscrit le
                                        <span>{{ auth()->user()->created_at ? auth()->user()->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush