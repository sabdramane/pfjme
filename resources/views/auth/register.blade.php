@extends('template')

@section('contenu')
<div class="container">
  <h4 class="blue-text">Enregistrer un utilisateur</h4>
     {!!Form::open(['url' => 'register']) !!}
      <div class="row">
            <div class="col s12 m4" >
                {!!Form::label('username', 'Nom d\'utilisateur:',['class'=>'form-control','id' => 'labe']) !!}
                {!! Form::text('username') !!}  
                @if($errors->has('username'))
                    <small>{{ $errors->first('username') }}</small>
                @endif  
            </div>
      </div>
       <div class="row">
            <div class="col s12 m4" >
                {!!Form::label('email', 'Adresse email:',['class'=>'form-control','id' => 'labe']) !!}
                {!! Form::text('email') !!}  
                @if($errors->has('email'))
                    <small>{{ $errors->first('email') }}</small>
                @endif  
            </div>
      </div>
      <div class="row">
            <div class="col s12 m4" >
                {!!Form::label('password', 'Mot de passe:',['class'=>'form-control','id' => 'labe']) !!}
                {!! Form::password('password') !!}  
                @if($errors->has('password'))
                    <small>{{ $errors->first('password') }}</small>
                @endif  
            </div>
      </div>
      <div class="row">
            <div class="col s12 m4" >
                {!!Form::label('password', 'Confirmer mot de passe:',['class'=>'form-control','id' => 'labe']) !!}
                {!! Form::password('password_confirmation') !!}  
                @if($errors->has('password_confirmation'))
                    <small>{{ $errors->first('password_confirmation') }}</small>
                @endif  
            </div>
      </div>

      <div class="row">
            <div class="col s12 m4" >
                {!!Form::label('role', 'Rôle:',['id' => 'labe']) !!}
             <select name="role" id="role" class="browser-default">
                    <option value=""></option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->titre }}</option>
                    @endforeach
             </select>
            @if($errors->has('role'))
                <small>{{ $errors->first('role') }}</small>
            @endif  
         </div>
      </div>
        <div style="margin-left:300px">
             {!!Form::submit('Valider!',['class'=>'waves-effect waves-light btn btn-large','id' => 'boutonbtn']) !!}
        </div>
          
      {!!Form::close() !!}
</div>
@endsection
