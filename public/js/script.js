$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#date').datepicker();

    $(document).on('click', '.item-parent', function () {
        var item = $(this);
        var status = item.data('status');
        var id = item.data('id');
        var icon = item.find('.more-collaborators-icon');

        if (status === 'visible') {
            item.next('ul').slideUp();
            icon.removeClass('glyphicon-minus');
            icon.addClass('glyphicon-plus');
            item.data('status', 'none');
        } else if (status === 'none') {
            if (item.next('ul').prop("tagName") === "UL") {
                item.next('ul').slideDown();
                icon.removeClass('glyphicon-plus');
                icon.addClass('glyphicon-minus');
                item.data('status', 'visible');
            } else {
                $.post('/more-child', {'id': item.data('id')}, function (response) {
                    if (response !== '0') {
                        item.after(response);
                    }
                    item.data('status', 'visible');
                    icon.removeClass('glyphicon-plus');
                    icon.addClass('glyphicon-minus');
                })
            }
        }

    });

    $('#positions').select2({
        placeholder: "Введите название должности",
        language:'ru',
        ajax : {
            url : '/positions-search',
            dataType : 'json',
            delay : 200,
            data : function(params){
                return {
                    q : params.term,
                    page : params.page
                };
            },
            processResults : function(data, params){
                params.page = params.page || 1;

                return {
                    results : data,
                    pagination: {
                        more : (params.page  * 10) < data.total
                    }
                };
            }
        },
        minimumInputLength : 3,
        templateResult : function (repo){
            return repo.name;
        },
        templateSelection : function(repo)
        {
            if (repo.name === undefined) {
                return repo.text;
            }
            return repo.name;
        },
        escapeMarkup : function(markup){ return markup; }
    });

    $('#boss').select2({
        placeholder: "Введите ФИО начальника",
        language:'ru',
        ajax : {
            url : '/boss-search',
            dataType : 'json',
            delay : 200,
            data : function(params){
                return {
                    q : params.term,
                    page : params.page
                };
            },
            processResults : function(data, params){
                params.page = params.page || 1;
                return {
                    results : data,
                    pagination: {
                        more : (params.page  * 10) < data.total
                    }
                };
            }
        },
        minimumInputLength : 3,
        templateResult : function (repo){
            if(repo.position !== undefined) {
                return repo.name + '(' + repo.position.name + ')';
            }
            return repo.name;
        },
        templateSelection : function(repo)
        {
            if(repo.position !== undefined) {
                return repo.name + '(' + repo.position.name + ')';
            }
            if (repo.name === undefined) {
                return repo.text;
            }

            return repo.name;
        },
        escapeMarkup : function(markup){ return markup; }
    });

    $(document).on('click', '.reset-select', function () {
        $('#positions > option').remove();
        $('#positions').append('<option value=""></option>');
        search();
    });

    $(document).on('click', '.pagination li', function () {
        var li = $(this);
        search();
        $('.pagination .active').removeClass('active');
        li.addClass('active');
        return false;
    });

    $(document).on('keyup input, select2:select, change', '.search-query', function () {
        search();
    });

    var sortObj = {name:'id', sort:'asc'};

    $(document).on('click', '.sort-collaborators', function () {
        var sort = $(this);

        if (!sort.hasClass('sort-collaborators-active')){
            resetSort($('.sort-collaborators-active'));
            sort.addClass('sort-collaborators-active');
        }

        if(sort.data('sort') === 'desc') {
            sort.removeClass('glyphicon-chevron-up');
            sort.addClass('glyphicon-chevron-down');
        }else {
            sort.removeClass('glyphicon-chevron-down');
            sort.addClass('glyphicon-chevron-up');
        }

        if(sort.data('sort') === 'asc') {
            sort.data('sort', 'desc');
            sortObj.sort = 'asc';
        }else {
            sort.data('sort', 'asc');
            sortObj.sort = 'desc';
        }
        sortObj.name = sort.data('name');
        search();
    });

    function resetSort(elem) {
        if(elem.data('sort') === 'asc') {
            elem.removeClass('glyphicon-chevron-down');
            elem.addClass('glyphicon-chevron-up');
        }
        elem.removeClass('sort-collaborators-active');
        elem.data('sort', 'desc');

    }

    function getData() {
        var form = $('#search').serialize();
        var page = 'page=' + $('.pagination .active').text() + '&';
        var sort = '&sort=' + sortObj.name + 'By' + sortObj.sort;

        return page + form + sort;
    }

    function search() {
        fnDelay(function () {
            $.post('/collaborators', getData(), function (response) {
                result = JSON.parse(response);
                $('tbody').html(result.table);
                $('#pagination').html(result.pagination);

            })
        }, 1000);
    }

    var fnDelay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    $(document).on('click', '.collaborator-delete', function () {
        alert('Выдействительно хотите удалить этого сотрудника?')
    });


    var fileInput = $('#avatar').fileinput({
        language:'ru'
    });

});
