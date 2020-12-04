<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SGI</title>
    </head>
    <body>
          <div >
                
                <div >

                   <div>
                       
                    </div>
                                        <br><br><br>
                  <!--   Icon Section   -->
                  <div >

                       <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th style="border:1px solid black;padding:5px">N°</th>
                                <th style="border:1px solid black;padding:5px">Nom et prénom</th>
                                <th style="border:1px solid black;padding:5px">Téléphone</th>
                                <th style="border:1px solid black;padding:5px">Code souscription</th>
                                <th style="border:1px solid black;padding:5px">Date souscription</th>
                              </tr>
                            </thead>
                            <tbody>
                         @foreach($souscripteurs as $souscripteur)
                            <tr>
                              <td style="border:1px solid black;padding:5px">{!! $souscripteur->id !!}</td>
                              <td style="border:1px solid black;padding:5px">{!! $souscripteur->nom !!}  {!! $souscripteur->prenom!!}</td>
                              <td style="border:1px solid black;padding:5px">{!! $souscripteur->telephone !!}</td>
                              <td style="border:1px solid black;padding:5px">
                                {!! $souscripteur->codeValidation !!}
                                {!! $souscripteur->numeroQuittance !!}
                                {!! $souscripteur->subvention !!}
                              </td>
                              <td style="border:1px solid black;padding:5px">{!! $souscripteur->created_at !!}</td>
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