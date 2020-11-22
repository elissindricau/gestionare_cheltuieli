

$(document).ready(function(){
 
    // show list of categories on first load
    showCheltuieli();
 
});
 
function insertCategories(){

    var user_id = 18;

    return citesteCategorii(user_id);

}

// function to show list of categories
function showCheltuieli(){

    var d = new Date();
    var current_date = "" + d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    //console.log(d.getMonth());

    var user_id = 18;

    // get list of products from the API
    $.getJSON("http://localhost/gestionare_cheltuieli/cheltuieli_api/cheltuiala/citeste_utilizator.php?utilizator=" + user_id, function(data){
        
        // html for listing categories

        console.log(data);
        var options = "";

        $.each(data.categorii, function(key, val){

            var opt = "<option value=" + val + ">" + val + "</option> \n";
            console.log(opt);
            options += opt;
        });

        var read_cheltuieli_html=`

        <!-- start table -->
        <table class='table table-bordered table-hover'>
    
        <!-- creating our table heading -->
        <tr>
            <th class='w-15-pct'>Valoare</th>
            <th class='w-15-pct'>Categorie</th>
            <th class='w-15-pct'>Detalii</th>
            <th class='w-15-pct'>Data</th>
            <th class='w-25-pct text-align-center'>Action</th>
        </tr>
        
        <!-- Primul rand e pentru introducere de cheltuiala noua -->
        <tr>
            <td class='w-15-pct'><input type="text" id="ivaloare" name="ivaloare"></td>
            <td class='w-15-pct'><select id="icategorie" name="icategorie">` + options + `</select></td>
            <td class='w-15-pct'><input type="text" id="idetalii" name="idetalii"></td>
            <td class='w-15-pct'><input type="text" id="idata" name="idata" value="` + current_date + `"></td>
            <td class='w-25-pct text-align-center'>
                <div onclick="adaugaCheltuiala(` + user_id + `)" id='create-cheltuiala' class='btn btn-primary m-b-15px adauga-cheltuiala-button'>
                    Adauga
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
                    <td>`+val.data_cheltuielii+`</td>
                    <td>
                        <div onclick="stergeCheltuiala(` + val.id + `)" id='sterge-cheltuiala' class='btn btn-danger pull-right m-b-15px sterge-cheltuiala-button'>
                            Sterge
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

