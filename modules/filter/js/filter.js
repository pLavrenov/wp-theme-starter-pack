
function filter_reset_values() {
    /*
    $("#price_field").slider({
        values: [filter_default['price']['min'], filter_default['price']['max']]
    });
    $("#area_filter").slider({
        values: [filter_default['area']['min'], filter_default['area']['max']]
    });
    $("#terrace_filter").slider({
        values: [filter_default['terrace']['min'], filter_default['terrace']['max']]
    });

    $("#floor_filter").val('').trigger('refresh');

    $("#bedroom_filter").val('').trigger('refresh');
    */


    $(".catalog-sortirovka__link").removeClass('down up active');

    filter_values['rooms_count'] = '';
    $('#rooms_count').siblings('span.value').text('Любой');

    filter_values['projects_square'] = '';
    $('#projects_square').siblings('span.value').text('Любой');

    // Очищаем этажи
    filter_values['floor_count'] = '';
    $('.projects-filter__floor').removeClass('active');

}

function filter_set_values() {
    /*

    $('.select > .option').click(function () {
        var val = $(this).data('value');
        $(this).parent().siblings('select').find('option[value=' + val + ']').attr('selected','selected').change();
    });

    $("#projects_square").closest('.projects-filter__select').find('.select > .option').click(function () {
        var val = $(this).data('value');
        filter_values['projects_square'] = val;
        console.log('Выбрана площадь', val);
    });

    $("#rooms_count").closest('.projects-filter__select').find('.select > .option').click(function () {
        var val = $(this).data('value');
        filter_values['rooms_count'] = val;
        console.log('Выбрана спален', val);
    });

    $("#floor_count").find('.projects-filter__floor').click(function () {
        var val = $(this).data('value');
        if ($(this).hasClass('active')) {
            filter_values['floor_count'] = '';
        } else {
            filter_values['floor_count'] = $(this).data('value');
        }
        $(this).toggleClass('active');
        console.log('Этаж', val);
    });

    $("#price_field").slider({
        min: filter_values['price']['min'],
        max: filter_values['price']['max'],
        values: [filter_values['price']['min'],filter_values['price']['max']],
        range: true,
        stop: function(event, ui) {
            filter_values['price']['min'] = $("#price_field").slider("values", 0);
            filter_values['price']['max'] = $("#price_field").slider("values", 1);
            $("input#minCost").val($("#price_field").slider("values",0));
            $("input#maxCost").val($("#price_field").slider("values",1));
        },
        slide: function(event, ui){
            $("input#minCost").val($("#price_field").slider("values",0));
            $("input#maxCost").val($("#price_field").slider("values",1));
        }
    });

    $("#price_field").slider({
        min: filter_values['price']['min'],
        max: filter_values['price']['max'],
        values: [filter_values['price']['min'],filter_values['price']['max']],
        range: true,
        stop: function(event, ui) {
            filter_values['price']['min'] = $("#price_field").slider("values", 0);
            filter_values['price']['max'] = $("#price_field").slider("values", 1);
            $("input#minCost").val($("#price_field").slider("values",0));
            $("input#maxCost").val($("#price_field").slider("values",1));
        },
        slide: function(event, ui){
            $("input#minCost").val($("#price_field").slider("values",0));
            $("input#maxCost").val($("#price_field").slider("values",1));
        }
    });
    $("#area_filter").slider({
        min: filter_values['area']['min'],
        max: filter_values['area']['max'],
        values: [filter_values['area']['min'],filter_values['area']['max']],
        range: true,
        stop: function(event, ui) {
            filter_values['area']['min'] = $("#area_filter").slider("values", 0);
            filter_values['area']['max'] = $("#area_filter").slider("values", 1);
            $("input#minCost2").val($("#area_filter").slider("values",0));
            $("input#maxCost2").val($("#area_filter").slider("values",1));
        },
        slide: function(event, ui){
            $("input#minCost2").val($("#area_filter").slider("values",0));
            $("input#maxCost2").val($("#area_filter").slider("values",1));
        }
    });
    $("#terrace_filter").slider({
        min: filter_values['terrace']['min'],
        max: filter_values['terrace']['max'],
        values: [filter_values['terrace']['min'],filter_values['terrace']['max']],
        range: true,
        stop: function(event, ui) {
            filter_values['terrace']['min'] = $("#terrace_filter").slider("values", 0);
            filter_values['terrace']['max'] = $("#terrace_filter").slider("values", 1);
            $("input#minCost3").val($("#terrace_filter").slider("values",0));
            $("input#maxCost3").val($("#terrace_filter").slider("values",1));
        },
        slide: function(event, ui){
            $("input#minCost3").val($("#terrace_filter").slider("values",0));
            $("input#maxCost3").val($("#terrace_filter").slider("values",1));
        }
    });
    $("#floor_filter").change(function() {
        filter_values['floor'] = $(this).find('option:selected').val();
    });
    $("#bedroom_filter").change(function() {
        filter_values['bedroom'] = $(this).find('option:selected').val();
    });
*/

}

