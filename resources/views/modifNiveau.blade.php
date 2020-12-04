@extends('template')

@section('contenu')
<br>
	<div class="container">
	 <div class="card z-depth-5" style="padding:20px">
	 {!!Form::open(['url' => 'modifEtude']) !!}
	  <div class="row">
	  	<h4 style="font-weight:bold;text-align:center">Remplir les champs</h4>
	  </div>
	  	<div class="row">
	  			<input type="hidden" name="id" value="{{ $id }}"/>
	  				<div class="col s12 m4">
				  		{!!Form::label('niveauEtude', 'Niveau d\'étude:', ['id' => 'labe']) !!}
				  		{!! Form::select('niveauEtude', ['' => '','Non scolarisé' => 'Non scolarisé', 'CEP' => 'CEP','CQP' => 'CQP',
				  		'CAP' => 'CAP', 'BQP' => 'BQP','BEPC' => 'BEPC','BEP' => 'BEP','BAC' => 'BAC', 'Universitaire' => 'Universitaire'],null,['class'=>'browser-default']) !!}	
				  		@if($errors->has('niveauEtude'))
			    			<small id="messageErreur">{{ $errors->first('niveauEtude') }}</small>
						@endif	
				  		
				  	</div>
				  	<div class="col s12 m4">
				  		{!!Form::label('profession', 'Profession:', ['id' => 'labe']) !!}
				  		{!! Form::text('profession') !!}	
				  		@if($errors->has('profession'))
			    			<small id="messageErreur">{{ $errors->first('profession') }}</small>
						@endif	
				  		
				  	</div>
		</div >
		<div class="row" >
			<h6>Période de formation</h6>
		</div>
		<div class="row">
	  		<div class="col s12 m4">
	  			<label for="dateDebut" id="labe">Date de debut</label>
		  		{!! Form::date('dateDebut') !!}	
		  		@if($errors->has('dateDebut'))
	    			<small id="messageErreur">{{ $errors->first('dateDebut') }}</small>
				@endif	
	  		</div >
	  		<div class="col s12 m4">
	  			<label for="dateFin" id="labe">Date de fin</label>
		  		{!! Form::date('dateFin') !!}	
		  		@if($errors->has('dateFin'))
	    			<small id="messageErreur">{{ $errors->first('dateFin') }}</small>
				@endif	
	  		</div >
	  	</div>
		
		<div class="row">
			<div class="right">
			<a href="{!! url('souscripteurs/listeSelectionne') !!}" class="waves-effect waves-light red center btn btn-large">Annuler</a>
	  		 {!!Form::submit('Valider !',['class'=>'waves-effect green waves-light btn btn-large']) !!}
	  		</div>
	  	</div>
		  
	  {!!Form::close() !!}
	</div>
</div>
@endsection
