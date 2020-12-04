@extends('template')

@section('contenu')

			  	 <ul id="dropdown5" class="dropdown-content " style="height:40px;line-height:40px">
                      <li>
                      	<a href="genererListePDF/{!!$souscripteurs->first()->id!!}/{!!$souscripteurs->last()->id!!}/{!!$souscripteurs->currentPage()!!}" style="font-size:18px;">
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
                      </li>
                      <li>
                      		<a href="genererListeExcel/{!!$souscripteurs->first()->id!!}/{!!$souscripteurs->last()->id!!}/{!!$souscripteurs->currentPage()!!}" style="font-size:18px">
			                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20pt" height="20pt" viewBox="0 0 20 20" version="1.1">
									<g id="surface1">
									<path style=" stroke:none;fill-rule:nonzero;fill:#4CAF50;fill-opacity:1;" d="M 17.082031 4.167969 L 10.417969 4.167969 L 10.417969 15.832031 L 17.082031 15.832031 C 17.3125 15.832031 17.5 15.648438 17.5 15.417969 L 17.5 4.582031 C 17.5 4.351563 17.3125 4.167969 17.082031 4.167969 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 13.332031 6.25 L 16.25 6.25 L 16.25 7.5 L 13.332031 7.5 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 13.332031 10.417969 L 16.25 10.417969 L 16.25 11.667969 L 13.332031 11.667969 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 13.332031 12.5 L 16.25 12.5 L 16.25 13.75 L 13.332031 13.75 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 13.332031 8.332031 L 16.25 8.332031 L 16.25 9.582031 L 13.332031 9.582031 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 10.417969 6.25 L 12.5 6.25 L 12.5 7.5 L 10.417969 7.5 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 10.417969 10.417969 L 12.5 10.417969 L 12.5 11.667969 L 10.417969 11.667969 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 10.417969 12.5 L 12.5 12.5 L 12.5 13.75 L 10.417969 13.75 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 10.417969 8.332031 L 12.5 8.332031 L 12.5 9.582031 L 10.417969 9.582031 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#2E7D32;fill-opacity:1;" d="M 11.25 17.5 L 2.5 15.832031 L 2.5 4.167969 L 11.25 2.5 Z "/>
									<path style=" stroke:none;fill-rule:nonzero;fill:#FFFFFF;fill-opacity:1;" d="M 7.96875 12.917969 L 6.964844 11.015625 C 6.925781 10.945313 6.886719 10.816406 6.847656 10.625 L 6.832031 10.625 C 6.8125 10.714844 6.769531 10.851563 6.695313 11.035156 L 5.6875 12.917969 L 4.121094 12.917969 L 5.980469 10 L 4.28125 7.082031 L 5.878906 7.082031 L 6.714844 8.832031 C 6.777344 8.96875 6.835938 9.132813 6.886719 9.324219 L 6.90625 9.324219 C 6.9375 9.210938 7 9.039063 7.089844 8.816406 L 8.015625 7.082031 L 9.480469 7.082031 L 7.730469 9.972656 L 9.527344 12.914063 L 7.96875 12.914063 Z "/>
									</g>
								</svg>
								Exporter en Excel
							</a>
                      </li>
                  </ul>
	<div class="container">
	  <div class="row">
			  <div class="col s12"><br>
			  	<div class="card z-depth-5" style="padding:20px">
			  	<h5 style="text-align:center">Générer la liste des souscripteurs</h5>

			  	@if($souscripteurs->total() > 201)
					<small style="color:green;font-size:18px">Compte tenu du nombre de souscripteurs la liste sera générer en plusieurs listes!</small>
				@endif
			  	
			  	<div class="row" style="margin-top: 50px">
		  			<div class="col s4">
		  				<a href="#!" class="dropdown-trigger waves-light green btn-large" data-target="dropdown5" style="font-size:18px">Liste N° {!! $souscripteurs->currentPage() !!}<i class="material-icons right">arrow_drop_down</i>
						</a>
		  			</div>
			  	</div>

		 			
				@if($souscripteurs->total() > 201)
					<a href="{!! $souscripteurs->nextPageUrl() !!}" style="font-size:18px">
								Liste suivant 
					</a>
				@endif
					
			  </div>
			  </div>

	  </div>
 </div>
@endsection
