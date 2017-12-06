@extends('adminlte::page')
@section('title', 'Consorcio software.')
@section('content_header')
<html>
<head>
    <title>Biblioteca de {{ Auth::user()->name }}</title>
    
</head>
@section('content')
<body>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div align="left" class="container">
    <a href="/profile">
        <img align="left" src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
    </a>  
    <h1>{{ Auth::user()->name }} <small>{{ Auth::user()->email }}</small></h1>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Agregar nuevo libro</button>
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ingresar los datos del libro</h4>
        </div>
        <div class="modal-body">
            <form enctype="multipart/form-data" action="/app/biblioteca" method="POST">
            
                <div class="form-group">
                    <label for="example-text-input" class="col-2 col-form-label">Titulo del libro:</label>
                    <div class="col-5">
                    <input class="form-control" type="text" name="titulo" id="example-text-input">
                    </div>

                    <label for="example-text-input" class="col-2 col-form-label">Autor:</label>
                    <div class="col-5">
                    <input class="form-control" type="text" name="autor" id="example-text-input">
                    </div>

                    <label for="example-text-input" class="col-2 col-form-label">Descripcion:</label>
                    <div class="col-5">
                    <input class="form-control" type="text" name="descripcion" id="example-text-input">
                    </div>

                    <label for="example-text-input" class="col-2 col-form-label">Año de publicacion:</label>
                    <div class="col-5">
                    <input class="form-control" type="number" min="1800" max="2017" step="1" value="2016" name="year" id="example-text-input">
                    </div>

                    <label for="example-text-input" class="col-2 col-form-label">Año de publicacion:</label>
                    <div class="col-5">
                    <input type="file" name="portada">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>

                    <label for="example-text-input" class="col-2 col-form-label">Agregar libro</label>
                    <div class="col-10">
                    <input class="btn btn-success" type="submit"  id="example-text-input">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>

    </div>
  </div>
</div>


<div class="list-group">
    <li class="list-group-item">Registrado desde: {{ Auth::user()->created_at }}</li>
    <li class="list-group-item">Cantidad de libros: {{ $cantLibros[0]->cantidad }}</li>
    <li class="list-group-item">Generos preferidos: </li>
</div>


<table class="libros" id="libros">
    <thead>
        <th>Titulo</th>
        <th>Descipcion</th>
        <th>Autor</th>
        <th>Portada</th>
        <th> accion </th>

    </thead>
    <tbody>
        @foreach($libros as $libros)
            <tr>
                <td> {{ $libros->titulo }} </td>
                <td> {{ $libros->descripcion }}</td>
                <td> {{ $libros->autor }} </td>
                <td> <img src="/uploads/portadas/{{ $libros->portada }}" style="width:150px; height:150px; float:left; border-radius:40%; margin-right:25px;"></td>
                <td>
                <form action="/app/biblioteca/{{ $libros->id}}"  method="POST">
                       {{csrf_field()}}
                       {{method_field('DELETE')}}
                       <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                     </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
 <script>
    $(document).ready(function(){
    $('#libros').DataTable({
    });
});
 </script>
</body>
</html>
@stop