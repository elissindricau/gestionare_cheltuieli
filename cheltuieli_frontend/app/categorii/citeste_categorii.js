

// function to show list of categories
function citesteCategorii(user_id){

    var options = "";
    console.log("am intrat in functie");

    $.ajax({
        url: "http://localhost/gestionare_cheltuieli/cheltuieli_api/categorie/citeste_categorii.php?utilizator=" + user_id,
        dataType: "json",
        async: false,
        succes: function(data)
        {
            $.each(data.records, function(key, val){
            
                var opt = "<option value=" + val.categorie + "> " + val.categorie + "</option> \n";
                console.log(opt);
                options += opt;
    
            });
        }
    })

    console.log(options);
}