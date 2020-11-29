

function showFormular() {

    var formular = `
    
    <div class="row">
		<div class="col-md-12">
			<form role="form" id="formular-inregistrare" action="#" method="post">
                <div class="form-group">
					 
					<label for="nume">
						Nume
					</label>
					<input type="text" class="form-control" id="unume" />
                </div>
                <div class="form-group">
					 
					<label for="prenume">
						Prenume
					</label>
					<input type="text" class="form-control" id="uprenume" />
				</div>
				<div class="form-group">
					 
					<label for="email">
						Email
					</label>
					<input type="email" class="form-control" id="uemail" />
				</div>
				<div class="form-group">
					 
					<label for="parola">
						Parola
					</label>
					<input type="password" class="form-control" id="uparola" />
                </div>
                <div class="form-group">
					 
					<label for="conf_parola">
						Confirmare parola
					</label>
					<input type="password" class="form-control" id="uconf_parola" />
                </div>
                <div class="form-group">
					 
					<label for="buget">
						Buget
					</label>
					<input type="number" class="form-control" id="ubuget" />
				</div>
                <div onclick="creazaUtilizator()" id='inregistrare' class='btn btn-primary m-b-15px inregistrare-button'>
                        Inregistrare
                </div>
			</form>
		</div>
	</div>
    
    `;

    $("#page-content").html(formular);

    
}


