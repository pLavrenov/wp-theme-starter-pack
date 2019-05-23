





function compare_get_items() {
    const store = localStorage.getItem('COMPARE_PROJECTS');
    if(store === null){
        return compare_create_store();
    } else {
        const items = store.split(',');
        if (items.length == 1 && items[0] == '') {
            return [];
        } else {
            return items;
        }
    }
}

function compare_create_store() {
    const items = [];
    compare_set_items(items);
    return items;
}

function compare_set_items(arr) {
    return localStorage.setItem('COMPARE_PROJECTS', arr.join(','));
}

function compare_set_count() {
    $('[data-compare-couner]').each(function(){
        $(this).text(compare_length_items());
    });
}

function compare_buttom_add() {
    var storage_items = compare_get_items();
    $('[data-compare-add]').each(function(){
        if (storage_items.indexOf($(this).data('compare-add').toString()) > -1) {
            $(this).addClass('active').find('span').text('Отменить');
        }
    });
}

function compare_length_items() {
    const items = compare_get_items();
    return items.length;
}

function compare_add_func() {
    var pid = $(this).data('compare-add').toString();
    var storage_items = compare_get_items();
    if (storage_items.indexOf(pid) == -1) {
        $(this).addClass('active').find('span').text('Отменить');
        storage_items.push(pid);
    } else {
        $(this).removeClass('active').find('span').text('Сравнить');
        storage_items = remove_in_array(storage_items, pid);
    }
    compare_set_items(storage_items);
    compare_set_count();
}

$("body").on("click","[data-compare-add]", compare_add_func);

$('[data-compare-href]').click(function() {
    const items = compare_get_items();
    if (items.length >= 2) {
        window.location = $(this).data('compare-href');
    } else {
        alert('Нужно выбрать больше двух проектов для сравнения.');
    }
});

$(document).ready(function($) {
    compare_set_count();
    compare_buttom_add();
});

function remove_in_array(arr, value) {
    arr.splice(arr.indexOf(value), 1);
    return arr;
}

function compare_get_posts(obj) {
    if (compare_length_items() > 0) {
        $.post(obj.url, {
            action: obj.action,
            items: compare_get_items()
        }, function(response) {
            $(obj.element).append($(response));
        });
    } else {
        window.location = '/';
    }
}

function compare_delete_post(id) {
    var pid = id.toString();
    var storage_items = compare_get_items();
    if (storage_items.indexOf(pid) != -1) {
        storage_items = remove_in_array(storage_items, pid);
    }
    compare_set_items(storage_items);
    compare_set_count();
    if (compare_length_items() > 0) {
        $('[compare-post-id='+ pid +']').remove();
    } else {
        window.location = '/';
    }

}
