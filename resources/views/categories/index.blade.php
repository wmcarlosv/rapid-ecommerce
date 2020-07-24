@extends('adminlte::page')

@section('title', $title)

@section('content')
    <div class="row">
    	<div class="col-md-12">
    		@include('flash::message')
    		<div class="card card-success">
    			<div class="card-header"><h3><i class="fa fa-file"></i>  {{ $title }}</h3></div>
    			<div class="card-body">
    				<a class="btn btn-success" href="{{ route('categories.create') }}"><i class="fas fa-check-circle"></i> Nueva Categoria</a>
		    		<br />
		    		<br />
		    		<table class="table table-bordered table-striped">
		    			<thead>
		    				<th>ID</th>
		    				<th>Nombre</th>
		    				<th>-</th>
		    			</thead>
		    			<tbody>
		    				@foreach($data as $category)
		    					<tr>
		    						<td>{{ $category->id }}</td>
		    						<td>{{ $category->name }}</td>
		    						<td>
		    							<a class="btn btn-info" href="{{ route('categories.edit',$category->id) }}"><i class="fas fa-pencil-alt"></i></a>
		    							{!! Form::open(['url' => route('categories.destroy',$category->id), 'method' => 'DELETE', 'style' => 'display:inline !important;', 'class' => 'delete-row']) !!}
		    								<button class="btn btn-success" type="submit"><i class="fas fa-times"></i></button>
		    							{!! Form::close() !!}
		    						</td>
		    					</tr>
		    				@endforeach
		    			</tbody>
		    		</table>
    			</div>
    		</div>
    	</div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('js')
<script type="text/javascript">
	$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	$(document).ready(function(){
		$("table").DataTable();

		$(".delete-row").submit(function(){
			if(!confirm("Estas Seguro de Eliminar este Registro!!")){
				return false;
			}
		});
	});
</script>
@stop