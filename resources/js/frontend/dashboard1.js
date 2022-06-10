(function () {
    XonBoard.Dashboard1 = {
        list: {


            init: function (data) {
                let result = data.toLowerCase();
                $("path[id='"+result+"']").css("fill",'var(--color_2)')
                $('select').select2({
                    sortField: 'text'
                });

            }
        },

    }
})();
