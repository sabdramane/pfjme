@extends('template')

@section('contenu')
<br>
<div class="container">
            <div class="card z-depth-5" style="padding:20px">

                <div class="card-body" >
                    <h5>{{ __('CONNECTEZ-VOUS') }}</h5>
                    <hr>
                    <br><br>

                <form method="POST" action="{{ route('login') }}">
                        @csrf

                    <div class="row" style="margin-left:100px">
                            <div class="col s12 m4">
                                {!!Form::label('username', 'Nom d\'utilisateur', ['id' => 'labe']) !!}
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>  
                  
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                      </div>
                      <div class="row" style="margin-left:100px">
                            <div class="col s12 m4">
                                {!!Form::label('numCnib', 'Mot de passe', ['id' => 'labe']) !!}
                               <input id="password" type="password"  name="password" required >
                               
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                      </div>

                        <div class="row mb-0" style="margin-right:200px">
                            <div class="col s12 m4 right">
                                <button type="submit" class="btn btn-primary green right">
                                    {{ __('Connexion') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
@endsection
