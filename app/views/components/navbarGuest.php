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