<script>
    // DataTables
    $(document).ready(function () {
        $('#myTable2').DataTable({
            paging: true,
            processing: true,
            responsive: true,
            language: {
                "decimal": "",
                "emptyTable": "No data available in table",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "_MENU_ Data ditampilkan",
                "loadingRecords": "Loading...",
                "processing": "Loading...",
                "search": "Cari:",
                "zeroRecords": "Tidak ada data yang cocok",
            }
        });
    });
</script>