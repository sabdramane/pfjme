@extends('template')

@section('contenu')
<br>
  <div class="container">
	  {!!Form::open(['url' => 'souscripteur/validationOperateur']) !!}
	<div class="card z-depth-5" style="padding:20px">
	  <div class="row">
	  	<h4 style="font-weight:bold;text-align:center">Valider la souscription</h4>
	  	<small style="color:green;font-size:18px">Veuillez choisir la méthode de validation! 
	  	</small>
	  </div>

	<div class="row">
			<label>
				{!! Form::radio('methode',"methode1",false,['id'=>'methode1']) !!}
				<span id="labe" >Validation par code orange money</span>
			</label><br>
			<label>
				{!! Form::radio('methode',"methode2",false,['id'=>'methode2']) !!}
				<span id="labe" >Validation par numéro quittance</span>
			</label><br>
			<input type="hidden" name="id" value="{{ $id }}" />
	</div>
	  <div class="row">
			<div class="right">
				{!!Form::submit('Continuer',['class'=>'modal-close white-text waves-light green center btn-flat']) !!}
		  	</div>
	  </div>
	</div>
	  {!!Form::close() !!}
 
 </div>
@endsection