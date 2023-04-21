<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= BASE_URL . "/home" ?>">
      <i class="fab fa-github fa-2x mx-3 ps-1"></i>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">Pull request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Issues</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Marketplace</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Explore</a>
        </li>
      </ul>
      <ul class="navbar-nav d-flex flex-row ms-auto me-3">
        <li class="nav-item me-3 me-lg-0 dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="<?php 
            $today=date('Y-m-d H:i');
            if (file_exists(("./public/img/profile/" . $_SESSION['user'] . ".jpg"))){
              echo BASE_URL_PUB . "/img/profile/" . $_SESSION['user'] . ".jpg" . "?lm=" . $today;
            } else {
              echo BASE_URL_PUB . "/img/profile/default.jpg";
            }
            ?>" class="rounded-circle img-cropped" height="25"
              alt="" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
            <li><a class="dropdown-item profile-a" data-bs-toggle="modal" data-bs-target="#profileModal" href="#">Profile</a></li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li>
              <a class="dropdown-item" href="<?= BASE_URL. "/login/logout"?>">Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar -->

