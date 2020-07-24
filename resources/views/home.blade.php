@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fas fa-file-invoice"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Ordenes</span>
                <span class="info-box-number">{{ $orders }}</span>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-blue"><i class="fas fa-box"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Productos</span>
                <span class="info-box-number">{{ $products }}</span>
              </div>
            </div>
        </div> 
        <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fas fa-file"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Categorias</span>
                <span class="info-box-number">{{ $categories }}</span>
              </div>
            </div>
        </div>  
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<div class="card card-success">
    			<div class="card-header">
    				<h3><i class="fa fa-inbox"></i> Ordenes sin Leer</h3>
    			</div>
    			<div class="card-body">
    				<table class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Nombre Cliente</th>
                            <th>Correo Cliente</th>
                            <th>Telefono Cliente</th>
                            <th>Monto Total</th>
                        </thead>
                        <tbody>
                            
                        </tbody>            
                    </table>
    			</div>
    		</div>
    	</div>
    </div>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop