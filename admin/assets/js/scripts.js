$("#quantity").on('keyup', function() {
	var retailProduct = $("#retailProduct").val();
	var quantity = $("#quantity").val();
	$.ajax({
		url: "check/data-check.php",
		method: "POST",
		data: {quantity: quantity, retailProduct: retailProduct},
		dataType: 'text',
		success: function(data) {
			$("#unitPrice").val(data);
		}
	});
});


$("#factoryPrice, #labourCost, #othersOne, #othersTwo").on('input', function() {
	var actualPrice = $("#actualPrice").val();
	var factoryCost = $("#factoryPrice").val();
	var labourCost = $("#labourCost").val();
	var othersOne = $("#othersOne").val();
	var othersTwo = $("#othersTwo").val();
	
	$.ajax({
		url: "check/productCost.php",
		method: "POST",
		data: {actualPrice: actualPrice, factoryCost: factoryCost, labourCost: labourCost, othersOne: othersOne, othersTwo: othersTwo},
		dataType: 'text',
		success: function(data) {
			$("#totalCost").val(data);
		}
	});
});

$("#profit").on('input', function() {
	var totalCost = $("#totalCost").val();
	var profit = $("#profit").val();
	
	$.ajax({
		url: "check/productCost.php",
		method: "POST",
		data: {profit: profit, totalCost: totalCost},
		dataType: 'text',
		success: function(data) {
			$("#productPrice").val(data);
		}
	});
});

$("#productDiscount").on('input', function() {
	var profit = $("#profit").val();
	var productPrice = $("#productPrice").val();
	var productDiscount = $("#productDiscount").val()
	var total = (productPrice / 100) * productDiscount;
	var profitMargin = profit - total;
	
	$.ajax({
		url: "check/productCost.php",
		method: "POST",
		data: {productPrice: productPrice, productDiscount: productDiscount},
		dataType: 'text',
		success: function(data) {
			$("#salePrice").val(data);
			$("#profitMargin").val(profitMargin);
		}
	});
	
});

function deleteTempProduct(id) {
	$.ajax({
		type: 'POST',
		url: 'check/data-check.php',
		data: {
			deletePro: id
		},
		dataType: 'text',
		success: function(response) {
			$("#msg").html(response);
		}
	});
	alert('Product deleted successfully!');
}

function deleteRetailProduct(id) {
	
	var confirmation = confirm("Are you sure you want to delete the product?");
	
	if(confirmation) {
		$.ajax({
			type: 'POST',
			url: 'check/data-check.php',
			data: {
				delRetail: id
			},
			dataType: 'text',
			success: function(response) {
				$("#msg").html(response);
			}
		});
		alert('Product deleted successfully!');
	}
}

$("#retailProduct").on('change', function() {
	var retailId = $(this).val();
	$.ajax({
		type: 'POST',
		url: 'check/data-check.php',
		data: {
			retailId: retailId
		},
		dataType: 'JSON',
		success: function(response) {
			 $("#outImg").attr("src", response[2]);
			 $("#existingQty").val(response[6]);
		}
	});
});

$("#MFproductId").on('change', function() {
	var MFproductId = $(this).val();
	// $("#outImg").attr("src", MFproductId);
	$.ajax({
		type: 'POST',
		url: 'check/data-check.php',
		data: {
			MFproductId: MFproductId
		},
		dataType: 'JSON',
		success: function(response) {
			 $("#outImg").attr("src", response[7]);
			 $("#existingQty").val(response[6]);
		}
	});
});