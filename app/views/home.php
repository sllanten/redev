<!doctype html>
<html>

<head>
    <title><?= $data['title']; ?></title>
    <link rel="icon" type="image/png" href="https://images.icon-icons.com/4242/PNG/512/bnb_crypto_icon_264371.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <?php if (!empty($data['css'])): ?>
        <?php foreach ($data['css'] as $style): ?>
            <link rel="stylesheet" href="<?= $style ?>">
        <?php endforeach; ?>
    <?php endif; ?>

</head>

<body class="bg-dark text-white">
    <br>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="#" class="text-decoration-none navbar-brand"">
                <i class=" bi bi-code-square me-1"></i> Devsllanten
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $data['tokenLink']; ?>" class="colorWarnin" id="sub" onclick="">Suscripcion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $data['tokenLink']; ?>" class="disabled" id="list" onclick="test(event);">List Dark</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <input id="cod" name="cod" class="form-control me-2" type="password" placeholder="Code">
                    <button class="btn btn-outline-warning text-white" id="btnSend" type="button" onclick="sendCode();">Trigger</button>
                </div>
            </div>
        </div>
    </nav>

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
    <div class="modal fade" id="modaCont" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
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
                                <th scope="col">id</th>
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

</body>

<?php if (!empty($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="<?= $js ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</html>