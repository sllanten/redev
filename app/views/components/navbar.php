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
                        <a class="nav-link active" href="http://devsllanten.com/admin/dasboard">Dasboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link devLink" href="<?= $data['tokenLink']; ?>" id="acc" onclick="">Acces Node</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link devLink" href="http://devsllanten.com/admin/adminListDark">List Dark</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button class="btn btn-outline-warning text-white" id="btnExit" type="button" onclick="salir()">Log out</button>
                </div>
            </div>
        </div>
    </nav>