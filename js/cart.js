//we hide the confirmation window until the user press the button

$(document).ready(function () {
    $('#confirmation_window').hide();
});
//the window cannot be close until after 1 second to avoid double clicks
var blocked = true;
//if the user click somewhere else we close the window


// add it to list 
function submitNumber() {
    //check if quantity is not empty
    var number = document.getElementById('quantity').value;
    if (number == 0) {
        alert("Has olvidado decirnos cuantos quieres");
    } else {
        var url = "includes/posts.php"; // the script where you handle the form input.

        $.ajax({
            type: "POST",
            url: url,
            data: $("#setNumber").serialize(), // serializes the form's elements.
            success: function (data)
            {
                location.reload();
                // alert(data); // show response from the php script.
            }
        });
    }
}

// give the price of the product:
function calculate() {

    var number = document.getElementById("quantity").value;
    var price = document.getElementById("theprice").value;

    var result = number * price;

    document.getElementById('price').value = result;


}

//it will receive everything to create the add table from the php code menulist.php
function addData(tempArray, clicked_id) {

    var div = document.createElement("div");

    div.innerHTML = '<div id="product"  class="fixed_window" method="postS" >\
            <iframe name="votar" style="display:none;"></iframe>\
            <form id="setNumber" onsubmit="submitNumber()" target="votar">\
                <p align="center" >' + tempArray[clicked_id][2] + '</p>\
                Producto:</br>\
                <input type="text" name="product" value="' + tempArray[clicked_id][1] + '" readonly> </br>\
                Cantidad:</br>\
                <input id="quantity" onkeyup="calculate()" onClick="calculate()" class="form-control" type="number" name="quantity"\
                       min="0" max="100" step="1" value="0" >\
                Price:</br>\
                <input id="price"   type="text" name="price"  readonly> </br>\
                    <input type="hidden" id="theprice" value="' + tempArray[clicked_id][3] + '">\
                <input type="submit" value="Confirmar">\
            </form> \
            </div>';

    document.body.appendChild(div);

    blocked = true;
    $("#product").show();
//we block this window for 1 second
    setTimeout(function () {
        blocked = false;
    }, 1000);

}
//it will show the confirmation window (we hided it before)
function ConfirmationWindow() {
    $("#confirmation_window").show();
}

//the user pressed the confirm order so we send the productud and its quantity to the database, it come from php_js
function ConfirmOrderData(product, quantity,company,table) {
    
    alert("here");
    if (product.length != 0) {
        $.ajax({
            type: "POST",
            url: "includes/posts.php",
            data: {'productToDB': product,
                'productQuantity': quantity,
                 'company': company,
                 'table': table
            },
            success: function (data)
            {
                if (data == "") {
                    alert("¡Oído cocina!"); // show response from the php script.
                }

            }
        });
//we remove the table and present a confirmation message
        $('#cart_table').remove();
        $('#total_title').remove();
        $('#total_price').remove();
        $('#confirmation_window').hide();
        var div = document.createElement("div");

        div.innerHTML = '<h2 align="center">¡Oído Cocina!</h2>';

        document.body.appendChild(div);
    } else {
        alert("¡No has añadido nada a la lista!");
    }
}


//if the user cancel the order we just hide the window.
function CancelOrder() {
    $('#confirmation_window').hide();
}


//before delete the clicked row we take away the deleted price from the total price and delete that row from the sessions array  


