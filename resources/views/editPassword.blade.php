@extends('template')

@section('contenu')
<div class="container">
  <h4 class="blue-text">Modifier votre mot de passe</h4>

    @isset($erreur)
            <small style="color:red;font-size:18px">{{ $erreur }}</small>
    @endisset
     {!!Form::model($user, ['route' => ['updatePassword', $user->id], 'method' => 'put'])!!}
      <div class="row">
            <div class="col s12 m4" >
                {!!Form::label('password_old', 'Ancien mot de passe:',['class'=>'form-control','id' => 'labe']) !!}
                {!! Form::password('password_old') !!}  
                @if($errors->has('password_old'))
                    <small>{{ $errors->first('password_old') }}</small>
                @endif  
            </div>
      </div>
      <div class="row">
            <div class="col s12 m4" >
                {!!Form::label('password_new', 'Nouveau mot de passe:',['class'=>'form-control','id' => 'labe']) !!}
                {!! Form::password('password_new') !!}  
                @if($errors->has('password_new'))
                    <small>{{ $errors->first('password_new') }}</small>
                @endif  
            </div>
      </div>
      <div class="row">
            <div class="col s12 m4" >
                {!!Form::label('password_new', 'Confirmer mot de passe:',['class'=>'form-control','id' => 'labe']) !!}
                {!! Form::password('password_new_confirmation') !!}  
                @if($errors->has('password_new_confirmation'))
                    <small>{{ $errors->first('password_new_confirmation') }}</small>
                @endif  
            </div>
      </div>
        <div style="margin-left:300px">
             {!!Form::submit('Valider!',['class'=>'waves-effect waves-light btn btn-large','id' => 'boutonbtn']) !!}
        </div>
          
      {!!Form::close() !!}
</div>
@endsection
