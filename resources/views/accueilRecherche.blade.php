@extends('template')

@section('contenu')
	
	  <div class="row">
			  <div class="col s12"><br>
              
				<div class="row" >
					{!!Form::open(['url' => 'souscripteurs/recherche']) !!}
		  			<div class="col s4" style="margin-top:50px">
		  				<input name="nom" id="nom" placeholder="Nom" class="browser-default" />
		  			</div>
		  			<div class="col s4" style="margin-top:50px">
		  				<input name="prenom" id="prenom" placeholder="Prenom" class="browser-default" >
		  			</div>
		  			<div class="col s4" style="margin-top:50px">
				  		 {!!Form::submit('Rechercher!',['class'=>'waves-effect green waves-light btn btn-large','id' => 'boutonbtn']) !!}
				  	</div>
				  	{!!Form::close() !!}
		  		</div>
			  	<h4>Liste des formés</h4>
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
								<td>{!! $souscripteur->niveauEtude !!}</td>
					  			<td>{!! $souscripteur->created_at !!}</td>
								<td>
									<div class="row">
								      	<a class="waves-effect waves-light btn-small" title="Formé" href="{!! url('recherche/selection',$souscripteur->id) !!}"><i class="material-icons center">check_circle</i></a>
					  				</div>
					  			</td>
							</tr>
							@endforeach
						</tbody>
		 			</table>
			  </div>
			  

	  </div>
@endsection