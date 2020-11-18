

$(document).ready(function(){
 
    // show list of categories on first load
    showCheltuieli();
 
});
 
// function to show list of categories
function showCheltuieli(){

    // get list of products from the API
    $.getJSON("http://localhost/api/cheltuiala/citeste_tot.php", function(data){

        // html for listing categories
        var read_cheltuieli_html=`
        <!-- when clicked, it will load the read cheltuiala form -->
        <div id='create-cheltuiala' class='btn btn-primary pull-right m-b-15px read-cheltuiala-button'>
            <span class='glyphicon glyphicon-plus'></span> Read cheltuieli
        </div> 

        <!-- start table -->
        <table class='table table-bordered table-hover'>
    
        <!-- creating our table heading -->
        <tr>
            <th class='w-15-pct'>Valoare</th>
            <th class='w-15-pct'>Categorie</th>
            <th class='w-15-pct'>Detalii</th>
            <th class='w-15-pct'>Data</th>
            <th class='w-25-pct text-align-center'>Action</th>
        </tr>`;
        
        // scriem fiecare linie din tabel

        $.each(data.records, function(key, val){

            read_cheltuieli_html = ` 
            
                <td> 
                    <tr>`+val.suma+`</tr>
                    <tr>`+val.categorie+`</tr>
                    <tr>`+val.descriere+`</tr>
                    <tr>`+val.data_cheltuielii+`</tr>
                    <tr>`+val.suma+`</tr>
                </td>

            `;

        });
    
        // end table
        read_cheltuieli_html+=`</table>`;

        // inject to 'page-content' of our app
        $("#page-content").html(read_cheltuieli_html);

    });

}




// when a 'read cheltuieli' button was clicked
$(document).on('click', '.read-cheltuieli-button', function(){
    showCheltuieli();
});

