<style>
    div .modal-dialog .eli{
        padding: 20px 30px;
        background-color: rgb(202, 15, 15);
        color: ivory;
    }

    div .modal-footer .btn-danger{
        background-color: rgb(202, 15, 15);
    }

    div .cuadro{
        padding-bottom: 0px;
    }

    div .fuente label{
        padding-top: 12px;
        color: #212529;
        font-size: 15px;
    }
</style>

<div class="modal fade" id="eliminarexampleModal<?php echo $row['rut'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header eli">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body cuadro">
                    <div class="form-group fuente">
                        <label>¿Estas seguro que quieres eliminar al cliente <b><?php echo $row['nombre']." ". $row['apellidop']." ". $row['apellidom'];?></b>?</label>
                        <div style="height:16px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="eliminarCliente.php?rut=<?php echo $row['rut'] ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>