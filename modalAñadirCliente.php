<style>
    .modal-content {
        max-width: 85%;
    }

    div .aña {
        background-color: forestgreen;
        color: honeydew;
        margin-bottom: 15px;
        padding: 20px 30px;
    }

    div .c {
        margin-bottom: 12px;
    }

    div form div {
        padding: 20px 30px;
    }

    div form label {
        color: #212529;
        margin-bottom: 0px;
        font-size: 14px;
    }

    div .modal-footer {
        background: #ecf0f1;
    }

    div form .btn-default {
        background-color: gray;
    }

    div .modal-footer .b1 {
        padding: 2px 12px;
    }

    div form .btn-success {
        background-color: forestgreen;
        font-size: 30px;
    }

    div form h6 {
        font-size: 16px;
        margin-top: 8px;
    }
</style>

<div class="modal fade" id="añadirexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header aña">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="insertarCliente.php" method="POST">
                <div>
                    <label>Rut: </label>
                    <input type="text" class="form-control mb-3 c" required="required" id="rutAgregar" name="rut" placeholder="Rut" maxlength="10">
                    <label>Nombre: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="nombre" placeholder="Nombre" maxlength="32">
                    <label>Apellido Paterno: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="apellidoP" placeholder="Apellido Paterno" maxlength="32">
                    <label>Apellido Materno: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="apellidoM" placeholder="Apellido Materno" maxlength="32">
                    <label>Región: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="region" placeholder="Region" maxlength="32">
                    <label>Comuna: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="comuna" placeholder="Comuna" maxlength="32">
                    <label>Calle: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="calle" placeholder="Calle" maxlength="32">
                    <label>Nº Calle: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="nCalle" placeholder="N° Calle" maxlength="32">
                    <label>Fecha Nacimiento: </label>
                    <input type="date" class="form-control mb-3 c" required="required" name="fechaNacimiento" placeholder="Fecha Nacimiento">
                    <label>Sexo: </label>
                    <br>
                    <select class="form-select" name="sexo" id="sexo">
                        <option selected>Seleccione...</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <br>
                    <label>Contraseña: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="Contraseña" placeholder="Contraseña" maxlength="12">
                    <label>Correo: </label>
                    <input type="email" class="form-control mb-3 c" required="required" name="Correo" placeholder="Correo" maxlength="64">
                    <label>Teléfono: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="Telefono" placeholder="Telefono" maxlength="16">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary b1" data-bs-dismiss="modal">
                        <h6>Cancelar</h6>
                    </button>
                    <button type="submit" onclick="return validarRut();" class="btn btn-success b1">
                        <h6>Añadir</h6>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>