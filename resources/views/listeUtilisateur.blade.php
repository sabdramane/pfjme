@extends('template')

@section('contenu')
	<div class="container">
	  <div class="row">
			  <div class="col s12">
			  	<h4>Liste des utilisateurs</h4>
				  <table class="table">
		   				<thead>
		   					<tr>
		   						<th>N°</th>
		   						<th>Nom d'utilisateur</th>
		   						<th>Adresse email</th>
		   						<th>Rôle</th>
		   						<th>Action</th>
		   					</tr>
		   				</thead>
		   				<tbody>
		 			 @foreach($users as $user)
		 			 		<tr>
								<td>{!! $user->id !!}</td>
								<td>{!! $user->username !!}</td>
								<td>{!! $user->email !!}</td>
								<td>{!! $user->role->titre !!}</td>
								<td><a href="{!!url('utilisateurs/delete',$user->id) !!}" class="btn red" title="Supprimer cet utilisateur"><i class="material-icons" style="margin-right:10px">delete</i></a></td>
							</tr>
							@endforeach
						</tbody>
		 			</table>
		 			<div class="pagination right">
		 			{{ $users->links() }}
		 			</div>
			  </div>
			  

	  </div>
	</div>
@endsection

