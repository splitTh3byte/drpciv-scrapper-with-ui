<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<?php

require __DIR__ . '/../include/header.php';
?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="/drpciv/index.php?page=login" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="name@example.com" name="username">
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password">
                                                <label for="inputPassword">Password</label>
                                            </div>
<!--                                            <div clasls="form-check mb-3">-->
<!--                                                    <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" name="rememberMe" onclick="validate()">-->
<!--                                                    <label cass="form-check-label" for="inputRememberPassword">Remember Password</label>-->
<!--                                            </div>-->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
<!--                                                <a class="small" href="password.php">Forgot Password?</a>-->
                                                <a></a>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy;  <?php  echo date('Y')?></div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php

        require __DIR__ . '/../include/scripts.php';
        ?>
        <script type="text/javascript">
            function validate() {
                if (document.getElementById('inputRememberPassword').checked) {
                    document.getElementById("inputRememberPassword").value = 1;

                } else {
                    document.getElementById("inputRememberPassword").value = 0;

                }
            }
        </script>

    </body>
