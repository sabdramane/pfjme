@extends('template')

@section('contenu')
	
	  <div class="row">
			  <div class="col s12"><br>
              
				<div class="row" >
		  			<div class="col s4" style="margin-top:50px">
		  				<label for="region" id="labe">Région:</label>
		  				<select name="region" id="region" class="browser-default" >
		  				 		<option value="" disabled selected>cliquer pour choisir la région</option>
			                    @foreach($regions as $region)
			                        <option value="{{ $region->id }}">{{ $region->libelleR }}</option>
			                    @endforeach
             			</select>
		  			</div>
		  			<div class="col s4" style="margin-top:50px">
		  				<label for="province" id="labe">Province:</label>
		  				<select name="province" id="province" class="browser-default" >
		  				 		<option value="" disabled selected>cliquer pour choisir la province</option>
			                   
             			</select>
		  			</div>
		  		</div>
			  	<h4>Liste des formés</h4>
				  <table class="responsive-table" id="table">
		   				<thead>
		   					<tr>
		   						<th>N°</th>
		   						<th>Nom et prénom</th>
		   						<th>Téléphone</th>
		   						<th>Date naissance</th>
		   					</tr>
		   				</thead>
		   				<tbody>
						</tbody>
		 			</table>
			  </div>
			  

	  </div>
@endsection

@section('scripts')
<script>
$(function() {
    
    // Changement de region
    $('#region').on('change', function(e) {
    	var region_id = e.target.value;
    	province_id = true;
    	provinceUpdate(region_id);
        tableUpdateRg(region_id);
    });

     // Changement de province
    $('#province').on('change', function(e) {
    	var province_id = e.target.value;
        tableUpdatePv(province_id);
    });

// Requête Ajax pour les provinces
    function provinceUpdate(region_Id) {
        $.get('{{ url('provinces') }}/'+ region_Id + "'", function(data) {
            $('#province').empty();
            $.each(data, function(index, provinces) {
                $('#province').append($('<option>', { 
                    value: provinces.id,
                    text : provinces.libelleP 
                }));
            });

            if(province_id) {
                $('#province').val(province_id).prop('selected', true);
            }
        });
    }

     // Requête Ajax pour les regions
    function tableUpdateRg(region_Id) {
        $.get('{{ url('recruteur/region') }}/'+ region_Id + "'", function(data) {
        		 $('#table tbody').empty();
        		 $('#page').hide();

            $.each(data, function(index, souscripteurs) {
				$("#table tbody").append("<tr>"+
											"<td>"+souscripteurs.id + "</td>"+
											"<td>"+souscripteurs.nom +" "+souscripteurs.prenom+ "</td>"+
											"<td>"+souscripteurs.telephone + "</td>"+
											"<td>"+souscripteurs.dateNaissance + "</td>"+
										"</tr>");

            });

        });
    }

     // Requête Ajax pour les regions
    function tableUpdatePv(province_Id) {
        $.get('{{ url('recruteur/province') }}/'+ province_Id + "'", function(data) {
        		 $('#table tbody').empty();
        		 $('#page').hide();
            $.each(data, function(index, souscripteurs) {
				$("#table tbody").append("<tr>"+
											"<td>"+souscripteurs.id + "</td>"+
											"<td>"+souscripteurs.nom +" "+souscripteurs.prenom+ "</td>"+
											"<td>"+souscripteurs.telephone + "</td>"+
											"<td>"+souscripteurs.dateNaissance + "</td>"+
										"</tr>");

            });

        });
    }

	})
</script>


@endsection


