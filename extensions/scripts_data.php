<!--DataTables-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>   
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>  
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>  
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>   
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script>
    // Fetch data from PHP and initialize DataTables tutors
 $(document).ready(function() {
        $.ajax({
            url: 'fetch_data_rastaushylar.php', // Replace 'fetch_data.php' with the path to your PHP script
            dataType: 'json',
            success: function(data) {
                $('#univ_data').DataTable({
                    data: data,
                    columns: [
                        { data: 'index' },
                        { data: 'fullName', render: function(data, type, row) {
                            return row.lastName + ' ' + row.firstName;
                        }},
                        { data: 'engbek_count'},
                        { data: 'status_2_count'},
                        { data: 'status_3_count'},
                        { data: 'status_4_count'},
                        { data: 'status_5_count' }
                    ],
                    language: {
                    url: 'languages/' + ER_Locale.lang + '.json',
                },
                lengthMenu: [[10, 25, 50], [10, 25, 50]],
                dom: 'Bfrtip', // Add this line to include the buttons in the DataTable
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Excel',
                        filename: 'Растаушылар', // Set your custom filename here
                        title: null // Optionally, you can set this to null to remove the default title
                    }
                ],
                    initComplete: function () {
                        var table = this.api();
                        var data = table.rows().data();
                    }
                });
            }
        });
    });

    // Fetch data from PHP and initialize DataTables cafedra
    $(document).ready(function() {
        $.ajax({
            url: 'fetch_data_tutoruploadfile.php',
            dataType: 'json',
            success: function(data) {
                $('#cafedra_data').DataTable({
                    data: data,
                    columns: [
                        { data: 'index' },
                        { data: 'sFaculty'},
                        { data: 'sTitle'},
                        { data: 'fullName', render: function(data, type, row) {
                            return row.lastName + ' ' + row.firstName;
                        }},
                        { data: 'engbek_count'},
                        { data: 'status_2_count'},
                        { data: 'status_3_count'},
                        { data: 'status_4_count'},
                        { data: 'status_5_count' },
                        { data: 'link', render: function(data, type, row) {
                            return '<a href="' + data + '"><?= $oL::get('Толық')?> >></a>';
                        }}
                    ],
                    language: {
                    url: 'languages/' + ER_Locale.lang + '.json',
                },
                lengthMenu: [[10, 25, 50], [10, 25, 50]],
                dom: 'Bfrtip', // Add this line to include the buttons in the DataTable
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Excel',
                        filename: 'Енгізілген енбектер ОПҚ', // Set your custom filename here
                        title: null // Optionally, you can set this to null to remove the default title
                    }
                ],
                    initComplete: function () {
                        var table = this.api();
                        var data = table.rows().data();
                    }
                });
            }
        });
    });
</script>