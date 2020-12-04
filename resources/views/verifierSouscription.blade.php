@extends('template')

@section('contenu')
<br><br>
<div class="container">
	<div class="card z-depth-5" style="padding:20px">
	  {!!Form::open(['url' => 'souscripteurs/verification']) !!}
	  <div class="row">
	  		<h4 style="font-weight:bold;text-align:center">Vérification d'une souscription</h4>
	  		<br>
	    	<small style="color:green;font-size:18px">Veuillez renseigner le numéro CNIB</small>
	  </div>
	  <div class="row">
		  	<div class="col s12 m4">
		  		{!!Form::label('numCnib', 'Numéro CNIB:', ['id' => 'labe']) !!}
		  		{!! Form::text('numCnib','',['required']) !!}	
		  		@if($errors->has('numCnib'))
	    			<small>{{ $errors->first('numCnib') }}</small>
				@endif	
		  		
		  	</div>
	  </div>
	  <div class="row">
		<div class="right">
	  		 {!!Form::submit('Vérifier !',['class'=>'waves-effect green waves-light btn btn-large','id' => 'boutonbtn']) !!}
	  	</div>
	  </div>
		  
	  {!!Form::close() !!}
	</div>
</div>
@endsection

