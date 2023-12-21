@extends('layouts.app')
@section('content')
    <title>Moderateur</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.11.6/i18n/French.json">
    <div class="main-content">
        <section class="section">
            <div class="row" style="margin-right: -54px;">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                                        <div class="card-content">
                                            <h5 class="font-15">Total des Recommandations</h5>
                                            <h2 class="mb-3 font-18">{{ $rapportaCount }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                                        <div class="card-content">
                                            <h5 class="font-15">Recommandations En Attente</h5>
                                            <h2 class="mb-3 font-18">{{ $totalEnAttente }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                                        <div class="card-content">
                                            <h5 class="font-15">Recommandations En cours</h5>
                                            <h2 class="mb-3 font-18">{{ $totalAccepte }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                                        <div class="card-content">
                                            <h5 class="font-15">Recommandations traitées</h5>
                                            <h2 class="mb-3 font-18">{{ $totaltraiter }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                                        <div class="card-content">
                                            <h5 class="font-15">Recommandations rejetées</h5>
                                            <h2 class="mb-3 font-18">{{ $totalRejete }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                                        <div class="card-content">
                                            <h5 class="font-15">Recommandations Clôturées</h5>
                                            <h2 class="mb-3 font-18">{{ $totalcloturer }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tableau de bord</h4>
                        <div class="card-header-form">
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                        </div>
                                        </th>
                                        <th>Client</th>
                                        <th>Total Recommandations</th>
                                        <th>Recommandations en Attente</th>
                                        <th>Recommandations en Cours</th>
                                        <th>Recommandations traitées</th>
                                        <th>Recommandations rejetées</th>
                                        <th>Recommandations Clôturées</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                    <tr>
                                        <td class="text-center">
                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                        </div>
                                        </td>
                                        <td>{{ $row->client }}</td>
                                        <td>{{ $row->total_recommandations }}</td>
                                        <td>{{ $row->recommandations_attente }}</td>
                                        <td>{{ $row->recommandations_en_cours }}</td>
                                        <td>{{ $row->recommandations_traiter }}</td>
                                        <td>{{ $row->recommandations_rejeter }}</td>
                                        <td>{{ $row->recommandations_cloture }}</td>
                                        <td>
                                            <a href="{{ route('detail', ['client' => $row->client]) }}" class="btn btn-danger" style="background-color: #c40404">Détails</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
