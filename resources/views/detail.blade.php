@extends('layouts.appd')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Moderateur</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.11.6/i18n/French.json">
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Détails du Client : {{ $client }}</h4>
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
                                        <th>ID</th>
                                        <th>Projet</th>
                                        <th>Constat</th>
                                        <th>Recommandation</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recommandations as $recommandation)
                                    <tr>
                                        <td class="text-center">
                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                        </div>
                                        </td>
                                        <td>{{ $recommandation->id }}</td>
                                        <td>{{ $recommandation->Projet }}</td>
                                        <td class="truncate-text show-text" data-full-text="{{  $recommandation->constat }}">{{ substr( $recommandation->constat, 0, 100) . (strlen( $recommandation->constat) > 100 ? '...' : '') }}</td>
                                        <td class="truncate-text show-text" data-full-text="{{  $recommandation->recommandations }}">{{ substr( $recommandation->recommandations, 0, 100) . (strlen( $recommandation->recommandations) > 100 ? '...' : '') }}</td>
                                        <td>{{ $recommandation->statut }}</td>
                                        <td> <button class="btn btn-icon btn-info fas fa-info-circle btn-details" ></button></td>
                                    </tr>
                                    <tr class="details-row" style="display: none;">
                                        <td colspan="6">
                                          <div class="additional-info">
                                            <p><strong> Numero de recommandation :</strong> {{ $recommandation->id }}</p>
                                            <p><strong> Client :</strong> {{ $recommandation->client }}</p>
                                            <p><strong> Projet :</strong> {{ $recommandation->Projet }}</p>
                                            <p><strong> Constat :</strong> {{ $recommandation->constat }}</p>
                                            <p><strong> Recommandations :</strong> {{ $recommandation->recommandations }}</p>
                                            <p><strong> Risque :</strong> {{ $recommandation->risque }}</p>
                                            <p><strong> priorité :</strong> {{ $recommandation->priorite }}</p>
                                        </div>
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
