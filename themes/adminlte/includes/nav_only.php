
          <li class="nav-item">
          <?php echo '<a href="' . _ROOT_URL_ . '/modules/sales/view_dashboard.php"  class="nav-link active">'; ?>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Invoice
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
              <?php 
                echo '<a href="' . _ROOT_URL_ . '/modules/sales/view_sales_invoice.php" class="nav-link active">';
              ?>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print Invoice</p>
                </a>
              </li>
              <li class="nav-item">
              <?php 
                echo '<a href="' . _ROOT_URL_ . '/modules/sales/sales_invoice.php" class="nav-link active">';
              ?>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit Invoice</p>
                </a>
              </li>
              <li class="nav-item">
              <?php 
                echo '<a href="' . _ROOT_URL_ . '/modules/sales/sales_invoice_items.php" class="nav-link active">';
              ?>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit Item</p>
                </a>
              </li>
            </ul>

          </li>

          <li class="nav-item">
              <?php 
                echo '<a href="' . _ROOT_URL_ . '/modules/accounts/cashbook.php" class="nav-link active">';
              ?>
              <i class="nav-icon fas fa-book"></i>
              <p>
                Cash Book
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
              <?php 
                echo '<a href="' . _ROOT_URL_ . '/modules/sales/reports.php" class="nav-link active">';
              ?>
              <i class="nav-icon fas fa-table"></i>
              <p>
                Reports
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
          <!-- PLANNER -->
          <li class="nav-item">
              <?php 
                echo '<a href="' . _ROOT_URL_ . '/modules/planner/" class="nav-link active">';
              ?>
              <i class="nav-icon fas fa-book"></i>
              <p>
                Planner
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <!-- ./PLANNER -->

          <li class="nav-item">
              <?php 
                echo '<a href="' . _ROOT_URL_ . '/modules/user/user.php?editid=' . @$_SESSION['user_id'] . '" class="nav-link active">';
              ?>
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>  