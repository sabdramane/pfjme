@extends('template')

@section('contenu')
<br>
  <div class="container">
	  {!!Form::open(['url' => 'souscripteur/validationQuittance','files' => true]) !!}
	<div class="card z-depth-5" style="padding:20px">
	  <div class="row">
	  	<h4 style="font-weight:bold;text-align:center">Valider la souscription par quittance</h4>
	  </div>
	  <div class="row"  >
	   
	  		<input type="hidden" name="id" value="{{ $id }}" />
		  	<div class="col s12 m4">
		  		<label for="nom" id="labe">N° quittance<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
		  		{!! Form::text('numeroQuittance','',['required','class'=>'validate','onChange'=>'javascript:this.value=this.value.toUpperCase();','id'=>'quittance']) !!}	
		  		@if($errors->has('numeroQuittance'))
	    			<small id="messageErreur">{{ $errors->first('numeroQuittance') }}</small>
				@endif	
		  	</div>
		  	<div class="col s12 m4">
		  		<div class="file-field input-field">
					<div class="btn">
					    <span>Quittance</span>
					    {!! Form::file('quittance') !!}	
					</div>
					<div class="file-path-wrapper">
					    <input class="file-path validate" type="text" placeholder="image ou pdf">
					</div>
				</div>
				@if($errors->has('quittance'))
					<small id="messageErreur">{{ $errors->first('quittance') }}</small>
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
@endsection