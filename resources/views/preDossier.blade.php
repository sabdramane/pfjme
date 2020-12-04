@extends('template')

@section('contenu')
<br>
<div class="container">
	<div class="card z-depth-5" style="padding:20px">
	  {!!Form::open(['url' => 'souscripteurs/suivieDossier']) !!}
	  <div class="row">
	  	<h4 style="font-weight:bold;text-align:center">Veuillez vous identifier avant de consulter votre dossier</h4>
	  	@isset($erreur)
	    			<small style="color:red;font-size:18px">Informations incorrectes</small>
		@endisset
	  </div>
	  <div class="row">
		  	<div class="col s12 m4" >
		  		{!!Form::label('codeSouscripteur', 'Code souscription:',['class'=>'form-control','id' => 'labe']) !!}
		  		{!! Form::text('codeSouscripteur','',['required']) !!}	
		  		@if($errors->has('codeSouscripteur'))
	    			<small id="messageErreur">{{ $errors->first('codeSouscripteur') }}</small>
				@endif	
		  	</div>
	  </div>

	  <div class="row">
		  	<div class="col s12 m4">
		  		{!!Form::label('numCnib', 'Numéro CNIB:', ['id' => 'labe']) !!}
		  		{!! Form::text('numCnib','',['required']) !!}	
		  		@if($errors->has('numCnib'))
	    			<small id="messageErreur">{{ $errors->first('numCnib') }}</small>
				@endif	
		  		
		  	</div>
	  </div>
	  <div class="row">
			<div class="right">
	  		 {!!Form::submit('Valider!',['class'=>'waves-effect green waves-light btn btn-large','id' => 'boutonbtn']) !!}
	  		</div>
	   </div>
		  
	  {!!Form::close() !!}
	</div>
</div>
@endsection

