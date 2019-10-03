<form action="{{ route('usuarios.destroy', $usuario->id) }}" method="post" style="display: inline-block;">
	
	@method('DELETE')
	@csrf
	<button type="submit" class="btn btn-danger">ELIMINAR</button>
</form>