<script src = "../js/Dropdownfunc.js"></script>
<script src = "../js/hideInputfunc.js"></script>
<script src = "../js/compareVariableFunc.js"></script>
<script src = "../js/searchfunc.js"></script>
<script src = "../js/showDialog.js"></script>
<script src = "../js/swal2Func.js"></script>
<script src = "../js/swal2Del.js"></script>
<script src = "../js/swal2DelOpk.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    function limit(element){
        var max_chars = 3;
        if(element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
    } 
        // Вызываем функцию при загрузке страницы
        window.onload = function() {
            hideInputText();
        };
</script>
