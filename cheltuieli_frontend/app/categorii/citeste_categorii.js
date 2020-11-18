

$(document).ready(function(){
 
    // show list of categories on first load
    showCategories();
 
});
 
// function to show list of categories
function showPCategories(){

    // get list of products from the API
    $.getJSON("http://localhost/api/cheltuiala/citeste_tot.php", function(data){
    });

    // html for listing categories
    var read_categories_html=`
    <!-- when clicked, it will load the create category form -->
    <div id='create-category' class='btn btn-primary pull-right m-b-15px create-category-button'>
        <span class='glyphicon glyphicon-plus'></span> Create Category
    </div> 

    <!-- start table -->
    <table class='table table-bordered table-hover'>
 
    <!-- creating our table heading -->
    <tr>
        <th class='w-15-pct'>Category</th>
        <th class='w-25-pct text-align-center'>Action</th>
    </tr>`;
     
    // rows will be here
 
    // end table
    read_categories_html+=`</table>`;
}




// when a 'read categories' button was clicked
$(document).on('click', '.read-categories-button', function(){
    showCategories();
});

