@extends('template')


@section('header')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('contenu')
	
	  <div class="row">
			  <div class="col s12"><br>
			  	<div class="card z-depth-5 col s12">
		  				<h5 style="text-align:center">Graphique des souscripteurs</h5>
		  				<hr>
		  				<div class="row">
		  					<div class="col s4">
		  						<h6 style="text-align:center">Tous les souscripteurs</h6>
				    			 <div id="ca_graph" >
				         		 </div>
				         		 <h6 style="text-align:center">Total:{!! $nbTotal !!}</h6>
				         	</div>
				         	<div class="col s4">
				         		<h6 style="text-align:center">1ère Catégorie</h6>
				         		 <div id="ca_graph2" >
				         		 </div>
				         		 <h6 style="text-align:center">Total:{!! $nb1 !!}</h6>
		         		 	</div>
		         		 	<div class="col s4">
		         		 		<h6 style="text-align:center">2ème Catégorie</h6>
				         		 <div id="ca_graph3" >
				         		 </div>
				         		 <h6 style="text-align:center">Total:{!! $nb2 !!}</h6>
				         	</div>
		         		 @piechart('Graphique', 'ca_graph')
		         		  @piechart('Graphique2', 'ca_graph2')
		         		   @piechart('Graphique3', 'ca_graph3')
		  			</div>
		  		 </div>
			  
			  	 <ul id="dropdown5" class="dropdown-content " style="height:40px;line-height:40px">
                      <li>
                      	<a href="{!! url('souscripteurs/selectionne/listepdf') !!}" style="font-size:18px;">
                      		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20pt" height="20pt" viewBox="0 0 20 20" version="1.1">
								<g id="surface1">
								<path style=" stroke:none;fill-rule:nonzero;fill:#FF5722;fill-opacity:1;" d="M 16.667969 18.75 L 3.332031 18.75 L 3.332031 1.25 L 12.5 1.25 L 16.667969 5.417969 Z "/>
								<path style=" stroke:none;fill-rule:nonzero;fill:#FBE9E7;fill-opacity:1;" d="M 16.042969 5.832031 L 12.082031 5.832031 L 12.082031 1.875 Z "/>
								<path style=" stroke:none;fill-rule:nonzero;fill:#FFEBEE;fill-opacity:1;" d="M 6.585938 12.292969 L 6.585938 13.75 L 5.75 13.75 L 5.75 9.601563 L 7.164063 9.601563 C 7.574219 9.601563 7.902344 9.730469 8.144531 9.984375 C 8.386719 10.238281 8.511719 10.570313 8.511719 10.976563 C 8.511719 11.382813 8.390625 11.703125 8.148438 11.9375 C 7.90625 12.175781 7.574219 12.292969 7.144531 12.292969 Z M 6.585938 11.59375 L 7.164063 11.59375 C 7.324219 11.59375 7.445313 11.542969 7.535156 11.4375 C 7.621094 11.332031 7.664063 11.179688 7.664063 10.980469 C 7.664063 10.773438 7.621094 10.609375 7.53125 10.488281 C 7.441406 10.363281 7.320313 10.300781 7.171875 10.300781 L 6.585938 10.300781 Z "/>
								<path style=" stroke:none;fill-rule:nonzero;fill:#FFEBEE;fill-opacity:1;" d="M 9.066406 13.75 L 9.066406 9.601563 L 10.164063 9.601563 C 10.648438 9.601563 11.035156 9.757813 11.324219 10.0625 C 11.609375 10.371094 11.757813 10.792969 11.761719 11.328125 L 11.761719 12 C 11.761719 12.546875 11.617188 12.972656 11.332031 13.285156 C 11.042969 13.59375 10.648438 13.75 10.140625 13.75 Z M 9.90625 10.300781 L 9.90625 13.054688 L 10.15625 13.054688 C 10.433594 13.054688 10.632813 12.980469 10.746094 12.835938 C 10.859375 12.6875 10.917969 12.433594 10.925781 12.074219 L 10.925781 11.351563 C 10.925781 10.964844 10.871094 10.695313 10.761719 10.542969 C 10.65625 10.390625 10.46875 10.308594 10.210938 10.300781 Z "/>
								<path style=" stroke:none;fill-rule:nonzero;fill:#FFEBEE;fill-opacity:1;" d="M 14.503906 12.058594 L 13.203125 12.058594 L 13.203125 13.75 L 12.363281 13.75 L 12.363281 9.601563 L 14.660156 9.601563 L 14.660156 10.300781 L 13.203125 10.300781 L 13.203125 11.363281 L 14.503906 11.363281 Z "/>
								</g>
							</svg>
							PDF
                      	</a>
                      </li>
                      <li>
                      		<a href="{!!url('souscripteurs/selectionne/listeexcel') !!}" style="font-size:18px">
			                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20pt" height="20pt" viewBox="0 0 20 20" version="1.1">
									<g id="surface1">
									<path style=" stroke:none;fill-rule:nonzero;fill:#4CAF50;fill-opacity:1;" d="M 17.082031 4.167969 L 10.417969 4.167969 L 10.417969 15.832031 L 17.082031 15.832031 C 17.3125 15.832031 17.5 15.648438 17.5 15.417969 L 17.5 4.582031 C 17.5 4.351563 17.3125 4.167969 17.082031 4.167969 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 13.332031 6.25 L 16.25 6.25 L 16.25 7.5 L 13.332031 7.5 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 13.332031 10.417969 L 16.25 10.417969 L 16.25 11.667969 L 13.332031 11.667969 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 13.332031 12.5 L 16.25 12.5 L 16.25 13.75 L 13.332031 13.75 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 13.332031 8.332031 L 16.25 8.332031 L 16.25 9.582031 L 13.332031 9.582031 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 10.417969 6.25 L 12.5 6.25 L 12.5 7.5 L 10.417969 7.5 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 10.417969 10.417969 L 12.5 10.417969 L 12.5 11.667969 L 10.417969 11.667969 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 10.417969 12.5 L 12.5 12.5 L 12.5 13.75 L 10.417969 13.75 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 10.417969 8.332031 L 12.5 8.332031 L 12.5 9.582031 L 10.417969 9.582031 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#2E7D32;fill-opacity:1;" d="M 11.25 17.5 L 2.5 15.832031 L 2.5 4.167969 L 11.25 2.5 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 7.96875 12.917969 L 6.964844 11.015625 C 6.925781 10.945313 6.886719 10.816406 6.847656 10.625 L 6.832031 10.625 C 6.8125 10.714844 6.769531 10.851563 6.695313 11.035156 L 5.6875 12.917969 L 4.121094 12.917969 L 5.980469 10 L 4.28125 7.082031 L 5.878906 7.082031 L 6.714844 8.832031 C 6.777344 8.96875 6.835938 9.132813 6.886719 9.324219 L 6.90625 9.324219 C 6.9375 9.210938 7 9.039063 7.089844 8.816406 L 8.015625 7.082031 L 9.480469 7.082031 L 7.730469 9.972656 L 9.527344 12.914063 L 7.96875 12.914063 Z "/>
									</g>
								</svg>
								Excel
							</a>
                      </li>
                  </ul>

                <ul id="dropdown6" class="dropdown-content " style="height:40px;line-height:40px;">
                      <li style="font-size:18px;">
                      	<a href="{!! url('souscripteurs/listeVague1') !!}" >
                      		<i class="material-icons left" style="margin-right:0px">bookmark</i>
							1ère catégorie
                      	</a>
                      </li>
                      <li>
                      		<a href="{!!url('souscripteurs/listeVague2') !!}" style="font-size:18px">
			                   <i class="material-icons left" style="margin-right:0px">list</i>
								2ème catégorie
							</a>
                      </li>
                       <li>
                      		<a href="{!!url('souscripteurs/listeSelectionne') !!}" style="font-size:18px">
			                   <i class="material-icons left" style="margin-right:0px">list</i>
								formés
							</a>
                      </li>
                  </ul>

			  	
				<div class="row" >
					 <div class="col s12" style="margin-top:50px">
		    				<a class="dropdown-trigger  waves-light green btn-large" href="#!" data-target="dropdown5" >Exporter en <i class="material-icons right">arrow_drop_down</i></a>
			  				<a style="width:350px"class="dropdown-trigger  waves-light green btn-large" href="#!" data-target="dropdown6" >Liste des  souscripteurs<i class="material-icons right">arrow_drop_down</i></a>
		  			</div>
		  		</div>
		  		<div class="row" >
		  			<div class="col s4" style="margin-top:50px">
		  				<input name="nom" id="nom" placeholder="Nom" class="browser-default" />
		  			</div>
		  			<div class="col s4" style="margin-top:50px">
		  				<input name="prenom" id="prenom" placeholder="Prenom" class="browser-default" >
		  			</div>
		  		</div>

		  			 <div id="modal1" class="modal" style="width:400px;">
			<div class="modal-content">
				<h4>Remplir les champs</h4>
					<hr>
					<div class="row">
						<div class="col s12 m6">
							<input type="hidden" name="id" id="id"/>
							<label for="niveauEtude" id="labe">Niveau d'étude</label>
							{!! Form::select('niveauEtude', ['' => '','Non scolarisé' => 'Non scolarisé', 'CEP' => 'CEP','CQP' => 'CQP',
						  	'CAP' => 'CAP', 'BQP' => 'BQP','BEPC' => 'BEPC','BEP' => 'BEP','BAC' => 'BAC', 'Universitaire' => 'Universitaire'],null,['class'=>'browser-default','id'=>'niveau']) !!}	
				  		</div>
				  		<div class="col s12 m6">
				  			<label for="profession" id="labe">Profession</label>
				  			{!! Form::text('profession','',['class'=>'validate','id'=>'profession']) !!}	
				  		</div>
				  	</div>
				  	<div class="row">
				  		<h6 >Période formation </h6>
				  	</div>
				  	<div class="row">
				  		<div class="col s12 m6">
				  			<label for="profession" id="labe">Debut </label>
				  			{!! Form::date('dateDebut','',['class'=>'validate','id'=>'dateDebut']) !!}		
				  		</div>
				  		<div class="col s12 m6">
				  			<label for="profession" id="labe">Fin </label>
				  			{!! Form::date('dateFin','',['class'=>'validate','id'=>'dateFin']) !!}		
				  		</div>
				  	</div>
			</div>
			<div class="modal-footer">
				{!!Form::submit('Valider',['class'=>'modal-close white-text waves-light green center btn-flat','id'=>'valider']) !!}
				<a href="#!" class="modal-close waves-light red btn-flat" style="color:white">Annuler</a>
			</div>
		</div>
			  	<h4>Liste des souscripteurs formés</h4>
				  <table class="responsive-table" id="table">
		   				<thead>
		   					<tr>
		   						<th>N°</th>
		   						<th>Code souscripteur</th>
		   						<th>Nom et prénom</th>
		   						<th>Numéro CNIB</th>
		   						<th>Téléphone</th>
		   						<th>Niveau d'étude</th>
		   						<th>Date souscription</th>
		   						<th>Attestation de formation</th>
		   						<th>Action</th>
		   					</tr>
		   				</thead>
		   				<tbody>
		 			 @foreach($souscripteurs as $souscripteur)
		 			 		<tr>
								<td>{!! $souscripteur->id !!}</td>
								<td>{!! $souscripteur->codeSouscripteur !!}</td>
								<td>{!! $souscripteur->nom !!}  {!! $souscripteur->prenom!!}</td>
								<td>{!! $souscripteur->numCnib !!} du {!! $souscripteur->dateEtabCnib!!}</td>
								<td>{!! $souscripteur->telephone !!}</td>
								<td>
									    {!! $souscripteur->niveauEtude !!}
										<a  data-id="{{ $souscripteur->id }}"  class="open-PersonneDialog btn btn-primary modal-trigger" href="#modal1" title="Modifier son niveau d'étude"><i class="material-icons center">edit</i></a>
								</td>
								<td>{!! $souscripteur->created_at !!}</td>
								<td>
									<!-- @if($souscripteur->attestationFormation==null)
										pas d'attestation
									@else
									<div class="row">
									 <a class="waves-effect waves-light btn-small" title="Voir le fichier joint" href="{!! url('uploads/attestation',$souscripteur->attestationFormation) !!}"><i class="material-icons center">cloud_download</i></a>
					  				</div>
					  				@endif -->
					  				<div class="row">
									 <a class="waves-effect waves-light btn-small" title="Télécharger l'attestation " href="{!! url('generation/attestation',$souscripteur->id) !!}"><i class="material-icons center">cloud_download</i></a>
					  				</div>
					  			</td>
								<td>
									<div class="row">
										<?php
    										$id= Crypt::encrypt($souscripteur->id);
										?>
										<a href="{!! url('souscripteur/JoindreAttestation',$id) !!}" class="waves-light green btn-flat" title="Joindre son attestation" style="color:white"><i class="material-icons center">attachment</i></a>
					  				</div>
					  			</td>
							</tr>
							@endforeach
						</tbody>
		 			</table>
		 			<div class="pagination right" id="page">
		 			{{ $souscripteurs->links() }}
		 			</div>
			  </div>
			  

	  </div>
