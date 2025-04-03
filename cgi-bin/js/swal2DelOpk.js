function deleteOpk(btn) {
    var Opkrec = $(btn).data('opk');
    Swal.fire({
        title: ER_Locale.get('Сіз сенімдісіз бе?'),
        text: ER_Locale.get("Жазба жойылады және баллды  қайта беруіңізге тура келеді !"),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: ER_Locale.get('Иә, жоямын!'),
        cancelButtonText:'Жоқ'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../extensions/deleteopk.php',
                type: 'post',
                data: {opk: Opkrec},
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
                          title: 'Қате',
                          text: response.message,
                          icon: 'error'
                        });
                      }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Қате',
                            text: ER_Locale.get('Деректі өшіру кезінде қате пайда болды'),
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }




  