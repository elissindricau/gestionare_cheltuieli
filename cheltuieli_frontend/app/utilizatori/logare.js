function showLogare() {

    var login = `
    
    <div class="row">
		<div class="col-md-12">
			<form role="form" id="formular-logare" action="#" method="post">
            
				<div class="form-group">
					 
					<label for="email">
						Email
					</label>
					<input type="email" class="form-control" id="lemail" />
				</div>
				<div class="form-group">
					 
					<label for="parola">
						Parola
					</label>
					<input type="password" class="form-control" id="lparola" />
                </div>
                <div onclick="verificaUtilizator()" id='logare' class='btn btn-primary m-b-15px logare-button'>
                        Logare
                </div>
			</form>
		</div>
	</div>
    
    `;


    //var text = "pagina logare";
    $("#page-content").html(login);

}


function verificaUtilizator() {

    email = document.getElementById("lemail").value;
    parola = document.getElementById("lparola").value;

    form_data = {
        "email": email,
        "parola": parola
    };

    var form_data=JSON.stringify(form_data);

    // submit form data to api
    $.ajax({
        url: "http://localhost/gestionare_cheltuieli/cheltuieli_api/utilizator/verifica_utilizator.php",
        type : "POST",
        contentType : 'application/json',
        data : form_data,
        success : function(result) {
            // product was created, go back to products list
            logheazaUtilizator(result);
        },
        error: function(xhr, resp, text) {
            alert("Email sau parola gresita");
            showLogare();
            // show error to console
            //console.log(xhr, resp, text);
        }
    });

}

function logheazaUtilizator(result) {

    var user = result.records[0];

    sessionStorage.setItem("user_id", user["id"]);
    sessionStorage.setItem("nume", user["nume"]);
    sessionStorage.setItem("prenume", user["prenume"]);
    sessionStorage.setItem("email", user["email"]);
    sessionStorage.setItem("buget", user["buget"]);

    showMeniu();
    showCheltuieli();

}

function delogare() {

    sessionStorage.clear();
    showMeniu();
    showLogare();
}