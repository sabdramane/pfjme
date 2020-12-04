@extends('template')

@section('contenu')
<br>
  <div class="container">
	  {!!Form::open(['url' => 'souscripteur/attestationJoint','files' => true]) !!}
	<div class="card z-depth-5" style="padding:20px">
	  <div class="row">
	  	<h4 style="font-weight:bold;text-align:center">Joindre son attestation</h4>
	  </div>
	  <div class="row">
	   
	  		<input type="hidden" name="id" value="{{ $id }}" />
		  	<div class="col s12 m4">
		  		<div class="file-field input-field">
					<div class="btn">
					    <span>Attestation</span>
					    {!! Form::file('attestation',['required']) !!}	
					</div>
					<div class="file-path-wrapper">
					    <input class="file-path validate" type="text" placeholder="image ou pdf">
					</div>
				</div>
				@if($errors->has('attestation'))
					<small id="messageErreur">{{ $errors->first('attestation') }}</small>
				@endif	
		  	</div>
	  </div>
	  <div class="row">
			<div class="right">
				<a href="{!! url('souscripteurs/listeVague1') !!}" class="waves-effect waves-light red center btn btn-large">Annuler</a>
				{!!Form::submit('Valider',['class'=>'modal-close white-text waves-light green center btn-large']) !!}
		  	</div>
	  </div>
	</div>
	  {!!Form::close() !!}
 
 </div>
@endsection