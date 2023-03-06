  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <?php 
        // TOP NAVIGATION BAR
        foreach ($navbar_menus as $key => $value) {
          echo '<li class="nav-item d-none d-sm-inline-block">';
          echo "<a href='$value' class='nav-link'>$key</a>";
          echo '</li>';
        }
      ?>
    </ul>

    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?= strtoupper(_COMPANY_); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" align="center">
        <div class="info">
          <a href="#" class="d-block"> <?= strtoupper(_PRODUCT_); ?> </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <?php 
            // SIDE NAVIGATION BAR
            foreach ($sidebar_menus as $sidebar_menu => $sidebar_menu_url) {
              if (is_array($sidebar_menu_url)) {
                // sidebar menu which has child menu
                echo '<li class="nav-item has-treeview menu-close">';
                  echo "<a href='#' class='nav-link active'>";
                    echo '<i class="nav-icon fas fa-copy"></i>';
                    echo "<p>";
                      echo "$sidebar_menu";
                      echo '<i class="right fas fa-angle-left"></i>';
                    echo "</p>";
                  echo '</a>';
                  echo '<ul class="nav nav-treeview">';
                    foreach ($sidebar_menu_url as $submenu => $submenu_url) {
                      $submenu_url = _ROOT_URL_ . "/index.php/" . $submenu_url;
                      echo '<li class="nav-item">';
                        echo "<a href='$submenu_url' class='nav-link active'>";
                          echo '<i class="nav-icon far fa-circle"></i>';
                          echo "<p>";
                          echo "$submenu";
                          // echo '<span class="right badge badge-danger">New</span>';
                          echo "</p>";
                        echo '</a>';
                      echo '</li>';
                    }//endforeach inner
                  echo '</ul>';
                echo '</li>';
              } else {
                  $sidebar_menu_url = _ROOT_URL_ . "/index.php/" . $sidebar_menu_url;
                  // normal sidebar menu
                  echo '<li class="nav-item">';
                    echo "<a href='$sidebar_menu_url' class='nav-link active'>";
                      echo '<i class="nav-icon fas fa-tachometer-alt"></i>';
                      echo "<p>$sidebar_menu</p>";
                      // echo '<span class="right badge badge-danger">New</span>';
                    echo '</a>';
                  echo '</li>';
              }//endif-else
            }//endforeach outer

          ?>

          <?php
          /*
            if (CP_Tools::logedin()) {
              echo '<li class="nav-item">';
              echo '<a href="' . _ROOT_URL_ . '/modules/user/login.php?e=logout" class="nav-link">';
              echo '<i class="nav-icon fas  fa-power-off"></i>';
              echo '<p>Logout -> ' . $_SESSION['username'] . '</p>';
              echo '  </a></li>';
            }
          */
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

