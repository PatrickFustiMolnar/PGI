@extends('layouts.app')

@section('title', 'Activité')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Activité</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Activité</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Votre activité récente</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media">
                                <i class="fas fa-sign-in-alt text-success mr-3 mt-2"></i>
                                <div class="media-body">
                                    <div class="float-right text-small text-muted">{{ now()->subHours(2)->format('d/m/Y H:i') }}</div>
                                    <div class="media-title">Connexion</div>
                                    <span class="text-small text-muted">Vous vous êtes connecté(e) depuis {{ request()->ip() }}</span>
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-user-edit text-primary mr-3 mt-2"></i>
                                <div class="media-body">
                                    <div class="float-right text-small text-muted">{{ now()->subDays(1)->format('d/m/Y H:i') }}</div>
                                    <div class="media-title">Modification du profil</div>
                                    <span class="text-small text-muted">Vous avez mis à jour vos informations</span>
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-sign-out-alt text-danger mr-3 mt-2"></i>
                                <div class="media-body">
                                    <div class="float-right text-small text-muted">{{ now()->subDays(2)->format('d/m/Y H:i') }}</div>
                                    <div class="media-title">Déconnexion</div>
                                    <span class="text-small text-muted">Vous vous êtes déconnecté(e)</span>
                                </div>
                            </li>
                        </ul>
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