function filter_sorted_values() {

    $(".catalog-sortirovka__link").click(function (e) {
        e.preventDefault();

        if ($(this).hasClass('active')) {
            if ($(this).data('order') == 'ASC') {
                $(this).data('order', 'DESC');
                // Ч
                $(this).toggleClass('up down');
                // Ч
            } else {
                $(this).data('order', 'ASC');
                // Ч
                $(this).toggleClass('up down');
                // Ч
            }
        } else {
            $(".catalog-sortirovka__link").data('order', 'DESC').removeClass('active');
            // Ч
            $(this).addClass('down');
            // Ч
            $(this).addClass('active');
        }

        filter_values['sort_by'] = $(this).data('sort');
        filter_values['order_by'] = $(this).data('order');

        update_projects_list();
    });

}


// Инициализация фильтра
if ($('[filters-block]').length > 0 && typeof filter_values != "undefined") {

    var $filter_reset_btn = $('#filter_reset_btn');
    var $filter_load_btn = $('#filter_load_btn');
    var $load_btn = $('#filter_loadmore');
    var $list_items = $('#load_list');

    // Слушатели обновления фильтра
    filter_set_values();

    // Сортировка по параметрам
    filter_sorted_values();

    // Сброс фильтра
    $filter_reset_btn.click(function(){

        console_event('Сброс фильтра');

        filter_active = clone_object(filter_default);
        filter_values = clone_object(filter_default);

        // Сброс параметров
        filter_reset_values();

        // Сброс параметров конец
        update_projects_list();
    });

    // Применение фильтра
    $filter_load_btn.click(function(){
        console_event('Применение фильтра');
        update_projects_list();
    });

    // Загрузка в список
    $load_btn.click(function(){

        $(this).text('Загружаю...');

        var data = {
            'action': action,
            'query': true_posts,
            'page' : current_page,
            'filter': filter_active
        };
        $.ajax({
            url:ajaxurl,
            data:data,
            type:'POST',
            success: function (data) {
                load_more_projects(data)
            }
        });
    });

    var filter_default = clone_object(filter_values);
    var filter_active = clone_object(filter_values);



    function console_event(str) {
        if (typeof str !== 'undefined') {
            console.log(str, ' - console_event');
        }
        console.log('Значения фильтра', filter_values);
        console.log('Стандартные значения', filter_default);
        console.log('Актуальные значения', filter_active);
    }

    function clone_object(obj) {
        return JSON.parse(JSON.stringify(obj));
    }

    function load_more_projects(data) {
        if( data ) {
            $load_btn.text($load_btn.data('text-loading'));
            $list_items.append($(data));
            current_page++;
            if (current_page == max_pages) $load_btn.remove();
        } else {
            $load_btn.remove();
        }
    }

    function update_projects_list() {
        filter_active = clone_object(filter_values);

        console_event('Загрузка');

        var data = {
            'action': action,
            'query': true_posts,
            'page' : 0,
            'filter': filter_active
        };
        $.ajax({
            url:ajaxurl,
            data:data,
            type:'POST',
            success: function (data) {
                $list_items.empty();
                load_more_projects(data)
            }
        });
    }

}
