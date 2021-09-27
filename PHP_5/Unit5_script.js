$(document).ready(function(){
	$("#form").submit(function(){
  		event.preventDefault();
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("orderMessage").innerHTML = this.responseText;
	        setAvail();
	      }
	    };
	    var data = $("#form").serialize();
	    xmlhttp.open("POST","Unit5_ajaxsubmit.php",true);
	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(data);
	});
});

function setAvail() {
	var product = document.getElementById("product_type").value;

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  	if (this.readyState == 4 && this.status == 200) {
	    	document.getElementById("product_available").value = this.responseText;
		}
	};
	var data = "name=" + product;
	xmlhttp.open("GET","Unit5_ajaxQty.php?" + data,true);
	xmlhttp.send();
}


function checkName(name, type) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  	if (this.readyState == 4 && this.status == 200) {
	    	document.getElementById("customerTable").innerHTML = this.responseText;
	    	highlight_row();
		}
	};
	var data = "name=" + name + "&type=" + type;
	xmlhttp.open("GET","Unit5_get_customer_table.php?" + data,true);
	xmlhttp.send();
}

function highlight_row() {
    var table = document.getElementById('custHint');
    var cells = table.getElementsByTagName('td');

    var firstName = document.getElementById('first_name');
    var lastName = document.getElementById('last_name');
    var email = document.getElementById('email');

    for (var i = 0; i < cells.length; i++) {
        // Take each cell
        var cell = cells[i];
        // do something on onclick event for cell
        cell.onclick = function () {
            // Get the row id where the cell exists
            var rowId = this.parentNode.rowIndex;

            var rowsNotSelected = table.getElementsByTagName('tr');
            for (var row = 0; row < rowsNotSelected.length; row++) 
                rowsNotSelected[row].classList.remove('selected');

            var rowSelected = table.getElementsByTagName('tr')[rowId];
            rowSelected.className += " selected";

            firstName.value = rowSelected.cells[0].innerHTML;
            lastName.value = rowSelected.cells[1].innerHTML;
            email.value = rowSelected.cells[2].innerHTML;
        }
    }

}