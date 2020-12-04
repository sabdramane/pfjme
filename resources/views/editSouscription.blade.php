@extends('template')

@section('contenu')
<br>
	<div class="container">
	 <div class="card z-depth-5" style="padding:20px">
	  {!!Form::model($souscripteur, ['route' => ['souscripteur.update', $souscripteur->id], 'method' => 'put','files' => true]) !!}
	  <div class="row">
	  	<h4 style="font-weight:bold;text-align:center">Modifier vos informations</h4>
	  </div>

	  <div class="row">
	  	<div class="col s12 m4" >
	  		{!! Form::hidden('codeSouscripteur',$souscripteur->codeSouscripteur) !!}	
	  		
	  	</div>
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
	  		{!!Form::label('nom', 'Nom:',['class'=>'form-control','id' => 'labe']) !!}
	  		<input type="text" name="nom" required class="validate" onChange="javascript:this.value=this.value.toUpperCase();" value="{{ $souscripteur->nom }}"/>
	  		@if($errors->has('nom'))
    			<small id="messageErreur">{{ $errors->first('nom') }}</small>
			@endif	
	  	</div>
	  	<div class="col s12 m4">
	  		{!!Form::label('prenom', 'Prenom:', ['id' => 'labe']) !!}
	  		{!! Form::text('prenom') !!}
	  		@if($errors->has('prenom'))
    			<small id="messageErreur">{{ $errors->first('prenom') }}</small>
			@endif	
	  		
	  	</div>
	  	<div  class="col s12 m4">
	  		{!!Form::label('genre', 'Genre:', ['id' => 'labe']) !!}
	  		{!! Form::select('genre', ['' => '','homme' => 'Homme', 'femme' => 'Femme'],null,['class'=>'browser-default','required']) !!}	
	  		@if($errors->has('genre'))
    			<small>{{ $errors->first('genre') }}</small>
			@endif	
	  		
	  	</div>
	  	</div>
	  	<div class="row">

		  	<div class="col s12 m4">
		  		{!!Form::label('lieuNaissance', 'Lieu de naissance:', ['id' => 'labe']) !!}
		  		{!! Form::text('lieuNaissance') !!}	
		  		@if($errors->has('lieuNaissance'))
	    			<small id="messageErreur">{{ $errors->first('lieuNaissance') }}</small>
				@endif	
		  		
		  	</div>
		  	<div class="col s12 m4">
		  		{!!Form::label('dateNaissance', 'Date de naissance:', ['id' => 'labe']) !!}
		  		{!! Form::date('dateNaissance') !!}	
		  		@if($errors->has('dateNaissance'))
	    			<small id="messageErreur">L'age minimum est de 15 ans</small>
				@endif	
		  		
		  	</div>
	  	</div>

	  	<div class="row">
	  	<div class="col s12 m4">
	  		{!!Form::label('numCnib', 'Numéro CNIB:', ['id' => 'labe']) !!}
	  		<input type="text" name="numCnib"  required class="validate" id="numCnib" value="{{ $souscripteur->numCnib }}" />
	  		@if($errors->has('numCnib'))
    			<small id="messageErreur">{{ $errors->first('numCnib') }}</small>
			@endif	
	  		
	  	</div>
	  	<div class="col s12 m4">
	  		{!!Form::label('dateEtabCnib', 'Date établissement CNIB:', ['id' => 'labe']) !!}
	  		{!! Form::date('dateEtabCnib') !!}	
	  		@if($errors->has('dateEtabCnib'))
    			<small id="messageErreur">{{ $errors->first('dateEtabCnib') }}</small>
			@endif	
	  		
	  	</div>

	  		<div class="col s12 m4">
		  		<div class="file-field input-field">
						<div class="btn">
					        <span>Joindre la CNIB</span>
					        <input type="file" name="cni">
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
			  		{!!Form::label('telephone', 'Téléphone:', ['id' => 'labe']) !!}
			  		{!! Form::text('telephone') !!}	
			  		@if($errors->has('telephone'))
		    			<small>{{ $errors->first('telephone') }}</small>
					@endif	
			  		
			  	</div>
			  	<div class="col s12 m4">
			  		{!!Form::label('email', 'Adresse email:', ['id' => 'labe']) !!}
			  		{!! Form::email('email') !!}	
			  		@if($errors->has('email'))
		    			<small id="messageErreur">{{ $errors->first('email') }}</small>
					@endif	
			  		
			  	</div>
	  	</div>

	  	<div class="row">
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
				  	<div class="col s12 m4">
						<div class="file-field input-field">
						      <div class="btn">
						        <span>Joindre un diplôme</span>
						        <input type="file" name="diplom">	
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text" placeholder="image ou pdf">
						      </div>
						</div>
						@if($errors->has('diplome'))
					    	<small id="messageErreur">La taille du fichier du diplôme ne peut pas dépasser 1Mo</small>
						@endif	
					</div>
		</div >
		<div class="row" >
					<div class="col s12 m4">
				  		<label for="domaine" id="labe">Connaissance approuvée en:</label>
				  		<label>
				  			@if($souscripteur->electricite==1)
						        <input type="checkbox" name="connaissance[]" checked="checked" value="Electricité" id="check1"/>
						        <span id="labe">Electricité</span>
						    @else
						    	<input type="checkbox" name="connaissance[]" value="Electricité" id="check1"/>
						        <span id="labe">Electricité</span>
						    @endif		
					      </label><br>
					      <label>
					      	@if($souscripteur->electronique==1)
						        <input type="checkbox" name="connaissance[]" checked="checked" value="Electronique" id="check2"/>
						        <span id="labe">Electronique</span>
						     @else
						     	<input type="checkbox" name="connaissance[]" value="Electronique" id="check2"/>
						        <span id="labe">Electronique</span>
						     @endif
					      </label><br>
					      <label>
					      	@if($souscripteur->electrotechnique==1)
						        <input type="checkbox" name="connaissance[]" checked="checked" value="Electrotechnique" id="check3"/>
						        <span id="labe">Electrotechnique</span>
						     @else
						     	<input type="checkbox" name="connaissance[]" value="Electrotechnique" id="check3"/>
						        <span id="labe">Electrotechnique</span>
						     @endif
					      </label><br>
					      <label>
					      	@if($souscripteur->climatisation==1)
						        <input type="checkbox" name="connaissance[]"  checked="checked" value="Froid et climatisation" id="check4"/>
						        <span id="labe">Froid et climatisation</span>
						    @else
						    	<input type="checkbox" name="connaissance[]" value="Froid et climatisation" id="check4"/>
						        <span id="labe">Froid et climatisation</span>
						    @endif
					      </label><br>
					      <label>
					      	@if($souscripteur->energie==1)
						        <input type="checkbox" name="connaissance[]" checked="checked" value="Energie" id="check5"/>
						        <span id="labe">Energie</span>
						    @else
						    	<input type="checkbox" name="connaissance[]" value="Energie" id="check5"/>
						        <span id="labe">Energie</span>
						    @endif
					      </label><br>
			     	      <label>
						        <input type="checkbox" name="autre" id="autre" value="autre"/>
						        <span id="labe">Autres</span>
					      </label>
			
				  	</div>
				  	<div class="col s12 m4" style="display:none" id="divAutre">
				  		<label for="autreDomaine" id="labe">Autre domaine</label>
				  		<input type="text" id="autreDomaine" placeholder="A saisir" name="autreDomaine" />	
				  		@if($errors->has('autreDomaine'))
			    			<small id="messageErreur">{{ $errors->first('autreDomaine') }}</small>
						@endif	
				  	</div>

				  	
				  	<div class="col s12 m4">
						<div class="file-field input-field">
					      <div class="btn">
					        <span>Attestation</span>
					        <input type="file" name="attestatio">	
					      </div>
					      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text" placeholder="image ou pdf">
					       </div>
					    </div>
					    @if($errors->has('attestation'))
							<small id="messageErreur">La taille du fichier de l'attestation ne peut pas dépasser 1Mo</small>
						@endif	
					</div>
		</div >
		<div class="row">
			<div class="col s12 m4">
					<div class="file-field input-field">
							<div class="btn">
								<span>Autre document</span>
								<input type="file" name="autreDocumen">
							</div>
							<div class="file-path-wrapper">
							    <input class="file-path validate" type="text" placeholder="image ou pdf">
							</div>
					</div>
					    @if($errors->has('autreDocument'))
							<small id="messageErreur">La taille du fichier du document ne peut pas dépasser 1Mo</small>
						@endif	
			</div>
		</div >
		<div class="row">
			<div class="right">
			<a href="{!! url('/') !!}" class="waves-effect waves-light red center btn btn-large">Annuler</a>
	  		 {!!Form::submit('Valider !',['class'=>'waves-effect green waves-light btn btn-large']) !!}
	  		</div>
	  	</div>
		  
	  {!!Form::close() !!}
	</div>
</div>
@endsection

@section('scripts')
<script>
$(function() {
    // Récupération des id pour region et ville
    var region_id = {{ old('region', $localite->departement->province->region->id) }};
    var province_id =  {{ old('province', $localite->departement->province->id) }};
    var departement_id = {{ old('departement', $localite->departement->id) }};
    var localite_id = {{ old('localite', $localite->id) }};
 
    // Sélection de la region
    $('#region').val(region_id).prop('selected', true);
     // Sélection de la province
    $('#province').val(province_id).prop('selected', true);
     // Sélection du departement
    $('#departement').val(departement_id).prop('selected', true);
    // Synchronisation des villes
    provinceUpdate(region_id);
    departementUpdate(province_id);
    localiteUpdate(departement_id);
 
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

