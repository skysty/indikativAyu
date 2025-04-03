function compareSelectedValue() {
    // Получаем элемент input по его ID
        var avtor_san = document.getElementById("univ_avtor_san2");
        // Получаем элемент input по его Class
        var avtor1 = document.querySelector('.avtor1');
        var avtor2 = document.querySelector('.avtor2');
        var avtor3 = document.querySelector('.avtor3');
        var avtor4 = document.querySelector('.avtor4');
        var avtor5 = document.querySelector('.avtor5');
        var avtor6 = document.querySelector('.avtor6');
        // Получаем значение поля ввода
        var inputValue = avtor_san.value;
        
        if (inputValue === "1") {
            hidingElem.style.display = "block";
            avtor1.style.display = "none";
            avtor2.style.display = "none";
            avtor3.style.display = "none";
            avtor4.style.display = "none";
            avtor5.style.display = "none";
            avtor6.style.display = "none";
            
        }
        // Сравниваем значение поля ввода с другим значением
        if (inputValue === "2") {
            hidingElem.style.display = "none";
            avtor1.style.display = "block";
            avtor2.style.display = "none";
            avtor3.style.display = "none";
            avtor4.style.display = "none";
            avtor5.style.display = "none";
            avtor6.style.display = "none";
            
        }
        if (inputValue === "3") {
            hidingElem.style.display = "none";
            avtor1.style.display = "block";
            avtor2.style.display = "block";
            avtor3.style.display = "none";
            avtor4.style.display = "none";
            avtor5.style.display = "none";
            avtor6.style.display = "none";
        }
        if (inputValue === "4") {
            hidingElem.style.display = "none";
            avtor1.style.display = "block";
            avtor2.style.display = "block";
            avtor3.style.display = "block";
            avtor4.style.display = "none";
            avtor5.style.display = "none";
            avtor6.style.display = "none";
            
        }
        if (inputValue === "5") {
            hidingElem.style.display = "none";
            avtor1.style.display = "block";
            avtor2.style.display = "block";
            avtor3.style.display = "block";
            avtor4.style.display = "block";
            avtor5.style.display = "none";
            avtor6.style.display = "none";
            
        }
        if (inputValue === "6") {
            hidingElem.style.display = "none";
            avtor1.style.display = "block";
            avtor2.style.display = "block";
            avtor3.style.display = "block";
            avtor4.style.display = "block";
            avtor5.style.display = "block";
            avtor6.style.display = "none";
        }
        if (inputValue === "7") {
            hidingElem.style.display = "none";
            avtor1.style.display = "block";
            avtor2.style.display = "block";
            avtor3.style.display = "block";
            avtor4.style.display = "block";
            avtor5.style.display = "block";
            avtor6.style.display = "block";
        }
        
    }