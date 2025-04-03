function deleteRecord(btn) {
    var recordId = $(btn).data('id');
    Swal.fire({
        title: ER_Locale.get('Сіз сенімдісіз бе?'),
        text: ER_Locale.get('Жүктеген еңбегіңізді қайтара алмайсыз!'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: ER_Locale.get('Иә, жоямын!'),
        cancelButtonText:ER_Locale.get('Жоқ')
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../extensions/delete.php',
                type: 'post',
                data: {id: recordId},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: ER_Locale.get('Жазба сәтті жойылды'),
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                          // remove row from table
                        $(btn).closest('tr').remove();
                        });
                      } else {
                        Swal.fire({
                          title: ER_Locale.get('Қате'),
                          text: response.message,
                          icon: 'error'
                        });
                      }
                    },
                    error: function() {
                        Swal.fire({
                            title:ER_Locale.get('Қате'),
                            text: ER_Locale.get('Деректі өшіру кезінде қате пайда болды'),
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }




  