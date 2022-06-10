(function () {
    XonBoard.Coalitions = {
        list: {

            selectors: {
                coalitions_table: $('#coalitions-table'),
            },

            init: function () {

                this.selectors.coalitions_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.coalitions_table.data('ajax_url'),
                        type: 'post',
                    },
                    columns: [
                        {data: 'name', name: 'coalitions.name'},
                        {data: 'created_by', name: 'coalitions.created_by'},
                        {data: 'created_at', name: 'coalitions.created_at'},
                        {data: 'actions', name: 'actions', searchable: false, sortable: false}
                    ],
                    order: [[0, "desc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        XonBoard.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },

        edit: {
            selectors: {},

            init: function (locale) {
                this.addHandlers(locale);
                XonBoard.tinyMCE.init(locale);
            },

            addHandlers: function (locale) {
            },
        },
    }
})();
