@extends('layouts.appc')

@section('content')
<title>Tableau de bord</title>
<div class="main-content">
  <section class="section">
    <div class="row ">
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                  <div class="card-content">
                    <h5 class="font-15">Total des Recommandations</h5>
                    <h2 class="mb-3 font-18">{{$totalrecos}}</h2>
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
              <div class="row ">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                  <div class="card-content">
                    @if($totalEnattente == 0)
                    <h5 class="font-15">Recommandations En Attente</h5>
                    <h2 class="mb-3 font-18">{{$totalEnattente}}</h2>
                    @else
                    <h5 class="font-15">Recommandations En Attente</h5>
                    <h2 class="mb-3 font-18" style="color: red">{{$totalEnattente}}</h2>
                    @endif
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
              <div class="row ">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                  <div class="card-content">
                    @if($totalEnCours == 0)
                    <h5 class="font-15">Recommandations En Cours</h5>
                    <h2 class="mb-3 font-18">{{$totalEnCours}}</h2>
                    @else
                    <h5 class="font-15" >Recommandations En Cours</h5>
                    <h2 class="mb-3 font-18" style="color: #78F509">{{$totalEnCours}}</h2>
                    @endif
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
              <div class="row ">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                  <div class="card-content">
                    @if($totalCloturer == 0)
                    <h5 class="font-15">Recommandations Clôtures</h5>
                    <h2 class="mb-3 font-18">{{$totalCloturer}}</h2>
                    @else
                    <h5 class="font-15" >Recommandations Clôtures</h5>
                    <h2 class="mb-3 font-18" style="color: blue">{{$totalCloturer}}</h2>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Plan D'action Affecter</h4>
            <div class="card-header-form">
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>N*</th>
                  <th>Projet</th>
                  <th>Constat</th>
                  <th>Recommandations</th>
                  <th>Statut</th>
                  <th>Priorité</th>
                  <th>Action</th>
                </thead>
                <tbody>
                    @foreach($rapportas as $rapporta)
                        <tr>
                            <td>{{ $rapporta->etat->rapporta->id }}</td>
                            <td>{{ $rapporta->etat->rapporta->Projet }}</td>
                            <td class="truncate-text show-text" data-full-text="{{ $rapporta->etat->rapporta->constat }}">{{ substr($rapporta->etat->rapporta->constat, 0, 20) . (strlen($rapporta->etat->rapporta->constat) > 20 ? '...' : '') }}</td>
                            <td class="truncate-text show-text" data-full-text="{{ $rapporta->etat->rapporta->recommandations }}">{{ substr($rapporta->etat->rapporta->recommandations, 0, 20) . (strlen($rapporta->etat->rapporta->recommandations) > 20 ? '...' : '') }}</td>
                            <td>
                              @if ($rapporta->etat->statut === 'En cours')
                                  <button class="status-button green">En cours</button>
                              @elseif ($rapporta->etat->statut === 'traiter')
                                  <button class="status-button dark-blue">Traitée</button>
                              @elseif ($rapporta->etat->statut === 'rejeter')
                                  <button class="status-button blue">Rejeter</button>
                              @endif
                            </td>
                          
                            <td>{{ $rapporta->etat->rapporta->priorite }}</td>
                            <td>
                              <div class="btn-group">
                              <button class="btn btn-icon btn-info fas fa-info-circle btn-details"></button>
                              @if ($rapporta->etat->statut == 'En attente')
                              <button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#acceptModal_{{ $rapporta->id }}"><i class="fas fa-check"></i></button>
                              @endif
                              @if ($rapporta->etat->statut == 'En cours')
                              <button type="button" class="btn btn-icon btn-dark far fa-edit" data-toggle="modal" data-target="#editModal{{ $rapporta->id }}"><i ></i></button>
                              <button type="button" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#accepteModal_{{ $rapporta->id }}"><i>Valider</i></button>
                              <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#acceptModale_{{ $rapporta->id }}"><i>Rejeter</i></button>
                              @endif
                             </div>
                            </td>
                            <div class="modal fade" id="editModal{{ $rapporta->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="false">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Modification</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST" action="{{ route('correcteur.update', ['correcteur' => $rapporta->etat->correcteur->id]) }}" enctype="multipart/form-data">
                                      @csrf
                                      @method('PUT')
                                      <div class="form-group">
                                        <label for="commentaire_management">Commentaire management</label>
                                        <input type="text" class="form-control" id="commentaire_management" name="commentaire_management" value="{{ old('commentaire_management', $rapporta->etat->correcteur->commentaire_management) }}" required>
                                      </div>
                                    
                                      <div class="form-group">
                                        <label for="avancement">Etat d'avancement</label>
                                        <select class="form-control" id="avancement" name="avancement" required>
                                          <option value="0%" class="avancement-0" {{ $rapporta->etat->correcteur->avancement === '0%' ? 'selected' : '' }}>0%</option>
                                          <option value="10%" class="avancement-10"{{ $rapporta->etat->correcteur->avancement === '10%' ? 'selected' : '' }}>10%</option>
                                          <option value="20%"{{ $rapporta->etat->correcteur->avancement === '20%' ? 'selected' : '' }}>20%</option>
                                          <option value="30%"{{ $rapporta->etat->correcteur->avancement === '30%' ? 'selected' : '' }}>30%</option>
                                          <option value="40%"{{ $rapporta->etat->correcteur->avancement === '40%' ? 'selected' : '' }}>40%</option>
                                          <option value="50%"{{ $rapporta->etat->correcteur->avancement === '50%' ? 'selected' : '' }}>50%</option>
                                          <option value="60%"{{ $rapporta->etat->correcteur->avancement === '60%' ? 'selected' : '' }}>60%</option>
                                          <option value="70%"{{ $rapporta->etat->correcteur->avancement === '70%' ? 'selected' : '' }}>70%</option>
                                          <option value="80%"{{ $rapporta->etat->correcteur->avancement === '80%' ? 'selected' : '' }}>80%</option>
                                          <option value="90%"{{ $rapporta->etat->correcteur->avancement === '90%' ? 'selected' : '' }}>90%</option>
                                          <option value="100%"{{ $rapporta->etat->correcteur->avancement === '100%' ? 'selected' : '' }}>100%</option>
                                        </select>
                                      </div>
                                      <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    </form>
                                    <form method="POST" action="{{ route('ajouter.fichier', ['id' => $rapporta->etat->correcteur->id]) }}" enctype="multipart/form-data">
                                      @csrf
                                      <div class="form-group">
                                        <label for="piece_jointe">Pièce jointe</label>
                                        <input type="file" class="form-control" id="piece_jointe" name="piece_jointe">
                                      </div>
                                      <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                  </div>
                                </div>
                              </div>
                            </div> 
                        </tr>
                        <tr class="details-row" style="display: none;">
                          <td colspan="6">
                            <div class="additional-info">
                              <p><strong>Le Numero de recommandation :</strong> {{ $rapporta->etat->rapporta->id }}</p>
                              <p><strong>Le client :</strong> {{ $rapporta->etat->rapporta->client }}</p>
                              <p><strong>Le Projet :</strong> {{ $rapporta->etat->rapporta->Projet }}</p>
                              <p><strong>Le Constat :</strong> {{ $rapporta->etat->rapporta->constat }}</p>
                              <p><strong>Les Recommandations :</strong> {{ $rapporta->etat->rapporta->recommandations }}</p>
                              <p><strong>Le Risque :</strong> {{ $rapporta->risque }}</p>
                              <p><strong>La priorité :</strong> {{ $rapporta->priorite }}</p>
                              <p><strong>Commentaire management :</strong> {{ $rapporta->etat->correcteur->commentaire_management }}</p>
                              <p><strong>Etat d'avancement :</strong> {{ $rapporta->etat->correcteur->avancement }}</p>
                              <p><strong>Livrable :</strong> {{ $rapporta->etat->correcteur->livrable }}
                                  @if ($rapporta->etat->correcteur->chemin_fichier)
                                  <a href="{{ route('telecharger.fichier', ['id' => $rapporta->etat->correcteur->id]) }}" class="btn btn-link">Télécharger la pièce jointe</a>
                                  @endif</p>
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
  </section>
