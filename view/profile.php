
<!DOCTYPE html>
<html lang="en">

<?php

require __DIR__ . '/../include/header.php';
?>


<?

?>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/drpciv/index.php?page=dashboard">Dashboard</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Profile</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="/drpciv/index.php?page=logout">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="/drpciv/index.php?page=dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Options</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Options
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                DRPCIV
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/drpciv/index.php?page=SetCrawlerParameters">Crawler Settings</a>
                                </nav>
                            </div>

                        </nav>
                    </div>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
               <?php
               echo $_SESSION['name'];
               ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Admin Profile</h1>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Adauga Utilizator
                            </div>
                            <div class="card-body">
                                <form action="/drpciv/index.php?page=register" method="POST">
                                    <label>Username</label>
                                    <div class="form-group pass_show">
                                        <input type="text" value="" class="form-control" placeholder="Doina" name="username">
                                    </div>
                                    <label>Password</label>
                                    <div class="form-group pass_show">
                                        <input type="password" value="" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    <label>Email</label>
                                    <div class="form-group pass_show">
                                        <input type="text" value="" class="form-control" placeholder="test@gmail.com" name="email">
                                    </div>
                                    <br>
                                    <div class="form-group pass_show">
                                        <button type="submit" class="btn btn-primary mb-4">Change password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Schimba parola pentru utilizatorul actual
                            </div>
                            <div class="card-body">
                                <form action="/drpciv/index.php?page=changePass" method="POST">
                            <label>Current Password</label>
                            <div class="form-group pass_show">
                                <input type="password" value="" class="form-control" placeholder="Current Password" name="current_password">
                            </div>
                            <label>New Password</label>
                            <div class="form-group pass_show">
                                <input type="password" value="" class="form-control" placeholder="New Password" name="new_password">
                            </div>
                            <label>Confirm Password</label>
                            <div class="form-group pass_show">
                                <input type="password" value="" class="form-control" placeholder="Confirm Password">

                                <br>
                                <button type="submit" class="btn btn-primary mb-4">Change password</button>
                            </div>
                                    <?php if($_REQUEST['changed']==true) {?>
                                    <div>

                                        <h4> Password Changed !!!</h4>
                                    </div>
                                    <?php }?>

                                </form>
                        </div>
                        </div>
                    </div>
                </div>


            </div>
        </main>
        <?php

        require __DIR__ . '/../include/footer.php';
        ?>
    </div>
</div>
<?php

require __DIR__ . '/../include/scripts.php';
?>
</body>
</html>
