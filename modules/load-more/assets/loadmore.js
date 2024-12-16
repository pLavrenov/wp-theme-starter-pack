document.addEventListener("DOMContentLoaded", function(event) {
    if (document.getElementById('true_loadmore')) {
        const btn_load = document.getElementById('true_loadmore');
        const load_list = document.getElementById('load_list');

        btn_load.addEventListener('click', function(){
            btn_load.textContent = 'Загружаю...';

            const data = new FormData();
            data.append('action', action);
            data.append('query', true_posts);
            data.append('page', current_page);

            fetch(ajaxurl, {
                method: 'POST',
                body: data
            })
                .then(response => response.text())
                .then(data => {
                    if (data) {
                        btn_load.textContent = 'Загрузить ещё';
                        load_list.insertAdjacentHTML('beforeend', data);
                        current_page++;
                        if (current_page == max_pages) {
                            btn_load.remove();
                        }
                        if (window.transferModals) {
                            console.log('transferModals');
                            window.transferModals();
                        }
                    } else {
                        btn_load.remove();
                    }
                });
        });
    }
});