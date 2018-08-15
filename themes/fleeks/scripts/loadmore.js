if (window.jQuery) {
    jQuery(function($){
        $('#true_loadmore').click(function(){

            var btn_load = $(this);
            var load_list = $('#load_list');

            btn_load.text('Загружаю...');

            var data = {
                'action': action,
                'query': true_posts,
                'page' : current_page
            };
            $.ajax({
                url:ajaxurl, // обработчик
                data:data, // данные
                type:'POST', // тип запроса
                success:function(data){
                    if(data) {

                        btn_load.text('Загрузить ещё');

                        if (load_list.attr('data-masonry')  !== "undefined") {
                            load_list.append($(data)).masonry( 'appended', $(data), true );
                        } else {
                            load_list.append(data);
                        }

                        current_page++;
                        if (current_page == max_pages) $("#true_loadmore").remove();
                    } else {
                        $('#true_loadmore').remove();
                    }
                }
            });
        });

    });
}


