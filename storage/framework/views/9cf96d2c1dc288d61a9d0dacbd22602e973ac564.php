<?php $__env->startSection('title', 'Consorcio software.'); ?>
<?php $__env->startSection('content_header'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/avatars/<?php echo e($user->avatar); ?>" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2><?php echo e($user->name); ?>'s Profile</h2>
            <form enctype="multipart/form-data" action="/profile" method="POST">
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="submit" class="btn btn-sm btn-primary">
            </form>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Agregar contactos</button>
            <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ingrese sus medios de contacto</h4>
                </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="profilen" method="POST">
                <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label for="example-text-input" class="col-2 col-form-label">Numero de contacto:</label>
                        <div class="col-5">
                        <input class="form-control" type="tel" name="numero_contacto" id="example-text-input">
                        </div>

                        <label for="example-text-input" class="col-2 col-form-label">Cuenta de facebook:</label>
                        <div class="col-5">
                        <input class="form-control" type="text" name="facebook" id="example-text-input">
                        </div>

                        <label for="example-text-input" class="col-2 col-form-label">Cuenta de instagram:</label>
                        <div class="col-5">
                        <input class="form-control" type="text" name="instagram" id="example-text-input">
                        </div>

                        <label for="example-text-input" class="col-2 col-form-label">Actualizar informacion</label>
                        <div class="col-10">
                        <input class="btn btn-success" type="submit"  id="example-text-input">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="list-group">
                <li class="list-group-item">Correo electronico: <?php echo e(Auth::user()->email); ?></li>
                <li class="list-group-item">numero de contacto: <?php echo e(Auth::user()->numero_contacto); ?></li>
                <a href="<?php echo e(Auth::user()->facebook); ?>">
                    <li class="list-group-item">facebook: <?php echo e(Auth::user()->facebook); ?></li>
                </a>
                <a href="<?php echo e(Auth::user()->instagram); ?>">
                    <li class="list-group-item">Cantidad de libros: <?php echo e(Auth::user()->instagram); ?></li>
                </a>
            </div>
        </div>
        
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>