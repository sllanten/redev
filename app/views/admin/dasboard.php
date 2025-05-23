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

    <!-- Dasboard-->
    <div class="container px-4 py-5" id="hanging-icons">
        <h2 class="pb-2 border-bottom">Panel Administrativo</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start">
                <div>
                    <h2>Configuration</h2>
                    <p>A través de esta opción, el administrador puede acceder a la configuración general para realizar ajustes clave. Permite modificar parámetros operativos del sistema, gestionar mensajes del entorno.</p>
                    <a href="http://devsllanten.com/admin/adminConf" class="btn btn-primary">
                        Ir a Configuration
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h2>Access Node</h2>
                    <p>Permite administrar clientes del sistema, generar sus accesos, editar o eliminar registros, así como asignar, cancelar o dar de baja las suscripciones ademas de actualizar las fecha de suscripcion entre otras opciones </p>
                    <a href="#" class="btn btn-primary">
                        Ir a Access Node
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h2>List Dark</h2>
                    <p>La opción List Dark permite gestionar redes del sistema. Desde aquí se puede actualizar la información de redes existentes, registrar nuevas conexiones o eliminar redes no deseadas ademas de reportar fallos.</p>
                    <a href="http://devsllanten.com/admin/adminListDark" class="btn btn-primary">
                        Ir a List Dark
                    </a>
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

</body>

<?php if (!empty($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="<?= $js ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</html>