<script>
    // DataTables
    $(document).ready(function () {
        var table = $('#myTable').DataTable({
            paging: false,
            searching: false,
            responsive: true,
            // dom: 'Bftip',
            buttons: [
                {
                    extend: 'print',
                    text: '<i class="fa-solid fa-print"></i> Print',
                    autoPrint: true,
                    exportOptions: {
                        columns: ':visible',
                    },
                    customize: function (win) {
                        $(win.document.body).find('table').addClass('display').css('font-size', '9px');
                        $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                            $(this).css('background-color', '#D0D0D0');
                        });
                    },
                    className: 'btn btn-warning rounded-0 btn-sm',
                },{
                    extend: 'pdf',
                    text: '<i class="fa-regular fa-file-pdf"></i> Pdf',
                    className: 'btn btn-danger rounded-0 btn-sm',
                },{
                    extend: 'excel',
                    text: '<i class="fa-regular fa-file-excel"></i> Excel',
                    className: 'btn btn-success rounded-0 btn-sm'
                }
            ],
            layout: {
                topStart: 'buttons',
            },
        });
    });
</script>