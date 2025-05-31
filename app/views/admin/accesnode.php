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

    <!--ModalListSub-->
    <div class="modal fade" id="modalList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalListLabel">Listado de Redes</h5>
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
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDatos2">
                            <!-- Datos dinámicos -->
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button id="btnAntModal" class="btn btn-primary">Anterior</button>
                        <span>Página <span id="paginaActualModal">1</span></span>
                        <button id="btnSigModal" class="btn btn-primary">Siguiente</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar Listado</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--ModalAddSub-->
    <div class="modal fade" id="modalNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog text-black">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaContLabel">Nueva suscripcion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3 text-black">
                        <input type="text" class="form-control" id="idCod" placeholder="Example" value="" disabled>
                        <label for="filtroCodig">Codigo de cliente</label>
                    </div>

                    <div class="form-floating mb-3 text-black">
                        <input type="date" class="form-control" id="idCod" placeholder="Example" >
                        <label for="filtroCodig">Fecha limite</label>
                    </div>

                    <!-- Buscador -->
                    <div class="mb-3">
                        <input type="text" id="filtroNombre2" class="form-control" placeholder="Filtrar por nombre (red)...">
                    </div>

                    <!-- Tabla -->
                    <table class="table table-warning">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Red</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDatos3">
                            <!-- Datos dinámicos -->
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button id="btnAntModalNew" class="btn btn-primary">Anterior</button>
                        <span>Página <span id="paginaActualModalNew">1</span></span>
                        <button id="btnSigModalNew" class="btn btn-primary">Siguiente</button>
                        <button type="button" class="btn btn-secondary" onclick="closeMod();">Cerrar Listado</button>
                    </div>
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

    <!-- Page-->
    <div class="container px-4 py-5" id="hanging-icons">
        <div>
            <h2 class="pb-2 border-bottom">Access Node</h2>
            <p>Permite administrar clientes del sistema, generar sus accesos, editar o eliminar registros, así como asignar, cancelar o dar de baja las suscripciones ademas de actualizar las fecha de suscripcion entre otras opciones.</p>
            <a href="http://devsllanten.com/admin/dasboard" class="btn btn-primary">
                Ir a Dasboard
            </a>
        </div>

        <h2 class="pb-2 py-4">Clientes</h2>
        <div class="form-floating mb-3 text-black">
            <input type="search" class="form-control" id="filtroCodig" placeholder="filtroCodig Example">
            <label for="filtroCodig">Buscar cliente (por codigo)</label>
        </div>

        <input type="button" class="text-end btn btn-primary" value="Buscar">
        <input type="button" class="text-end btn btn-secondary" value="Nuevo Mensaje" data-bs-toggle="modal" data-bs-target="#modalMessage">
        <div class="py-4 table-responsive">
            <table class="table" style="color: var(--bs-warning)">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Suscripcion</th>
                        <th scope="col">Opcion</th>
                    </tr>
                </thead>
                <tbody id="tablaDatos" class="text-white">
                    <!-- Datos dinámicos -->
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="d-flex justify-content-between align-items-center">
                <button id="btnAnteTable" class="btn btn-primary">Anterior</button>
                <span>Página <span id="paginaActualTable">1</span></span>
                <button id="btnSigTable" class="btn btn-primary">Siguiente</button>
            </div>
        </div>

    </div>

    <?php if (!empty($data['js'])): ?>
        <?php foreach ($data['js'] as $js): ?>
            <script src="<?= $js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>