@extends('template')

@section('contenu')
	
	  <div class="row">
			  <div class="col s12"><br>

			  	<h4>Liste de mes souscripteurs</h4>
			  	<div class="row" >
					 <div class="col s12">
		    			<a class="waves-light green btn-large" href="{!! url('souscripteurs/mesListepdf') !!}">
		    				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20pt" height="20pt" viewBox="0 0 20 20" version="1.1">
								<g id="surface1">
								<path style=" stroke:none;fill-rule:nonzero;fill:#FF5722;fill-opacity:1;" d="M 16.667969 18.75 L 3.332031 18.75 L 3.332031 1.25 L 12.5 1.25 L 16.667969 5.417969 Z "/>
								<path style=" stroke:none;fill-rule:nonzero;fill:#FBE9E7;fill-opacity:1;" d="M 16.042969 5.832031 L 12.082031 5.832031 L 12.082031 1.875 Z "/>
								<path style=" stroke:none;fill-rule:nonzero;fill:#FFEBEE;fill-opacity:1;" d="M 6.585938 12.292969 L 6.585938 13.75 L 5.75 13.75 L 5.75 9.601563 L 7.164063 9.601563 C 7.574219 9.601563 7.902344 9.730469 8.144531 9.984375 C 8.386719 10.238281 8.511719 10.570313 8.511719 10.976563 C 8.511719 11.382813 8.390625 11.703125 8.148438 11.9375 C 7.90625 12.175781 7.574219 12.292969 7.144531 12.292969 Z M 6.585938 11.59375 L 7.164063 11.59375 C 7.324219 11.59375 7.445313 11.542969 7.535156 11.4375 C 7.621094 11.332031 7.664063 11.179688 7.664063 10.980469 C 7.664063 10.773438 7.621094 10.609375 7.53125 10.488281 C 7.441406 10.363281 7.320313 10.300781 7.171875 10.300781 L 6.585938 10.300781 Z "/>
								<path style=" stroke:none;fill-rule:nonzero;fill:#FFEBEE;fill-opacity:1;" d="M 9.066406 13.75 L 9.066406 9.601563 L 10.164063 9.601563 C 10.648438 9.601563 11.035156 9.757813 11.324219 10.0625 C 11.609375 10.371094 11.757813 10.792969 11.761719 11.328125 L 11.761719 12 C 11.761719 12.546875 11.617188 12.972656 11.332031 13.285156 C 11.042969 13.59375 10.648438 13.75 10.140625 13.75 Z M 9.90625 10.300781 L 9.90625 13.054688 L 10.15625 13.054688 C 10.433594 13.054688 10.632813 12.980469 10.746094 12.835938 C 10.859375 12.6875 10.917969 12.433594 10.925781 12.074219 L 10.925781 11.351563 C 10.925781 10.964844 10.871094 10.695313 10.761719 10.542969 C 10.65625 10.390625 10.46875 10.308594 10.210938 10.300781 Z "/>
								<path style=" stroke:none;fill-rule:nonzero;fill:#FFEBEE;fill-opacity:1;" d="M 14.503906 12.058594 L 13.203125 12.058594 L 13.203125 13.75 L 12.363281 13.75 L 12.363281 9.601563 L 14.660156 9.601563 L 14.660156 10.300781 L 13.203125 10.300781 L 13.203125 11.363281 L 14.503906 11.363281 Z "/>
								</g>
							</svg>
							Exporter en PDF
						</a>
		  			</div>
		  		</div>
				  <table class="responsive-table">
		   				<thead>
		   					<tr>
		   						<th>N°</th>
		   						<th>Code souscripteur</th>
		   						<th>Nom et prénom</th>
		   						<th>Numéro CNIB</th>
		   						<th>Téléphone</th>
		   						<th>Date souscription</th>
		   						<th>Action</th>
		   					</tr>
		   				</thead>
		   				<tbody>
		 			 @foreach($souscripteurs as $souscripteur)
		 			 		<tr>
								<td>{!! $souscripteur->id !!}</td>
								<td>{!! $souscripteur->codeSouscripteur !!}</td>
								<td>{!! $souscripteur->nom !!}  {!! $souscripteur->prenom!!}</td>
								<td>{!! $souscripteur->numCnib !!} du {!! $souscripteur->dateEtabCnib!!}</td>
								<td>{!! $souscripteur->telephone !!}</td>
								<td>{!! $souscripteur->created_at !!}</td>
								<td>
									<div class="row">
										<?php
    											$id= Crypt::encrypt($souscripteur->id);
										?>
								     	<a class="waves-effect waves-light btn-small modal-trigger" title="Modifier les informations" href="{!! url('souscripteur/modification',$id) !!}"><i class="material-icons center">check_circle</i></a>
					  				</div>
					  			</td>
							</tr>
							@endforeach
						</tbody>
		 			</table>
		 			<div class="pagination right">
		 			{{ $souscripteurs->links() }}
		 			</div>
			  </div>
			  

	  </div>
@endsection

