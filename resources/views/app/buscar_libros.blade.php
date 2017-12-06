@extends('adminlte::page')
@section('title', 'buscar libros')
@section('content_header')


@section('content')
<div class="container col-md-10 col-md-offset-1">
            <form enctype="multipart/form-data" action="/app/buscar_libros" method="POST">
                <label>Buscar libro</label>
                <input type="text" name="titulo">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-sm btn-primary">
            </form>

</div>
<div class="container col-md-10 col-md-offset-1">
    <div class="row">
            <div class="">
        <table class="libros" id="libros">
        <thead>
            <th>Nombre</th>
            <th>Email</th>
            <th>numero de contacto</th>
            <th>Facebook </th>
            <th>Instagram</th>
            <th> portada </th>

        </thead>
        <tbody>
            @foreach($contacto as $contacto)
                <tr>
                    <td> {{ $contacto->name}} </td>
                    <td> {{ $contacto->email}} </td>
                    <td> {{ $contacto->numero_contacto}} </td>
                    <td> <a href="{{ $contacto->facebook }}"> {{ $contacto->facebook }} </a></td>
                    <td> <a href="{{ $contacto->instagram}}"> {{ $contacto->instagram}} </a></td>
                    <td> <img src="/uploads/portadas/{{ $contacto->portada }}" style="width:150px; height:150px; float:left; border-radius:40%; margin-right:25px;"></td>
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
        </div>
    </div>
</div>
@stop

