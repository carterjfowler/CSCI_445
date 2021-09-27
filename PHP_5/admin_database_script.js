$(document).ready(function(){
	$("#add").click(function(e){ 
		e.preventDefault();
		clearWarning();
	  	if (validateForm()) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("response").innerHTML = this.responseText;
					reloadProductTable();
			    }
			};
			var data = $("#databaseForm").serialize();
			data += "&type=add";
			xmlhttp.open("POST","do_admin.php",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send(data);
		}
	});

	$("#update").click(function(e){ 
  		e.preventDefault();
		clearWarning();
  		if (validateForm()) {
		    var xmlhttp = new XMLHttpRequest();
		    xmlhttp.onreadystatechange = function() {
		      if (this.readyState == 4 && this.status == 200) {
		        document.getElementById("response").innerHTML = this.responseText;
		        reloadProductTable();
		      }
		    };
		    var data = $("#databaseForm").serialize();
		    data += "&type=update";
		    xmlhttp.open("POST","do_admin.php",true);
		    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send(data);
		}
	});

	$("#delete").click(function(e){ 
  		e.preventDefault();
		clearWarning();
  		if (validateForm()) {
  			if (window.confirm("Are you sure you want to delete this product?")) {
				    var xmlhttp = new XMLHttpRequest();
				    xmlhttp.onreadystatechange = function() {
				      if (this.readyState == 4 && this.status == 200) {
				        document.getElementById("response").innerHTML = this.responseText;
				        reloadProductTable();
				      } else if (this.status != 200) {
				      	alert("Cannot delete, there are existing orders of this Dice Vault.");
				      }
				    };
				    var data = $("#databaseForm").serialize();
				    data += "&type=delete";
				    xmlhttp.open("POST","do_admin.php",true);
				    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlhttp.send(data);
				}
		}
	});
});

function validateForm() {
	//add more validation stuff
	var warning = document.getElementById("warning");
	var name = document.getElementById("dice_vault_name");
	var image = document.getElementById("dice_vault_image");

	if (name == "") {
		warning.innerHTML = "Please enter a name";
		name.focus();
		return false;
	} else if (image == "") {
		warning.innerHTML = "Please enter an image name";
		image.focus();
		return false;
	} else if (!(/\.(gif|jpe?g|tiff?|png|webp|bmp)$/i).test(image.value)) {
		warning.innerHTML = "Image field format incorrect";
		image.focus();
		return false;
	} else {
		return true;
	}
}

function clearWarning() {
	var warning = document.getElementById("warning");
	var response = document.getElementById("response");
	warning.innerHTML = "";
	response.innerHTML = "";
}

function reloadProductTable() {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  	if (this.readyState == 4 && this.status == 200) {
	    	document.getElementById("productTable").innerHTML = this.responseText;
	    	highlight_row();
		}
	};
	xmlhttp.open("GET","Unit5_get_product_table.php",true);
	xmlhttp.send();
}

function highlight_row() {
	var table = document.getElementById('adminProducts');
	var cells = table.getElementsByTagName('td');

	var productId = document.getElementById('id');
	var productName = document.getElementById('dice_vault_name');
	var price = document.getElementById('price');
	var quantity = document.getElementById('quantity');
	var image = document.getElementById('dice_vault_image');
	var inactive = document.getElementById('inactive');

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

		productId.value = rowSelected.cells[0].innerHTML;
		productName.value = rowSelected.cells[1].innerHTML;
		price.value = rowSelected.cells[2].innerHTML;
		quantity.value = rowSelected.cells[3].innerHTML;
		image.value = rowSelected.cells[4].innerHTML;
		if (rowSelected.cells[5].innerHTML == 'Yes')
			inactive.checked = true;
		else
			inactive.checked = false;
	}
}
}