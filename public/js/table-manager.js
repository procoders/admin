var AdminTable = function () {
    "use strict";
    return {
        //main function
        init: function (id, options) {

            var bindFilters = function(filters, id) {
                for(var i=0; i < filters.length; i++) {
                    switch (filters[i].type) {
                        case 'dropdown':
                            $('#' + id + '-dropdown-' + i).data('sequance', filters[i].sequanceNumber);
                            $('#' + id + '-dropdown-' + i).on('change', function(){
                                var val = $(this).val();
                                var sequance = $(this).data('sequance');
                                table.column(sequance).search(val).draw();
                            });
                            break;
                        case 'text':
                        case 'price':
                            $('#' + id + '-' + filters[i].type + '-' + i).data('sequance', filters[i].sequanceNumber);
                            $('#' + id + '-' + filters[i].type + '-' + i).keyup(function(){
                                var val = $(this).val();
                                var sequance = $(this).data('sequance');
                                table.column(sequance).search(val).draw();
                            });
                            break;
                        case 'date':
                            $('#' + id + '-date-' + i).data('sequance', filters[i].sequanceNumber);
                            $('#' + id + '-date-' + i).datepicker({
                                format: 'dd.mm.yyyy',
                                todayHighlight: true,
                            });
                            $('#' + id + '-date-' + i).on('change', function(){
                                var val = $(this).val();
                                var sequance = $(this).data('sequance');
                                var rule = $(this).data('rule');
                                table.column(sequance).search('').draw();
                                if (val.length > 0) {
                                    var tmp = val.split('.');
                                    val = new Date(tmp[2], tmp[1]-1, tmp[0]);
                                    customFilters().date(val.getTime(), rule, sequance, table);
                                } else {
                                    table.column(sequance).search('').draw();
                                }
                            });
                            break;
                        case 'datetime':
                            $('#' + id + '-datetime-' + i).data('sequance', filters[i].sequanceNumber);
                            $('#' + id + '-datetime-' + i).datetimepicker({
                                format: "dd.mm.yyyy hh:ii",
                                autoclose: true,
                                minuteStep: 1
                            });
                            $('#' + id + '-datetime-' + i).on('change', function(){
                                var val = $(this).val();
                                var sequance = $(this).data('sequance');
                                var rule = $(this).data('rule');
                                table.column(sequance).search('').draw();
                                if (val.length > 0) {
                                    var tmp = val.split('.');
                                    var tmpYear = tmp[2].split(' ');
                                    var tmpTime = tmpYear[1].split(':');

                                    val = new Date(tmpYear[0], tmp[1]-1, tmp[0], tmpTime[0], tmpTime[1]);

                                    customFilters().datetime(val.getTime(), rule, sequance, table);
                                } else {
                                    table.column(sequance).search('').draw();
                                }
                            });
                            break;
                        case 'bool':
                            $('#' + id + '-bool-' + i).data('sequance', filters[i].sequanceNumber);
                            $('#' + id + '-bool-' + i).on('change', function(){
                                var val = $(this).val();
                                var sequance = $(this).data('sequance');
                                customFilters().bool(val, sequance, table);
                            });
                            break;
                    }
                }
                $('#reset-' + id).on('click', function() {
                    for(i=0; i < filters.length; i++) {
                        if (filters[i].type == 'dropdown') {
                            $('#' + id + '-dropdown-' + i).val('-1');
                        } else {
                            $('#' + id + '-' + filters[i].type + '-' + i).val('');
                        }
                        table.column(filters[i].sequanceNumber).search('');
                    }
                    table.draw();
                });
            };

            var customFilters = function() {
                return {
                    date: function(filterValue, rule, sequance, table) {
                        $.fn.dataTable.ext.search = [];
                        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                            var value = table.data()[dataIndex][sequance];
                            if (value['@data-order'] !== undefined)
                            {
                                value = value['@data-order'];
                            }
                            var tmp = value.split('-');
                            value = new Date(tmp[0], (tmp[1]-1), tmp[2]);

                            value = value.getTime();

                            var valid = false;
                            switch (rule) {
                                case '>':
                                    valid = (filterValue > value);
                                    break;
                                case '<':
                                    valid = (filterValue < value);
                                    break;
                                case '<=':
                                    valid = (filterValue <= value);
                                    break;
                                case '>=':
                                    valid = (filterValue >= value);
                                    break;

                            }

                            return valid;
                        });
                        table.column(sequance).draw();
                    },
                    datetime: function(filterValue, rule, sequance, table) {
                        $.fn.dataTable.ext.search = [];
                        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                            var value = table.data()[dataIndex][sequance];
                            if (value['display'] !== undefined)
                            {
                                value = value['display'];
                            }

                            var tmp = value.split('.');
                            var tmpDay = tmp[2].split(' ');
                            var tmpTime = tmpDay[1].split(':');

                            value = new Date(tmp[0], tmp[1]-1, tmpDay[0], tmpTime[0], tmpTime[1]);

                            value = value.getTime();

                            var valid = false;
                            switch (rule) {
                                case '>':
                                    valid = (filterValue > value);
                                    break;
                                case '<':
                                    valid = (filterValue < value);
                                    break;
                                case '<=':
                                    valid = (filterValue <= value);
                                    break;
                                case '>=':
                                    valid = (filterValue >= value);
                                    break;

                            }

                            return valid;
                        });
                        table.column(sequance).draw();
                    },
                    bool: function(filterValue, sequance, table) {
                        $.fn.dataTable.ext.search = [];
                        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                            var value = table.data()[dataIndex][sequance];
                            if (filterValue.length < 1)
                                return true;
                            if (value['@data-search'] !== undefined) {
                                value = value['@data-search'];
                            }
                            return (filterValue == value);
                        });
                        table.column(sequance).draw();
                    }
                }
            };

            if ($('#'+id).length !== 0) {
                var table = $('#'+id).DataTable({
                    "lengthMenu": [20, 40, 60],
                    "dom": 'C<"clear">lfrtip',
                    colVis: {
                        exclude: [ options.exclColumns ]
                    },
                    paging: true,
                    "autoWidth": true,
                    "order": [[ 0, "asc" ]],
                    "aoColumnDefs": options.sortConfig
                });

                if (typeof options.filters != 'undefined' && options.filters.length > 0) {
                    bindFilters(options.filters, id);
                }

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