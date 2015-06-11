var AdminTable = function () {
    "use strict";
    return {
        //main function
        init: function (id, options) {
            if ($('#'+id).length !== 0) {
                var table = $('#'+id).DataTable({
                    "lengthMenu": [20, 40, 60],
                    "dom": 'C<"clear">lfrtip',
                    colVis: {
                        exclude: [ options.exclColumns ]
                    },
                    paging: false,
                    "autoWidth": true,
                    "order": [[ 0, "asc" ]],
                    "aoColumnDefs": options.sortConfig
                });
                var tbl = new $.fn.dataTable.FixedHeader(table);
                new $.fn.dataTable.KeyTable(table);

                $(window).resize(function() {
                    tbl._fnUpdateClones(true);
                    tbl._fnUpdatePositions();
                });
            }
        }
    };
}();