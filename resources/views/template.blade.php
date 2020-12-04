<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

          <!-- Bootstrap core CSS -->
        <!-- Compiled and minified CSS -->
        <link rel="shortcut icon" href="{{ asset('/image/favicon.ico') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="/materialize/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
       
        <title>Formation des jeunes @yield('titre')</title>
         @yield('header')
    </head>
    <body style="font-family:sans-serif;">
        <div class="container">
          <div class="row" style="margin-top: 20px;" >
              <div class="col s12 m12 l12" >
                <img class="responsive-img" src="{{ asset('/image/entete.jpg') }}" />
              </div>
           </div>
       
        </div>
          <nav class="green accent-4" role="navigation" style="height:40px;line-height:40px">
                  <div class="nav-wrapper container" >
                    <ul id="dropdown1" class="dropdown-content " style="height:40px;line-height:40px" >
                      @if (Route::has('login'))
                          @auth
                              @if((auth()->user()->role->abrege=="opera")||(auth()->user()->role->abrege=="superv"))
                      <li ><a href="{!!url('souscripteur/create') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">person_add</i>Souscrire</a></li>
                              @endif
                         @endauth
                      @endif
                      <li><a href="{!!url('souscripteurs/modification') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">edit</i>Modifier une souscription</a></li>
                      <li><a href="{!!url('souscripteurs/verification') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">search</i>Vérifier une souscription</a></li>
                      <li><a href="{!!url('souscripteurs/suivieDossier') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">autorenew</i>Suivre son dossier</a></li>
                      <li class="divider"></li>
                      <li><a href="{!! url('souscription/aide') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">help</i>Comment souscrire?</a></li>
                    </ul>

                    <ul class="left hide-on-med-and-down">
                        <li><a href="{!!url('/') !!}" style="font-size:15px"><i class="material-icons left" style="height:40px;line-height:40px;margin-right:10px">home</i>Accueil</a></li>
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1" style="font-size:15px">Souscription<i class="material-icons right" style="height:40px;line-height:40px;margin-left:10px">arrow_drop_down</i></a></li>
                        <li><a href="{!! url('projetFormation')!!}" style="font-size:15px">Formation 5000 jeunes</a></li>
                        <li><a href="{!!url('aneree') !!}" style="font-size:15px">ANEREE</a></li>
                        <li><a href="{!!url('espace/recruteur') !!}" style="font-size:15px">Recruteurs</a></li>
                    </ul>

                    
                    <ul class="right hide-on-med-and-down">
                       @if (Route::has('login'))
                       
                                @auth

                                    <ul id="dropdown4" class="dropdown-content ">
                                      <li><a href="{!!url('utilisateurs/modificationPassword') !!}" style="font-size:15px"><i class="material-icons left" style="margin-right:10px">mode_edit</i>Modifier mot de passe</a></li>
                                      <li><a href="{!!url('utilisateurs/modificationUsername') !!}" style="font-size:15px"><i class="material-icons left" style="margin-right:10px">edit</i>Changer nom d'utilisateur</a></li>
                                      @if(auth()->user()->role->abrege=="admin")
                                      <li><a href="{!!url('register') !!}" style="font-size:15px"><i class="material-icons left" style="margin-right:10px">person_add</i>Créer utilisateur</a></li>
                                      <li><a href="{!!url('utilisateurs') !!}" style="font-size:15px"><i class="material-icons left" style="margin-right:10px">list</i>Liste utilisateurs</a></li>
                                      @endif
                                      <li class="divider"></li>
                                      <li><a href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                                   document.getElementById('logout-form').submit();" style="font-size:15px">
                                                                   <i class="material-icons left" style="margin-right:10px">lock_outline</i>
                                                                   Déconnexion
                                          </a>
                                      </li>
                                    </ul>

                                     <li class="nav-item dropdown">
                                          <a  style="font-size:15px" href="#" role="button" >
                                              {{ Auth::user()->username}} <span class="caret"></span>
                                          </a>
                                      </li>
                                         <li>
                                              <a class="dropdown-trigger" href="#!" data-target="dropdown4" style="font-size:15px" >Mon Compte<i class="material-icons right" style="height:40px;line-height:40px">arrow_drop_down</i></a>
                                             

                                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                  @csrf
                                              </form>
                                          
                                        </li>
                                @else
                                    <li><a href="{{ route('login') }}" style="font-size:15px"><i class="material-icons left" style="height:40px;line-height:40px;margin-right:10px">lock</i>Connexion</a></li>
                                @endauth
                      @endif
                    </ul>
                    <ul id="dropdown2" class="dropdown-content ">
                      <li><a href="{!!url('souscripteur/create') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">person_add</i>Souscrire</a></li>
                      <li><a href="{!!url('souscripteurs/modification') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">edit</i>Modifier une souscription</a></li>
                      <li><a href="{!!url('souscripteurs/verification') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">search</i>Vérifier une souscription</a></li>
                      <li><a href="{!!url('souscripteurs/suivieDossier') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">autorenew</i>Suivre son dossier</a></li>
                      <li class="divider"></li>
                      <li><a href="{!! url('souscription/aide') !!}" style="font-size:15px"><i class="material-icons" style="margin-right:10px">help</i>Comment souscrire?</a></li>
                    </ul>
                    <ul id="nav-mobile" class="sidenav">
                        <li><a href="{!!url('/') !!}" style="font-size:15px"><i class="material-icons left" style="height:40px;line-height:40px;margin-right:10px">home</i>Accueil</a></li>
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown2" style="font-size:15px">Souscription<i class="material-icons right" style="margin-left:10px">arrow_drop_down</i></a></li>
                        <li><a href="{!! url('projetFormation')!!}" style="font-size:15px">Formation 5000 jeunes</a></li>
                        <li><a href="{!!url('aneree') !!}" style="font-size:15px">ANEREE</a></li>
                        <li><a href="{!!url('espace/recruteur') !!}" style="font-size:15px">Espace recruteurs</a></li>
                         @if (Route::has('login'))
                       
                                @auth
                                <ul id="dropdown3" class="dropdown-content ">
                                  <li><a href="{!!url('utilisateurs/modificationPassword') !!}" style="font-size:15px"><i class="material-icons left" style="margin-right:10px">mode_edit</i>Modifier mot de passe</a></li>
                                  <li><a href="{!!url('utilisateurs/modificationUsername') !!}" style="font-size:15px"><i class="material-icons left" style="margin-right:10px">edit</i>Changer nom d'utilisateur</a></li>
                                   @if(auth()->user()->role->abrege=="admin")
                                  <li><a href="{!!url('register') !!}" style="font-size:15px"><i class="material-icons left" style="margin-right:10px">person_add</i>Créer utilisateur</a></li>
                                  <li><a href="{!!url('utilisateurs') !!}" style="font-size:15px"><i class="material-icons left" style="margin-right:10px">list</i>Liste utilisateurs</a></li>
                                  @endif
                                  <li class="divider"></li>
                                  <li><a href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                               document.getElementById('logout-form').submit();" style="font-size:15px">
                                                               <i class="material-icons left" style="margin-right:10px">lock_outline</i>
                                                               Déconnexion
                                      </a>
                                  </li>
                                </ul>
                                     <li class="nav-item dropdown">
                                          <a id="navbarDropdown" class="nav-link dropdown-toggle"  style="font-size:15px" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                              {{ Auth::user()->username}} <span class="caret"></span>
                                          </a>
                                      </li>
                                      <li>
                                            <a class="dropdown-trigger" href="#!" data-target="dropdown3" style="font-size:15px">Mon Compte<i class="material-icons right">arrow_drop_down</i></a>
                                             

                                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                  @csrf
                                              </form>
                                          
                                    </li>
                                @else
                                    <li><a href="{{ route('login') }}" style="font-size:15px"><i class="material-icons left" style="height:40px;line-height:40px;margin-right:10px">lock</i>Connexion</a></li>
                                @endauth
                      @endif
                    </ul>
                    <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons" style="height:40px;line-height:40px">menu</i></a>
                  </div>
          </nav>
      
          <div>
                @yield('contenu')
          </div>
          <br><br><br>
  <footer class="page-footer green darken-4">
    <div class="container">
      <div class="row">
           <div class="col l3 s12">
          <h6 class="white-text" style="font-weight:bold"><a class="white-text" href="http://energie.bf" target="_blank" >MINISTERE DE L'ENERGIE</a></h6>
          <p class="grey-text text-lighten-4">
          Avenue de l´Indépendance, Koulouba, Ouagadougou<br>
          <br>
          Courriel: dcpm@energie.gov.bf<br>
          <br>
        <br>
       
        </p>
        </div>
        <div class="col l3 s12">
          <h6 class="white-text" style="font-weight:bold">ANEREE</h6>
          <p class="grey-text text-lighten-4">
          18 BP 212 Ouagadougou 18-Burkina Faso<br>
          Boulevard Muammar Kaddafi après l’échangeur Ouaga 2000,<br>
          1er immeuble à gauche avant WASCAL et IAM<br>
        Téléphone : +226 25 37 47 47 <br>
        Courriel : aneree.bf@gmail.com
        </p>
        </div>
        <div class="col l3 s12">
          <h6 class="white-text" style="font-weight:bold">PARTENAIRES</h6>
          <ul>
            <li><a class="white-text" href="https://bf.jobbooster-network.com/" target="_blank">Job booster</a></li>
            <li><a class="white-text" href="http://sonabel.bf" target="_blank" >SONABEL</a></li>
            <li><a class="white-text" href="#!">ABER</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h6 class="white-text" style="font-weight:bold">CONTACT</h6>
          <ul>
            <li><span class="white-text" href="#!">(+226) 58 83 35 45</span></li>
            <li><span class="white-text" href="#!">(+226) 53 58 10 45</span></li>
            <li><span class="white-text" href="#!">(+226) 54 82 03 36</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      © Copyright 2019, Tous droits réservés | Ministère de l'Energie Burkina Faso<span class="orange-text text-lighten-3 right">Conçue et développée intégralement par la DSI-ME</span>
      </div>
    </div>
  </footer>
              
          
       

         <!-- SCRIPTS -->
          <!-- JQuery -->
          <script src="{{ asset('/js/jquery-2.1.4.js') }}"></script>
          <script src="/materialize/js/materialize.min.js"></script>
          
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
          <script src="https://materializecss.com/docs/js/init.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
         
          @include('sweet::alert')
          @yield('scripts')

    </body>
</html>