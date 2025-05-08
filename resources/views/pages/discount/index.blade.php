@extends('layouts.app')

@section('title', 'discounts')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Réduction</h1>
                <div class="section-header-button">
                    <a href="{{ route('discount.create') }}" class="btn btn-primary">Ajouter</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('discount.index') }}">Réductions</a></div>
                    <div class="breadcrumb-item">Tous les réductions</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Réductions</h2>
                <p class="section-lead">
                    Vous pouvez gérer tous les réductions, modifier, supprimer et plus.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tous</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('discount.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Rechercher" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Nom</th>
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Valeur</th>
                                            <th>Status</th>
                                            <th>Date d'expiration</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($discounts as $discount)
                                            <tr>
                                                <td>{{ $discount->name }}</td>
                                                <td>{{ $discount->description }}</td>
                                                <td>{{ $discount->type }}</td>
                                                <td>{{ $discount->value }}</td>
                                                <td>{{ $discount->status }}</td>
                                                <td>{{ $discount->expired_date }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('discount.edit', $discount->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Modifier
                                                        </a>

                                                        <form action="{{ route('discount.destroy', $discount->id) }}" method="POST"
                                                            class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $discounts->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
