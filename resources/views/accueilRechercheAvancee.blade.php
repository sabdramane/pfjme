@extends('template')

@section('contenu')
	
	  <div class="row">
			  <div class="col s12"><br>
              
				<div class="row" >
					{!!Form::open(['url' => 'souscripteurs/rechercheAvancee']) !!}
		  			<div class="col s4" style="margin-top:50px">
		  				<label for="genre" id="labe">Recheche par:</label>
		  				{!! Form::select('filtre', ['' => '','CodeOTP' => 'Code OTP', 'quittance' => 'Quittance', 'subvention' => 'Subvention'],null,['class'=>'browser-default']) !!}
		  			</div>
		  			
		  			<div class="col s4" style="margin-top:80px">
				  		 {!!Form::submit('Rechercher',['class'=>'waves-effect green waves-light btn btn-large','id' => 'boutonbtn']) !!}
				  	</div>
				  	{!!Form::close() !!}
				  	<div class="col s4" style="margin-top:80px">
				  		 <a class="waves-effect waves-light green btn-large" href="{!! url('souscripteurs/genererPDF',$nom) !!}">Générer en PDF<i class="material-icons left">check_circle</i></a>
				  	</div>
		  		</div>
			  	<h4>Liste des souscripteurs en fonction de {{ $nom }}</h4>
			  	<h6 style="text-align:center">Total:{!! $nb !!}</h6>
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