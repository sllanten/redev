<!doctype html>
<html>

<head>
    <title><?= $data['title']; ?></title>
    <link rel="icon" type="image/png" href="https://images.icon-icons.com/4242/PNG/512/bnb_crypto_icon_264371.png">

    <!-- Componente-->
    <?= $component['head'] ?? '' ?>

    <?php if (!empty($data['css'])): ?>
        <?php foreach ($data['css'] as $style): ?>
            <link rel="stylesheet" href="<?= $style ?>">
        <?php endforeach; ?>
    <?php endif; ?>

</head>

<body class="bg-dark text-white">

    <!-- Componente-->
    <?= $component['nav'] ?? '' ?>

    <!--ModalMessages-->
    <div class="modal fade" id="modalMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMessageLabel">Nuevo Mensage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="newMessage" placeholder="Message Example">
                        <label for="newMessage">Mensaje</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="selectType">
                            <option selected>Seleccione</option>
                            <option value="1">Sistema</option>
                            <option value="2">Suscripcion</option>
                        </select>
                        <label for="selectType">Indique el tipo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!--ModalEndpoint-->
    <div class="modal fade" id="modalEndpoint" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEndpointLabel">Nuevo Endpoint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="newNombre" placeholder="Nombre Example">
                        <label for="newNombre">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="newDescription" placeholder="Description Example">
                        <label for="newDescription">Descripcion</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="newUrl" placeholder="Url Example">
                        <label for="newUrl">Url</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!--ModalEditMessage-->
    <div class="modal fade" id="modalEditMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditMessageLabel">Editar Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="editMessage" placeholder="Message Example">
                        <label for="editMessage">Mensaje</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="EditselectType">
                            <option selected>Seleccione</option>
                            <option value="1">Sistema</option>
                            <option value="2">Suscripcion</option>
                        </select>
                        <label for="EditselectType">Indique el tipo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!--ModalEditEndpoint-->
    <div class="modal fade" id="modalEditEndpoint" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditEndpointLabel">Editar Endpoint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="editNombre" placeholder="Nombre Example">
                        <label for="editNombre">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="editDescription" placeholder="Description Example">
                        <label for="editDescription">Descripcion</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="editUrl" placeholder="Url Example">
                        <label for="editUrl">Url</label>
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
            <h2 class="pb-2 border-bottom">Configuration</h2>
            <p>A través de esta opción, el administrador puede acceder a la configuración general para realizar ajustes clave. Permite modificar parámetros operativos del sistema, gestionar mensajes del entorno.</p>
            <a href="http://devsllanten.com/admin/dasboard" class="btn btn-primary">
                Ir a Dasboard
            </a>
        </div>

        <h2 class="pb-2 py-4">Mensajes</h2>
        <div class="form-floating mb-3 text-black">
            <input type="search" class="form-control" id="searchMessage" placeholder="SearchMessage Example">
            <label for="searchMessage">Buscar Mensaje</label>
        </div>

        <input type="button" class="text-end btn btn-primary" value="Buscar">
        <input type="button" class="text-end btn btn-secondary" value="Nuevo Mensaje" data-bs-toggle="modal" data-bs-target="#modalMessage">
        <div class="py-4 table-responsive">
            <table class="table" style="color: var(--bs-warning)">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Tipó</th>
                        <th scope="col">Opcion</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <tr>
                        <th scope="row">1</th>
                        <td>Welcome guest, enjoy!</td>
                        <td><span class="badge bg-secondary">Sistema</span></td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditMessage">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>La suscripcion ha sido realizada con exito.</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditMessage">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>La suscripcion ha sido cancelada.</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditMessage">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>La suscripcion ha sido reanudada con exito.</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditMessage">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>No tienes activa una suscripcion.</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td colspan="2">
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditMessage">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>La suscripcion se esta validando.</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditMessage">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>La suscripcion esta pronto a finalizar,para renovarla ingresa a la pestaña Suscripcion.</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditMessage">Editar</button>
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

        <h2 class="pb-2 py-3">Endpoint</h2>
        <div class="form-floating mb-3 text-black">
            <input type="search" class="form-control" id="searchEndpoint" placeholder="SearchEndpoint Example">
            <label for="searchEndpoint">Buscar Endpoint</label>
        </div>
        <input type="button" class="text-end btn btn-primary" value="Buscar">
        <input type="button" class="text-end btn btn-secondary" value="Nuevo Endpoint" data-bs-toggle="modal" data-bs-target="#modalEndpoint">
        <div class="py-4 table-responsive">
            <table class="table" style="color: var(--bs-warning)">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Url</th>
                        <th scope="col">Opcion</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <tr>
                        <th scope="row">1</th>
                        <td>validateCode</td>
                        <td>Obtiene la list Dark</td>
                        <td class="text-break">http://devsllanten.com/api/validateCode</td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditEndpoint">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>createSubs</td>
                        <td>Genera la Suscripcion</td>
                        <td class="text-break">http://devsllanten.com/api/createSubs</td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditEndpoint">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>getSubs</td>
                        <td>Optiene las Suscripciones</td>
                        <td class="text-break">http://devsllanten.com/api/getSubs</td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditEndpoint">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>validateLogin</td>
                        <td>Valida el ingreso al Dasboard</td>
                        <td class="text-break">http://devsllanten.com/api/validateLogin</td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditEndpoint">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>getMessage</td>
                        <td>Obtiene todos los Mensajes</td>
                        <td class="text-break">http://devsllanten.com/api/getMessage</td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditEndpoint">Editar</button>
                            &nbsp
                            <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>getEndpoint</td>
                        <td>Obtiene los EndPoint</td>
                        <td class="text-break">http://devsllanten.com/api/getEndpoint</td>
                        <td>
                            <button class="devBtn btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditEndpoint">Editar</button>
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