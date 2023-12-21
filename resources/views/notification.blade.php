@extends('layouts.appc')

@section('content')
    <title>Notification</title>
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recommandations à suivre</h4>
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
                                            <th>Moderateur</th>
                                            <th>Constat</th>
                                            <th>Recommandations</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($notifications as $notification)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    </div>
                                                </td>
                                                <td>{{ $notification->etat->rapporta->user->name }}</td>
                                                <td class="truncate-text show-text" data-full-text="{{  $notification->etat->rapporta->constat }}">{{ substr( $notification->etat->rapporta->constat, 0, 100) . (strlen( $notification->etat->rapporta->constat) > 100 ? '...' : '') }}</td>
                                                <td class="truncate-text show-text" data-full-text="{{  $notification->etat->rapporta->recommandations }}">{{ substr( $notification->etat->rapporta->recommandations, 0, 100) . (strlen( $notification->etat->rapporta->recommandations) > 100 ? '...' : '') }}</td>
                                                <td>
                                                    @if ($notification->etat->statut == 'En attente')
                                                    <div class="btn-group">
                                                        <button class="btn btn-icon btn-info fas fa-info-circle btn-details" ></button>
                                                        <button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#acceptModal_{{ $notification->id }}"><i class="fas fa-check"></i></button>
                                                    </div>
                                                     @else 
                                                        <p>{{ $notification->etat->statut }}</p>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr class="details-row" style="display: none;">
                                                <td colspan="6">
                                                  <div class="additional-info">
                                                    <p><strong> Numero de recommandation :</strong> {{ $notification->etat->rapporta->id }}</p>
                                                    <p><strong> Client :</strong> {{ $notification->etat->rapporta->client }}</p>
                                                    <p><strong> Projet :</strong> {{ $notification->etat->rapporta->Projet }}</p>
                                                    <p><strong> Constat :</strong> {{ $notification->etat->rapporta->constat }}</p>
                                                    <p><strong> Recommandations :</strong> {{ $notification->etat->rapporta->recommandations }}</p>
                                                    <p><strong> Risque :</strong> {{ $notification->etat->rapporta->risque }}</p>
                                                    <p><strong> priorité :</strong> {{ $notification->etat->rapporta->priorite }}</p>
                                                </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($notifications->isEmpty())
                                        <p class="text-center">Aucune recommandation disponible</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @foreach($notifications as $notification)
        <div class="modal fade" id="acceptModal_{{ $notification->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="acceptModalLabel">Rejeter la reccommadation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous vraiment rejeter cette reccommadation ?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('rejeter', $notification->id) }}" method="POST">
                            @csrf
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Rejeter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    
@endsection
