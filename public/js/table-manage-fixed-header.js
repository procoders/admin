var handleDataTableFixedHeader = function() {
	"use strict";
    
    if ($('#data-table').length !== 0) {
        var table = $('#data-table').DataTable({
            "lengthMenu": [20, 40, 60]
        });
        new $.fn.dataTable.FixedHeader(table);
    }
};

var TableManageFixedHeader = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleDataTableFixedHeader();
        }
    };
}();