
 
function insertCategories(){

    var user_id = getID();

    return citesteCategorii(user_id);

}

// function to show list of categories
function showCheltuieli(){

    var d = new Date();
    var current_date = "" + d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    /*var current_date = `<label for="start"> </lable>
                            <input type="date" id="start" name="trip-start"
                                    value='2020-12-20'
                                    min='2020-01-01' max='2050-12-31'>`;*/
    
    //console.log(d.getMonth());

    var user_id = getID();

    // get list of products from the API
    $.getJSON("http://localhost/gestionare_cheltuieli/cheltuieli_api/cheltuiala/citeste_utilizator.php?utilizator=" + user_id, function(data){
        
        // html for listing categories

        //console.log(data);
        var options = "";

        $.each(data.categorii, function(key, val){

            var opt = "<option value=" + val + ">" + val + "</option> \n";
            //console.log(opt);
            options += opt;
        });

        var read_cheltuieli_html=`

        <!-- start table -->
        <table class='table table-bordered table-hover'>
    
        <!-- creating our table heading -->
        <tr>
            <th class='w-15-pct text-align-center' id='valoare'>Valoare</th>
            <th class='w-15-pct text-align-center' id='categorie'>Categorie</th>
            <th class='w-15-pct text-align-center' id='detalii'>Detalii</th>
            <th class='w-15-pct text-align-center' id='data'>Data</th>
            <th class='w-25-pct text-align-center' id='action'>Action</th>
        </tr>
        
        <!-- Primul rand e pentru introducere de cheltuiala noua -->
        <tr>
            <td class='w-15-pct text-align-center'><input type="text" id="ivaloare" name="ivaloare"></td>
            <td class='w-15-pct text-align-center'><select id="icategorie" name="icategorie">` + options + `</select></td>
            <td class='w-15-pct text-align-center'><input type="text" id="idetalii" name="idetalii"></td>
            <td class='w-15-pct text-align-center'><input type="date" id="idata" name="idata" value="` + current_date + `"></td>
            <td class='w-25-pct text-align-center'>
                <div onclick="adaugaCheltuiala(` + user_id + `)" id='create-cheltuiala' class='btn btn-primary m-b-15px adauga-cheltuiala-button'>
                <span class="glyphicon">&#x2b;</span>
                </div>
            </td>
        </tr>
        
        `;
        
        // scriem fiecare linie din tabel

        $.each(data.records, function(key, val){

            read_cheltuieli_html += ` 
            
                <tr> 
                    <td>`+val.suma+`</td>
                    <td>`+val.categorie+`</td>
                    <td>`+val.descriere+`</td>
                    <td class='w-25-pct text-align-center'>`+val.data_cheltuielii+`</td>
                    <td class='w-25-pct text-align-center'>
                        <div onclick="stergeCheltuiala(` + val.id + `)" id='sterge-cheltuiala' class='btn btn-danger m-b-15px sterge-cheltuiala-button'>
                        <span class="glyphicon">&#xe020;</span>
                        </div>
                    </td>
                </tr>

            `;
            
        });
        
        // end table
        read_cheltuieli_html +=`</table>`;
        
        // inject to 'page-content' of our app
        $("#page-content").html(read_cheltuieli_html);


    });

    

}




// when a 'read cheltuieli' button was clicked
$(document).on('click', '.read-cheltuieli-button', function(){
    showCheltuieli();
});

