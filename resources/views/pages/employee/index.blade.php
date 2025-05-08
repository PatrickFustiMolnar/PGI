@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Employé</h1>
                <div class="section-header-button">
                    <a href="{{ route('employee.create') }}" class="btn btn-primary">Ajouter</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Employé</a></div>
                    <div class="breadcrumb-item">Tous les employés</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Employé</h2>
                <p class="section-lead">
                    Vous pouvez gérer tous les employés, modifier, supprimer et plus.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action</option>
                                        <option>Archiver</option>
                                        <option>Suspendre</option>
                                        <option>Supprimer temporairement</option>
                                    </select>
                                </div>
                                <div class="float-right">
                                    <form method="GET" action="{{ route('employee.index') }}">
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
                                            <th>Téléphone</th>
                                            <th>Position</th>
                                            <th>Date de naissance</th>
                                            <th>Entrée</th>
                                            <th>Salaire</th>
                                            <th>Adresse</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->name }}
                                                </td>
                                                <td>
                                                    {{ $employee->phone }}
                                                <td>
                                                    {{ $employee->position }}
                                                </td>
                                                <td>
                                                    {{ $employee->date_of_birth }}
                                                </td>
                                                <td>
                                                    {{ $employee->date_of_joining }}
                                                </td>
                                                <td>
                                                    {{ $employee->salary }}
                                                </td>
                                                <td>
                                                    {{ $employee->address }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('employee.edit', $employee->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Modifier
                                                        </a>

                                                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
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
                                    {{ $employees->withQueryString()->links() }}
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
