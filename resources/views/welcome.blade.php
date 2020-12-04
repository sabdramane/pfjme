@extends('template')

@section('contenu')
<br>
<div class="container">
<div class="row">
      <div class="slider">
          <ul class="slides">
             <li>
              <img  class="activator responsive-img" src="{{ asset('image/ministre.jpg') }}"> <!-- random image -->
               <div class="caption center-align">
                <h3 >Visite du Ministre à l'ANEREE!</h3>
               <!--<h4 class="light grey-text text-lighten-3">le Premier ministre visite un chantier d’électrification de 50 MW </h4>-->
              </div>
            </li>
            <li>
              <img  class="activator responsive-img" src="{{ asset('image/JobBooster.jpg') }}"> <!-- random image -->
               <div class="caption center-align">
                <h3 >Job Booster partenaire de l'ANEREE</h3>
               <!--<h4 class="light grey-text text-lighten-3">le Premier ministre visite un chantier d’électrification de 50 MW </h4>-->
              </div>
            </li>
			 <li>
              <img  class="activator responsive-img" src="{{ asset('image/formation1.jpg') }}"> <!-- random image -->
               <div class="caption center-align">
                <h3 >Premières formations à l'institut Ben Gourion de Ouagadougou</h3>
               <!--<h4 class="light grey-text text-lighten-3">le Premier ministre visite un chantier d’électrification de 50 MW </h4>-->
              </div>
            </li>
            <li>
              <img  class="activator responsive-img" src="{{ asset('image/formation2.jpg') }}"> <!-- random image -->
               <div class="caption center-align">
                <h3 >Premières formations à l'institut Ben Gourion de Ouagadougou</h3>
               <!--<h4 class="light grey-text text-lighten-3">le Premier ministre visite un chantier d’électrification de 50 MW </h4>-->
              </div>
            </li>
             <li>
              <img  class="activator responsive-img" src="{{ asset('image/formation3.jpg') }}"> <!-- random image -->
               <div class="caption center-align">
                <h3 >Le Ministre Bachir Ouedraogo supervise la formation des 5000 jeunes à l'institut Ben Gourion partenaire de l'ANEREE</h3>
               <!--<h4 class="light grey-text text-lighten-3">le Premier ministre visite un chantier d’électrification de 50 MW </h4>-->
              </div>
            </li>
             <li>
              <img  class="activator responsive-img" src="{{ asset('image/formation4.jpg') }}"> <!-- random image -->
               <div class="caption center-align">
                <h3 >Le Ministre Bachir Ouedraogo supervise la formation des 5000 jeunes à l'institut Ben Gourion partenaire de l'ANEREE</h3>
               <!--<h4 class="light grey-text text-lighten-3">le Premier ministre visite un chantier d’électrification de 50 MW </h4>-->
              </div>
            </li>
             <li>
              <img  class="activator responsive-img" src="{{ asset('image/formation5.jpg') }}"> <!-- random image -->
               <div class="caption center-align">
                <h3 >Le Ministre Bachir Ouedraogo supervise la formation des 5000 jeunes à l'institut Ben Gourion partenaire de l'ANEREE</h3>
               <!--<h4 class="light grey-text text-lighten-3">le Premier ministre visite un chantier d’électrification de 50 MW </h4>-->
              </div>
            </li>
             <li>
              <img  class="activator responsive-img" src="{{ asset('image/formation6.jpg') }}"> <!-- random image -->
               <div class="caption center-align">
                <h3 >Le Ministre Bachir Ouedraogo supervise la formation des 5000 jeunes à l'institut Ben Gourion partenaire de l'ANEREE</h3>
               <!--<h4 class="light grey-text text-lighten-3">le Premier ministre visite un chantier d’électrification de 50 MW </h4>-->
              </div>
            </li>
            <li>
              <img  class="activator responsive-img" src="{{ asset('image/1.jpg') }}"> <!-- random image -->
               <div class="caption center-align">
                <h3 >Visite Aggreko du Premier Ministre!</h3>
               <!--<h4 class="light grey-text text-lighten-3">le Premier ministre visite un chantier d’électrification de 50 MW </h4>-->
              </div>
            </li>
            <li>
              <img class="activator responsive-img" src="{{ asset('image/chine_me.jpg') }}"> <!-- random image -->
               <div class="caption bottom-align">
                <h3>Coopération dans le secteur de l’énergie!</h3>
                <h4 class="light grey-text text-lighten-3">La Chine fait le point de sa collaboration</h4>
              </div>
            </li>
            <li>
              <img  class="activator responsive-img" src="{{ asset('image/pnud.jpg') }}"> <!-- random image -->
              <div class="caption center-align">
                <h3>Défis du secteur de l’énergie!</h3>
                <h4 class="light grey-text text-lighten-3">Le PNUD prêt à accompagner le Burkina Faso</h4>
              </div>
            </li>
            <li>
              <img  class="activator responsive-img" src="{{ asset('image/Bachir.jpg') }}"> <!-- random image -->
              <div class="caption center-align">
                <h3>Accès des Burkinabè à l’énergie!</h3>
                <h4 class="light grey-text text-lighten-3">Coopération dans le secteur de l’énergie</h4>
              </div>
            </li>

          </ul>
        </div>
    </div>
    <div class="row">
         <div class="row">
            <div class="col s12 m3 " >
               @if (Route::has('login'))
                          @auth
                              @if((auth()->user()->role->abrege=="opera")||(auth()->user()->role->abrege=="superv"))
              <div class="card-panel waves-effect waves-light hoverable grey lighten-2" style="width:220px">
                    <a href="{!!url('souscripteur/create') !!}">
                    <div class="card-image waves-effect waves-block waves-light center">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                          <g id="surface1">
                          <path style=" stroke:none;fill-rule:nonzero;fill:#4FC3F7;fill-opacity:1;" d="M 29 31 C 29 31 28 35 24 35 C 20 35 19 31 19 31 C 19 31 8 32.984375 8 44 L 40 44 C 40 33.023438 29 31 29 31 "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#FF9800;fill-opacity:1;" d="M 24 37 C 19 37 19 31 19 31 L 19 25 L 29 25 L 29 31 C 29 31 29 37 24 37 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#FFA726;fill-opacity:1;" d="M 35 19 C 35 20.105469 34.105469 21 33 21 C 31.894531 21 31 20.105469 31 19 C 31 17.894531 31.894531 17 33 17 C 34.105469 17 35 17.894531 35 19 M 17 19 C 17 17.894531 16.105469 17 15 17 C 13.894531 17 13 17.894531 13 19 C 13 20.105469 13.894531 21 15 21 C 16.105469 21 17 20.105469 17 19 "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#FFB74D;fill-opacity:1;" d="M 33 13 C 33 5.363281 15 8.027344 15 13 L 15 20 C 15 24.972656 19.027344 29 24 29 C 28.972656 29 33 24.972656 33 20 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#424242;fill-opacity:1;" d="M 24 4 C 17.925781 4 14 8.925781 14 15 L 14 17.285156 L 16 19 L 16 14 L 28 10 L 32 14 L 32 19 L 34 17.257813 L 34 15 C 34 10.976563 32.960938 6.984375 28 6 L 27 4 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#784719;fill-opacity:1;" d="M 27 19 C 27 18.449219 27.449219 18 28 18 C 28.550781 18 29 18.449219 29 19 C 29 19.550781 28.550781 20 28 20 C 27.449219 20 27 19.550781 27 19 M 19 19 C 19 19.550781 19.449219 20 20 20 C 20.550781 20 21 19.550781 21 19 C 21 18.449219 20.550781 18 20 18 C 19.449219 18 19 18.449219 19 19 "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#01579B;fill-opacity:1;" d="M 24 37 C 29 37 30.746094 33.070313 30.949219 31.570313 C 29.792969 31.148438 29 31 29 31 C 29 31 28 35 24 35 C 20 35 19 31 19 31 C 19 31 18.203125 31.144531 17.046875 31.566406 C 17.253906 33.0625 19 37 24 37 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#E57373;fill-opacity:1;" d="M 45.679688 29.140625 L 42.859375 26.324219 C 42.429688 25.894531 41.730469 25.894531 41.304688 26.324219 L 39.976563 27.652344 L 44.351563 32.027344 L 45.679688 30.699219 C 46.105469 30.269531 46.105469 29.570313 45.679688 29.140625 "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#FF9800;fill-opacity:1;" d="M 25.472656 42.152344 L 37.789063 29.839844 L 42.164063 34.214844 L 29.847656 46.53125 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#B0BEC5;fill-opacity:1;" d="M 44.351563 32.023438 L 42.164063 34.214844 L 37.785156 29.835938 L 39.972656 27.648438 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#FFC107;fill-opacity:1;" d="M 25.472656 42.152344 L 24 48 L 29.847656 46.527344 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#37474F;fill-opacity:1;" d="M 24.742188 45.042969 L 24 48 L 26.957031 47.257813 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#01579B;fill-opacity:1;" d="M 24 37 C 29 37 30.746094 33.070313 30.949219 31.570313 C 29.792969 31.148438 29 31 29 31 C 29 31 28 35 24 35 C 20 35 19 31 19 31 C 19 31 18.203125 31.144531 17.046875 31.566406 C 17.253906 33.0625 19 37 24 37 Z "/>
                          </g>
                      </svg>
                    </div>
                    <div class="card-title center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Faire Souscription</span>
                      
                    </div>
                    </a>
              </div>
                    @endif
                  @endauth
                @endif
            </div>

            <div class="col s12 m3">
               <div class="card-panel waves-effect waves-light hoverable grey lighten-2 center" style="width:220px">
                    <a href="{!!url('souscripteurs/modification') !!}">
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                          <g id="surface1">
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 38 13 C 38 13.554688 37.554688 14 37 14 L 5 14 C 4.449219 14 4 13.554688 4 13 L 4 6 C 4 5.445313 4.449219 5 5 5 L 37 5 C 37.554688 5 38 5.445313 38 6 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#BBDEFB;fill-opacity:1;" d="M 4 10 L 38 10 L 38 39 L 4 39 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#E57373;fill-opacity:1;" d="M 43.679688 25.140625 L 40.859375 22.324219 C 40.429688 21.894531 39.730469 21.894531 39.304688 22.324219 L 37.976563 23.652344 L 42.351563 28.027344 L 43.679688 26.699219 C 44.105469 26.269531 44.105469 25.570313 43.679688 25.140625 "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#FF9800;fill-opacity:1;" d="M 23.472656 38.152344 L 35.785156 25.839844 L 40.160156 30.214844 L 27.847656 42.527344 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#B0BEC5;fill-opacity:1;" d="M 42.351563 28.027344 L 40.164063 30.214844 L 35.785156 25.839844 L 37.972656 23.652344 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#FFC107;fill-opacity:1;" d="M 23.472656 38.152344 L 22 44 L 27.847656 42.527344 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#37474F;fill-opacity:1;" d="M 22.742188 41.042969 L 22 44 L 24.957031 43.257813 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 27.796875 31 L 15 31 L 15 33 L 25.796875 33 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 31 27.796875 L 31 27 L 15 27 L 15 29 L 29.796875 29 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 15 19 L 31 19 L 31 21 L 15 21 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 15 15 L 31 15 L 31 17 L 15 17 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 11 15 L 13 15 L 13 17 L 11 17 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 11 19 L 13 19 L 13 21 L 11 21 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 11 31 L 13 31 L 13 33 L 11 33 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 15 31 L 15 33 L 22 33 C 22 32.316406 22.070313 31.648438 22.191406 31 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 11 23 L 13 23 L 13 25 L 11 25 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 11 27 L 13 27 L 13 29 L 11 29 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#1976D2;fill-opacity:1;" d="M 15 23 L 31 23 L 31 25 L 15 25 Z "/>
                          </g>
                      </svg>
                    <div class="card-content center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Modifier Souscription</span>
                    </div>
                    </a>
              </div>
            </div>

            <div class="col s12 m3">
             <div class="card-panel waves-effect waves-light hoverable grey lighten-2 " style="width:220px">
                    <a href="{!!url('souscripteurs/verification') !!}">
                    <div class="card-image waves-effect waves-block waves-light center">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                            <g id="surface1">
                            <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 5.007813 26.867188 C 5.007813 26.867188 4.691406 30.679688 8.632813 31.742188 C 12.570313 32.804688 11.945313 24.054688 11.945313 24.054688 Z "/>
                            <path style="fill:none;stroke-width:4;stroke-linecap:butt;stroke-linejoin:round;stroke:#607D8B;stroke-opacity:1;stroke-miterlimit:4;" d="M 38 11 L 38 20.128906 L 32 23.132813 "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:#455A64;fill-opacity:1;" d="M 31 8 L 31 9 C 31 10.105469 31.894531 11 33 11 L 43 11 C 44.105469 11 45 10.105469 45 9 L 45 8 Z "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:#C5CAE9;fill-opacity:1;" d="M 35.800781 29.625 L 15.710938 38.945313 L 9.5625 25.425781 L 29.65625 16.105469 Z "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:#C5CAE9;fill-opacity:1;" d="M 36.988281 20.9375 C 38.652344 24.671875 38.078125 28.554688 35.710938 29.609375 C 33.339844 30.667969 30.066406 28.503906 28.402344 24.769531 C 26.738281 21.035156 27.308594 17.15625 29.683594 16.097656 C 32.054688 15.042969 35.324219 17.207031 36.988281 20.9375 Z "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:#42257A;fill-opacity:1;" d="M 16.980469 30.277344 C 18.644531 34.011719 18.242188 37.816406 16.085938 38.777344 C 13.929688 39.738281 10.828125 37.496094 9.164063 33.761719 C 7.5 30.03125 7.898438 26.226563 10.058594 25.265625 C 12.214844 24.304688 15.3125 26.546875 16.980469 30.277344 Z "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:#B388FF;fill-opacity:1;" d="M 15.0625 31.175781 C 13.992188 28.78125 12.253906 27.226563 11.179688 27.707031 C 10.105469 28.1875 10.101563 30.515625 11.167969 32.910156 C 12.238281 35.308594 13.972656 36.859375 15.050781 36.382813 C 16.125 35.902344 16.128906 33.570313 15.0625 31.175781 Z "/>
                            <path style="fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:miter;stroke:#CEB8FF;stroke-opacity:1;stroke-miterlimit:4;" d="M 12.128906 29.832031 C 12.515625 29.660156 13.273438 30.507813 13.816406 31.726563 "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:#7986CB;fill-opacity:1;" d="M 29.683594 16.097656 C 29.675781 16.101563 29.667969 16.109375 29.660156 16.113281 L 29.65625 16.105469 L 5 26.832031 C 5 26.832031 10.207031 25.417969 17.207031 30.542969 C 23.429688 27.8125 37.171875 21.382813 37.171875 21.382813 C 37.113281 21.234375 37.058594 21.085938 36.988281 20.9375 C 35.324219 17.207031 32.054688 15.042969 29.683594 16.097656 Z "/>
                            </g>
                      </svg>
                    </div>
                    <div class="card-content center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Vérifier souscription</span>
                      
                    </div>
                    </a>
              </div>
            </div>
             <div class="col s12 m3">
             <div class="card-panel waves-effect waves-light hoverable grey lighten-2" style="width:220px">
                    <a href="{!!url('souscripteurs/suivieDossier') !!}">
                    <div class="card-image waves-effect waves-block waves-light center">
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                          <g id="surface1">
                          <path style=" stroke:none;fill-rule:nonzero;fill:#BBDEFB;fill-opacity:1;" d="M 43 24 C 43 34.492188 34.492188 43 24 43 C 13.507813 43 5 34.492188 5 24 C 5 13.507813 13.507813 5 24 5 C 34.492188 5 43 13.507813 43 24 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 35 C 19.738281 35 16.046875 32.554688 14.222656 29 L 17 29 L 13 24 L 9 29 L 12.019531 29 C 13.980469 33.691406 18.605469 37 24 37 C 30.132813 37 35.277344 32.722656 36.636719 27 L 34.574219 27 C 33.261719 31.609375 29.023438 35 24 35 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 13 C 28.261719 13 31.953125 15.445313 33.777344 19 L 31 19 L 35 24 L 39 19 L 35.980469 19 C 34.019531 14.308594 29.394531 11 24 11 C 17.867188 11 12.722656 15.277344 11.363281 21 L 13.425781 21 C 14.738281 16.390625 18.976563 13 24 13 Z "/>
                          </g>
                      </svg>
                    </div>
                    <div class="card-content center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Suivre son dossier</span>
                      
                    </div>
                    </a>
              </div>
            </div>
            @if (Route::has('login'))
                       
              @auth

              @if(auth()->user()->role->abrege=="superv")
            <div class="col s12 m3">
             <div class="card-panel waves-effect waves-light hoverable grey lighten-2 center" style="width:220px">
                    <a href="{!!url('souscripteurs/liste') !!}">
                    <div class="card-image waves-effect waves-block waves-light">
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                          <g id="surface1">
                          <path style=" stroke:none;fill-rule:nonzero;fill:#BBDEFB;fill-opacity:1;" d="M 43 24 C 43 34.492188 34.492188 43 24 43 C 13.507813 43 5 34.492188 5 24 C 5 13.507813 13.507813 5 24 5 C 34.492188 5 43 13.507813 43 24 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 35 C 19.738281 35 16.046875 32.554688 14.222656 29 L 17 29 L 13 24 L 9 29 L 12.019531 29 C 13.980469 33.691406 18.605469 37 24 37 C 30.132813 37 35.277344 32.722656 36.636719 27 L 34.574219 27 C 33.261719 31.609375 29.023438 35 24 35 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 13 C 28.261719 13 31.953125 15.445313 33.777344 19 L 31 19 L 35 24 L 39 19 L 35.980469 19 C 34.019531 14.308594 29.394531 11 24 11 C 17.867188 11 12.722656 15.277344 11.363281 21 L 13.425781 21 C 14.738281 16.390625 18.976563 13 24 13 Z "/>
                          </g>
                      </svg>
                    </div>
                    <div class="card-content center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Liste des souscripteurs</span>
                      
                    </div>
                    </a>
              </div>
            </div>
            <div class="col s12 m3">
             <div class="card-panel waves-effect waves-light hoverable grey lighten-2 center" style="width:220px">
                    <a href="{!!url('souscripteurs/operateur/liste') !!}">
                    <div class="card-image waves-effect waves-block waves-light">
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                          <g id="surface1">
                          <path style=" stroke:none;fill-rule:nonzero;fill:#BBDEFB;fill-opacity:1;" d="M 43 24 C 43 34.492188 34.492188 43 24 43 C 13.507813 43 5 34.492188 5 24 C 5 13.507813 13.507813 5 24 5 C 34.492188 5 43 13.507813 43 24 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 35 C 19.738281 35 16.046875 32.554688 14.222656 29 L 17 29 L 13 24 L 9 29 L 12.019531 29 C 13.980469 33.691406 18.605469 37 24 37 C 30.132813 37 35.277344 32.722656 36.636719 27 L 34.574219 27 C 33.261719 31.609375 29.023438 35 24 35 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 13 C 28.261719 13 31.953125 15.445313 33.777344 19 L 31 19 L 35 24 L 39 19 L 35.980469 19 C 34.019531 14.308594 29.394531 11 24 11 C 17.867188 11 12.722656 15.277344 11.363281 21 L 13.425781 21 C 14.738281 16.390625 18.976563 13 24 13 Z "/>
                          </g>
                      </svg>
                    </div>
                    <div class="card-content center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Liste de mes souscripteurs</span>
                      
                    </div>
                    </a>
              </div>
            </div>
            <div class="col s12 m3">
             <div class="card-panel waves-effect waves-light hoverable grey lighten-2 center" style="width:220px">
                    <a href="{!!url('souscripteurs/rechercher') !!}">
                    <div class="card-image waves-effect waves-block waves-light">
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                          <g id="surface1">
                          <path style=" stroke:none;fill-rule:nonzero;fill:#BBDEFB;fill-opacity:1;" d="M 43 24 C 43 34.492188 34.492188 43 24 43 C 13.507813 43 5 34.492188 5 24 C 5 13.507813 13.507813 5 24 5 C 34.492188 5 43 13.507813 43 24 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 35 C 19.738281 35 16.046875 32.554688 14.222656 29 L 17 29 L 13 24 L 9 29 L 12.019531 29 C 13.980469 33.691406 18.605469 37 24 37 C 30.132813 37 35.277344 32.722656 36.636719 27 L 34.574219 27 C 33.261719 31.609375 29.023438 35 24 35 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 13 C 28.261719 13 31.953125 15.445313 33.777344 19 L 31 19 L 35 24 L 39 19 L 35.980469 19 C 34.019531 14.308594 29.394531 11 24 11 C 17.867188 11 12.722656 15.277344 11.363281 21 L 13.425781 21 C 14.738281 16.390625 18.976563 13 24 13 Z "/>
                          </g>
                      </svg>
                    </div>
                    <div class="card-content center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Rechercher</span>
                      
                    </div>
                    </a>
              </div>
            </div>
            <div class="col s12 m3">
             <div class="card-panel waves-effect waves-light hoverable grey lighten-2 center" style="width:220px">
                    <a href="{!!url('souscripteurs/rechercheAvancee') !!}">
                    <div class="card-image waves-effect waves-block waves-light">
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                          <g id="surface1">
                          <path style=" stroke:none;fill-rule:nonzero;fill:#BBDEFB;fill-opacity:1;" d="M 43 24 C 43 34.492188 34.492188 43 24 43 C 13.507813 43 5 34.492188 5 24 C 5 13.507813 13.507813 5 24 5 C 34.492188 5 43 13.507813 43 24 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 35 C 19.738281 35 16.046875 32.554688 14.222656 29 L 17 29 L 13 24 L 9 29 L 12.019531 29 C 13.980469 33.691406 18.605469 37 24 37 C 30.132813 37 35.277344 32.722656 36.636719 27 L 34.574219 27 C 33.261719 31.609375 29.023438 35 24 35 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 13 C 28.261719 13 31.953125 15.445313 33.777344 19 L 31 19 L 35 24 L 39 19 L 35.980469 19 C 34.019531 14.308594 29.394531 11 24 11 C 17.867188 11 12.722656 15.277344 11.363281 21 L 13.425781 21 C 14.738281 16.390625 18.976563 13 24 13 Z "/>
                          </g>
                      </svg>
                    </div>
                    <div class="card-content center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Recherche Avancée</span>
                      
                    </div>
                    </a>
              </div>
            </div>
            @endif
            @if(auth()->user()->role->abrege=="recru")
            <div class="col s12 m3">
             <div class="card-panel waves-effect waves-light hoverable grey lighten-2 center" style="width:220px">
                    <a href="{!!url('espace/recruteur/accueil') !!}">
                    <div class="card-image waves-effect waves-block waves-light">
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                          <g id="surface1">
                          <path style=" stroke:none;fill-rule:nonzero;fill:#BBDEFB;fill-opacity:1;" d="M 43 24 C 43 34.492188 34.492188 43 24 43 C 13.507813 43 5 34.492188 5 24 C 5 13.507813 13.507813 5 24 5 C 34.492188 5 43 13.507813 43 24 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 35 C 19.738281 35 16.046875 32.554688 14.222656 29 L 17 29 L 13 24 L 9 29 L 12.019531 29 C 13.980469 33.691406 18.605469 37 24 37 C 30.132813 37 35.277344 32.722656 36.636719 27 L 34.574219 27 C 33.261719 31.609375 29.023438 35 24 35 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 13 C 28.261719 13 31.953125 15.445313 33.777344 19 L 31 19 L 35 24 L 39 19 L 35.980469 19 C 34.019531 14.308594 29.394531 11 24 11 C 17.867188 11 12.722656 15.277344 11.363281 21 L 13.425781 21 C 14.738281 16.390625 18.976563 13 24 13 Z "/>
                          </g>
                      </svg>
                    </div>
                    <div class="card-content center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Rechercher les jeunes formés</span>
                      
                    </div>
                    </a>
              </div>
            </div>
          
            @endif
            @if(auth()->user()->role->abrege=="opera")
             <div class="col s12 m3">
             <div class="card-panel waves-effect waves-light hoverable grey lighten-2 center" style="width:220px">
                    <a href="{!!url('souscripteurs/operateur/liste') !!}">
                    <div class="card-image waves-effect waves-block waves-light">
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48pt" height="48pt" viewBox="0 0 48 48" version="1.1">
                          <g id="surface1">
                          <path style=" stroke:none;fill-rule:nonzero;fill:#BBDEFB;fill-opacity:1;" d="M 43 24 C 43 34.492188 34.492188 43 24 43 C 13.507813 43 5 34.492188 5 24 C 5 13.507813 13.507813 5 24 5 C 34.492188 5 43 13.507813 43 24 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 35 C 19.738281 35 16.046875 32.554688 14.222656 29 L 17 29 L 13 24 L 9 29 L 12.019531 29 C 13.980469 33.691406 18.605469 37 24 37 C 30.132813 37 35.277344 32.722656 36.636719 27 L 34.574219 27 C 33.261719 31.609375 29.023438 35 24 35 Z "/>
                          <path style=" stroke:none;fill-rule:nonzero;fill:#3F51B5;fill-opacity:1;" d="M 24 13 C 28.261719 13 31.953125 15.445313 33.777344 19 L 31 19 L 35 24 L 39 19 L 35.980469 19 C 34.019531 14.308594 29.394531 11 24 11 C 17.867188 11 12.722656 15.277344 11.363281 21 L 13.425781 21 C 14.738281 16.390625 18.976563 13 24 13 Z "/>
                          </g>
                      </svg>
                    </div>
                    <div class="card-content center">
                      <span class="card-title activator grey-text text-darken-4" style="font-weight:bold">Liste de mes souscripteurs</span>
                      
                    </div>
                    </a>
              </div>
            </div>
             @endif
            @endauth
           @endif
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
  $('.slider').slider();
});
</script>
@endsection