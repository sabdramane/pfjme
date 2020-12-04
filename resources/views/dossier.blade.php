@extends('template')

@section('contenu')
	<div class="container">
			 <div class="row">
				<div class="col s12 m6">
					<div class="card blue-grey darken-1">
					    <div class="card-content white-text">
					        <span class="card-title">Dossier</span>
					        	<hr>
					          <p>
					          		{!! $souscripteur->nom !!}  {!! $souscripteur->prenom!!}
					          		, vous êtes inscrit à la formation
					          		@if($souscripteur->etat=="formé")
					          			et a été formé.<br>
					          				Vous pouvez télécharger votre attestation en cliquez ici
					          				<a class="waves-effect waves-light btn-small" title="Télécharger l'attestation" href="{!! url('generation/attestation',$souscripteur->id) !!}"><i class="material-icons center">cloud_download</i>Attestation de formation</a> 
					          		@else
					          			mais pas encore formé.
					          		@endif		
					          </p>
					    </div>
					       
					</div>
				</div>
			</div>
	</div>
@endsection

