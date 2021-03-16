function validateForm() {
    var x = document.getElementById("test").value;
    /*if (x == "") {
        alert("Datum muss gesetzt sein");
        return false;
    }*/
    if (x == "") {
        text = "Input not valid";
    } else {
        text = "Input OK";
    }
    document.getElementById("fehlerTest").innerHTML = text;
}