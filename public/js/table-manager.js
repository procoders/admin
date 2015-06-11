var AdminTable = function () {
    "use strict";
    return {
        //main function
        init: function (id) {
            if ($('#'+id).length !== 0) {
                var table = $('#'+id).DataTable({
                    "lengthMenu": [20, 40, 60],
                    dom: 'Rlfrtip'
                });
                var tbl = new $.fn.dataTable.FixedHeader(table);

                $(window).resize(function() {
                    tbl._fnUpdateClones(true);
                    tbl._fnUpdatePositions();
                });
            }
        }
    };
}();