<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index1.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">VARS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['user_name']; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index1.php?pg=content.php" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                </li>
                <?php if($role_id=="R01" ||$role_id=="R02"  ){ ?>

                <li class="nav-item">
                    <a href="index1.php?pg=faculty.php&option=view" class="nav-link">
                        <i class="nav-icon fa fa-building"></i>
                        <p>
                            Faculty
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index1.php?pg=department.php&option=view" class="nav-link">
                        <i class="nav-icon fa fa-institution"></i>
                        <p> Department</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index1.php?pg=instruments.php&option=view" class="nav-link">
                        <i class="nav-icon fa fa-flask"></i>
                        <p> Equipments</p>
                    </a>
                </li> <?php } ?>
                <li class="nav-item">
                    <a href="index1.php?pg=reservation.php&option=view" class="nav-link">
                        <i class="nav-icon fa fa-calendar-check-o" aria-hidden="true"></i>
                        <p> Reservation</p>
                    </a>
                </li>
                <?php if($role_id=="R01" ||$role_id=="R02"  ){ ?>
                <li class="nav-item">
                    <a href="index1.php?pg=reserv_confirm.php&option=view" class="nav-link">
                        <i class="nav-icon fa fa-check-square"></i>
                        <p> Reservation Confirm</p>
                    </a>
                </li>
                <?php 
                if($role_id=="R01")
                { ?>
                <li class="nav-item">
                    <a href="index1.php?pg=staff.php&option=view" class="nav-link">
                        <!-- <i class="nav-icon 	fa fa-id-badge"></i> -->
                        <i class="nav-icon fa fa-group"></i>
                        <p> Staff Management</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="index1.php?pg=researchers.php&option=view" class="nav-link">
                        <i class="nav-icon fa fa-mortar-board"></i>
                        <p> Researchers</p>
                    </a>
                </li> 
                

                <?php
            }
             } ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Reports
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index1.php?pg=report.php&option=reservation_report" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reservation Reports</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reserchers Reports</p>
                            </a>
                        </li> -->

                    </ul>
                </li>



                <!-- <li class="nav-item">
                    <a href="index1.php?pg=sync.php" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>sync </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p>Logout </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">

                        <p> </p>
                    </a>
                </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>