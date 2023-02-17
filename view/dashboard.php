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
    <a class="navbar-brand ps-3" href="/drpciv/index.php?page=dashboard">DRPCIV</a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
               aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/drpciv/index.php?page=profile">Profile</a></li>
                <li>
                    <hr class="dropdown-divider"/>
                </li>
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
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                       aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Optiuni Bot
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/drpciv/index.php?page=SetCrawlerParameters">Crawler
                                    Settings</a>
                            </nav>

                        </nav>
                    </div>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php echo $_SESSION['name'] ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Admin Dashboard</h1>
                <div class="col-xl-3 col-md-4" id="antiCaptchaBox">
                    <div  class="card bg-success text-white mb-4" >
                        <div class="card-footer d-flex align-items-center justify-content-between" id="antiCaptchaDiv">
                            <?php
                            echo " Anti-Captcha : Mai aveti disponibil " . number_format((float)$antiCaptcha, 2, '.', '') . '$';
                            ?>
                        </div>
                    </div>
                </div>


                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Statistici in timp real</li>
                </ol>

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Adauga o noua lista cu rezervari</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <form action="/drpciv/index.php?page=upload" method="POST" enctype="multipart/form-data"
                                      id="uploadForm"
                                ">
                                <label class="form-label" for="customFile"></label>
                                <input type="file" class="form-control" id="customFile" name="uploadFile">
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="0" id="flexCheckChecked"
                                           name="deleteRecords" onclick="validate()">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Sterge inregistrarile vechi
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary" onclick=" return IsInputFileEmpty()">
                                    Upload
                                </button>


                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">


                        <?php if(isset($pid)) { ?>
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Opreste Botul</div>
                            <?php } else { ?>
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Porneste Botul</div>
                                <?php } ?>
                                <?php if (isset($pid)) { ?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="col text-center">
                                            <form action="/drpciv/index.php?page=CrawlerControl" method="get">
                                                <button type="submit" class="btn btn-danger">Stop</button>
                                                <input type="hidden" name="page" value="CrawlerControl"/>
                                                <input type="hidden" name="state" value="0"/>
                                            </form>
                                        </div>

                                    </div>
                                <?php } else { ?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                        <div class="col text-center">
                                            <form action="/drpciv/index.php?page=CrawlerControl" method="get">
                                                <input type="hidden" name="page" value="CrawlerControl"/>
                                                <input type="hidden" name="state" value="1"/>
                                                <button type="submit" class="btn  btn-success">Start</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                    </div>

                    <div class="card mb-4">

                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Lista cu rezervari &nbsp;

                            <button type="button" id="editButton"  class="btn btn-success btn-sm btn pull-right" data-toggle="modal"
                            data-target="#addModal"  >Adauga Inregistrare
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                <tr>
                                    <th>Nume</th>
                                    <th>Prenume</th>
                                    <th>VIN</th>
                                    <th>Data Dorita</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                foreach ($results as $row) { ?>

                                    <tr class="item-model-number">
                                        <td id="numeTd"
                                            value=<?php echo $row['id'] ?> name="nume"><?php echo $row['nume']?></td>
                                        <td id="prenumeTd"
                                            name="prenume"><?php echo $row['prenume'] ?></td>
                                        <td id="vinTd" name="vin"><?php echo $row['VIN'] ?></td>
                                        <td id="dataTd" name="data"><?php echo $row['data'] ?></td>
                                        <td style="display:none;" id="category" name="category"><?php echo $row['category'] ?></td>
                                        <td>
                                            <button type="button" id="editButton"  value=<?php echo $row['id']  ?> class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#editModal" onclick="PopulateModal()">Edit
                                            </button>

                                            <button type="button" id="deleteButton"  value=<?php echo $row['id']?> class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal" onclick="PopulateDeleteField()">Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                            <!-- Modal -->
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
<script type="text/javascript">
    function validate() {
        if (document.getElementById('flexCheckChecked').checked) {
            document.getElementById("flexCheckChecked").value = 1;

        } else {
            document.getElementById("flexCheckChecked").value = 0;

        }
    }
</script>


<script>
    var file = document.getElementById("customFile");

    function IsInputFileEmpty() {
        if (file.files.length == 0) {
            console.log("0");
            alert("Nici un fisier selectat");
            return false;
            // } else {
            //     document.getElementById("uploadForm").submit();
            // }
        }
    }
</script>

<script>


</script>
<script type="text/javascript">

    // //do your stuff, you can use $(this) to get current cell
    function PopulateModal() {


        $("#datatablesSimple").on('click','#editButton',function(){
            // get the current row

            var currentRow=$(this).closest("tr");

            var col0=currentRow.find("td:eq(0)").attr("value");
            var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
            var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
            var col3=currentRow.find("td:eq(2)").text(); // get current row 3rd TD
            var col4=currentRow.find("td:eq(3)").text(); // get current row 3rd TD
            var col5=currentRow.find("td:eq(4)").text();
            $(".modal-body #recordId").attr("value", col0);
            $(".modal-body #nume").attr("value", col1);
            $(".modal-body #prenume").attr("value", col2);
            $(".modal-body #vin").attr("value", col3);
            $(".modal-body #data").attr("value", col4);
            $(".modal-body #categorie").val(col5).selected=true;
        });

    }
    function PopulateDeleteField(){
        $("#datatablesSimple").on('click','#deleteButton',function(){
            // get the current row

            var currentRow=$(this).closest("tr");

            var col0=currentRow.find("td:eq(0)").attr("value");

            $(".modal-body #recordId").attr("value", col0);
        });
    }

</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="addModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4>
                        Adauga Inregistrare Noua
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="/drpciv/index.php?page=addRecord" method="POST">
                        <div class="form-group">
                            <label for="nume">Nume</label>
                            <input type="text" class="form-control" placeholder="Nume" id="Addnume" name="Addnume" required>
                        </div>
                        <div class="form-group">
                            <label for="prenume">Prenume</label>
                            <input type="text" class="form-control" placeholder="Prenume" id="Addprenume" name="Addprenume" required>
                        </div>
                        <div class="form-group">
                            <label for="vin">VIN</label>
                            <input type="text" class="form-control" placeholder="Serie Sasiu" id="Addvin" name="Addvin" maxlength="17" required>
                        </div>
                        <div class="form-group">
                            <label for="data">Data</label>
                            <input type="text" class="form-control" placeholder="2020-10-27" id="Adddata" name="Adddata" required>
                        </div>
                        <div class="form-group">
                            <select class="form-select" aria-label="Selecteaza Categoria" name="categorie">
                                <option selected>Selecteaza Categoria</option>
                                <option value="16">Autorizare-provizorie-numere roșii</option>
                                <option value="8">Inmatriculare-vehicul-neînmatriculat-in-România</option>

                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Adauga</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>


<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="editModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4>
                        Editeaza inregistrarea
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="/drpciv/index.php?page=editRecord" method="POST">
                        <input type="hidden" id="recordId" name="recordId" value="">
                        <div class="form-group">
                            <label for="nume">Nume</label>
                            <input type="text" class="form-control" placeholder="Nume" id="nume" name="nume" required>
                        </div>
                        <div class="form-group">
                            <label for="prenume">Prenume</label>
                            <input type="text" class="form-control" placeholder="Prenume" id="prenume" name="prenume" required>
                        </div>
                        <div class="form-group">
                            <label for="vin">VIN</label>
                            <input type="text" class="form-control" placeholder="Serie Sasiu" id="vin" name="vin" required>
                        </div>
                        <div class="form-group">
                            <label for="data">Data</label>
                            <input type="text" class="form-control" placeholder="Data" id="data" name="data" required>
                        </div>
                        <div class="form-group">
                            <select class="form-select" aria-label="Selecteaza Categoria" name="categorie" id="categorie">
                                <option selected>Selecteaza Categoria</option>
                                <option value="16">Autorizare-provizorie-numere roșii</option>
                                <option value="8">Inmatriculare-vehicul-neînmatriculat-in-România</option>

                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Editeaza</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>


<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4>
                        Sterge inregistrarea
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <p>Sigur vrei sa stergi ?</p>
                    <form action="/drpciv/index.php?page=deleteRecord" method="POST">
                        <input type="hidden" id="recordId" name="recordId" value="">

                        <button type="submit" class="btn btn-danger">Da, sterge !</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Nu,renunta !</button>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
