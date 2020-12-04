<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body style="border: 2px solid blue">
         <br><br>
                   <div>
                        <span style="margin-left: 40px">
                          <img  src="{{ asset('image/banniere6.jpeg') }}" />
                        </span>
                    </div>
                  <div class="row" style="text-align: center;margin-top: -30px">
                      <h1 style="font-size: 2.5em;text-decoration: underline;">Attestation</h1>
                  </div>
                  <div class="row" style="text-align: center;line-height: 1.5">
                    <span style="font-size: 1.4em;">
                      Le Directeur Général de l’Agence Nationale des Energies Renouvelables et de l’Efficacité Energétique (ANEREE) atteste que,
                    </span>
                    <br>
                    <span style="font-size: 1.4em;">
                      Madame/ Monsieur ......<span style="font-weight: bold;">{{ $souscripteur->nom}} {{ $souscripteur->prenom}}</span>.... Code N° <span style="font-weight: bold;">{{ $souscripteur->codeSouscripteur}}</span>,
                    </span>
                    <span style="font-size: 1.4em;">a participé à la formation théorique et pratique N°1 en énergie solaire (Photovoltaïque) dans le cadre du</span>
                    <span style="font-size: 1.4em;font-weight: bold;">
                      « Projet de formation de 5 000 jeunes aux métiers des énergies renouvelables <br> (ER) et de l’efficacité énergétique (EE) », session de 2019.
                    </span>
                    <br>
                    <span style="font-size: 1.4em;">En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit.</span>
                  </div>
                  <br>
                 <div style="text-align: right;margin-top: 30px">
                   <span style="font-size: 1.4em;">Fait à Ouagadougou le… <span style="color: blue">03 Juil. 2020</span> …</span>
                 </div>
                 <div class="row">
                  <table style="width: 960px;margin-left: 15px;margin-bottom: -40px;margin-top: -20px">
                    <tr>
                      <td>
                        <br>
                        <p style="text-align: left;">
                        Adresse : <br>
                        Boite postale 18 BP 212 Ouagadougou 18<br>
                        Tél : +226 25 37 47 47<br>
                        Site web : <span style="text-decoration: underline">www.aneree.bf</span> <br>
                        <span style="text-decoration: underline">www.5000jeunes.aneree.bf</span> <br>
                        Email : <span style="text-decoration: underline">aneree.bf@gmail.com</span><br>
                      </p>
                      </td>
                      <td style="text-align: right;">
                        <div style="margin-left: 250px">
                          <p>
                            <img  src="{{ asset('image/signature_attestation2.png') }}" />
                            {{-- <span style="font-size: 1.6em;font-weight: bold;">Le Directeur Général</span>  <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <span style="font-size: 1.6em;font-weight: bold;font-style: italic;text-decoration: underline">Issouf ZOUNGRANA</span><br>
                            Chevalier de l’Ordre National<br> --}}
                          </p>
                        </div>
                      </td>
                    </tr>
                  </table>
                 </div>
            <br><br>
    </body>
</html>