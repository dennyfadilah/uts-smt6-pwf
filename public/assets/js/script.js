$(function () {
	// Initialize Bootstrap
	$('[data-bs-toggle="dropdown"]').dropdown();
	$('[data-bs-toggle="tooltip"]').tooltip();

	// Sidebar
	$("#btnSidebar").on("click", function () {
		$("#sidebar").toggleClass("d-md-block");
		$("#layoutSidebar").toggleClass("d-md-block");
		$("#layoutContent").toggleClass("col-md-10");
	});

	// Alert
	setTimeout(() => {
		$(".alert").fadeOut();
	}, 5000);

	$("#category").on("change", function () {
		var category = $(this).val();

		$("#product_id").empty().append("<option selected>Pilih Produk</option:");

		if (category) {
			$.ajax({
				url: "/api/get-by-category/" + category,
				method: "GET",
				dataType: "json",
				success: function (products) {
					$.each(products, function (index, product) {
						$("#product_id").append(
							$("<option></option>").val(product.id).text(product.product_name)
						);
					});
				},
				error: function (xhr, status, error) {
					console.error("Error fetching products:", error);
				},
			});
		}
	});

	$("#product_id").on("change", function () {
		var product_id = $(this).val();

		if (product_id) {
			$.ajax({
				url: "/api/get-unit-price/" + product_id,
				method: "GET",
				dataType: "json",
				success: function (unit_price) {
					$("#unit_price").val(unit_price);
				},
				error: function (xhr, status, error) {
					console.error("Error fetching unit price:", error);
				},
			});
		}
	});

	$("#quantity").on("change", function () {
		var quantity = $(this).val();
		var unit_price = $("#unit_price").val();
		var count_price = $("#count_price").val(unit_price * quantity);
		var total_price = $("#total_price");

		total_price.val(count_price.val());
		$("#discount_applied").on("change", function () {
			var discount_applied = $(this).val();

			total_price.val(
				count_price.val() - (count_price.val() * discount_applied) / 100
			);
		});
	});
});

function calculateUnitPrice() {
	var price = $("#price").val() || 0;
	var discount = $("#discount_percentage").val() || 0;
	var unit_price = $("#unit_price") || 0;

	unit_price.val(price - (price * discount) / 100);
}
