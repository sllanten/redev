<!doctype html>
<html>

<head>
    <title><?= $data['title']; ?></title>
    <link rel="icon" type="image/png" href="https://images.icon-icons.com/4242/PNG/512/bnb_crypto_icon_264371.png">

    <!-- Componente-->
    <?= $component['head'] ?? '' ?>

</head>

<body class="bg-dark text-white">

    <!-- Componente-->
    <?= $component['nav'] ?? '' ?>

    <div class="ajust py-5 container">
        <h1 class="typewriter">
            <?= $data['textInfo']; ?>
        </h1>
    </div>

    <div class="container">
        <input type="button" class="oculto btn btn-danger text-white whithBtn" id="btnExit" value="Exit" onclick="exitApp();">
    </div>

    <!-- infoToast-->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="infoToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img class="logo rounded me-2"
                    src="https://images.icon-icons.com/4242/PNG/512/bnb_crypto_icon_264371.png" alt="logo">
                <strong class="me-auto"><?= $data['title']; ?></strong>
                <small>Informacion</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-black">
                <label id="toastLabel"></label>
            </div>
        </div>
    </div>

    <!--ModalConte-->
    <div class="modal " id="modalCont" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaContLabel">Listado de Redes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Buscador -->
                    <div class="mb-3">
                        <input type="text" id="filtroNombre" class="form-control" placeholder="Filtrar por nombre (red)...">
                    </div>

                    <!-- Tabla -->
                    <table class="table table-warning">
                        <thead>
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Red</th>
                                <th scope="col">Pass</th>
                                <th scope="col">Actualizada</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDatos">
                            <!-- Datos dinámicos -->
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button id="anterior" class="btn btn-primary">Anterior</button>
                        <span>Página <span id="paginaActual">1</span></span>
                        <button id="siguiente" class="btn btn-primary">Siguiente</button>
                        <button type="button" class="btn btn-secondary" onclick="closeMod();">Cerrar Listado</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--ModalSub-->
    <div class="modal " id="modalSus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaContLabel">RedDev</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="py-3">
                        Para completar tu suscripción a RedDev, solo necesitamos que nos compartas tu nombre y un número de celular de contacto.
                        De esta manera podremos activar tu acceso de forma segura y mantenerte informado sobre las novedades de la plataforma.
                    </label>
                    <label>
                        <input type="checkbox" value="remember-me" id="term">
                        Acepto los términos y condiciones así como el uso de datos personales.
                    </label>

                    <br><br>
                    <div id="datos" class="d-none">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nameSub" placeholder="text example">
                            <label for="nameSub">Ingresa Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="celSub" placeholder="number example">
                            <label for="celSub">Ingresa Numero celular</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="valiSub()">Enviar</button>
                </div>
            </div>
        </div>
    </div>

</body>

<?php if (!empty($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="<?= $js ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</html>