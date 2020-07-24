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
                    <h3><i class="fa fa-box"></i> {{ $title }}</h3>
                </div>
                <div class="card-body">
                    @if($type == 'new')
                        {!! Form::open(['url' => route('products.store'), 'method' => 'POST', 'autocomplete' => 'off', 'files' => true]) !!}
                    @else
                        {!! Form::open(['url' => route('products.update',$data->id), 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true]) !!}
                    @endif
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="name" value="{{ @$data->name }}" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Descripcion:</label>
                            <textarea type="text" name="description" class="form-control">{{ @$data->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Tags:</label>
                            <select class="form-control s2-multiple" name="tags[]" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option value='{{ $tag->id }}'>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto:</label>
                            <input type="file" name="photo" class="form-control" />
                            @if(!empty(@$data->photo))
                            <br />
                                <img src="{{ asset('storage/products/'.explode('/',@$data->photo)[2]) }}" style="width: 150px; height: 150px;" class="img-thumbnail">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Categoria:</label>
                            <select class="form-control" name="category_id">
                                <option value="">-</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(@$data->category_id == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unidad de Medida:</label>
                            <select class="form-control" name="uom_id">
                                <option value="">-</option>
                                @foreach($uoms as $uom)
                                    <option value="{{ $uom->id }}" @if(@$data->uom_id == $uom->id) selected="selected" @endif>{{ $uom->name }} ({{ $uom->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Precio:</label>
                            <input type="text" name="price" value="{{ @$data->prices }}" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                        <a class="btn btn-danger" href="{{ route('products.index') }}"><i class="fas fa-times"></i> Cancelar</a>
                    {!! Form::close() !!}
                </div>
            </div>
    	</div>
    </div>
@stop

@section('plugins.Select2', true)
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.s2-multiple').select2();

        @if($type == 'edit')
            $('.s2-multiple').val([@foreach($data->tags as $tag) '{{ $tag->id }}', @endforeach]);
        @endif
        $('.s2-multiple').trigger('change');
    });
</script>
@stop