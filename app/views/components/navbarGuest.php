<?php
$indexed = [];
foreach ($endpoints as $row) {
    $indexed[$row['id']] = $row;
}
$appData = [
    'validateCode' => $indexed[1]['url']
];
?>
<script>
    window.AppData = <?= json_encode($appData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
</script>
<br>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="#" class="navbar-brand text-decoration-none">
            <i class="bi bi-code-square me-1"></i> Devsllanten
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a id="sub" class="nav-link colorWarnin" href="<?= $data['tokenLink']; ?>" data-bs-toggle="modal" data-bs-target="#modalSus">Suscripción</a>
                </li>
                <li class="nav-item">
                    <a id="list" class="nav-link disabledLink" href="<?= $data['tokenLink']; ?>" onclick="test(event);">List Dark</a>
                </li>
            </ul>
            <div class="d-flex">
                <input id="cod" name="cod" class="form-control me-2" type="password" placeholder="Code">
                <button id="btnSend" class="btn btn-outline-warning text-white" type="button" onclick="sendCode();">Trigger</button>
            </div>
        </div>
    </div>
</nav>