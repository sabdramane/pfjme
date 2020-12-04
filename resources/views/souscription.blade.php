@extends('template')

@section('contenu')
<br>
  <div class="container">
	  {!!Form::open(['url' => 'souscripteur','files' => true]) !!}
	<div class="card z-depth-5" style="padding:20px">
	  <div class="row">
	  	<h4 style="font-weight:bold;text-align:center">Veuillez vous inscrire au projet</h4>
	  	<small style="color:green;font-size:18px">Les champs obligatoires sont notés par une étoile rouge!</small>
	  </div>
	  <div class="row">
	    <div class="col s12 m4">
	    	<label for="region" id="labe">Région<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
	  		 <select name="region" id="region" class="browser-default" >
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->libelleR }}</option>
                    @endforeach
             </select>
	  		@if($errors->has('region'))
    			<small id="messageErreur">{{ $errors->first('region') }}</small>
			@endif	
	  	</div>

	  	<div class="col s12 m4">
	  		<label for="province" id="labe">Province<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
	  		 <select name="province" id="province" class="browser-default">
             </select>
	  		@if($errors->has('province'))
    			<small id="messageErreur">{{ $errors->first('province') }}</small>
			@endif	
	  		
	  	</div>
	  	</div>

	  	<div class="row">
	  		<div class="col s12 m4">
	  		<label for="departement" id="labe">Departement<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
	  		 <select name="departement" id="departement" class="browser-default">
             </select>
	  		@if($errors->has('departement'))
    			<small id="messageErreur">{{ $errors->first('departement') }}</small>
			@endif	
	  		
	  	</div>
	  	<div class="col s12 m4">
	  		<label for="localite" id="labe">Localité<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
	  		 <select name="localite" id="localite" class="browser-default">
             </select>
	  		@if($errors->has('localite'))
    			<small id="messageErreur">{{ $errors->first('localite') }}</small>
			@endif	
	  		
	  	</div>
	  	</div>
	  
	  <div class="row">

	  	<div class="col s12 m4" >
	  		<label for="nom" id="labe">Nom<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
	  		{!! Form::text('nom','',['required','class'=>'validate','onChange'=>'javascript:this.value=this.value.toUpperCase();']) !!}	
	  		@if($errors->has('nom'))
    			<small id="messageErreur">{{ $errors->first('nom') }}</small>
			@endif	
	  	</div>
	  	<div class="col s12 m4">
	  		<label for="prenom" id="labe">Prénom<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
	  		{!! Form::text('prenom','',['required']) !!}
	  		@if($errors->has('prenom'))
    			<small id="messageErreur">{{ $errors->first('prenom') }}</small>
			@endif	
	  		
	  	</div>
	  	<div  class="col s12 m4">
	  		<label for="genre" id="labe">Genre</label>
	  		{!! Form::select('genre', ['' => '','homme' => 'Homme', 'femme' => 'Femme'],null,['class'=>'browser-default']) !!}	
	  		@if($errors->has('genre'))
    			<small id="messageErreur">{{ $errors->first('genre') }}</small>
			@endif	
	  		
	  	</div>
	  	</div>
	  	<div class="row">

		  	<div class="col s12 m4">
		  		<label for="lieuNaissance" id="labe">Lieu de naissance</label>
		  		{!! Form::text('lieuNaissance','') !!}	
		  		@if($errors->has('lieuNaissance'))
	    			<small id="messageErreur">{{ $errors->first('lieuNaissance') }}</small>
				@endif	
		  		
		  	</div>
		  	<div class="col s12 m4">
		  		<label for="dateNaissance" id="labe">Date de naissance</label>
		  		{!! Form::date('dateNaissance') !!}	
		  		@if($errors->has('dateNaissance'))
	    			<small id="messageErreur">L'age minimum est de 15 ans et maximum 35 ans</small>
				@endif	
		  		
		  	</div>
	  	</div>

	  	<div class="row">
		  	<div class="col s12 m4">
		  		<label for="numCnib" id="labe">Numéro du CNIB ou de l'extrait<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
		  		{!! Form::text('numCnib','',['class'=>'validate','id'=>'numCnib','placeholder'=>'B2367891']) !!}
		  		@if($errors->has('numCnib'))
	    			<small id="messageErreur">{{ $errors->first('numCnib') }}</small>
				@endif	
		  		
		  	</div>
		  	<div class="col s12 m4">
		  		<label for="dateEtabCnib" id="labe">Date établissement du CNIB ou de l'extrait<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
		  		{!! Form::date('dateEtabCnib') !!}	
		  		@if($errors->has('dateEtabCnib'))
	    			<small id="messageErreur">{{ $errors->first('dateEtabCnib') }}</small>
				@endif	
		  		
		  	</div>
		  	<div class="col s12 m4">
		  		<div class="file-field input-field">
						<div class="btn">
					        <span>Joindre la CNIB ou l'extrait</span>
					        {!! Form::file('cnib') !!}	
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="image ou pdf">
				      </div>
				</div>
				   @if($errors->has('cnib'))
						<small id="messageErreur">La taille du fichier de cnib ne peut pas dépasser 1Mo</small>
					@endif	
		  	</div>
	  	</div>

	  	<div class="row">
			  	<div class="col s12 m4">
			  		<label for="telephone" id="labe">Téléphone<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
			  		{!! Form::text('telephone','',['placeholder' => 'EX: 76789012']) !!}	
			  		@if($errors->has('telephone'))
		    			<small id="messageErreur">{{ $errors->first('telephone') }}</small>
					@endif	
			  		
			  	</div>
			  	<div class="col s12 m4">
			  		<label for="email" id="labe">Adresse email<small style="font-size: 22px;color: red;font-weight: bold;">*</small></label>
			  		{!! Form::email('email') !!}	
			  		@if($errors->has('email'))
		    			<small id="messageErreur">{{ $errors->first('email') }}</small>
					@endif	
			  		
			  	</div>
	  	</div>

	  	<div class="row">
				  	<div class="col s12 m4">
				  		<label for="niveauEtude" id="labe">Niveau d'étude</label>
				  		{!! Form::select('niveauEtude', ['' => '','Non scolarisé' => 'Non scolarisé', 'CEP' => 'CEP','CQP' => 'CQP',
				  		'CAP' => 'CAP', 'BQP' => 'BQP','BEPC' => 'BEPC','BEP' => 'BEP','BAC' => 'BAC', 'Universitaire' => 'Universitaire'],null,['class'=>'browser-default']) !!}	
				  		@if($errors->has('niveauEtude'))
			    			<small id="messageErreur">{{ $errors->first('niveauEtude') }}</small>
						@endif	
				  	</div>
				  	<div class="col s12 m4">
				  		<label for="profession" id="labe">Profession</label>
				  		{!! Form::text('profession') !!}
				  		@if($errors->has('profession'))
			    			<small id="messageErreur">{{ $errors->first('profession') }}</small>
						@endif	
				  	</div>

				  	<div class="col s12 m4">
								<div class="file-field input-field">
								      <div class="btn">
								        <span>Joindre un diplôme</span>
								       {!! Form::file('diplome') !!}	
								      </div>
								      <div class="file-path-wrapper">
								        <input class="file-path validate" type="text" placeholder="image ou pdf">
								      </div>
							    </div>
							    @if($errors->has('diplome'))
					    			<small id="messageErreur">La taille du fichier de diplôme ne peut pas dépasser 1Mo</small>
								@endif	
						  	</div>
						</div >
				<div class="row" >
					<div class="col s12 m4">
				  		<label for="domaine" id="labe">Connaissance approuvée en:</label><br>
				  		<label>
				  				{!! Form::checkbox('connaissance[]',"Electricité",false,['id'=>'check1']) !!}
						        <span id="labe" >Electricité</span>
					      </label><br>
					      <label>
					      		{!! Form::checkbox('connaissance[]',"Electronique",false,['id'=>'check2']) !!}
						        <span id="labe">Electronique</span>
					      </label><br>
					      <label>
					      		{!! Form::checkbox('connaissance[]',"Electrotechnique",false,['id'=>'check3']) !!}
						        <span id="labe">Electrotechnique</span>
					      </label><br>
					      <label>
					      		{!! Form::checkbox('connaissance[]',"Froid et climatisation",false,['id'=>'check4']) !!}
						        <span id="labe">Froid et climatisation</span>
					      </label><br>
					      <label>
					      		{!! Form::checkbox('connaissance[]',"Energie",false,['id'=>'check5']) !!}
						        <span id="labe">Energie</span>
					      </label><br>
			   	          <label>
			   	          		{!! Form::checkbox('autre',"autre",false,['id'=>'autre']) !!}
						        <span id="labe">Autres</span>
					      </label>
			
				  	</div>
				  	<div class="col s12 m4" style="display:none" id="divAutre">
				  		<label for="autreDomaine" id="labe">Autres connaissances</label>
				  		{!! Form::text('autreDomaine','',['placeholder'=>"A saisir",'id'=>'autreDomaine']) !!}	
				  		@if($errors->has('autreDomaine'))
			    			<small id="messageErreur">{{ $errors->first('autreDomaine') }}</small>
						@endif	
				  	</div>
				  	<div class="col s12 m4">
								<div class="file-field input-field">
								      <div class="btn">
								        <span>Attestation</span>
								        {!! Form::file('attestation') !!}	
								      </div>
								      <div class="file-path-wrapper">
								        <input class="file-path validate" type="text" placeholder="image ou pdf">
								      </div>
							    </div>
							    @if($errors->has('attestation'))
					    			<small id="messageErreur">La taille du fichier de attestation ne peut pas dépasser 1Mo</small>
								@endif	
						  	</div>
		</div >
				<div class="row">
						  	<div class="col s12 m4">
								<div class="file-field input-field">
								      <div class="btn">
								        <span>Autre document</span>
								        {!! Form::file('autreDocument') !!}	
								      </div>
								      <div class="file-path-wrapper">
								        <input class="file-path validate" type="text" placeholder="image ou pdf">
								      </div>
							    </div>
							    @if($errors->has('autreDocument'))
					    			<small id="messageErreur">La taille du fichier de autre document ne peut pas dépasser 1Mo</small>
								@endif	
						  	</div>
						</div >

		 <div id="modal1" class="modal" style="width:300px">
						    <div class="modal-content">
						      <h4>Confirmer</h4>
						      <hr>
						      <p>Veuillez saisir des informations justes et correctes sous peine d'être exclus de la formation.
						      	Etes-vous sûr de vouloir continuer?</p>
						    </div>
						    <div class="modal-footer">
						      {!!Form::submit('OUI',['class'=>'modal-close white-text waves-light green center btn-flat']) !!}
						      <a href="#!" class="modal-close waves-light red btn-flat" style="color:white">NON</a>
						    </div>
		</div>


		<div class="row">
			<div class="right">
				<a href="{!! url('/') !!}" class="waves-effect waves-light red center btn btn-large">Annuler</a>
		  		<a href="#modal1" class="waves-light green btn btn-large modal-trigger" style="color:white">Suivant</a>
		  	</div>
	  	</div>
	</div>
	  {!!Form::close() !!}
 
 </div>
