(function () {

    XonBoard.Users = {

        list: {

            selectors: {
                users_table: $('#users-table'),
            },

            init: function (pageName) {

                var data = {};

                if (pageName == 'active') {
                    data = { status: 'active', trashed: 0 };
                } else if (pageName == 'deleted') {
                    data = { status: 'inactive', trashed: 1 };
                } else if (pageName == 'deactive') {
                    data = { status: 'inactive', trashed: 0 };
                }


                this.selectors.users_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.users_table.data('ajax_url'),
                        type: 'post',
                        data: data
                    },
                    columns: [

                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'roles', name: 'roles', sortable: false },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'approved_at', name: 'approved_at' },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }
                    ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        XonBoard.Utils.dtAnchorToForm(row);
                    }
                })
            }
        },

        edit: {
            selectors: {
                getPremissionURL: "",
                getRoleForPermissions: "",
                getAvailabelPermissions: "",
                Role3: "",
                searchButton: "",
            },
            init: function (pageName) {
                this.setSelectors();
                this.addHandlers(pageName);
            },
            setSelectors: function () {
                this.selectors.getRoleForPermissions = document.querySelectorAll(".get-role-for-permissions");
                this.selectors.getAvailabelPermissions = document.querySelector(".get-available-permissions");
                this.selectors.searchButton = document.querySelector(".search-button");
                this.selectors.Role3 = document.getElementById("role-3");
            },
            addHandlers: function (pageName) {

                this.selectors.getRoleForPermissions.forEach(function (element) {
                    element.onclick = function (event) {

                        XonBoard.Users.edit.selectors.searchButton.value = '';
                        XonBoard.Utils.addClass(XonBoard.Users.edit.selectors.searchButton, 'hidden');
                        // XonBoard.Users.edit.selectors.searchButton.dispatchEvent(new Event('keyup'));

                        XonBoard.Utils.addClass(document.getElementById("available-permissions"), 'hidden');

                        callback = {
                            success: function (request) {
                                if (request.status >= 200 && request.status < 400) {
                                    // Success!
                                    var response = JSON.parse(request.responseText);
                                    var permissions = response.permissions;
                                    var rolePermissions = response.rolePermissions;
                                    var allPermisssions = response.allPermissions;

                                    XonBoard.Users.edit.selectors.getAvailabelPermissions.innerHTML = "";
                                    htmlstring = "";
                                    if (permissions.length == 0) {
                                        XonBoard.Users.edit.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
                                    } else {
                                        for (var key in permissions) {
                                            var addChecked = '';
                                            if (allPermisssions == 1 && rolePermissions.length == 0) {
                                                addChecked = 'checked="checked"';
                                            } else {
                                                if (typeof rolePermissions[key] !== "undefined") {
                                                    addChecked = 'checked="checked"';
                                                }
                                            }

                                            htmlstring += '<div><input type="checkbox" name="permissions[' + key + ']" value="' + key + '" id="perm_' + key + '" ' + addChecked + '/><label for="perm_' + key + '" style="margin-left:10px;">' + permissions[key] + '</label></div>';
                                        }
                                    }
                                    XonBoard.Users.edit.selectors.getAvailabelPermissions.innerHTML = htmlstring;
                                    XonBoard.Utils.removeClass(document.getElementById("available-permissions"), 'hidden');
                                    XonBoard.Utils.removeClass(XonBoard.Users.edit.selectors.searchButton, 'hidden');

                                } else {
                                    // We reached our target server, but it returned an error
                                    XonBoard.Users.edit.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
                                }
                            },
                            error: function () {
                                XonBoard.Users.edit.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
                            }
                        };

                        XonBoard.Utils.ajaxrequest(XonBoard.Users.edit.selectors.getPremissionURL, "post", {
                            role_id: event.target.value
                        }, XonBoard.Utils.csrf, callback);
                    };
                });

                this.selectors.searchButton.addEventListener('keyup', function (e) {

                    var searchTerm = this.value.toLowerCase();

                    XonBoard.Users.edit.selectors.getAvailabelPermissions.children.forEach(function (el) {

                        var shouldShow = true;

                        searchTerm.split(" ").forEach(function (val) {
                            if (shouldShow && (el.querySelector('label').innerHTML.toLowerCase().indexOf(val) == -1)) {
                                shouldShow = false;
                            }
                        });

                        if (shouldShow) {
                            XonBoard.Utils.removeClass(el, 'hidden');
                        } else {
                            XonBoard.Utils.addClass(el, 'hidden');
                        }
                    });
                });

                if (pageName == "create") {
                    XonBoard.Users.edit.selectors.Role3.click();
                }
            },
        },
    }
})();
