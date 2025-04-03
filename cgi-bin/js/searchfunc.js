/*----------автор екі-------------*/
$(document).ready(function() {
    $("#avtor_bir").keyup(function() {
        $.ajax({
            type: "POST",
            url: "searchAvtor.php",
            data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                $("#avtor_bir").css("background", "#FFF url(../img/LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#avtor_bir").css("background", "#FFF");
            }
        });
    });
});
function selectCountry(val) {
    $("#avtor_bir").val(val);
    $("#suggesstion-box").hide();
}
/*----------автор үш-------------*/
$(document).ready(function() {
    $("#avtor_eki").keyup(function() {
        $.ajax({
            type: "POST",
            url: "searchAvtor2.php",
            data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                $("#avtor_eki").css("background", "#FFF url(../img/LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                $("#suggesstion-box2").show();
                $("#suggesstion-box2").html(data);
                $("#avtor_eki").css("background", "#FFF");
            }
        });
    });
});
function selectAvtor2(val) {
    $("#avtor_eki").val(val);
    $("#suggesstion-box2").hide();
}
/*----------автор төрт-------------*/
$(document).ready(function() {
    $("#avtor_ush").keyup(function() {
        $.ajax({
            type: "POST",
            url: "searchAvtor3.php",
            data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                $("#avtor_ush").css("background", "#FFF url(../img/LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                $("#suggesstion-box3").show();
                $("#suggesstion-box3").html(data);
                $("#avtor_ush").css("background", "#FFF");
            }
        });
    });
});
function selectAvtor3(val) {
    $("#avtor_ush").val(val);
    $("#suggesstion-box3").hide();
}
/*----------автор бес-------------*/
$(document).ready(function() {
    $("#avtor_tort").keyup(function() {
        $.ajax({
            type: "POST",
            url: "searchAvtor4.php",
            data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                $("#avtor_tort").css("background", "#FFF url(../img/LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                $("#suggesstion-box4").show();
                $("#suggesstion-box4").html(data);
                $("#avtor_tort").css("background", "#FFF");
            }
        });
    });
});
function selectAvtor4(val) {
    $("#avtor_tort").val(val);
    $("#suggesstion-box4").hide();
}
/*----------автор алты-------------*/
$(document).ready(function() {
    $("#avtor_bes").keyup(function() {
        $.ajax({
            type: "POST",
            url: "searchAvtor5.php",
            data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                $("#avtor_bes").css("background", "#FFF url(../img/LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                $("#suggesstion-box5").show();
                $("#suggesstion-box5").html(data);
                $("#avtor_bes").css("background", "#FFF");
            }
        });
    });
});
function selectAvtor5(val) {
    $("#avtor_bes").val(val);
    $("#suggesstion-box5").hide();
}
/*----------автор жеті-------------*/
$(document).ready(function() {
    $("#avtor_alty").keyup(function() {
        $.ajax({
            type: "POST",
            url: "searchAvtor6.php",
            data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                $("#avtor_alty").css("background", "#FFF url(../img/LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                $("#suggesstion-box6").show();
                $("#suggesstion-box6").html(data);
                $("#avtor_alty").css("background", "#FFF");
            }
        });
    });
});
function selectAvtor6(val) {
    $("#avtor_alty").val(val);
    $("#suggesstion-box6").hide();
}