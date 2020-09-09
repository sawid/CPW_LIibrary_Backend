  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="contact.php" class="nav-link">Contact</a>
          </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                  </button>
              </div>
          </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Language Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="flag-icon flag-icon-th"></i> TH 
              </a>
              <div class="dropdown-menu dropdown-menu-right p-0">
                  <a href="#" class="dropdown-item active">
                      <i class="flag-icon flag-icon-us mr-2"></i> English
                  </a>
                  <a href="#" class="dropdown-item">
                      <i class="flag-icon flag-icon-th mr-2"></i> ไทย
                  </a>
                  <a href="#" class="dropdown-item">
                      <i class="flag-icon flag-icon-fr mr-2"></i> French
                  </a>
                  <a href="#" class="dropdown-item">
                      <i class="flag-icon flag-icon-es mr-2"></i> Spanish
                  </a>
              </div>
          </li>
            
          <!-- Messages Dropdown Menu -->
          <li class="nav-item d-none d-sm-inline-block">
              <a class="nav-link" href="dist/php/sp_process_logout.php"><i class="fas fa-sign-out-alt"> </i> ลงชื่อออก </a>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->