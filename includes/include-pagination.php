<?php
if (!function_exists('pagination')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
    function pagination() { // функция вывода пагинации
        global $wp_query; // текущая выборка должна быть глобальной
        $big = 999999999; // число для замены
        $links = paginate_links(array( // вывод пагинации с опциями ниже
            'base' => str_replace($big,'%#%',esc_url(get_pagenum_link($big))), // что заменяем в формате ниже
            'format' => '?paged=%#%', // формат, %#% будет заменено
            'current' => max(1, get_query_var('paged')), // текущая страница, 1, если $_GET['page'] не определено
            'type' => 'array', // нам надо получить массив
            'prev_text'    => 'Назад', // текст назад
            'next_text'    => 'Вперед', // текст вперед
            'total' => $wp_query->max_num_pages, // общие кол-во страниц в пагинации
            'show_all'     => false, // не показывать ссылки на все страницы, иначе end_size и mid_size будут проигнорированны
            'end_size'     => 15, //  сколько страниц показать в начале и конце списка (12 ... 4 ... 89)
            'mid_size'     => 15, // сколько страниц показать вокруг текущей страницы (... 123 5 678 ...).
            'add_args'     => false, // массив GET параметров для добавления в ссылку страницы
            'add_fragment' => '',	// строка для добавления в конец ссылки на страницу
            'before_page_number' => '', // строка перед цифрой
            'after_page_number' => '' // строка после цифры
        ));
        if( is_array( $links ) ) { // если пагинация есть
            echo '<ul class="page-pagination">';
            foreach ( $links as $link ) {
                if ( strpos( $link, 'current' ) !== false ) {
                    echo "<li class='active'>$link</li>"; // если это активная страница
                } else {
                    echo "<li>$link</li>";
                }
            }
            echo '</ul>';
        }
    }
}