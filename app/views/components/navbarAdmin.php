    <?php
    $indexed = [];
    foreach ($endpoints as $row) {
        $indexed[$row['id']] = $row;
    }
    $appData = [
        'getCliente' => $indexed[8]['url'],
        'getSubs' => $indexed[3]['url'],
        'getLisDark' => $indexed[9]['url'],
        'deleteLisDark' => $indexed[10]['url'],
        'createLisDark' => $indexed[11]['url'],
        'updateLisDark' => $indexed[12]['url']
    ];
    ?>
    <script>
        window.AppData = <?= json_encode($appData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    </script>
    <br>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="<?= $data['tokenLink']; ?>" class="text-decoration-none navbar-brand"">
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
                        <a class="nav-link" href="http://devsllanten.com/admin/adminAcces">Acces Node</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://devsllanten.com/admin/adminListDark">List Dark</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button class="btn btn-outline-warning text-white" id="btnExit" type="button" onclick="salir()">Log out</button>
                </div>
            </div>
        </div>
    </nav>