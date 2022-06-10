(function () {
    XonBoard.Notifications = {
        list: {

            selectors: {
                notifications_table: $('#notifications-table'),
            },

            init: function () {

                this.selectors.notifications_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.notifications_table.data('ajax_url'),
                        type: 'post',
                    },
                    columns: [
                        {data: 'created_by', name: 'changes.created_by'},
                        {data: 'created_at', name: 'changes.created_at'},
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
