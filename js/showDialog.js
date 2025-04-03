function showDialog() {
    document.getElementById('dialog').style.display = 'block';
}

function closeDialog() {
    document.getElementById('dialog').style.display = 'none';
}
function handleChange() {
    var korsetkish = document.getElementById("korsetkish");
    var options = korsetkish.options;
    var selectedIndex = korsetkish.selectedIndex;
    var id_esep = options[selectedIndex].getAttribute('id_esep');
    if(id_esep=="6")
        showDialog();
}