</div>
</div>
@foreach($rapportas as $rapporta)
<div class="modal fade" id="rejectModal_{{ $rapporta->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="rejectModalLabel">Clôturer la Recommandation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>Voulez-vous vraiment cloturer cette recommandation ?</p>
              <form action="{{ route('cloturer', $rapporta->id) }}" method="POST">
                  @csrf
                  <div class="form-group">
                      <label for="commentaire">Commentaire</label>
                      <input type="text" class="form-control" id="commentaire" name="commentaire" placeholder="Commentaire">
                  </div>
                  <button type="submit" class="btn btn-danger">Clôturer</button>
              </form>
          </div>
      </div>
  </div>
</div>
<div class="modal fade" id="acceptModal_{{ $rapporta->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="acceptModalLabel">Accepter la reccommadation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>Voulez-vous vraiment accepter cette reccommadation ?</p>
          </div>
          <div class="modal-footer">
              <form action="{{ route('accept', $rapporta->id) }}" method="POST">
                  @csrf
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-success">Accepter</button>
              </form>
          </div>
      </div>
  </div>
</div>
<div class="modal fade" id="accepteModal_{{ $rapporta->id }}" tabindex="-1" role="dialog" aria-labelledby="accepteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="accepteModalLabel">Valider le traitement de la reccommadation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>Voulez-vous vraiment le valider ?</p>
          </div>
          <div class="modal-footer">
              <form action="{{ route('traiter', $rapporta->id) }}" method="POST">
                  @csrf
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-primary">Valider</button>
              </form>
          </div>
      </div>
  </div>
</div>
<div class="modal fade" id="acceptModale_{{ $rapporta->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModaleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="acceptModaleLabel">Rejeter la reccommadation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>Voulez-vous vraiment rejeter cette reccommadation ?</p>
          </div>
          <div class="modal-footer">
              <form action="{{ route('rejeter', $rapporta->id) }}" method="POST">
                  @csrf
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-danger">Rejeter</button>
              </form>
          </div>
      </div>
  </div>
</div>
@endforeach
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script>
  function downloadAttachment(correcteurId) {
      window.location.href = "{{ route('telecharger.fichier', ['id' => '__correcteur_ID__']) }}".replace('__correcteur_ID__', correcteurId);
  }
</script>

  <style>
  .modal.fade {
  padding: 58px; 
  }
  </style>
@endsection