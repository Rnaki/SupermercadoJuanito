<style>
    .modal-content {
        max-width: 85%;
    }

    div .edi {
        background-color: gold;
        color: honeydew;
        margin-bottom: 15px;
        padding: 20px 30px;
    }

    div .modal-content .form label {
        color: #212529;
        margin-bottom: 0px;
        font-size: 14px;
    }

    div .c {
        margin-bottom: 12px;
    }

    div .modal-body {
        padding: 20px 30px;
    }

    .modal .modal-footer .btn-warning {
        color: rgb(255, 255, 255);
    }

    div .modal-footer {
        background: #ecf0f1;
    }
</style>

<div class="modal fade" id="edicionexampleModal<?php echo $row['rut']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header edi">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="updatePersonal.php" method="POST">
                <input type="hidden" name="rut" value="<?php echo $row['rut'] ?>">
                <div class="modal-body">
                    <div class="form-group form">
                        <div class="form-group">
                            <label>Rut: </label>
                            <input type="text" class="form-control c" name="nombre" required value="<?php echo $row['rut'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nombre: </label>
                            <input type="text" class="form-control c" name="nombre" required value="<?php echo $row['nombre'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Apellido Paterno: </label>
                            <input type="text" class="form-control c" name="apellidoP" required value="<?php echo $row['apellidop'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Apellido Materno: </label>
                            <input type="text" class="form-control c" name="apellidoM" required value="<?php echo $row['apellidom'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Region: </label>
                            <input type="text" class="form-control c" name="region" required value="<?php echo $row['region'] ?>" maxlength="32">
                        </div>
                        <div class="form-group">
                            <label>Comuna: </label>
                            <input type="text" class="form-control c" name="comuna" required value="<?php echo $row['comuna'] ?>" maxlength="32">
                        </div>
                        <div class="form-group">
                            <label>Calle: </label>
                            <input type="text" class="form-control c" name="calle" required value="<?php echo $row['calle'] ?>" maxlength="32">
                        </div>
                        <div class="form-group">
                            <label>Nª Calle: </label>
                            <input type="text" class="form-control c" name="ncalle" required value="<?php echo $row['ncalle'] ?>" maxlength="32">
                        </div>
                        <div class="form-group">
                            <label>Fecha Nacimiento: </label>
                            <input type="text" class="form-control c" name="fechaNacimiento" required value="<?php echo $row['fechanacimiento'] ?>">
                        </div>
                        <label>Sexo: </label>
                        <br>
                        <select class="form-select" name="sexo" id="sexoupdate<?php echo $row['rut'] ?>">
                            <option value="Hombre" id="Hombre">Hombre</option>
                            <option value="Mujer" id="Mujer">Mujer</option>
                            <option value="Otros" id="Otros">Otros</option>
                        </select>
                        <br>
                        <div class="form-group">
                            <label>Contraseña: </label>
                            <input type="text" class="form-control c" name="Contraseña" required value="<?php echo $row['contraseña'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Correo: </label>
                            <input type="text" class="form-control c" name="Correo" required value="<?php echo $row['correo'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Teléfono: </label>
                            <input type="text" class="form-control c" name="Telefono" required value="<?php echo $row['teléfono'] ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#sexoupdate<?php echo $row['rut'] ?> option[id="<?php echo $row['sexo'] ?>"]').attr("selected", true);
        //$('#sexoupdate option[id="'+$info['compañia']+'"]').attr("selected", true);
    </script>
</div>