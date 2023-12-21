<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <!-- Lien vers le fichier CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    
</head>
<body>
    <div class="container mt-4">
        <!-- Votre contenu HTML ici, y compris la balise <img> pour l'image -->
        <div class="row">
            <div class="col">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/logo.png'))) }}" height="auto" width="150">
            </div>
        </div>
        <h1 class="text-center">{{ $title }}</h1>
        <hr>
        <hr>
        <ul class="list-group">
            @foreach ($rapportas as $rapporta)
            <li class="list-group-item">
                <strong>Numero de recommandation:</strong> {{ $rapporta->id }}
            </li>
            <li class="list-group-item">
                <strong>Date d'arrivee:</strong> {{ $rapporta->client }}
            </li>
            <li class="list-group-item">
                <strong>Context:</strong> {{ $rapporta->Projet }}
            </li>
            <li class="list-group-item">
                <strong>Constat:</strong> {{ $rapporta->constat }}
            </li>
            <li class="list-group-item">
                <strong>Recommandations:</strong> {{ $rapporta->recommandations }}
            </li>
            <li class="list-group-item">
                <strong>Proprietaire:</strong> {{ $rapporta->planificateur }}
            </li>
            <li class="list-group-item">
                <strong>Risque:</strong> {{ $rapporta->risque }}
            </li>
            <li class="list-group-item">
                <strong>Priorite:</strong> {{ $rapporta->priorite }}
            </li>
            <li class="list-group-item">
                <strong>Commentaire Management:</strong> {{ $rapporta->etat->correcteur->commentaire_management }}
            </li>
            <li class="list-group-item">
                <strong>Etat d'avancement:</strong> {{ $rapporta->etat->correcteur->avancement }}
            </li>
            <hr>
           
            @endforeach
        </ul>
    </div>

    <!-- Lien vers le fichier JavaScript de Bootstrap 5 (optionnel, mais nécessaire pour certaines fonctionnalités de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
