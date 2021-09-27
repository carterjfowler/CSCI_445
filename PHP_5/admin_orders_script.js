$(document).ready(function(){
	loadOrderTable();
	$("#run").click(function(e){ 
		e.preventDefault();
		clearWarning();
	  	if (validateForm()) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("ordersTable").innerHTML = this.responseText;
			    }
			};
			var data = $("#adminOrdersForm").serialize();
			xmlhttp.open("POST","ajaxLoad.php",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send(data);
		}
	});
});

function validateForm() {
	//add more validation stuff
	var customer = document.getElementById("customer");
	var product = document.getElementById("product");
	var totals = document.getElementById("totals");
	var table = document.getElementById("ordersTable");

	if (totals.checked == true && customer.checked == false && product.checked == false) {
		table.innerHTML = "<p id='warning' style='color: red;'>Must select customer or product!</p>";
		return false;
	}
	return true;
}

function clearWarning() {
	var table = document.getElementById("ordersTable");
	table.innerHTML = "";
}

function clearFilters() {
	$("#product_type").val("default");
	$("#customer_list").val("default");
}

function clearAllButProduct() {
	var customer = document.getElementById("customer");
	var product = document.getElementById("product");
	var totals = document.getElementById("totals");
	customer.checked = false;
	product.checked = false;
	totals.checked = false;
	$("#customer_list").val("default");
}

function clearAllButCustomer() {
	var customer = document.getElementById("customer");
	var product = document.getElementById("product");
	var totals = document.getElementById("totals");
	customer.checked = false;
	product.checked = false;
	totals.checked = false;
	$("#product_type").val("default");
}

function loadOrderTable() {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("ordersTable").innerHTML = this.responseText;
		}
	};
	var data = $("#adminOrdersForm").serialize();
	xmlhttp.open("POST","ajaxLoad.php",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);
}
