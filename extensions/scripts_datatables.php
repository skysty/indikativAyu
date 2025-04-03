<script>
    // Fetch data from PHP and initialize DataTables tutors
 $(document).ready(function() {
        $.ajax({
            url: 'fetch_data_tutor.php', // Replace 'fetch_data.php' with the path to your PHP script
            dataType: 'json',
            success: function(data) {
                $('#univ_data').DataTable({
                    data: data,
                    columns: [
                        { data: 'index' },
                        { data: 'fullName', render: function(data, type, row) {
                            return row.lastName + ' ' + row.firstName;
                        }},
                        { data: 'typ1', visible: false },
                        { data: 'typ2', visible: false },
                        { data: 'typ3', visible: false },
                        { data: 'typ4', visible: false },
                        { data: 'sum_val' },
                        { data: 'link', render: function(data, type, row) {
                            return '<a href="' + data + '"><?= $oL::get('Толық')?> >></a>';
                        }},
                        { data: 'tutorID', visible: false }
                    ],
                    language: {
                    url: 'languages/' + ER_Locale.lang + '.json',
                },
                    initComplete: function () {
                        var table = this.api();
                        var data = table.rows().data();
                        
                        for (var i = 1; i < data.length; i++) {
                        var currentVal = parseFloat(data[i].sum_val);
                        var previousVal = parseFloat(data[i - 1].sum_val);
                        var icon = currentVal > previousVal ? '<i class="fas fa-arrow-up" style="color:green"></i>' : (currentVal < previousVal ? '<i class="fas fa-arrow-down" style="color:red"></i>' : '');
                        table.cell(i, 6).data(icon + ' ' + data[i].sum_val).draw(false);
                        }
                    }
                });
            }
        });
    });

    // Fetch data from PHP and initialize DataTables cafedra
    $(document).ready(function() {
        $.ajax({
            url: 'fetch_data_cafedra.php',
            dataType: 'json',
            success: function(data) {
                $('#cafedra_data').DataTable({
                    data: data,
                    columns: [
                        { data: 'index' },
                        { data: 'sTitle'},
                        { data: 'shtat_sany'},
                        { data: 'sum_cafedra' },
                        { data: 'avg_cafedra'},
                        { data: 'link', render: function(data, type, row) {
                            return '<a href="' + data + '"><?= $oL::get('Толық')?> >></a>';
                        }},
                        { data: 'cafedraID', visible: false }
                    ],
                    language: {
                    url: 'languages/' + ER_Locale.lang + '.json',
                },
                    initComplete: function () {
                        var table = this.api();
                        var data = table.rows().data();
                        
                        for (var i = 1; i < data.length; i++) {
                            var currentVal = parseFloat(data[i].sum_cafedra);
                            var previousVal = parseFloat(data[i - 1].sum_cafedra);
                            var icon = currentVal > previousVal ? '<i class="fas fa-arrow-up" style="color:green"></i>' : (currentVal < previousVal ? '<i class="fas fa-arrow-down" style="color:red"></i>' : '');
                            table.cell(i, 3).data(icon + ' ' + data[i].sum_cafedra);
                        }
                    }
                });
            }
        });
    });

    // Fetch data from PHP and initialize DataTables cafedra
    $(document).ready(function() {
        $.ajax({
            url: 'fetch_data_institution.php',
            dataType: 'json',
            success: function(data) {
                $('#institution_data').DataTable({
                    data: data,
                    columns: [
                        { data: 'index' },
                        { data: 'sTitle'},
                        { data: 'shtat_sany'},
                        { data: 'sum_cafedra' },
                        { data: 'avg_cafedra'},
                        { data: 'link', render: function(data, type, row) {
                            return '<a href="' + data + '"><?= $oL::get('Толық')?> >></a>';
                        }},
                        { data: 'cafedraID', visible: false }
                    ],
                    language: {
                    url: 'languages/' + ER_Locale.lang + '.json',
                },
                    paging: data.length > 11,
                    searching: data.length > 11, 
                    ordering: data.length > 11,
                    info: data.length > 11,
                    initComplete: function () {
                        var table = this.api();
                        var data = table.rows().data();
                        
                        for (var i = 1; i < data.length; i++) {
                            var currentVal = parseFloat(data[i].sum_cafedra);
                            var previousVal = parseFloat(data[i - 1].sum_cafedra);
                            var icon = currentVal > previousVal ? '<i class="fas fa-arrow-up" style="color:green"></i>' : (currentVal < previousVal ? '<i class="fas fa-arrow-down" style="color:red"></i>' : '');
                            table.cell(i, 3).data(icon + ' ' + data[i].sum_cafedra);
                        }
                    }
                });
            }
        });
    });

// Fetch data from PHP and initialize DataTables facutly
$(document).ready(function() {
        $.ajax({
            url: 'fetch_data_faculty.php',
            dataType: 'json',
            success: function(data) {
                $('#faculty_data').DataTable({
                    data: data,
                    columns: [
                        { data: 'index' },
                        { data: 'sTitle'},
                        { data: 'shtat_sany'},
                        { data: 'sumAllType' },
                        { data: 'avg_faculty'},
                        { data: 'link', render: function(data, type, row) {
                            return '<a href="' + data + '"><?= $oL::get('Толық')?> >></a>';
                        }},
                        { data: 'facultyID', visible: false }
                    ],
                    language: {
                    url: 'languages/' + ER_Locale.lang + '.json',
                },
                    paging: data.length > 11,
                    searching: data.length > 11, 
                    ordering: data.length > 11,
                    info: data.length > 11,
                    initComplete: function () {
                        var table = this.api();
                        var data = table.rows().data();
                        
                        for (var i = 1; i < data.length; i++) {
                            var currentVal = parseFloat(data[i].sumAllType);
                            var previousVal = parseFloat(data[i - 1].sumAllType);
                            var icon = currentVal > previousVal ? '<i class="fas fa-arrow-up" style="color:green"></i>' : (currentVal < previousVal ? '<i class="fas fa-arrow-down" style="color:red"></i>' : '');
                            table.cell(i, 3).data(icon + ' ' + data[i].sumAllType);
                        }
                    }
                });
            }
        });
    });
 
</script>