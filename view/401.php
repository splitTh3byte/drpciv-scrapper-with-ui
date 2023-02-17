<!DOCTYPE html>
<html lang="en">

<?php

require __DIR__ . '/../include/header.php';
?>
    <body>
        <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center mt-4">
                                    <h1 class="display-1">401</h1>
                                    <p class="lead">Unauthorized</p>
<!--                                    <p>User sau parola gresite .</p>-->
                                    <a href="/drpciv/index.php?page=dashboard">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Return to Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutError_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <?php  echo date('Y')?></div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php

        require __DIR__ . '/../include/scripts.php';
        ?>
    </body>
</html>
