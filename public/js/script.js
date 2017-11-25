$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
   $(document).on('click', '.item-parent', function () {
        var item = $(this);
        var status = item.data('status');
        var id = item.data('id');
        var icon = item.find('.more-collaborators-icon');

        if(status === 'visible') {
            item.next('ul').slideUp();
            icon.removeClass('glyphicon-minus');
            icon.addClass('glyphicon-plus');
            item.data('status', 'none');
        }else if (status === 'none') {
            //console.log(item.prop("tagName"));
            if(item.next('ul').prop("tagName") === "UL") {
                item.next('ul').slideDown();
                icon.removeClass('glyphicon-plus');
                icon.addClass('glyphicon-minus');
                item.data('status', 'visible');
            }else {
                $.post('/more-child', {'id' : item.data('id')}, function (response) {
                    if(response !== '0' ) {
                        item.after(response);
                    }
                    item.data('status', 'visible');
                    icon.removeClass('glyphicon-plus');
                    icon.addClass('glyphicon-minus');
                })
            }
        }

    });
});
