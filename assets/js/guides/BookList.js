function bookList() {

    "use strict";

    var myBookList = {

        settings: {},
        strings: {},
        bindUiActions: function () {
            myBookList.validCharacters();
            myBookList.isNumberKey();
        },
        init: function () {
            myBookList.bindUiActions();
        },
        validCharacters: function () {
            $('textarea[name=BookList-extra-isbn]').on('paste', function() {
                var $el = $(this);
                setTimeout(function() {
                    $el.val(function(i, val) {
                        return val.replace(/[^0-9X,]/g, '')
                    })
                })
            });
        },
        isNumberKey: function ()
        {
            $('textarea[name=BookList-extra-isbn]').keypress(function(evt) {
                console.log('key')
                var result = true;
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if (charCode < 48 || charCode > 57)
                    result = false;

                if (charCode == 88 || charCode == 44 || charCode == 32)
                    result = true;

                return result;
            });
        }
    };

    return myBookList;
}