@endsection

@section('scripts')
<script>
$(function() {
    // Récupération des id pour region et ville

    var region_id = {{ old('region', 0) }};
    var province_id = {{ old('province', 0) }};
    var departement_id = {{ old('departement', 0) }};
    var localite_id = {{ old('localite', 0) }};
 
    // Sélection de la region
    $('#region').val(region_id).prop('selected', true);
     // Sélection de la province
    $('#province').val(province_id).prop('selected', true);
     // Sélection du departement
    $('#departement').val(departement_id).prop('selected', true);
    // Synchronisation des villes
   
 
    // Changement de region
    $('#region').on('change', function(e) {
        var region_id = e.target.value;

        province_id = true;
        provinceUpdate(region_id);
    });

    // Changement de province
    $('#province').on('change', function(e) {
        var province_id = e.target.value;

        departement_id = true;
        departementUpdate(province_id);
    });

    // Changement de departement
    $('#departement').on('change', function(e) {
        var departement_id = e.target.value;

        localite_id = true;
        localiteUpdate(departement_id);
    });
 
    // Requête Ajax pour les provinces
    function provinceUpdate(region_Id) {
        $.get('{{ url('provinces') }}/'+ region_Id + "'", function(data) {
            $('#province').empty();
            $('#localite').empty();
            $('#departement').empty();
            $.each(data, function(index, provinces) {
                $('#province').append($('<option>', { 
                    value: provinces.id,
                    text : provinces.libelleP 
                }));
            });

            if(province_id) {
                $('#province').val(province_id).prop('selected', true);
                departementUpdate(province_id);
            }
        });
    }

     // Requête Ajax pour les departements
    function departementUpdate(province_Id) {
        $.get('{{ url('departements') }}/'+ province_Id + "'", function(data) {
            $('#departement').empty();
            $.each(data, function(index, departements) {
                $('#departement').append($('<option>', { 
                    value: departements.id,
                    text : departements.libelleD 
                }));
            });
            if(departement_id) {
                $('#departement').val(departement_id).prop('selected', true);
            }
        });
    }

     // Requête Ajax pour les localites
    function localiteUpdate(departement_Id) {
        $.get('{{ url('localites') }}/'+ departement_Id + "'", function(data) {
            $('#localite').empty();
            $.each(data, function(index, localites) {
                $('#localite').append($('<option>', { 
                    value: localites.id,
                    text : localites.libelleL 
                }));
            });
            if(localite_id) {
                $('#localite').val(localite_id).prop('selected', true);
            }
        });
    }
     
});

$("#numCnib").change(function() {
		var numCnib=$(this).val();
		numCnib = numCnib.replace(/\s/g,'');
		numCnib=numCnib.toUpperCase();
		$(this).val(numCnib);
		//this.value.toUpperCase();"
		
	});

	$("#autre").change(function() {
		if($("#autre").is(":checked"))
		{
			$("#divAutre").show();
			$("#check1").prop("checked", false);
			$("#check1").prop("disabled", true);

			$("#check2").prop("checked", false);
			$("#check2").prop("disabled", true);

			$("#check3").prop("checked", false);
			$("#check3").prop("disabled", true);

			$("#check4").prop("checked", false);
			$("#check4").prop("disabled", true);

			$("#check5").prop("checked", false);
			$("#check5").prop("disabled", true);
		}
	else{
			$("#divAutre").hide();
			$("#check1").prop("disabled", false);
			$("#check2").prop("disabled", false);
			$("#check3").prop("disabled", false);
			$("#check4").prop("disabled", false);
			$("#check5").prop("disabled", false);
		}
	});
</script>


@endsection

