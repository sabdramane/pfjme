@extends('template')

@section('contenu')
<br>
  <div class="container">
  	<div class="row">
  	<div class="col s12 m8">
	  {!!Form::open(['url' => 'souscripteur/validationCode']) !!}
	<div class="card z-depth-5" style="padding:20px;">
	  <div class="row">
	  	<h4 style="font-weight:bold;text-align:center">Valider votre souscription</h4>
	  	<small style="color:green;font-size:18px">Afin de valider votre souscription, veuillez saisir le code OTP
	  	obtenu après paiement des frais de formation par orange money! 
	  	</small>
	  </div>
	  <div class="row">
	   
	  		<input type="hidden" name="id" value="{{ $id }}">
		  	<div class="col s12 m4">
		  		<label for="nom" id="labe">Code OTP<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
		  		{!! Form::text('codeValidation','',['required','class'=>'validate','onChange'=>'javascript:this.value=this.value.toUpperCase();']) !!}	
		  		@if($errors->has('codeValidation'))
	    			<small id="messageErreur">{{ $errors->first('codeValidation') }}</small>
				@endif	

				@isset($erreur)
				<small id="messageErreur">{{ $erreur }}</small>
				@endisset
		  	</div>
		  	<div class="col s12 m4">
			  		<label for="telephone" id="labe">Mobile orange<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
			  		{!! Form::text('mobile','',['required','placeholder' => 'EX: 76789012']) !!}	
			  		@if($errors->has('mobile'))
		    			<small id="messageErreur">{{ $errors->first('mobile') }}</small>
					@endif	
			  		
			</div>

	  </div>
	  <div class="row">
			<div class="right">
				{!!Form::submit('Valider',['class'=>'modal-close white-text waves-light green center btn-flat']) !!}
		  	</div>
	  	</div>
	</div>
	  {!!Form::close() !!}
	  </div>
	<div class="col s12 m4">
 	<div class="card z-depth-5" style="padding:20px;">
 		<h6 style="font-weight:bold;">Comment obtenir le code OTP?</h6>
 		<small >Pour obtenir le code OTP, veuillez tapez sur votre téléphone orange: <strong style="color:green">*144*4*6*montant#</strong></small><br/>
 		<small>Le montant de la transaction est 20 000 FCFA</small>
 	</div>
 	</div>
 	</div>
 </div>
@endsection
