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
                        <a class="nav-link" href="http://devsllanten.com/admin/dasboard">Dasboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link devLink" href="<?= $data['tokenLink']; ?>" id="acc" onclick="">Acces Node</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link devLink" href="<?= $data['tokenLink']; ?>" id="list" onclick="">List Dark</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button class="btn btn-outline-warning text-white" id="btnExit" type="button" onclick="salir()">Log out</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container px-4 py-5" id="hanging-icons">
        <h2 class="pb-2 border-bottom">Configuration</h2>
        <h2 class="pb-2 py-3">Mensajes</h2>
        <div class="form-floating mb-3 text-black">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Buscar Mensaje</label>
        </div>

        <input type="button" class="text-end btn btn-primary" value="Buscar">
        <input type="button" class="text-end btn btn-secondary" value="Nuevo Mensaje">

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
                        <td><button class="btn btn-sm btn-warning text-white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>La suscripcion ha sido realizada con exito</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td><button class="btn btn-sm btn-warning text-white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>La suscripcion ha sido cancelada</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td><button class="btn btn-sm btn-warning text-white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>La suscripcion ha sido reanudada con exito</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td><button class="btn btn-sm btn-warning text-white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>No has realizado una suscripcion</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td><button class="btn btn-sm btn-warning text-white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>La suscripcion se esta validando</td>
                        <td><span class="badge bg-primary">Suscripcion</span></td>
                        <td><button class="btn btn-sm btn-warning text-white">Editar</button></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <h2 class="pb-2 py-3">Endpoint</h2>
        <div class="form-floating mb-3 text-black">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Buscar Endpoint</label>
        </div>

        <input type="button" class="text-end btn btn-primary" value="Buscar">
        <input type="button" class="text-end btn btn-secondary" value="Nuevo Endpoint">

        <div class="py-4 table-responsive">
            <table class="table" style="color: var(--bs-warning)">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Url</th>
                        <th scope="col">Opcion</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <tr>
                        <th scope="row">1</th>
                        <td>Obtiene la List Dark</td>
                        <td>http://devsllanten.com/api/validateCode</td>
                        <td><button class="btn btn-sm btn-warning text-white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Valida el ingreso a Dasboard</td>
                        <td>http://devsllanten.com/api/validateLogin</td>
                        <td><button class="btn btn-sm btn-warning text-white">Editar</button></td>
                    </tr>
                </tbody>
            </table>
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

</body>

<?php if (!empty($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="<?= $js ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</html>