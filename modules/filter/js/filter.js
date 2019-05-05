
// Инициализация фильтра
if ($('[filters-block]').length > 0) {

    var active_page = 1;

    var $filter_form = $('[filters-block]');
    var $filter_reset_btn = $('#filter_reset_btn');
    var $filter_load_btn = $('#filter_load_btn');
    var $filter_post_counter = $('#filter_post_counter');
    var $load_btn = $('#filter_loadmore');
    var $list_items = $('#load_list');
    var $empty_load_list = $('#empty_load_list');

    // Сортировка
    var $filter_sort_btn = $('[filters-sort-btn]');
    var $filter_sort_input = $('[filters-sort-input]');
    var $filter_order_input = $('[filters-order-input]');

    $filter_form.change(function(){
        console_event('Автообновление фильтра');
        // Обновление списка после сброса
        update_projects_list(true);
    });

    // Сброс фильтра
    $filter_reset_btn.click(function(){
        console_event('Сброс фильтра');
        $filter_form.trigger("reset");
        // Обновление списка после сброса
        update_projects_list(true);
    });

    // Применение фильтра
    $filter_load_btn.click(function(){
        console_event('Применение фильтра');
        // Обновление списка
        update_projects_list(true);
    });

    $filter_sort_btn.click(function (e) {
        e.preventDefault();

        if ($(this).hasClass('active')) {
            if ($(this).data('order') == 'ASC') {
                $(this).data('order', 'DESC');
                $(this).toggleClass('up down');
            } else {
                $(this).data('order', 'ASC');
                $(this).toggleClass('up down');
            }
        } else {
            $filter_sort_btn.data('order', 'DESC').removeClass('active');
            $(this).addClass('down');
            $(this).addClass('active');
        }

        $filter_sort_input.val($(this).data('sort'));
        $filter_order_input.val($(this).data('order'));

        update_projects_list(true);
    });

    function console_event(str) {
        if (typeof str !== 'undefined') {
            console.log(str, ' - console_event');
        }
        console.log('Значения фильтра', $filter_form.serialize());
    }

    function load_more_projects(data) {
        var jdata = JSON.parse(data);

        $filter_post_counter.text(parseInt(jdata.count));

        (jdata.count == 0) ? $empty_load_list.show() : $empty_load_list.hide();

        if( jdata.posts ) {
            $list_items.append($(jdata.posts));
            active_page++;
            (active_page == jdata.max_page) ? $load_btn.hide() : $load_btn.show();
        } else {
            $load_btn.hide();
        }
    }

    // Загрузка в список
    $load_btn.click(function(){
        $(this).text($(this).data('text-loaded'));
        update_projects_list(false);
    });

    function update_projects_list(reload) {

        if (reload) {
            active_page = 0;
        }

        console.log('ЗАГРУЗКА СТРАНИЦА НОМЕР: ' + active_page);

        var data = {
            'action': action,
            'query': true_posts,
            'page' : active_page,
            'filter': $filter_form.serialize()
        };
        $.ajax({
            url:ajaxurl,
            data:data,
            type:'POST',
            success: function (data) {
                if (reload) {
                    $list_items.empty();
                }
                load_more_projects(data)
            }
        });
    }

}
