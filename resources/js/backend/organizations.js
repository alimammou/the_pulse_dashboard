(function () {
    XonBoard.Organizations = {
        list: {

            selectors: {
                organizations_table: $('#organizations-table'),
            },

            init: function () {

                this.selectors.organizations_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.organizations_table.data('ajax_url'),
                        type: 'post',
                    },
                    columns: [
                        {data: 'name', name: 'organizations.name'},
                        {data: 'created_by', name: 'organizations.created_by'},
                        {data: 'created_at', name: 'organizations.created_at'},
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
