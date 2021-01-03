

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
      
        //console.log("categorii");

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

        //var meniu_verif = "";
        //var start_tabel_verif = "<table><tr>";
        //var drop_statistici = `<td>` + an_luna + `</td>`;

        drop_an_luna = "<div class='custom-select'><select id='drop_statistici'>";

        $.each(cheltuieli, function(key, val){

            var opt = "<option value=" + val + ">" + val + "</option> \n";

            drop_an_luna += opt;
        });

        drop_an_luna += "</select></div>";

        drop_an_luna += `<div onclick="getStatistici()" id='statistici_luna' class='btn btn-primary m-b-15px verificare-button'>
                            Verifica luna
                         </div>`;
                    
        /*var verif_luna = `
        <td>` + drop_an_luna + `</td>`;

        var meniu_end = `
        </tr>
        </table>
        `;

        meniu_verif = start_tabel_verif + drop_statistici + verif_luna + meniu_end;
        $("#meniu_verif").html(meniu_verif);
        

        read_statistici_html = ` 
            
        <tr> 
            <td>`+an_luna+`</td>
            <td>`+drop_an_luna+`</td>
        </tr>
        `;
        read_statistici_html +=`</table>`;
        $("#page-content").html(read_statistici_html);  */




        var pie_chart = "<div class='container' align='center'> <canvas id='pieChart'></canvas> </div>";

        //console.log(cheltuieli);
        //console.log(categorii);

        var buget = sessionStorage.getItem("buget");
        var i = iesiri(categorii);
        var buget_ramas = buget - i;

        if(buget_ramas>0){

            // `<input type="text" id="ivaloare" name="ivaloare"></input>`;
            // valoare = document.getElementById("ivaloare").value;

            // var bug = `<input type="text" id="add_buget" name="add_buget"></input>`;
            // var bug = document.getElementById("add_buget").value;
            // var buget_html = `<div>
            // Buget pe luna: ` + buget + `</br>` + bug + `</br> </div>
            // <div onclick="adaugaBuget(`+ bug +`)" id='adaugare-buget' class='btn btn-primary m-b-15px adauga-cheltuiala-button'>
            //     Modifica buget
            // </div>
            // <div>
            //     Total cheltuieli: ` +  i + `</br>
            // </div>
            // De cheltuit: ` + buget_ramas + `</br>
            // <br>
            // </div>`;


            var buget_html = `<div id="detalii_buget">
                            <span class="glyphicon">&#xe225;</span> Buget lunar: ` +  buget + `</br>
                            <span class="glyphicon">&#x2212;</span> Total cheltuieli: ` +  i + `</br>
                            <span class="glyphicon">&#x2b;</span> De cheltuit: ` +  buget_ramas + `</br>
                            <br>
                            </div>`;
        } else {
            if(buget_ramas<0){

                
                // var bug = `<input type="text" id="add_buget" name="buget">`;
                // var input = document.getElementById("add_buget");
                // var buget_html = `<div>
                // Buget pe luna: ` + buget + `</br>` + bug + `</br> </div>
                // <div onclick="adaugaBuget(`+ input +`)" id='adaugare-buget' class='btn btn-primary m-b-15px adauga-cheltuiala-button'>
                //     Modifica buget
                // </div>
                // <div>
                //     Total cheltuieli: ` +  i + `</br>
                // </div>
                // <b>Ai depasit bugetul lunar!</b></br>
                // <br>
                // </div>`;



                var buget_html = `<div>
                <span class="glyphicon">&#xe225;</span> Buget lunar: ` +  buget + `</br>
                <span class="glyphicon">&#x2212;</span> Total cheltuieli: ` +  i + `</br>
                <span class="glyphicon">&#xe209;</span> <b>Ai depasit bugetul lunar!</b></br>
                <br>
                </div>`;
            }
            else {

                
                // var bug = `<input type="text" id="add_buget" name="buget"></td>`;
                // var input = document.getElementById("add_buget");
                // var buget_html = `<div>
                // Buget pe luna: ` + buget + `</br>` + bug + `</br> </div>
                // <div onclick="adaugaBuget(`+ input +`)" id='adaugare-buget' class='btn btn-primary m-b-15px adauga-cheltuiala-button'>
                //     Modifica buget
                // </div>
                // <div>
                //     Total cheltuieli: ` +  i + `</br>
                // </div>
                // <b>Bugetul tau este 0!</b></br>
                // <br>
                // </div>`;




                var buget_html = `<div>
                <span class="glyphicon">&#xe225;</span> Buget lunar: ` +  buget + `</br>
                <span class="glyphicon">&#x2212;</span> Total cheltuieli: ` +  i + `</br>
                <span class="glyphicon">&#xe209;</span> <b>Bugetul tau e 0!</b></br>
                <br>
                </div>`;
            }
        }

        
        // inject to 'page-content' of our app
        $("#page-content").html(buget_html + drop_an_luna + pie_chart);

        showGraph(categorii);


    });
}

function adaugaBuget(buget){

    var buget_nou = `<div>Buget pe luna: `+ buget;
    return buget_nou;

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


    //console.log(cat);
    //console.log(suma);

    var data = [{
        data: suma,
        labels: cat,
        backgroundColor: [
            "#9C505C",
            "#29212E",
            "#3D2A39",
            "#6A424D",
            "#CE726D",
            "#B27200",
            "#FFCB76"
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


