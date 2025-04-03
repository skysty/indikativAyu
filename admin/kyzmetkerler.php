<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Қызметкерлер</title>
    <?php

		include('../incs/connect.php');

		

		session_start();
		$_SESSION['tutor'];
		$_SESSION['lang'];
		if(!isset($_SESSION['tutor'])){

			header('Location: ../login.php');

		}

	?>
    <link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script type="text/javascript">
            /* <![CDATA[ */
            /* Locale for JS */
            <?php require_once '../locale/jslocale.php'; ?>

            /* ]]> */
        </script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.2/sweetalert2.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/card.css">
</head>
<body>
<div class = "upper_header">
        <?php include '../extensions/header.php'?>
    </div>
    <div class = "header">
    <div id = "menu_nav">
        <?php include '../extensions/nav.php'?>
    </div>
</div>
<div class="container tasks-container">
    <div class="title  row">
        <div class="col-8">
            <h1 class="mt-5 mb-3">Қызметкерлер</h1>
        </div>
        <div class="col-4 text-right">
            <button class="btn btn-primary mb-3" onclick="openAddTaskModal()"><i class="fas fa-user-plus"> </i>
            </button>
        </div>
    </div>
    <div class="table-container">
        <table id="personalTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Толық аты-жөні</th>
                    <th>Жоғарғы бөлім</th>
                    <th>Бөлім</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Add Task Modal -->
<div class="modal fade" id="addTutorModal" tabindex="-1" role="dialog" aria-labelledby="addTutorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTutorModalLabel">Қызметкер қосу</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addTutorForm">
                    <div class="form-row custom-form-row">
                        <div class="form-group col-md-6">
                            <label for="TutorIIN">IIN</label>
                            <input type="text" class="form-control" id="TutorIIN" name="iin">
                            <span id="iinError" style="color: red;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastname">
                            <span id="lastNameError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstname">
                            <span id="firstNameError" style="color: red;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Patronymic">Patronymic</label>
                            <input type="text" class="form-control" id="Patronymic" name="patronymic">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                                <label for="BirthDate">BirthDate</label>
                                <input type="date" class="form-control" id="BirthDate" name="birthdate">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sex">Jynysy</label>
                            <select id="sex"  name="sex" class="js-example-basic-single form-control" style="width: 375px;">
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Phone">Phone</label>
                            <input type="text" class="form-control" id="Phone" name="phone">
                            <span id="phoneError" style="color: red;"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control" id="Email" name="email">
                            <span id="emailError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Faculty">Faculty</label>
                            <select id="Faculty"  name="Faculty" class="js-example-basic-single form-control" style="width: 375px;">
                                <!-- Options for Faculty -->
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Cafedra">Cafedra</label>
                            <select id="Cafedra" name="Cafedra"class="js-example-basic-single form-control" style="width: 375px;">
                                <!-- Options for Cafedra -->
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="akademikDareje">Ғылыми дәреже</label>
                            <select id="akademikDareje" name="akademikDareje" class="js-example-basic-single form-control" style="width: 375px;">
                                <!-- Options for Ғылыми дәреже -->
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="akademikKadrTipi">Қызметі</label>
                            <select id="akademikKadrTipi" name="akademikKadrTipi" class="js-example-basic-single form-control" style="width: 375px;">
                                <!-- Options for Қызметі -->
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="jumysTuru">jumys_turu</label>
                            <select id="jumysTuru" name="jumysTuru" class="js-example-basic-single form-control" style="width: 375px;">
                                <!-- Options for jumys_turu -->
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="workstatus">Штат саны</label>
                            <select id="workstatus"  name="workstatus" class="js-example-basic-single form-control" style="width: 375px;">
                                <!-- Options for Штат саны -->
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Сақтау</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Edit Task Modal -->
<div class="modal fade" id="editTutorModal" tabindex="-1" role="dialog" aria-labelledby="editTutorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTutorModalLabel">Өзгерту</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editTutorForm">
                    <input type="hidden" id="editTutorId" name="tutorId">
                    <div class="form-group">
                        <label for="editTutorIIN">IIN</label>
                        <input type="text" class="form-control" id="editTutorIIN" name="iin" required>
                    </div>
                    <div class="form-group">
                        <label for="editTutorFirstName">Firstname</label>
                        <input type="text" class="form-control" id="editTutorFirstName" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="editTutorLastName">LastName</label>
                        <input type="text" class="form-control" id="editTutorLastName" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="editTutorPatronymic">Patronymic</label>
                        <input type="text" class="form-control" id="editTutorPatronymic" name="patronymic" required>
                    </div>
                    <div class="form-group">
                        <label for="editTutorBirthDate">BirthDate</label>
                        <input type="date" class="form-control" id="editTutorBirthDate" name="birthdate" required>
                    </div>
                    <div class="form-group">
                        <label for="editTaskDescription">Description</label>
                        <textarea class="form-control" id="editTutorDescription" name="task_description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../extensions/scripts_admin.php'; ?>
</body>
</html>
