@extends('template')

@section('contenu')
<div class="container">
  <h4 class="blue-text">Modifier votre nom d'utilisateur</h4>
     {!!Form::model($user, ['route' => ['updateUsername', $user->id], 'method' => 'put'])!!}
      <div class="row">
            <div class="col s12 m4" >
                {!!Form::label('username', 'Nouveau Nom d\'utilisateur:',['class'=>'form-control','id' => 'labe']) !!}
                {!! Form::text('username','') !!}  
                @if($errors->has('username'))
                    <small>{{ $errors->first('username') }}</small>
                @endif  
            </div>
      </div>
        <div style="margin-left:300px">
             {!!Form::submit('Valider!',['class'=>'waves-effect waves-light btn btn-large','id' => 'boutonbtn']) !!}
        </div>
          
      {!!Form::close() !!}
</div>
@endsection
