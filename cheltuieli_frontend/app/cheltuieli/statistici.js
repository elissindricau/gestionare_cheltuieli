

// function to show list of categories
function statistici(an, luna){

    var drop_year = "";
    var drop_month = "";
    var cheltuieli = Array();

    //console.log(d.getMonth());

    var user_id = getID();

    // get list of products from the API
    $.getJSON("http://localhost/gestionare_cheltuieli/cheltuieli_api/cheltuiala/citeste_utilizator.php?utilizator=" + user_id, function(data){
      
        console.log("categorii");

        var categorii = Array();

        $.each(data.categorii, function(key, val){

            categorii[val] = 0;
        });


        $.each(data.records, function(key, val){

            var d = new Date(val["data_cheltuielii"]);
            var cheltuiala = {
                an: d.getFullYear(),
                luna: d.getMonth() + 1,
                categoria: val["categorie"],
                suma: parseInt(val["suma"])
            }

            

            if(an == cheltuiala.an && luna == cheltuiala.luna) {

                categorii[cheltuiala.categoria] += cheltuiala.suma;
            }

            if(!cheltuieli.hasOwnProperty(cheltuiala.an))
                cheltuieli[cheltuiala.an] = Array();

            if($.inArray(cheltuiala.luna, cheltuieli[cheltuiala.an]) === -1) 
                cheltuieli[cheltuiala.an].push(cheltuiala.luna);
            
        });

        console.log(cheltuieli);
        //console.log(categorii);
        
        // inject to 'page-content' of our app
        //$("#page-content").html(read_cheltuieli_html);


    });



    

}


