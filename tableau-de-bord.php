<?php require_once('templates/header.php'); ?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    <?php if (isset($_SESSION['id']))

{

    echo 'Bonjour ' . $_SESSION['id']["pseudo"];

}?>
                    </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class=" nav-item active">
                <a class="text-center nav-link" href="index.html">
                    <span>Tableau de bord</span></a>
            </li>
            <li class="text-center d-none d-md-inline">
            <a class="btn btn-success" href="index.html">Logout</a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <span>Ajouter un article</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#"> 
                    
                    <span>Listes des articles</span>
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
<?php require_once('formulaire-article.php'); ?>
                   

<p>liste des articles par id</p>
                   
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>

            </div>
        </div>
    </div>
    <?php require_once('list-articles.php'); ?>
<?php require_once('templates/footer.php'); ?>