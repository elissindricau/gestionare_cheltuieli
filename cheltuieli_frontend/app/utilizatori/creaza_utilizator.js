


// function to show list of categories
function creazaUtilizator(){

    nume = document.getElementById("unume").value;
    prenume = document.getElementById("uprenume").value;
    email = document.getElementById("uemail").value;
    parola = document.getElementById("uparola").value;
    conf_parola = document.getElementById("uconf_parola").value;
    buget = document.getElementById("ubuget").value;

    if(parola == conf_parola) {

        form_data = {
            "nume": nume,
            "prenume": prenume,
            "email": email,
            "parola": parola,
            "buget": buget
        };
    
        var form_data=JSON.stringify(form_data);
    
        console.log(form_data);
    
        // submit form data to api
        $.ajax({
            url: "http://localhost/gestionare_cheltuieli/cheltuieli_api/utilizator/create.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                // product was created, go back to products list
                showLogare();
            },
            error: function(xhr, resp, text) {
                // show error to console
                //console.log(xhr, resp, text);
            }
        });
     

    }
    else {

        alert("Parolele nu corespund!");
    }

    /*console.log(nume);
    console.log(prenume);
    console.log(email);
    console.log(parola);
    console.log(conf_parola);
    console.log(buget);*/

}