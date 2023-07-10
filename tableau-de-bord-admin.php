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
                    <span>Tableau de bord Administrateur</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <span>Afficher tout les utilisateurs</span>
                </a>
            </li>
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



<?php require_once('list-users.php'); ?>       
<?php require_once('formulaire-article.php'); ?>
<?php require_once('list-articles.php'); ?>
<?php require_once('templates/footer.php'); ?>