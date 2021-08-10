<script>
    function deleteItem(e) {

        let slug = e.getAttribute('data-slug');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "Data will be move to the trash",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: "companies/" + slug,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE",
                        },
                        success: function(data) {
                            if (data.success) {
                                swalWithBootstrapButtons.fire(
                                    data.title,
                                    data.message,
                                    "success"
                                ).then((result) => {
                                    // Reload the Page
                                    location.reload();
                                })
                                $("#" + slug + "").remove(); // you can add name div to remove
                            } else {
                                swalWithBootstrapButtons.fire(
                                    data.title,
                                    data.message,
                                    "warning"
                                ).then((result) => {
                                    // Reload the Page
                                    location.reload();
                                })
                                $("#" + slug + "").remove(); // you can add name div to remove
                            }
                        }
                    });

                }

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        });

    }
</script>
