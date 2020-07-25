@extends('adminlte::page')

@section('title', $title)

@section('content')
    <div class="row">
    	<div class="col-md-12">
            @include('flash::message')

             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

    		<div class="card card-success">
                <div class="card-header">
                    <h3><i class="fa fa-user-cog"></i> {{ $title }}</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'change_profile', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                        <div class="form-group">
                            <label>Nombre: </label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}" />
                        </div>
                        <div class="form-group">
                            <label>Correo: </label>
                            <input type="text" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}" />
                        </div>
                        <div class="form-group">
                            <label>Nombre de Tienda:</label>
                            <input type="text" name="shop_name" class="form-control" value="{{ Auth::user()->shop_name }}">
                        </div>
                        <div class="form-group">
                            <label>Telefono:</label>
                            <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="form-group">
                            <label>Region:</label>
                            <input type="text" name="region" class="form-control" value="{{ Auth::user()->region }}">
                        </div>
                        <div class="form-group">
                            <label>Ciudad:</label>
                            <input type="text" name="city" class="form-control" value="{{ Auth::user()->city }}">
                        </div>
                        <div class="form-group">
                            <label>Direccion:</label>
                            <textarea class="form-control" name="address">{{ Auth::user()->address }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Actualizar Perfil</button>
                    {!! Form::close() !!}
                </div>
            </div>
    	</div>

        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3><i class="fa fa-user-cog"></i> Cambiar Clave</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'change_password', 'method' => 'POST']) !!}
                        <div class="form-group">
                            <label>Nueva Clave: </label>
                            <input type="password" name="password" class="form-control" id="password" />
                        </div>
                        <div class="form-group">
                            <label>Repita Clave: </label>
                            <input type="password" name="password_confirm" class="form-control" id="password_confirm" />
                        </div>
                        <button type="submit" class="btn btn-success">Cambiar Clave</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script type="text/javascript">
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@stop