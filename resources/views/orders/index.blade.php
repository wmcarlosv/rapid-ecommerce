@extends('adminlte::page')

@section('title', $title)

@section('content')
    <div class="row">
    	<div class="col-md-12">
    		@include('flash::message')
    		<div class="card card-success">
    			<div class="card-header"><h3><i class="fa fa-file-invoice"></i>  {{ $title }}</h3></div>
    			<div class="card-body">
		    		<table class="table table-bordered table-striped">
		    			<thead>
		    				<th>ID</th>
		    				<th>Nombre Cliente</th>
		    				<th>Correo Cliente</th>
		    				<th>Telefono Cliente</th>
		    				<th>Monto Total</th>
		    				<th>Leido?</th>
		    				<th>-</th>
		    			</thead>
		    			<tbody>
		    				@foreach($data as $order)
		    					<tr>
		    						<td>{{ $order->id }}</td>
		    						<td>{{ $order->customer_name }}</td>
		    						<td>{{ $order->customer_email }}</td>
		    						<td>{{ $order->customer_phone }}</td>
		    						<td>{{ $order->total }}</td>
		    						<td>

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
	});
</script>
@stop