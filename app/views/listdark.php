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
                        <a class="nav-link devLink" href="http://devsllanten.com/admin/dasboard">Dasboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link devLink" href="<?= $data['tokenLink']; ?>" id="acc" onclick="">Acces Node</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="http://devsllanten.com/admin/adminListDark">List Dark</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button class="btn btn-outline-warning text-white" id="btnExit" type="button" onclick="salir()">Log out</button>
                </div>
            </div>
        </div>
    </nav>

    <!--ModalRed-->
    <div class="modal fade" id="modalRed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRedLabel">Nueva Red</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="newName" placeholder="Red Example">
                        <label for="newName">Red</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="newPass" placeholder="Red Example">
                        <label for="newPass">Contraseña</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="text" value="2025-07-05" class="form-control" id="newPass" placeholder="Red Example" disabled readonly>
                        <label for="newPass">Fecha de registro</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!--ModalEditRed-->
    <div class="modal fade" id="modalEditRed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditRedLabel">Endpoint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="newName" placeholder="Red Example">
                        <label for="newName">Red</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="newPass" placeholder="Red Example">
                        <label for="newPass">Contraseña</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="newPass" placeholder="Red Example" disabled readonly>
                        <label for="newPass">Fecha de registro</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!--ModalDelete-->
    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Devsllanten Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Seguro de eliminar</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
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

    <!-- Page-->
    <div class="container px-4 py-5" id="hanging-icons">
        <div>
            <h2 class="pb-2 border-bottom">List Dark</h2>
            <p>La opción List Dark permite gestionar redes del sistema. Desde aquí se puede actualizar la información de redes existentes, registrar nuevas conexiones o eliminar redes no deseadas ademas de reportar fallos.</p>
            <a href="http://devsllanten.com/admin/dasboard" class="btn btn-primary">
                Ir a Dasboard
            </a>
        </div>

        <h2 class="pb-2 py-4">Red</h2>
        <div class="form-floating mb-3 text-black">
            <input type="search" class="form-control" id="searchMessage" placeholder="SearchMessage Example">
            <label for="searchMessage">Buscar Red</label>
        </div>

        <input type="button" class="text-end btn btn-primary" value="Buscar">
        <input type="button" class="text-end btn btn-secondary" value="Nueva Red" data-bs-toggle="modal" data-bs-target="#modalRed">
        <div class="py-4 table-responsive">
            <table class="table" style="color: var(--bs-warning)">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Red</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Fecha Regisro</th>
                        <th scope="col">Fecha Modificada</th>
                        <th scope="col">Opcion</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <tr>
                        <th scope="row">1</th>
                        <td>redAdmin</td>
                        <td>test</td>
                        <td>2025-05-04</td>
                        <td>2025-07-04</td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditRed">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>redAdmin2</td>
                        <td>test</td>
                        <td>2025-05-04</td>
                        <td>2025-05-04</td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditRed">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>redGuest</td>
                        <td>test3</td>
                        <td>2025-05-04</td>
                        <td>2025-05-04</td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditRed">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>redGUest2</td>
                        <td>test4</td>
                        <td>2025-05-04</td>
                        <td>2025-05-04</td>
                        <td colspan="2">
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditRed">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Paginación -->
            <div class="d-flex justify-content-between align-items-center">
                <button id="anterior" class="btn btn-primary">Anterior</button>
                <span>Página <span id="paginaActual">1</span></span>
                <button id="siguiente" class="btn btn-primary">Siguiente</button>
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