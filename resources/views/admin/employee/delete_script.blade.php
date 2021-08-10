<script type="application/javascript">
    function deleteItem(e) {

        let username = e.getAttribute('data-username');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: "delete/" + username,
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
                                $("#" + username + "").remove(); // you can add name div to remove
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
