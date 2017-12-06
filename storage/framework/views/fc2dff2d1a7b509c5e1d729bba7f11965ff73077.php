<?php $__env->startSection('title', 'Consorcio software.'); ?>
<?php $__env->startSection('content_header'); ?>
<html>
<head>
    <title>Biblioteca de <?php echo e(Auth::user()->name); ?></title>
    
</head>
<?php $__env->startSection('content'); ?>
<body>
<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div align="left" class="container">
    <a href="/profile">
        <img align="left" src="/uploads/avatars/<?php echo e(Auth::user()->avatar); ?>" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
    </a>  
    <h1><?php echo e(Auth::user()->name); ?> <small><?php echo e(Auth::user()->email); ?></small></h1>
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
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
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
    <li class="list-group-item">Registrado desde: <?php echo e(Auth::user()->created_at); ?></li>
    <li class="list-group-item">Cantidad de libros: <?php echo e($cantLibros[0]->cantidad); ?></li>
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
        <?php $__currentLoopData = $libros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $libros): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td> <?php echo e($libros->titulo); ?> </td>
                <td> <?php echo e($libros->descripcion); ?></td>
                <td> <?php echo e($libros->autor); ?> </td>
                <td> <img src="/uploads/portadas/<?php echo e($libros->portada); ?>" style="width:150px; height:150px; float:left; border-radius:40%; margin-right:25px;"></td>
                <td>
                <form action="/app/biblioteca/<?php echo e($libros->id); ?>"  method="POST">
                       <?php echo e(csrf_field()); ?>

                       <?php echo e(method_field('DELETE')); ?>

                       <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                     </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>