@extends('template')

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
					 <div class="col s8" style="margin-top:50px">
			  			<a style="width:350px"class="dropdown-trigger  waves-light green btn-large" href="#!" data-target="dropdown6" >Liste des souscripteurs <i class="material-icons right">arrow_drop_down</i></a>
		  				<a class="waves-light green btn-large" href="{!! url('operateurs/listeSouscripteurs') !!}" >Liste des souscripteurs/opérateurs de saisie</a>
		  			</div>
		  			<div class="col s4" style="margin-top:50px">
		  				<label for="region" id="labe">Opérateur:</label>
		  				<select name="user" id="user" class="browser-default" >
		  				 		<option value="" disabled selected>cliquer pour choisir</option>
			                    @foreach($users as $user)
			                        <option value="{{ $user->id }}">{{ $user->username }}</option>
			                    @endforeach
             			</select>
		  			</div>
		  		</div>
			  	<h4>Liste des souscripteurs par opérateur de saisie</h4>
				  <table class="responsive-table" id="table">
		   				<thead>
		   					<tr>
		   						<th>N°</th>
		   						<th>Opérateur de saisie</th>
		   						<th>Code souscripteur</th>
		   						<th>Nom et prénom</th>
		   						<th>Numéro CNIB</th>
		   						<th>Téléphone</th>
		   						<th>Date souscription</th>
		   					</tr>
		   				</thead>
		   				<tbody>
		 			 @foreach($souscripteurs as $souscripteur)
		 			 		<tr>
								<td>{!! $souscripteur->id !!}</td>
								<td>{!! $souscripteur->user->username !!} </td>
								<td>{!! $souscripteur->codeSouscripteur !!}</td>
								<td>{!! $souscripteur->nom !!}  {!! $souscripteur->prenom!!}</td>
								<td>{!! $souscripteur->numCnib !!} du {!! $souscripteur->dateEtabCnib!!}</td>
								<td>{!! $souscripteur->telephone !!}</td>
								<td>{!! $souscripteur->created_at !!}</td>
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
    $('#user').on('change', function(e) {
    	var user_id = e.target.value;
        tableUpdate(user_id);
    });

     // Requête Ajax pour les provinces
    function tableUpdate(user_Id) {
        $.get('{{ url('operateurs') }}/'+ user_Id + "'", function(data) {
        		 $('#table tbody').empty();
        		 $('#page').hide();
            $.each(data, function(index, souscripteurs) {
				$("#table tbody").append("<tr>"+
											"<td>"+souscripteurs.id + "</td>"+
											"<td>"+souscripteurs.user.username + "</td>"+
											"<td>"+souscripteurs.codeSouscripteur + "</td>"+
											"<td>"+souscripteurs.nom +" "+souscripteurs.prenom+ "</td>"+
											"<td>"+souscripteurs.numCnib + "</td>"+
											"<td>"+souscripteurs.telephone + "</td>"+
											"<td>"+souscripteurs.created_at + "</td>"+
										"</tr>");

            });

        });
    }

	})
</script>


@endsection


