

// function to show list of categories
function statistici(an, luna){

    var drop_year = "";
    var drop_month = "";
    var cheltuieli = Array();
    var d = new Date();
    var current_date = "" + d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    //console.log(d.getMonth());

    var user_id = getID();

    // get list of products from the API
    $.getJSON("http://localhost/gestionare_cheltuieli/cheltuieli_api/cheltuiala/citeste_utilizator.php?utilizator=" + user_id, function(data){
      
        console.log("categorii");

        var categorii = Array();

        $.each(data.categorii, function(key, val){

            categorii[val] = 0;
        });

        var years = Array();
        var months = Array();

        $.each(data.records, function(key, val){

            var data = new Date(val["data_cheltuielii"]);
            var cheltuiala = {
                an: data.getFullYear(),
                luna: data.getMonth() + 1,
                categoria: val["categorie"],
                suma: parseInt(val["suma"])
            }

            

            if(an == cheltuiala.an && luna == cheltuiala.luna) {

                categorii[cheltuiala.categoria] += cheltuiala.suma;
            }

            if($.inArray(cheltuiala.an, years) === -1) 
                years.push(cheltuiala.an);
            
            if($.inArray(cheltuiala.luna, months) === -1) 
                months.push(cheltuiala.luna);
            
            cheltuieli.push(cheltuiala);
        });

        console.log(years);
        console.log(months);

        //console.log(cheltuieli);
        //console.log(categorii);
        
        // inject to 'page-content' of our app
        //$("#page-content").html(read_cheltuieli_html);


    });



    

}


