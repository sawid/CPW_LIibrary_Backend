<?php
$dataPeople   = getdataDetailUser($conn, $user_id);
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar  elevation-4 sidebar-light-maroon sidebar-no-expand">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="dist/img/CPWLibraryLOGO.png" alt="CPWLibrary Logo" class="brand-image " style="opacity: .8">
        <span class="brand-text font-weight-light"><b>CPW</b>Library</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $dataPeople['image'];?>" class="img--circle elevation-2"
                    style=" width:2.1rem;  height:2.1rem;  object-fit:cover;object-position: top; border-radius:50%;"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $dataPeople['info_title'].$dataPeople['name'];?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a id="dashboard" href="index.php" class="nav-link" title="Dashboard">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>

                <li class="nav-header">ADMINISTRATION SYSTEM</li>
                <li class="nav-item">
                    <a id="member_library" href="member.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Library Member</p>
                    </a>

                </li>
                <!-- <li class="nav-header">Book Management</li> -->
                <li class="nav-item">
                    <a id="book_library" href="book.php" class="nav-link">
                        <i class=" nav-icon fas fa-box"></i>
                        <p>Library Book Storage</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a id="loan_book" href="loan_book.php" class="nav-link" title="Loan Book">
                        <i class="nav-icon fas fa-qrcode"></i>
                        <p>
                            Loan Book
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="return_book" href="return_book.php" class="nav-link" title="Return Book">
                        <i class="nav-icon fas fa-undo  "></i>
                        <p>
                            Return Book
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                  <!-- <li class="nav-item">
                    <a id="book_library" href="#" class="nav-link">
                        <i class="nav-icon fas fa-book-medical"></i>
                        <p>Insert New Book</p>
                    </a>

                </li> -->
                <!-- <li id="ml_h" class="nav-item has-treeview">
                    <a id="member_library" href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Member Library
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a id="member_search" href="member.php" class="nav-link">
                                <i class="far nav-icon fas fa-address-book"></i>
                                <p>Member Search</p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a id="member_profile" href="profile.php" class="nav-link">
                                <i class="far fas fa-user nav-icon"></i>
                                <p>Member Profile</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.0" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Documentation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>Level 1</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Level 1
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Level 2</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Level 2
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Level 2</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>Level 1</p>
                    </a>
                </li>
               
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>