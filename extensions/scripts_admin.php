<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- SweetAlert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.2/sweetalert2.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
 <!-- Include Select2 JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    var dataTable;
    var currentPage = localStorage.getItem('currentPage') || 1;

    function format(d) {
        return (
            '<dl>' +
            '<dt>Туылған күні:</dt>' +
            '<dd>' +
            d.birthdate +
            '</dd>' +
            '<dt>Телефоны:</dt>' +
            '<dd>' +
            d.phone +
            '</dd>' +
            '<dt>Ғылыми дәрежесі:</dt>' +
            '<dd>' +
            d.akademikDareje +
            '</dd>' +
            '<dt>Қызметі:</dt>' +
            '<dd>' +
            d.akademikKadrTipi +
            '</dd>' +
            '<dt>Жұмыс түрі:</dt>' +
            '<dd>' +
            d.jumys_turi +
            '</dd>' +
            '<dt>Штат саны:</dt>' +
            '<dd>' +
            d.workstatus +
            '</dd>' +
            '</dl>'
        );
    }

    function initializeDataTable() {
        dataTable = $('#personalTable').DataTable({
            "ajax": "get_kyzmetker.php",
            "columns": [
                {
                    "className": 'dt-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                { "data": "tutid" },
                { 
                    "data": "fullName",
                    "render": function(data, type, row) {
                        return row.lastname + ' ' + row.firstname + ' ' + row.patronymic;
                    }
                },
                { "data": "sTitle" },
                { "data": "facilty" },
                { 
                    "data": null, 
                    "defaultContent": "<button class='btn btn-primary btn-sm open-row'><i class='fas fa-edit'></i></button> <button class='btn btn-danger btn-sm' onclick='deleteTask(this)'><i class='fa fa-trash'></i></button>" 
                }
            ],
            order: [[1, 'asc']],
            "language": {
                "url": 'languages/' + ER_Locale.lang + '.json',
            },
            "initComplete": function () {
                var table = this.api();
                table.page(currentPage - 1).draw(false);

                // Event listener for opening row
                $('#personalTable tbody').on('click', 'td.dt-control', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                
                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                    }
                    else {
                        // Open this row
                        row.child(format(row.data())).show();
                    }
                });
            }
        });
    }
  
    initializeDataTable();

    $('#addTutorForm').submit(function(e) {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }
        
        $.ajax({
            url: 'add_kyzmetker.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                dataTable.ajax.reload(function() {
                    dataTable.page('last').draw('page');
                }, false);
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Task added successfully'
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to add task'
                });
            }
        });
    });

    $('#personalTable').on('page.dt', function() {
        var pageInfo = dataTable.page.info();
        localStorage.setItem('currentPage', pageInfo.page + 1);
    });
});
    $('#editTaskForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'edit_task.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#editTaskModal').modal('hide');
                $('#taskTable').DataTable().ajax.reload();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Task updated successfully'
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update task'
                });
            }
        });
    });
    // Function to open Add Task Modal
    function openAddTaskModal() {
        $('#addTutorModal').modal('show');
        $('#addTutorModal').find('form')[0].reset();
        $('#addTutorModal').modal('show');
    }

    // Function to open Edit Task Modal
    function openEditTaskModal(btn) {
        var data = $('#taskTable').DataTable().row($(btn).parents('tr')).data();

        // Clear previous data from the modal
        //$('#editTaskModal').find('form')[0].reset();

        // Populate edit form with task data and open modal
        $('#editTaskModal').find('#editTaskId').val(data.id);
        $('#editTaskModal').find('#editTaskName').val(data.task_name);
        $('#editTaskModal').find('#editTaskDescription').val(data.task_description);
        
        $('#editTaskModal').modal('show');
        }

    // Function to delete Task
    function deleteTask(btn) {
            var data = $('#personalTable').DataTable().row($(btn).parents('tr')).data();
            var taskId = data['tutid'];
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delete_task.php',
                        type: 'POST',
                        data: { id: taskId },
                        success: function(response) {
                            $('#personalTable').DataTable().ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Task has been deleted.'
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to delete task'
                            });
                        }
                    });
                }
            });
        }
        $(document).ready(function() {
            // Initialize Select2 for Faculty dropdown
            $('#Faculty').select2({
                theme: "classic"
            });

            // Initialize Select2 for Cafedra dropdown
            $('#Cafedra').select2({
                theme: "classic"
            });

            // Fetch data for Faculty dropdown
            $.getJSON("fetchfaculty.php", function(data) {
                $('#Faculty').append($('<option value="" selected required>Таңдаңыз</option>'));
                // Populate Faculty dropdown with options
                $.each(data, function(key, value) {
                    $('#Faculty').append($('<option></option>').attr('value', value.facid).text(value.facilty));
                });
                
                // Trigger change event for Faculty dropdown after options are loaded (required for Select2)
                $('#Faculty').trigger('change');
            });

            // Change event handler for Faculty dropdown
            $('#Faculty').on('change', function() {
                var FacultyID = $(this).val();
                // Fetch data for Cafedra dropdown based on selected Faculty
                $.ajax({
                    url: "fetchcafedra.php",
                    method: "POST",
                    data: {FacultyID: FacultyID},
                    dataType: "json", // Assuming your get_cafedra.php returns JSON data
                    success: function(data) {
                        // Clear existing options in Cafedra dropdown
                        $('#Cafedra').append($('<option value="" selected required>Таңдаңыз</option>'));
                        $('#Cafedra').empty();
                        // Populate Cafedra dropdown with options
                        $.each(data, function(key, value) {
                            $('#Cafedra').append($('<option></option>').attr('value', value.cafid).text(value.cafname));
                        });
                        // Trigger change event for Cafedra dropdown after options are loaded (required for Select2)
                        $('#Cafedra').trigger('change');
                    }
                });
            });
        });

        // Initialize Select2
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                // Add additional options here
            });
        });

        // Fetch data from the server and populate dropdown
        $.getJSON("fetchjumys_turu.php", function(data) {
            $('#jumysTuru').append($('<option value="" selected required>Таңдаңыз</option>'));
            // Populate dropdown with options
            $.each(data, function(key, value) {
                $('#jumysTuru').append($('<option></option>').attr('value', value.jumsId).text(value.jumysTuru));
            });
            
            // Trigger change event after options are loaded (required for Select2)
            $('#jumysTuru').trigger('change');
        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                // Add additional options here
            });
        });

        // Fetch data from the server and populate dropdown
        $.getJSON("fetchsex.php", function(data) {
            $('#sex').append($('<option value="" selected required>Таңдаңыз</option>'));
            // Populate dropdown with options
            $.each(data, function(key, value) {
                $('#sex').append($('<option></option>').attr('value', value.sexId).text(value.name));
            });
            
            // Trigger change event after options are loaded (required for Select2)
            $('#sex').trigger('change');
        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                // Add additional options here
            });
        });

        // Fetch data from the server and populate dropdown
        $.getJSON("fetchDareje.php", function(data) {
            $('#akademikDareje').append($('<option value="" selected required>Ғылыми дәрежені таңдаңыз</option>'));
            // Populate dropdown with options
            $.each(data, function(key, value) {
                $('#akademikDareje').append($('<option></option>').attr('value', value.Id).text(value.name));
            });
            
            // Trigger change event after options are loaded (required for Select2)
            $('#akademikDareje').trigger('change');
        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                // Add additional options here
            });
        });

        // Fetch data from the server and populate dropdown
        $.getJSON("fetchKadrTipi.php", function(data) {
            $('#akademikKadrTipi').append($('<option value="" selected required>Қызмет түрін таңдаңыз</option>'));
            // Populate dropdown with options
            $.each(data, function(key, value) {
                $('#akademikKadrTipi').append($('<option></option>').attr('value', value.Id).text(value.name));
            });
            
            // Trigger change event after options are loaded (required for Select2)
            $('#akademikKadrTipi').trigger('change');
        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                // Add additional options here
            });
        });

        // Fetch data from the server and populate dropdown
        $.getJSON("fetchShatSany.php", function(data) {
            $('#workstatus').append($('<option value="" selected required>Штат санын таңдаңыз</option>'));
            // Populate dropdown with options
            $.each(data, function(key, value) {
                $('#workstatus').append($('<option></option>').attr('value', value.Id).text(value.name));
            });
            
            // Trigger change event after options are loaded (required for Select2)
            $('#workstatus').trigger('change');
        });
        // Function to validate the form
    function validateForm() {
        var iin = document.getElementById("TutorIIN").value;
        var lastName = document.getElementById("lastName").value;
        var firstName = document.getElementById("firstName").value;
        var phone = document.getElementById("Phone").value;
        var email = document.getElementById("Email").value;

        // Regular expressions for validation
        var iinRegex = /^[0-9]{12}$/;
        var nameRegex = /^[\p{L}\s]+$/u;
        var phoneRegex = /^[0-9]{10}$/;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Get error message elements
        var iinError = document.getElementById("iinError");
        var lastNameError = document.getElementById("lastNameError");
        var firstNameError = document.getElementById("firstNameError");
        var phoneError = document.getElementById("phoneError");
        var emailError = document.getElementById("emailError");
        var faculty = $('#Faculty').val();
        var cafedra = $('#Cafedra').val();
        var akademikDareje = $('#akademikDareje').val();
        var akademikKadrTipi = $('#akademikKadrTipi').val();
        var sex = $('#sex').val();
        // Reset error messages
        iinError.textContent = "";
        lastNameError.textContent = "";
        firstNameError.textContent = "";
        phoneError.textContent = "";
        emailError.textContent = "";

        // Checking each field for validation
        if (!iin.match(iinRegex)) {
            iinError.textContent = "Please enter a valid IIN (12 digits)";
            return false;
        }
        if (!lastName.match(nameRegex)) {
            lastNameError.textContent = "Please enter a valid last name";
            return false;
        }
        if (!firstName.match(nameRegex)) {
            firstNameError.textContent = "Please enter a valid first name";
            return false;
        }
        if (!phone.match(phoneRegex)) {
            phoneError.textContent = "Please enter a valid phone number (10 digits)";
            return false;
        }
        if (!email.match(emailRegex)) {
            emailError.textContent = "Please enter a valid email address";
            return false;
        }
        if (!faculty) { // Check if Faculty is not selected
            alert("Please select a Faculty");
            return false;
        }
        if (!sex) { // Check if Faculty is not selected
            alert("Please select sex");
            return false;
        }
        if (!cafedra) { // Check if Faculty is not selected
            alert("Please select cafedra");
            return false;
        }
        if (!akademikDareje) { // Check if Faculty is not selected
            alert("Please select akademikDareje");
            return false;
        }
        if (!akademikKadrTipi) { // Check if Faculty is not selected
            alert("Please select akademikKadrTipi");
            return false;
        }
        if (!jumysTuru) { // Check if Faculty is not selected
            alert("Please select jumysTuru");
            return false;
        }
        // If all fields are valid, return true
        return true;
    }
   
</script>