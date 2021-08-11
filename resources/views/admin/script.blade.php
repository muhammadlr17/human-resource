<script>
    function clean() {

        let timerInterval

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });

        swalWithBootstrapButtons.fire({
            title: 'System Cleaner',
            text: "All cache will be clean",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, clean it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'GET',
                        url: "cleaner/process",
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Cleaning system ...',
                                    html: 'Cleaning will be completed in <b></b> milliseconds.',
                                    timer: 1500,
                                    timerProgressBar: true,
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        const b = Swal.getHtmlContainer().querySelector(
                                            'b')
                                        timerInterval = setInterval(() => {
                                            b.textContent = Swal.getTimerLeft()
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        Swal.fire(
                                            'Success',
                                            'System cleaned successfully!',
                                            'success'
                                        )
                                    }
                                })
                            }
                        }
                    });

                }

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Uncleaned system',
                    'error'
                );
            }
        });

    }
</script>
