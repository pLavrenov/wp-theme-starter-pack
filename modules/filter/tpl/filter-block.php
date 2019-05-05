<?php
global $wp_query;
?>

<form class="sort-wrap" filters-block >

    <input name="sort" value="new" type="hidden" filters-sort-input>
    <input name="order" value="DESC" type="hidden" filters-order-input>

    <?php
    render_input_field('Вид', 'types', get_posts_name_fields('types'), get_queried_object_id() ? get_queried_object_id() : '', 'checkbox'); ?>

    <?php
    $minPrice = out_meta_value('_new_price', 'product', 'MIN');
    $maxPrice = out_meta_value('_new_price', 'product', 'MAX');
    render_range_field('Цена', 'price', $minPrice, $maxPrice); ?>

    <?php
    $minWidth = out_meta_value('ширина', 'product', 'MIN');
    $maxWidth = out_meta_value('ширина', 'product', 'MAX');
    render_range_field('Ширина', 'width', $minWidth, $maxWidth);
    ?>

    <?php
    $values = [
        [
            'name' => '1.5',
            'value' => '1.5'
        ],
        [
            'name' => '2',
            'value' => '2'
        ],
        [
            'name' => '2.5',
            'value' => '2.5'
        ],
        [
            'name' => '3',
            'value' => '3'
        ],
        [
            'name' => '3.5',
            'value' => '3.5'
        ],
        [
            'name' => '4',
            'value' => '4'
        ],
    ];
    render_input_field('Вынос', 'long', $values, '', 'checkbox');
    ?>

    <?php
    $terms = get_terms('product_color_scheme', [
        'hide_empty' => true,
    ]);
    if ($terms) { ?>
        <div class="sort-item open">
            <div class="reset"></div>
            <div class="title-wr">
                <div class="title"><?php _e('Цвет товара', 'fleeks_theme') ?></div>
            </div>
            <div class="content-wr">
                <?php foreach ($terms as $key => $term) { ?>
                    <input value="<?php echo $term->slug ?>" class="color color-filter-<?php echo $term->slug ?>" type="checkbox" name="product_color_scheme[]">
                <?php } ?>
            </div>

            <style>
                <?php foreach ($terms as $key => $term) { ?>
                    .color-filter-<?php echo $term->slug ?>:after {
                        background-color: <?php the_field('цвет', 'product_color_scheme_' . $term->term_id) ?> !important;
                    }
                <?php } ?>
            </style>
        </div>
    <?php } ?>

    <?php
    $values = [
        [
            'name' => 'Любой',
            'value' => ''
        ],
        [
            'name' => 'До 12 м/с',
            'value' => '12'
        ],
        [
            'name' => 'До 15 м/с',
            'value' => '15'
        ],
        [
            'name' => 'До 20 м/с',
            'value' => '20'
        ],
    ];
    render_input_field('Ветровая нагрузка', 'wind', $values, '', 'radio');
    ?>

    <?php
    $values = [
        [
            'name' => 'Не важно',
            'value' => ''
        ],
        [
            'name' => 'Нет',
            'value' => 0
        ],
        [
            'name' => 'Да',
            'value' => 1
        ],
    ];
    render_input_field('Электропривод', 'rotor', $values, '', 'radio');
    ?>

</form>

<?php function render_input_field($name, $slug, $items = [], $default = '', $type = 'radio') { ?>
    <div class="sort-item open">
        <div class="reset"></div>
        <?php if ($name) { ?>
            <div class="title-wr">
                <div class="title"><?php _e($name, 'fleeks_theme') ?></div>
            </div>
        <?php } ?>
        <?php if ($items) { ?>
            <div class="content-wr">
                <div class="radio-group">
                    <?php $i = 0; foreach ($items as $key => $value) { $i++; ?>
                        <div class="radio-group-item">
                            <input <?php echo $value['value'] === $default ? 'checked' : '' ?> value="<?php echo $value['value'] ?>" id="<?php echo $slug . $i ?>" class="<?php echo $type ?>" type="<?php echo $type ?>" name="<?php echo $slug . ($type == 'checkbox' ? '[]' : '') ?>">
                            <label for="<?php echo $slug . $i ?>"><?php echo $value['name'] ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php function render_range_field($name, $slug, $min = 0, $max = 10000) { ?>
    <div class="sort-item open">
        <div class="reset"></div>
        <div class="title-wr">
            <div class="title"><?php _e($name, 'fleeks_theme') ?></div>
        </div>
        <div class="content-wr">
            <div class="yam-filter-section">
                <div class="multipleRange">
                    <span class="track"
                          data-min="<?php echo $min ?>"
                          data-max="<?php echo $max ?>"
                          data-current-min="<?php echo $min ?>"
                          data-current-max="<?php echo $max ?>">
                      <span class="pointer min"></span>
                      <span class="range"></span>
                      <span class="pointer max"></span>
                    </span>
                    <div class="multipleRange-items">
                        <label>
                            <span class="txt"><?php _e('от', 'fleeks_theme') ?></span>
                            <input id="<?php echo $slug ?>Min" name="<?php echo $slug ?>[min]" value="<?php echo $min ?>" type="text" class="text-field min">
                        </label>
                        <label>
                            <span class="txt"><?php _e('до', 'fleeks_theme') ?></span>
                            <input id="<?php echo $slug ?>Max" name="<?php echo $slug ?>[max]" value="<?php echo $max ?>" type="text" class="text-field max">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
