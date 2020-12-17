

// function to show list of categories
function statistici(an_luna){

    var drop_an_luna = "";
    var cheltuieli = Array();
    var an;
    var luna;

    if(an_luna == 0){

        var d = new Date();
        an = d.getFullYear();
        luna = d.getMonth() + 1;

    } else {
        var an_luna_arr = an_luna.split("-")
        an = parseInt(an_luna_arr[0]);
        luna = parseInt(an_luna_arr[1]);
    }

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
            var an_luna = cheltuiala.an.toString() + "-" + cheltuiala.luna.toString();
            
            if($.inArray(an_luna, cheltuieli) === -1) 
                cheltuieli.push(an_luna);

        });

        drop_an_luna = "<select id='drop_statistici'>";

        $.each(cheltuieli, function(key, val){

            var opt = "<option value=" + val + ">" + val + "</option> \n";

            drop_an_luna += opt;
        });

        drop_an_luna += "</select>";

        drop_an_luna += `<div onclick="getStatistici()" id='statistici' class='btn btn-primary m-b-15px delogare-button'>
                            Verifica luna
                         </div>`;

        var pie_chart = "<div class='container' align='center'> <canvas id='pieChart'></canvas> </div>";

        //console.log(cheltuieli);
        //console.log(categorii);

        var buget = sessionStorage.getItem("buget");
        var i = iesiri(categorii);
        var buget_ramas = buget - i;

        if(buget_ramas>0){
            var buget_html = `<div>
                            Buget pe luna: ` +  buget + `</br>
                            Total cheltuieli: ` +  i + `</br>
                            De cheltuit: ` +  buget_ramas + `</br>
                            </div>`;
        } else {
            var buget_html = `<div>
            Buget pe luna: ` +  buget + `</br>
            Total cheltuieli: ` +  i + `</br>
            <b>Ai depasit bugetul lunar!</b></br>
            </div>`;
        }

        
        // inject to 'page-content' of our app
        $("#page-content").html(buget_html + drop_an_luna + pie_chart);

        showGraph(categorii);


    });
}

function iesiri(c){

    var suma = 0;
    for (const [key, val] of Object.entries(c)){
        suma += val;
    }

    return suma;
}

function getStatistici(){
    an_luna = document.getElementById("drop_statistici").value;
    statistici(an_luna);
}

function showGraph(c){
    var categorii = c;
    var suma = Array();
    var cat = Array();

    for (const [key, val] of Object.entries(categorii)){
        //console.log(key, val);
        cat.push(key);
        suma.push(val);
    }


    console.log(cat);
    console.log(suma);

    var data = [{
        data: suma,
        labels: cat,
        backgroundColor: [
            "#4b77a9",
            "#5f255f",
            "#d21243",
            "#B27200",
            "#e45643",
            "#056243",
            "#c21243"
        ],
        borderColor: "#fff"
    }];

   

    var options = {
        tooltips: {
            enabled: true
        }
        };

    var ctx = document.getElementById('pieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data:  {
            labels: cat,
            datasets: data
        },
        options: options
    });
}


