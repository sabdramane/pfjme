            @auth
                  @if(Auth::user()->role->abrege=="admin")
                 <div class="col s12 m3">
                      <div class="card">
                          <a href="souscripteurs/liste">
                          <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="image/liste.jpg">
                          </div>
                          <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Liste souscripteurs</span>
                            
                          </div>
                          </a>
                      </div>
                  </div>

                @endif
            @endauth