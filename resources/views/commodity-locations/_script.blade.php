<script>
$(document).ready(function () {

    $(".edit-modal").click(function () {

        const id = $(this).data("id");

        let url = "{{ route('api.ruangan.show', ':paramID') }}"
            .replace(":paramID", id);

        let updateURL = "{{ route('ruangan.update', ':paramID') }}"
            .replace(":paramID", id);

        $.ajax({
            url: url,
            type: "GET",

            success: function(res){

                $("#commodity_location_edit_modal form")
                    .attr("action", updateURL);

                $("#commodity_location_edit_modal #name")
                    .val(res.data.name);

                $("#commodity_location_edit_modal #description")
                    .val(res.data.description);

            },

            error: function(err){
                console.log(err);
                alert("error occured, check console");
            }

        });

    });

});
</script>
<script>
$(document).ready(function () {

    $(".show-modal").click(function () {

        const id = $(this).data("id");

        let url = "{{ route('api.ruangan.show', ':paramID') }}"
            .replace(":paramID", id);

        $.ajax({

            url: url,
            type: "GET",

            success:function(res){

                $("#show_commodity_location #name")
                    .val(res.data.name);

                $("#show_commodity_location #description")
                    .val(res.data.description);

            },

            error:function(err){

                console.log(err);

                alert("Terjadi kesalahan.");

            }

        });

    });

});
</script>   