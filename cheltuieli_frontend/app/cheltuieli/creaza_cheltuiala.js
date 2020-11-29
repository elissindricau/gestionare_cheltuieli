
 
// function to show list of categories
function adaugaCheltuiala(user_id){

    //console.log(user_id);

    var form_data;

    valoare = document.getElementById("ivaloare").value;
    categorie = document.getElementById("icategorie").value;
    detalii = document.getElementById("idetalii").value;
    data = document.getElementById("idata").value;

    /*$chelt->utilizator_id = $data->utilizator_id;
    $chelt->categorie = $data->categorie;
    $chelt->suma = $data->suma;
    $chelt->descriere = $data->descriere;
    $chelt->data_cheltuielii = $data->data_cheltuielii;*/



    form_data = {
        "utilizator_id": user_id,
        "categorie": categorie,
        "suma": valoare,
        "descriere": detalii,
        "data_cheltuielii": data
    };

    var form_data=JSON.stringify(form_data);

    //console.log(form_data);

    // submit form data to api
    $.ajax({
        url: "http://localhost/gestionare_cheltuieli/cheltuieli_api/cheltuiala/create.php",
        type : "POST",
        contentType : 'application/json',
        data : form_data,
        success : function(result) {
            // product was created, go back to products list
            showCheltuieli();
        },
        error: function(xhr, resp, text) {
            // show error to console
            //console.log(xhr, resp, text);
        }
    });
 



}

