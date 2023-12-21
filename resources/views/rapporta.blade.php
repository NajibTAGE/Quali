@extends('layouts.app')
@section('content')
<title>Moderateur</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.11.6/i18n/French.json">
<div class="main-content">
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#createModal">Nouvelle Recommandation</button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#textModal">Exporter PDF/Excel</button>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#texteModal">Importer Excel</button>
    <div class="modal fade" id="texteModal" tabindex="-1" role="dialog" aria-labelledby="texteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
              </div>
              <div class="modal-body">
                  <h5>Excel</h5>
                  <form id="importExcelForm" action="{{ route('importExcel') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <input type="file" name="excelFile" id="excelFile" accept=".xlsx, .xls">
                        <button type="submit" class="btn btn-success">Importer</button>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              </div>
          </div>
      </div>
    </div>
    <br>
    <br>
    <div class="card">
        <div class="card-header">
            <h4>Rapport D'audite</h4>
            <div class="card-header-form">

               </div>
            </div>
        <div class="card-body p-0">
            <div class="table-responsive">
            <table id="myTable"  class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                          <th style="width: 21px;"></th>
                          <th><input type="checkbox" class="checkbox" id="selectTout" onchange="toggleSelectAll()"></th>
                          <th>N*</th>
                          <th>Client</th>
                          <th>Projet</th>
                          <th>Constat</th>
                          <th>Recommandations</th>
                          <th>Departement</th>
                          <th>Prioritée</th>
                          <th>Statut</th>
                          <th>Etat d'avancement</th>
                          <th>Actions</th>
                          <th>Detaills</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($rapportas as $rapporta)
                        <tr data-rapporta-id="{{ $rapporta->id }}" class="table-row">
                            <td style="background: url('assets/img/details_open.png') no-repeat center;background-size: 24px;"> </td>
                            <td><input type="checkbox" class="checkbox" value="{{ $rapporta->id }}"></td>
                            <td>{{ $rapporta->id }}</td>
                            <td>{{ $rapporta->client }}</td>
                            <td>{{ $rapporta->Projet }}</td>
                            <td class="truncate-text show-text" data-full-text="{{ $rapporta->constat }}">{{ substr($rapporta->constat, 0, 20) . (strlen($rapporta->constat) > 20 ? '...' : '') }}</td>
                            <td class="truncate-text show-text" data-full-text="{{ $rapporta->recommandations }}">{{ substr($rapporta->recommandations, 0, 20) . (strlen($rapporta->recommandations) > 20 ? '...' : '') }}</td>
                            <td>{{ $rapporta->departement }}</td>
                            <td>   @if ($rapporta->priorite === 'Faible')
                                      <button class="circle green"></button>
                                  @elseif ($rapporta->priorite === 'Moyenne')
                                      <button class="circle blue"></button>
                                  @elseif ($rapporta->priorite === 'Elevee')
                                      <button class="circle red"></button>
                                  @endif
                            </td>
                            <td>
                              @if ($rapporta->etat->statut === 'En cours')
                                  <button class="status-button blue">En cours</button>
                              @elseif ($rapporta->etat->statut === 'traiter')
                                  <button class="status-button dark-blue">Traitée</button>
                              @elseif ($rapporta->etat->statut === 'rejeter')
                                  <button class="status-button red">Rejetée</button>
                              @elseif ($rapporta->etat->statut === 'En attente')
                                  <button class="status-button green">En attente</button>
                              @elseif ($rapporta->etat->statut === 'cloturer')
                                  <button class="status-button gray">Cloturée</button>
                              @endif
                            </td>
                            <td> @if($rapporta->etat->correcteur->avancement !== null)
                            <div class="progress-bar-container">
                              <div class="progress-bar" style="width: {{ $rapporta->etat->correcteur->avancement }};"></div>
                              @endif
                            </div> 
                            </td> 
                            <td>
                              <div class="btn-group">
                                  <button type="button" class="btn btn-dark far fa-edit" data-toggle="modal" data-target="#editModal{{ $rapporta->id }}"></button>
                                  <button type="button" class="btn btn-danger fas fa-times" data-toggle="modal" data-target="#deleteModal{{ $rapporta->id }}"></button>
                                  @if($rapporta->etat->statut !== 'cloturer')
                                  <button type="button" class="btn btn gray far fa-lock" data-toggle="modal" data-target="#cloturer{{ $rapporta->id }}"></button>
                                 @endif
                                </div>
                            </td>
                            <td>
                                <div class="additional-info">
                                    <p><strong>Numero de recommandation :</strong> {{ $rapporta->id }}</p>
                                    <p><strong>Client :</strong> {{ $rapporta->client }}</p>
                                    <p><strong>Projet :</strong> {{ $rapporta->Projet }}</p>
                                    <p><strong>Constat :</strong> {{ $rapporta->constat }}</p>
                                    <p><strong>Recommandations :</strong> {{ $rapporta->recommandations }}</p>
                                    <p><strong>Departement :</strong> {{ $rapporta->user->departement }}</p>
                                    <p><strong>Risque :</strong> {{ $rapporta->risque }}</p>
                                    <p><strong>priorité :</strong> {{ $rapporta->priorite }}</p>
                                    <p><strong>Commentaire management :</strong> {{ $rapporta->etat->correcteur->commentaire_management }}</p>
                                    <p><strong>Date de mise en oeuvre :</strong> {{ $rapporta->etat->correcteur->echeance }}</p>
                                    <p><strong>Etat d'avancement :</strong> {{ $rapporta->etat->correcteur->avancement }}</p>
                                    <p><strong>Livrable :</strong> {{ $rapporta->etat->correcteur->livrable }}
                                        @if ($rapporta->etat->correcteur->chemin_fichier)
                                        <a href="{{ route('telecharger.fichier', ['id' => $rapporta->etat->correcteur->id]) }}" class="btn btn-link">Télécharger la pièce jointe</a>
                                        @endif</p>
                                </div>
                            </td>

                        </tr>
                        <div class="modal fade" id="textModal" tabindex="-1" role="dialog" aria-labelledby="textModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  </div>
                                  <div class="modal-body">
                                      <h5>Choisissez les colonnes à exporter :</h5>
                                      <form id="ExcelForm" action="{{ route('export.excel') }}" method="post">
                                          @csrf
                                          <div>
                                              <input type="hidden" id="selectedRowsExcel" name="selectedRows" value="">
                                              <label><input type="checkbox" name="columns[]" value="id" checked> ID</label><br>
                                              <label><input type="checkbox" name="columns[]" value="client" checked> Client</label><br>
                                              <label><input type="checkbox" name="columns[]" value="projet" checked> Projet</label><br>
                                              <label><input type="checkbox" name="columns[]" value="constat" checked> Constat<br>
                                              <label><input type="checkbox" name="columns[]" value="recommandations" checked> Recommandations</label><br>
                                              <label><input type="checkbox" name="columns[]" value="departement" checked> Proprietaire</label><br>
                                              <label><input type="checkbox" name="columns[]" value="risque" checked> Risque</label><br>
                                              <label><input type="checkbox" name="columns[]" value="priorite" checked> Priorite</label><br>
                                              <label><input type="checkbox" name="columns[]" value="commentaire_management" checked> Commentaire Management</label><br>
                                              <label><input type="checkbox" name="columns[]" value="avancement" checked> Etat d'avancement</label><br>
                                          </div>
                                          <div class="mt-3">
                                              <button type="submit" class="btn btn-success far fa-file-excel">Exporter Excel</button>
                                          </div>
                                      </form>
                                      <form id="pdfForm" action="{{ url('/generate-pdf') }}" method="post">
                                          @csrf
                                          <input type="hidden" id="selectedRowsPDF" name="selectedRows" value="">
                                          <div class="mt-3">
                                              <button type="submit" class="btn btn-danger far fa-file-pdf">Exporter PDF</button>
                                          </div>
                                      </form>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="modal fade" id="editModal{{ $rapporta->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $rapporta->id }}" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $rapporta->id }}">Modification</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="{{ route('rapporta.update', $rapporta->id) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <div class="form-group">
                                    <label for="client">Client</label>
                                    <input type="text" class="form-control" id="client" name="client" value="{{ $rapporta->client }}" required>
                                </div>
                                <div class="form-group">
                                  <label for="projet">Projet</label>
                                  <input type="text" class="form-control" id="projet" name="projet" value="{{ $rapporta->Projet }}" required>
                              </div>
                                  <div class="form-group">
                                      <label for="constat">Constat</label>
                                      <input type="text" class="form-control" id="constat" name="constat" value="{{ $rapporta->constat }}" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="recommandations">Recommandations</label>
                                      <input type="text" class="form-control" id="recommandations" name="recommandations" value="{{ $rapporta->recommandations }}" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="departement">Departement</label>
                                      <input type="text" class="form-control" id="departement" name="departement" value="{{ $rapporta->departement }}" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="risque">Risque</label>
                                    <select class="form-control" id="risque" name="risque" required>
                                      <option value="--"{{ $rapporta->risque === '--' ? 'selected' : '' }}>--</option>
                                      <option value="Acceptable"{{ $rapporta->risque === 'Acceptable' ? 'selected' : '' }}>Acceptable</option>
                                      <option value="Moyen"{{ $rapporta->risque === 'Moyen' ? 'selected' : '' }}>Moyen</option>
                                      <option value="Eleve"{{ $rapporta->risque === 'Eleve' ? 'selected' : '' }}>Elevé</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="priorite">Priorité</label>
                                    <select class="form-control" id="priorite" name="priorite" required>
                                      <option value="--"{{ $rapporta->priorite === '--' ? 'selected' : '' }}>--</option>
                                      <option value="Faible"{{ $rapporta->priorite === 'Faible' ? 'selected' : '' }}>Faible</option>
                                      <option value="Moyenne"{{ $rapporta->priorite === 'Moyenne' ? 'selected' : '' }}>Moyenne</option>
                                      <option value="Elevee"{{ $rapporta->priorite === 'Elevee' ? 'selected' : '' }}>Elevée</option>
                                    </select>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                              </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal fade" id="deleteModal{{ $rapporta->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $rapporta->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $rapporta->id }}">Supprimer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <p>Êtes-vous sûr de vouloir supprimer cette Recommandation ?</p>
                                </div>
                                <div class="modal-footer">
                                <form action="{{ route('rapporta.destroy', $rapporta) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="modal fade" id="cloturer{{ $rapporta->id }}" tabindex="-1" role="dialog" aria-labelledby="cloturerModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="cloturerModalLabel">Cloturer la Recommadation</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <p>Voulez-vous vraiment Cloturer cette reccommadation ?</p>
                                  </div>
                                  <div class="modal-footer">
                                      <form action="{{ route('cloturer', $rapporta->id) }}" method="POST">
                                          @csrf
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                          <button type="submit" class="btn btn-danger">Cloturer</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Nouvelle Recommandation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="card-body">
                              <form method="POST" action="{{ route('rapporta.store') }}">
                                @csrf
                                <div class="form-group">
                                  <label for="client" class="col-md-4 col-form-label text-md-end">{{ __('Client') }}</label>
                                  <div class="col-md-6">
                                      <input id="name" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ old('client') }}" required autocomplete="client" autofocus>
                                  </div>
                              </div>
                                <div class="form-group">
                                  <label for="projet" class="col-md-4 col-form-label text-md-end">{{ __('Projet') }}</label>
                                  <div class="col-md-6">
                                      <input id="name" type="text" class="form-control @error('projet') is-invalid @enderror" name="projet" value="{{ old('projet') }}" required autocomplete="projet" autofocus>
                                  </div>
                              </div>
                                <div class="form-group">
                                    <label for="constat" class="col-md-4 col-form-label text-md-end">{{ __('Constat') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('constat') is-invalid @enderror" name="constat" value="{{ old('constat') }}" required autocomplete="constat" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="recommandations" class="col-md-4 col-form-label text-md-end">{{ __('Recommandations') }}</label>
                                    <div class="col-md-6">
                                        <input id="recommandations" type="recommandations" class="form-control @error('recommandations') is-invalid @enderror" name="recommandations" value="{{ old('recommandations') }}" required autocomplete="recommandations">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="departement" class="col-md-4 col-form-label text-md-end">{{ __('Departement') }}</label>
                                  <div class="col-md-6">
                                    <input id="departement" type="departement" class="form-control @error('departement') is-invalid @enderror" name="departement" value="{{ old('departement') }}" required autocomplete="departement">   
                                  </div>
                                  <div class="form-group">
                                    <label for="risque" class="col-md-4 col-form-label text-md-end">{{ __('Risque') }}</label>
                                    <div class="col-md-6">
                                    <select  class="form-control" id="risque" name="risque" required>
                                        <option value="--"{{ old('risque') === '--' ? 'selected' : '' }}>--</option>
                                        <option value="Acceptable"{{ old('risque') === 'Acceptable' ? 'selected' : '' }}>Acceptable</option>
                                        <option value="Moyen"{{ old('risque') === 'Moyen' ? 'selected' : '' }}>Moyen</option>
                                        <option value="Eleve"{{ old('risque') === 'Eleve' ? 'selected' : '' }}>Elevé</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label for="priorite" class="col-md-4 col-form-label text-md-end">{{ __('priorité') }}</label>
                                    <div class="col-md-6">
                                    <select class="form-control" id="priorite" name="priorite" required>
                                        <option value="--"{{ old('priorite') === '--' ? 'selected' : '' }}>--</option>
                                        <option value="Faible"{{ old('priorite') === 'Faible' ? 'selected' : '' }}>Faible</option>
                                        <option value="Moyenne"{{ old('priorite') === 'Moyenne' ? 'selected' : '' }}>Moyenne</option>
                                        <option value="Elevee"{{ old('priorite') === 'Elevee' ? 'selected' : '' }}>Elevée</option>
                                    </select>
                                </div>

                                </div>
                              </div>
                              <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Creer') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          </div>
                        </div>
                      </div>
                    </div>

    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.navbar').on('click', function(){
                $($(this).attr('data-target')).slideToggle();
            });
            var selectedRows = [];
            $("#selectTout").click(function () {
                $(".checkbox").prop('checked', $(this).prop('checked'));
                updateSelectedRows();
            });

            $(".table-row .checkbox").click(function () {
                updateSelectedRows();
            });

            $("#pdfForm").submit(function () {
                if (selectedRows.length === 0) {
                    alert("Sélectionnez au moins une ligne.");
                    return false;
                }
                $("#selectedRowsPDF").val(selectedRows.join(','));
            });
            $("#ExcelForm").submit(function () {
                if (selectedRows.length === 0) {
                    alert("Sélectionnez au moins une ligne.");
                    return false;
                }
                $("#selectedRowsExcel").val(selectedRows.join(','));
            });


            function updateSelectedRows() {
                selectedRows = [];
                $(".table-row .checkbox:checked").each(function () {
                    selectedRows.push($(this).val());
                });
                $("#selectedRows").val(selectedRows.join(','));
            }
        });
    </script>
    <script>
      $(document).ready(function() {
          var table = $('#myTable').DataTable({
              responsive: true,
              order: [],
              initComplete: function () {
                  this.api().order([2, 'desc']).draw();
              },
              columnDefs: [
                  {
                      targets: [0, 1, 8, 5, 6,10, 11],
                      searchable: false,
                      orderable: false,
                  }
              ],
              language: {
                  "sEmptyTable": "Aucune donnée disponible dans le tableau",
                  "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                  "sLengthMenu": "Afficher _MENU_ éléments",
                  "sSearch": "Rechercher",
                  "sZeroRecords": "Aucun résultat trouvé",
                  "oPaginate": {
                      "sFirst": "Premier",
                      "sLast": "Dernier",
                      "sNext": "Suivant",
                      "sPrevious": "Précédent"
                  },
              }
          });

          $('#myTable_wrapper').css('margin', '5px');
          $('#myTable tbody').on('click', 'tr .btn-details', function() {
              var tr = $(this).closest('tr');
              var row = table.row(tr);
              var idx = detailRows.indexOf(tr.attr('data-rapporta-id'));

              if (row.child.isShown()) {
                  tr.removeClass('details');
                  row.child.hide();
                  detailRows.splice(idx, 1);
              } else {
                  tr.addClass('details');
                  row.child(format(row.data())).show();
                  if (idx === -1) {
                      detailRows.push(tr.attr('data-rapporta-id'));
                  }
              }
          });

          function format(d) {
              return '<div>' +
                  '<p>Additional information for row with ID: ' + d.id + '</p>' +
                  '</div>';
          }

          table.on('draw', function() {
              detailRows.forEach(function(id) {
                  $('#' + id + ' .btn-details').trigger('click');
              });
          });

          table.columns().every(function() {
              var column = this;
              if (column.header().innerText === 'État d\'avancement') {
                  column.nodes().each(function(cell, index) {
                      var avancement = parseFloat($(cell).data('avancement'));
                      avancement = Math.min(100, Math.max(0, avancement)); 
                      var progressBar = '<div class="progress-bar-container">' +
                          '<div class="progress-bar" style="width: ' + avancement + '%;">' +
                          '<div class="progress-percent">' + avancement + '%</div>' +
                          '</div></div>';
                      $(cell).html(progressBar);
                  });
              }
          });
      });
    </script>

@endsection

