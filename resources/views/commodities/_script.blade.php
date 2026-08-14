<script>
	$(document).ready(function () {
		$(".show-modal").click(function () {
			const id = $(this).data("id");
			let url = "{{ route('api.barang.show', ':paramID') }}".replace(
				":paramID",
				id
			);

			$.ajax({
				url: url,
				header: {
					"Content-Type": "application/json",
				},
				success: (res) => {
					$("#show_commodity #item_code").val(res.data.item_code);
					$("#show_commodity #name").val(res.data.name);
					$("#show_commodity #commodity_location_id").val(
						res.data.commodity_location.name
					);
					
					$("#show_commodity #year_of_purchase").val(res.data.year_of_purchase);
					$("#show_commodity #condition").val(res.data.condition_name);
					
					$("#show_commodity #note").val(res.data.note);
					$("#show_commodity #quantity").val(res.data.quantity);
					$("#show_commodity #price").val(res.data.price_formatted);
					$("#show_commodity #price_per_item").val(res.data.price_per_item_formatted);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});

		$(".edit-modal").on("click", function () {
			const id = $(this).data("id");
			let url = "{{ route('api.barang.show', ':paramID') }}".replace(
				":paramID",
				id
			);

			let updateURL = "{{ route('barang.update', ':paramID') }}".replace(
				":paramID",
				id
			);

			$.ajax({
				url: url,
				method: "GET",
				header: {
					"Content-Type": "application/json",
				},
				success: (res) => {

    $("#edit_commodity form #item_code").val(res.data.item_code);
    $("#edit_commodity form #name").val(res.data.name);
    $("#edit_commodity form #commodity_location_id").val(res.data.commodity_location.id);
    $("#edit_commodity form #year_of_purchase").val(res.data.year_of_purchase);
    $("#edit_commodity form #commodity_condition_id")
    .val(String(res.data.commodity_condition_id))
    .trigger("change");

console.log("commodity_condition_id =", res.data.commodity_condition_id);
console.log(
    $("#edit_commodity form #commodity_condition_id").val()
);
    $("#edit_commodity form #note").val(res.data.note);
    $("#edit_commodity form #quantity").val(res.data.quantity);
    $("#edit_commodity form #price").val(res.data.price);
    $("#edit_commodity form #price_per_item").val(res.data.price_per_item);

    $("#edit_commodity form").attr("action", updateURL);

},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});
	});
</script>
