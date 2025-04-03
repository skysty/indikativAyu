<?php 
session_start();
$login = $_SESSION['tutor'];
include('../incs/connect.php');

if(!isset($_SESSION['tutor'])){
    header('Location: ../login.php');
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ОПҚ-ға қайта рұқсат беру</title>

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- material icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="bg-light">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom" style="position: sticky !important;
    top: 0 !important; z-index : 99999 !important;">
        <div class="container-fluid container">
            <a class="navbar-brand btn btn-primary ms-md-4 text-white" href="index.php">Басты бет</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link active text-sm-start text-center" aria-current="page" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-sm-start text-cente" href="#"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <!-- form tambah mahasiswa -->



        <!-- judul tabel -->
        <h5 class="mb-3">ОПҚ тізімі</h5>

        <div class="row my-3">
            <div class="col-md-2 mb-3">
                <select class="form-select" aria-label="Пример выбора по умолчанию">
                    <option selected>ОПҚ тізімі</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col-md-3 ms-auto">
                <div class="input-group mb-3 ms-auto">
                    <input type="text" class="form-control" placeholder="Бірдеңе іздеу..." aria-label="іздеу" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>


        <!-- показать сообщение успешно удалено -->
        <?php if (isset($_GET['delete'])) : ?>
            <?php
            if ($_GET['delete'] == 'success')
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Сәтті!</strong> Деректер сәтті өзгертілді!
                        <button type='button' class='btn-close' onclick='clicking()' data-bs-dismiss='alert' aria-label='Закрыть'></button>
                      </div>";
            else
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Упс!</strong> Қәте !
                        <button type='button' class='btn-close' onclick='clicking()' data-bs-dismiss='alert' aria-label='Закрыть'></button>
                      </div>";
            ?>
        <?php endif; ?>

        <!-- показать сообщение об успешном редактировании -->
        <?php if (isset($_GET['update'])) : ?>
            <?php
            if ($_GET['update'] == 'success')
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Сіз рұқсат беріп қойғансыз!</strong> !
                        <button type='button' class='btn-close' onclick='clicking()' data-bs-dismiss='alert' aria-label='Закрыть'></button>
                      </div>";
            else
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Упс!</strong> Не удалось обновить данные!
                        <button type='button' class='btn-close' onclick='clicking()' data-bs-dismiss='alert' aria-label='Закрыть'></button>
                      </div>";
            ?>
        <?php endif; ?>

        <!-- tabel -->
        <div class="table-responsive mb-5 card">
            <?php
            echo "<div class='card-body'>";

            echo "<table class='table table-hover align-middle bg-white'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col' class='text-center'>№</th>";
            echo "<th scope='col'>Кафедра/ҒЗИ</th>";
            echo "<th scope='col'>Аты жөні</th>";
            echo "<th scope='col'>Көрсеткіш</th>";
            echo "<th scope='col'>Саны</th>";
            echo "<th scope='col'>Автор саны</th>";
            echo "<th scope='col'>Файл аты</th>";
            echo "<th scope='col'>Қайтару себебі</th>";
            echo "<th scope='col' class='text-center'>Құралдар</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";



            $limit = 10;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $home_page = ($page > 1) ? ($page * $limit) - $limit : 0;

            $previous = $page - 1;
            $next = $page + 1;
            $sql = "SELECT COUNT(*) as total, tutors.TutorID as tutid FROM engbekter
            INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
            INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
            INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
            INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
            INNER JOIN status ON status.statusID = engbekter.kod_stat Where korsetkishter.jauapty = '$login' AND  statusID=4 AND kayt_sebeb IS NOT NULL ";
            $data =mysqli_fetch_assoc(mysqli_query($connection, $sql));
            $amount_of_data = $data['total'];
            $iduser = $data['tutid'];
            $total_page = ceil($amount_of_data / $limit);
            $sql1 = "SELECT tutors.TutorID,tutors.dostup, korsetkishter.dos_id, korsetkishter.kod_korsetkish, engbekter.engbekID, engbekter.dostup_id,tutors.exist, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.ball, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ 
            FROM engbekter
            INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
            INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
            INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
            INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
            INNER JOIN status ON status.statusID = engbekter.kod_stat Where korsetkishter.jauapty = '$login' AND  statusID=4 AND kayt_sebeb IS NOT NULL LIMIT $home_page, $limit";
            $data_mhs = mysqli_query($connection, $sql1);
            $no = $home_page + 1;
            $sql2 = "SELECT *
            FROM korsetkishter k
            JOIN dostupkorset dost ON k.kod_korsetkish=dost.korsetkishID
            JOIN tutors t ON dost.tutorID = t.TutorID
            where k.jauapty='$login' LIMIT $home_page, $limit";
            $data_mhs2 = mysqli_query($connection, $sql2);
            // $sql = "SELECT * FROM student";
            // $query = mysqli_query($db, $sql);


            while ($row = mysqli_fetch_array($data_mhs2)) {
                echo "<tr>";
                echo "<td style='display:none'>" . $row['kod_korsetkish'] . "</td>";
                echo "<td style='display:none'>" . $row['TutorID'] . "</td>";
                echo "<td class='text-center'>" . $no++ . "</td>";
                echo "<td>рұқсат берілді</td>";
                echo "<td>" .$row["lastname"]." ".$row["firstname"]. "</td>";
                echo "<td>" .$row["korsetkish_ati"]. "</td>";
                echo "<td>рұқсат берілді</td>";
                echo "<td>рұқсат берілді</td>";
                echo "<td>рұқсат берілді</td>";
                echo "<td>рұқсат берілді</td>";
                echo "<td class='text-center'>";
               
                //echo "<button type='button' class='btn btn-primary editButton pad m-1'><span class='material-icons align-middle'>edit</span></button>";
                if($row["tutorID"] And $row["korsetkishID"]){
                // кнопка доступа
                        echo "
                        <!-- Button trigger modal -->
                            <button type='button' class='btn btn-danger removeButton pad m-1'><span class='material-icons align-middle'>add</span></button>
                            ";
                        }else{
                            echo "
                            <!-- Button trigger modal -->
                            <button type='button' class='btn btn-success checkButton pad m-1'><span class='material-icons align-middle'>check</span></button>
                            ";
                        }
                echo "</td>";

                echo "</tr>";
            }
           
            while ($row = mysqli_fetch_array($data_mhs)) {
                echo "<tr>";
                echo "<td style='display:none'>" . $row['kod_korsetkish'] . "</td>";
                echo "<td style='display:none'>" . $row['TutorID'] . "</td>";
                echo "<td style='display:none'>" . $row['engbekID'] . "</td>";
                echo "<td class='text-center'>" . $no++ . "</td>";
                echo "<td>" . $row['cafedraNameKZ'] . "</td>";
                echo "<td>" .$row["lastname"]." ".$row["firstname"]. "</td>";
                echo "<td>" .$row["korsetkish_ati"]. "</td>";
                echo "<td>" .$row["sani"]. "</td>";
                echo "<td>" .$row["univ_avtor_san"]. "</td>";
                echo "<td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td>";
                echo "<td>" .$row["kayt_sebeb"]. "</td>";
                echo "<td class='text-center'>";
               
                //echo "<button type='button' class='btn btn-primary editButton pad m-1'><span class='material-icons align-middle'>edit</span></button>";
                if($row["dostup"]And $row["dos_id"]){
                // кнопка доступа
                        echo "
                        <!-- Button trigger modal -->
                            <button type='button' class='btn btn btn-danger  removeButton pad m-1'><span class='material-icons align-middle'>add</span></button>
                            ";
                        }else{
                            echo "
                            <!-- Button trigger modal -->
                            <button type='button' class='btn btn-success checkButton pad m-1'><span class='material-icons align-middle'>check</span></button>
                            ";
                        }
                echo "</td>";

                echo "</tr>";
                
            }

            echo "</tbody>";
            echo "</table>";
            if ($amount_of_data == 0) {
                echo "<p class='text-center'>Таблицада деректер жоқ</p>";
            } else {
                echo "<p>Барлық мәлімет саны $amount_of_data</p>";
            }

            echo "</div>";
            ?>
        </div>

        <!-- pagination -->
        <nav class="mt-5 mb-5">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php echo ($page > 1) ? "href='?page=$previous'" : "" ?>><i class="fa fa-chevron-left"></i></a>
                </li>
                <?php
                for ($x = 1; $x <= $total_page; $x++) {
                ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php echo ($page < $total_page) ? "href='?page=$next'" : "" ?>><i class="fa fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Modal remove-->
        <div class='modal fade' style="top:58px !important;" id='removeModal' tabindex='-1' aria-labelledby='removeModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='removeModalLabel'>Растау</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>


                    <form action='remove.php' method='POST'>

                        <div class='modal-body text-start'>
                            <input type='hidden' name='remove_id' id='remove_id'>
                            <p>Бұл оқытушыға cіз еңбегін салу үшін рұқсат беріп қойғансыз рұқсат бермеу батырмасы үшін администратормен хабарласыңыз керек </p>
                        </div>

                        <div class='modal-footer'>
                            
                        </div>

                    </form>


                </div>
            </div>
        </div>


        <!-- Modal Delete-->
        <div class='modal fade' style="top:58px !important;" id='checkModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Растау</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <?php
                   function load_korsetkish(){
                    global $connection;
                    $output = '';
                    $sql = "SELECT * FROM korsetkishter WHERE bolimderID = '1'";
                    $result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
                    
                    while($row = mysqli_fetch_array($result)){			
                        $output .= '<option  value = "'.$row["kod_korsetkish"].'" id_shekteu="'.$row["id_shekteu"].'">' . $row["korsetkish_ati"] . '</option>';				
                    }
                    return $output;
                }
                    ?>

                    <form action='allow.php' method='POST'>

                        <div class='modal-body text-start'>
                        Көрсеткіштер
						<select name = "korsetkish" id = "korsetkish">
							<option>---</option>
								<?php echo load_korsetkish(); ?>
						</select><br /><br />
						<span>Көрсеткіштің толық атауы</span><br />
						<input type='text' name = "tolyk_korset" id = "tolyk_korset" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;" readonly><br /><br />
                            <input type='hidden' name='tutor_id' id='tutor_id'>
                            <input type='hidden' name='enbekId' id='enbekId'>
                            <p>Бұл оқытушыға шынымен рұқсат бергіңіз келе ме?</p>
                        </div>

                        <div class='modal-footer'>
                            <button type='submit' name='savedata' class='btn btn-primary'>ИӘ</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>


        <!-- tutup container -->
    </div>


    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Javascript bule with popper bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- edit function -->
    <script>
        $(document).ready(function() {
            $('.editButton').on('click', function() {
                $('#editModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#edit_id').val(data[0]);
                // gak dipake, karena cuma increment number
                // $('#no').val(data[1]);
                $('#edit_nama').val(data[2]);
                $('#edit_NIM').val(data[3]);
                $('#gender').val(data[4]);
                // jenis kelamin checked
                if (data[4] == "Laki-Laki") {
                    $("#cowok").prop("checked", true);
                } else {
                    $("#cewek").prop("checked", true);
                }

                $('#edit_jurusan').val(data[5]);
                $('#edit_agama').val(data[6]);
                $('#edit_ipk').val(data[7]);
            });
        });
    </script>

    <!-- delete function -->
    <script>
        $(document).ready(function() {
            $('.removeButton').on('click', function() {
                $('#removeModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#remove_id').val(data[0]);
            });
        });
    </script>
    <!-- korsetkith function -->
    <script>
       	$(document).ready(function(){
		
             $("#korsetkish").change(function(){
                var kod_korsetkish = $("#korsetkish option:selected").text();
                var id_esep =$("#korsetkish option:selected").attr('id_esep');
                var id_shekteu =$("#korsetkish option:selected").attr('id_shekteu');								
                var id_comment =$("#korsetkish option:selected").attr('value');
                $.ajax({
                       method:"POST",
                       data:{kod_korsetkish:kod_korsetkish},
                       dataType:"text",
                        success:function(data){
                        $("#tolyk_korset").val(id_comment);
                    }
               });
           });
        });
    </script>
 <!-- remove function -->
 <script>
        $(document).ready(function() {
            $('.checkButton').on('click', function() {
                $('#checkModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#tolyk_korset').val(data[0]);
                $('#tutor_id').val(data[1]);
                $('#enbekId').val(data[2]);
            });
        });
        
    </script>
    
    <script>
        function clicking() {
            window.location.href = './index.php';
        }
    </script>
</body>

</html>