@extends('layouts.app')
@section('content')
<title>Administration</title>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-4">
                                    <div class="card-content">
                                        <h5 class="font-15">Total des Utilisateurs</h5>
                                        <h2 class="mb-3 font-18">{{ $userCount }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#createModal">Créer un utilisateur</button>
    <br>
    <br>
    <div class="card">
        <div class="card-header">
            <h4>Administration</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="example" class="cell-border" style="width:100%">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Departement</th>
                            <th>Cree le</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->societe }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->departement }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#editModal{{ $user->id }}"><i class="far fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $user->id }}"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Modification</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <form method="POST" action="{{ route('admin.update', $user->id) }}">
                                                  @csrf
                                                  @method('PUT')
                                                  <div class="form-group">
                                                      <label for="name">Nom</label>
                                                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                                      @error('name')
                                                      <div class="invalid-feedback">{{ $message }}</div>
                                                      @enderror
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="email">Email</label>
                                                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                                      @error('email')
                                                      <div class="invalid-feedback">{{ $message }}</div>
                                                      @enderror
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="role">Rôle</label>
                                                      <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                                          <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>Client</option>
                                                          <option value="moderateur" {{ old('role') == 'moderateur' ? 'selected' : '' }}>Moderateur</option>
                                                      </select>
                                                      @error('role')
                                                      <div class="invalid-feedback">{{ $message }}</div>
                                                      @enderror
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="name">Departement</label>
                                                    <input type="text" class="form-control @error('departement') is-invalid @enderror" id="departement" name="departement" value="{{ old('departement', $user->departement) }}" required>
                                                    @error('departement')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="name">Société</label>
                                                    <input type="text" class="form-control @error('societe') is-invalid @enderror" id="societe" name="societe" value="{{ old('societe', $user->societe) }}" required>
                                                    @error('departement')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                              </form>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>                              
                              <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Supprimer</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
                                    </div>
                                    <div class="modal-footer">
                                      <form action="{{ route('admin.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
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
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Création d'utilisateur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <form method="POST" action="{{ route('admin.store') }}">
              @csrf
              <div class="mb-3 row">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>
                <div class="col-md-6">
                  <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                <div class="col-md-6">
                  <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                <div class="col-md-6">
                  <select id="role" class="form-control" name="role" required>
                    <option value="client">Client</option>
                    <option value="moderateur">Moderateur</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="departement" class="col-md-4 col-form-label text-md-end">{{ __('Departement') }}</label>
                <div class="col-md-6">
                  <input id="departement" class="form-control" type="text" name="departement" value="{{ old('departement') }}" required autocomplete="departement" autofocus>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="societe" class="col-md-4 col-form-label text-md-end">{{ __('Société') }}</label>
                <div class="col-md-6">
                  <input id="societe" class="form-control" type="text" name="societe" value="{{ old('societe') }}" required autocomplete="societe" autofocus>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>
                <div class="col-md-6">
                  <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmer le Mot de passe') }}</label>
                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>
              <div class="mb-0 row">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Créer un Compte') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  

@endsection
