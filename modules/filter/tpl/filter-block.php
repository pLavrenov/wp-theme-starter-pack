<?php
global $wp_query;
?>

<script>
    var filter_values = {

        projects_square: '',
        rooms_count: '',
        floor_count: '',
        price: {
            min: 0,
            max: 0
        },


        sort_by: 'date',
        order_by: 'DESC'
    };
</script>

<div class="sort-wrap" filters-block >

    <div class="sort-item open">
        <div class="reset"></div>
        <div class="title-wr">
            <div class="title"><?php _e('Тип', 'fleeks_theme') ?></div>
        </div>
        <div class="content-wr">
            <div class="radio-group">
                <div class="radio-group-item">
                    <input id="radio1" class="checkbox" type="checkbox" name="type">
                    <label for="radio1">Тканевые</label>
                </div>
                <div class="radio-group-item">
                    <input id="radio2" class="checkbox" type="checkbox" name="type"
                           checked="checked">
                    <label for="radio2">Пластиковые</label>
                </div>
                <div class="radio-group-item">
                    <input id="radio3" class="checkbox" type="checkbox" name="type">
                    <label for="radio3">Алюминиевые</label>
                </div>
                <div class="radio-group-item">
                    <input id="radio4" class="checkbox" type="checkbox" name="type">
                    <label for="radio4">Веревочные</label>
                </div>
            </div>
        </div>
    </div>

    <div class="sort-item open">
        <div class="reset"></div>
        <div class="title-wr">
            <div class="title">Цена</div>
        </div>
        <div class="content-wr">
            <div class="yam-filter-section">
                <div class="multipleRange">
                                    <span class="track" data-min="0" data-max="10000" data-current-max="10000" data-current-min="0">
                                      <span class="pointer min"></span>
                                      <span class="range"></span>
                                      <span class="pointer max"></span>
                                    </span>
                    <div class="multipleRange-items">
                        <label>
                            <span class="txt">от</span>
                            <input type="text" class="text-field min" placeholder="0">
                        </label>
                        <label>
                            <span class="txt">до</span>
                            <input type="text" class="text-field max" placeholder="10000">
                        </label>
                    </div>

                </div>
            </div>


        </div>
    </div>
    <div class="sort-item open">
        <div class="reset"></div>
        <div class="title-wr">
            <div class="title">Цвет товара</div>
        </div>
        <div class="content-wr">
            <input class="color cyan" type="radio" name="color">
            <input class="color blue" type="radio" name="color">
            <input class="color indigo" type="radio" name="color">
            <input class="color goldenrod" type="radio" name="color" checked="checked">
            <input class="color pear" type="radio" name="color">
            <input class="color malachite" type="radio" name="color">
            <input class="color purple" type="radio" name="color">
        </div>
    </div>
    <div class="sort-item">
        <div class="reset"></div>
        <div class="title-wr">
            <div class="title">Назначение</div>
        </div>
        <div class="content-wr">
            Другой фильтр
        </div>
    </div>
    <div class="sort-item">
        <div class="reset"></div>
        <div class="title-wr">
            <div class="title">Коллекция</div>
        </div>
        <div class="content-wr">
            Другой фильтр
        </div>
    </div>
</div>


