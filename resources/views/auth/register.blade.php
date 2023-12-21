@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
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
                      </form></form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