@endsection

@section('scripts')
	<script>
		$(function() {
		// Changement de region
		    $('#nom').on('change', function(e) {
		    	var nom_id = e.target.value;
		    	tableUpdateNm(nom_id);
		    });

		    $('#prenom').on('change', function(e) {
		    	var prenom_id = e.target.value;
		    	var nom_id = $('#nom').val();
		    	tableUpdatePNm(nom_id,prenom_id);
		    });


		     // Requête Ajax pour les regions
    function tableUpdatePNm(nom_Id,prenom_Id) {
        $.get('{{ url('forme/prenom') }}/'+nom_Id+'/'+prenom_Id, function(data) {
        		$('#table tbody').empty();
        		$('#page').hide();
            $.each(data, function(index, souscripteurs) {

				$("#table tbody").append("<tr>"+
											"<td>"+souscripteurs.id + "</td>"+
											"<td>"+souscripteurs.codeSouscripteur + "</td>"+
											"<td>"+souscripteurs.nom +" "+souscripteurs.prenom+ "</td>"+
											"<td>"+souscripteurs.numCnib+" du"+ souscripteurs.dateEtabCnib + "</td>"+
											"<td>"+souscripteurs.telephone + "</td>"+
											'<td>'
											+souscripteurs.niveauEtude+
											'<a class="waves-effect waves-light green btn-small modal-trigger" title="Modifier le niveau d\' étude" href="modifNiveauEtude/'+souscripteurs.id+'"><i class="material-icons center">check_circle</i></a></td>'+
											"<td>"+ souscripteurs.created_at+ "</td>"+
											"<td></td>"+
											"<td></td>"+
											'<td><a class="selectionne waves-effect waves-light red btn-small modal-trigger" title="Mettre non fomé" href="nonForme/'+souscripteurs.id+'"><i class="material-icons center">check_circle</i></a></td>'+
											
										"</tr>");
				
            });

        });
    }


    	     // Requête Ajax pour les regions
      function tableUpdateNm(nom_Id) {
        $.get('{{ url('forme/nom') }}/'+nom_Id, function(data) {
        		$('#table tbody').empty();
        		$('#page').hide();
            $.each(data, function(index, souscripteurs) {
				$("#table tbody").append("<tr>"+
											"<td>"+souscripteurs.id + "</td>"+
											"<td>"+souscripteurs.codeSouscripteur + "</td>"+
											"<td>"+souscripteurs.nom +" "+souscripteurs.prenom+ "</td>"+
											"<td>"+souscripteurs.numCnib+" du"+ souscripteurs.dateEtabCnib + "</td>"+
											"<td>"+souscripteurs.telephone + "</td>"+
											'<td>'+
												souscripteurs.niveauEtude
											+'<a class="waves-effect waves-light green btn-small modal-trigger" title="Modifier le niveau d\' étude" href="modifNiveauEtude/'+souscripteurs.id+'"><i class="material-icons center">check_circle</i></a></td>'+
											"<td>"+ souscripteurs.created_at+ "</td>"+
											"<td></td>"+
											"<td></td>"+
											'<td><a class="selectionne waves-effect waves-light red btn-small modal-trigger" title="Mettre non fomé" href="nonForme/'+souscripteurs.id+'"><i class="material-icons center">check_circle</i></a></td>'+
										"</tr>");
				
            });

        });
    }

     // Changement de region
    $('.open-PersonneDialog').on('click', function(e) {
        var id = $(this).data("id");
        $('#id').val(id);
        $('#valider').on('click',function(e){
        	var idRe=$('#id').val();
        	var niveau=$('#niveau').val();
        	var profession=$('#profession').val();
        	var dateDebut=$('#dateDebut').val();
        	var dateFin=$('#dateFin').val();

        	var token = $("meta[name='csrf-token']").attr("content");
						$.ajax(
							{
								url: '/changerNiveau/' + id+'/'+niveau+'/'+profession+'/'+dateDebut+'/'+dateFin,
								type: 'PUT',
								data: {
											"id": id,
											"niveau": niveau,
											"profession": profession,
											"dateDebut": dateDebut,
											"dateFin": dateFin,
											"_token": token,
									}
							}
							)
							.done(function() {
									document.location.reload(true);
							})
							.fail(function(jqXHR,textStatus,errorThrown){
								alert("erreur "+ jqXHR.responseText);
							})
    });


		});
    });
</script>
@endsection

