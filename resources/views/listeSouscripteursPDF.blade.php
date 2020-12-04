<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
          <div class="container">
                
                <div class="section">

                   <div>
                        <div>
                          <img  src="{{ asset('image/Entete_finale_liste.jpg') }}" /></a>
                        </div>
                    </div>
                                        <br><br><br>
                  <!--   Icon Section   -->
                  <div class="row">
                          <h4>{{ $titre }}</h4><br><br>
                       <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th style="border:1px solid black;padding:10px">N°</th>
                                <th style="border:1px solid black;padding:10px">Nom et prénom</th>
                                <th style="border:1px solid black;padding:10px">Numéro CNIB</th>
                                <th style="border:1px solid black;padding:10px">Téléphone</th>
                                <th style="border:1px solid black;padding:10px">Date souscription</th>
                              </tr>
                            </thead>
                            <tbody>
                         @foreach($souscripteurs as $souscripteur)
                            <tr>
                              <td style="border:1px solid black;padding:10px">{!! $souscripteur->id !!}</td>
                              <td style="border:1px solid black;padding:10px">{!! $souscripteur->nom !!}  {!! $souscripteur->prenom!!}</td>
                              <td style="border:1px solid black;padding:10px">{!! $souscripteur->numCnib !!} du {!! $souscripteur->dateEtabCnib!!}</td>
                              <td style="border:1px solid black;padding:10px">{!! $souscripteur->telephone !!}</td>
                              <td style="border:1px solid black;padding:10px">{!! $souscripteur->created_at !!}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    
                  </div>
                  </div>

                </div>
            <br><br>
    </body>
</html>