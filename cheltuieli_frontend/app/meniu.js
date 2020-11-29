
function showMeniu() {

    var meniu = `

        <table>
        <tr>
    `;

    var logare = `
        <td>
        <div onclick="showLogare()" id='logare' class='btn btn-primary m-b-15px logare-button'>
            Logare
        </div>
        </td>
    `;
    var inregistrare = `
        <td>
        <div onclick="showFormular()" id='inregistrare' class='btn btn-primary m-b-15px inregistrare-button'>
            Inregistrare
        </div>
        </td>
    `;
    var cheltuieli = `
        <td>
        <div onclick="showCheltuieli()" id='cheltuieli' class='btn btn-primary m-b-15px cheltuieli-button'>
            Cheltuieli
        </div>
        </td>
    `;
    var statistici = `
        <td>
        <div onclick="statistici(2020, 11)" id='statistici' class='btn btn-primary m-b-15px statistici-button'>
            Statistici
        </div>
        </td>
    `;
    var delogare = `
        <td>
        <div onclick="delogare()" id='delogare' class='btn btn-primary m-b-15px delogare-button'>
            Delogare
        </div>
        </td>
    `;
    var meniu_end = `
        </tr>
        </table>
    `;


    if(getID()) {

        meniu += cheltuieli + statistici + delogare + meniu_end;
    }
    else {

        meniu += logare + inregistrare + meniu_end;
    }

    $("#meniu").html(meniu);

}