<?php /*
<div id="filters" class="projects-filter wow fadeInUp">
    <div class="projects-filter__header">
        <div class="projects-filter__header-item projects-filter__header-filtr"><?php _e('Фильтр', 'fleeks_theme') ?></div>
        <div class="projects-filter__header-item projects-filter__header-sort"><?php _e('Сортировка', 'fleeks_theme') ?></div>
    </div>
    <div class="projects-filter__top">
        <div class="projects-filter__close">
            <div class="title"><?php _e('Фильтр', 'fleeks_theme') ?></div>
            <div class="close"></div>
        </div>
        <div class="projects-filter__items">

            <div class="projects-filter__item projects-filter__item--price">
                <div class="projects-filter__title"><?php _e('цена', 'fleeks_theme') ?></div>
                <div class="projects-filter__price">
                    <label class="left">
                        <span><?php _e('от', 'fleeks_theme') ?></span>
                        <input type="text" id="minCost" class="range-text width-dynamic range-text--input" value="<?php echo min_meta_value('цена_проекта') ?>">
                    </label>
                    <label class="right">
                        <span><?php _e('до', 'fleeks_theme') ?></span>
                        <input type="text" id="maxCost" class="range-text width-dynamic range-text-right" value="<?php echo max_meta_value('цена_проекта') ?>">
                    </label>
                    <div id="price_field"></div>
                </div>
            </div>

            <?php
            $terms = get_terms('projects_square', [
                'hide_empty' => false,
            ]);
            if ($terms) { ?>
                <div class="projects-filter__item">
                    <div class="projects-filter__title"><?php _e('ПЛОЩАДЬ', 'fleeks_theme') ?></div>
                    <div class="projects-filter__select w270" data-kr-select data-max-items="4">
                        <select id="projects_square" name="projects_square">
                            <option value=""><?php _e('Любая', 'fleeks_theme') ?></option>
                            <?php foreach ($terms as $term) { ?>
                                <option value="<?php echo $term->term_id ?>"><?php echo $term->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            <?php } ?>


            <?php
            $terms = get_terms('projects_floor', [
                'hide_empty' => false,
            ]);
            if ($terms) { ?>
                <div class="projects-filter__item">
                    <div class="projects-filter__title"><?php _e('ЭТАЖНОСТЬ', 'fleeks_theme') ?></div>
                    <div id="floor_count" class="projects-filter__floors">
                        <?php foreach ($terms as $term) { ?>
                            <div class="projects-filter__floor" data-value="<?php echo $term->term_id ?>"><?php echo $term->name ?></div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <div class="projects-filter__item">
                <div class="projects-filter__title"><?php _e('СПАЛЬНИ', 'fleeks_theme') ?></div>
                <div class="projects-filter__select w170" data-kr-select data-max-items="4">
                    <select id="rooms_count" name="select">
                        <option value="">Не важно</option>
                        <?php
                        $bdrooms = all_meta_values('количество_спален');
                        foreach ($bdrooms as $bdroom) {
                            echo '<option value="'.$bdroom.'">'.$bdroom.'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="projects-filter__item">
                <div class="projects-filter__title"><?php _e('ГАРАЖ', 'fleeks_theme') ?></div>
                <div class="projects-filter__select w170" data-kr-select data-max-items="4">
                    <select id="have_garage" name="select">
                        <option>Навес</option>
                        <option>Гараж</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="projects-filter__btns">
            <div class="btn filter-link-three"><?php _e('Применить', 'fleeks_theme') ?></div>
            <div class="projects-filter__reset filter-reset-btn">
                <span><?php _e('СБРОСИТЬ ФИЛЬТРЫ', 'fleeks_theme') ?></span>
            </div>
        </div>

    </div>
    <div class="projects-filter__bottom">
        <div class="projects-filter__reset filter-reset-btn">
            <span><?php _e('СБРОСИТЬ ФИЛЬТРЫ', 'fleeks_theme') ?></span>
        </div>
        <div class="projects-filter__apply filter-link-three"><?php _e('Применить', 'fleeks_theme') ?></div>
    </div>
</div>


<div id="fixed" class="projects__sorts wow fadeInUp" data-wow-delay="0.3s">

    <div class="projects__sort sort-items">
        <div class="projects__sort-title"><?php _e('сортировать по:', 'fleeks_theme') ?></div>
        <div class="projects__sort-item active">
            <span><?php _e('все', 'fleeks_theme') ?></span>
        </div>
        <div class="projects__sort-item catalog-sortirovka__link" data-sort="цена_проекта" data-order="ASC">
            <span><?php _e('цена', 'fleeks_theme') ?></span>
        </div>
    </div>
    <div class="projects__sort d-none d-md-flex">
        <?php echo sprintf('', $num, $location); ?>
        Всего <span> <?php echo $wp_query->found_posts ?> </span> проектов
    </div>
    <div class="projects__sort d-flex d-md-none">
        Всего <span> <?php echo $wp_query->found_posts ?> </span> проектов
    </div>
    <div class="projects-filter__reset d-flex d-md-none">
        <span><?php _e('СБРОСИТЬ ФИЛЬТРЫ', 'fleeks_theme') ?></span>
    </div>

</div>
*/ ?>
