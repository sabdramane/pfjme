@extends('template')

@section('contenu')
	<div class="container">
			 <div class="row">
					<div class="col s12 m6">
					    <div class="card blue-grey darken-1">
					        <div class="card-content white-text">
					          <span class="card-title">Vérification</span>
					          <hr>
					          <p>{{$message}}!</p>
					        </div>
					       
					    </div>
					</div>
			  </div>
	</div>
@endsection

