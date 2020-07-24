@extends('adminlte::page')

@section('title', $title)

@section('content')
    <div class="row">
    	<div class="col-md-12">
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
                    <h3><i class="fa fa-tag"></i> {{ $title }}</h3>
                </div>
                <div class="card-body">
                    @if($type == 'new')
                        {!! Form::open(['url' => route('tags.store'), 'method' => 'POST', 'autocomplete' => 'off']) !!}
                    @else
                        {!! Form::open(['url' => route('tags.update',$data->id), 'method' => 'PUT', 'autocomplete' => 'off']) !!}
                    @endif
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="name" value="{{ @$data->name }}" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                        <a class="btn btn-danger" href="{{ route('tags.index') }}"><i class="fas fa-times"></i> Cancelar</a>
                    {!! Form::close() !!}
                </div>
            </div>
    	</div>
    </div>
@stop