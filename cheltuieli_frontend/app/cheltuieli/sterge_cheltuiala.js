

function stergeCheltuiala(id) {

    var data = {
        "id": id
    };

    data = JSON.stringify(data);

    //console.log(data);

    var url = "http://localhost/gestionare_cheltuieli/cheltuieli_api/cheltuiala/delete.php";

    $.ajax({
        
        url: url,
        type: "POST",
        contentType: "application/json",
        data: data,
        success: function(result){
            //console.log(result);
            showCheltuieli();
        },
        error: function(xhr, resp, text){
           // console.log(xhr, resp, text);
        }
    });

}