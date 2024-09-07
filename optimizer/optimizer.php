<?php

$ejs_files = glob(__DIR__ . '/src/*.ejs');
$ejs_new_files = rglob(__DIR__ . '/builds/blocks/*.ejs');

array_map('unlink', glob(__DIR__ . '/builds/blocks/*'));
array_map('unlink', glob(__DIR__ . '/builds/json/*'));

foreach ($ejs_files as $ejs_file) {
    $content = file_get_contents($ejs_file);
    preg_match_all('/include\((?:\'|")([^\'"]+\.ejs)/', $content, $matches);
    foreach ($matches[1] as $match) {
        $path = str_replace('.ejs', '', $match);
        $old_path = __DIR__ . '/src/' . $path . '.ejs';
        $old_path_array = explode('/', $path);
        $last = array_pop($old_path_array);
        $last = str_replace('_', '-', $last);
        if (substr($last, 0, 1) == '-') {
            $last = substr($last, 1);
        }
        $new_path = __DIR__ . '/builds/blocks/' . $last . '.ejs';
        $php_path = __DIR__ . '/builds/blocks/' . $last . '.php';

        if (!file_exists($php_path) && file_exists($old_path)) {
            copy($old_path, $new_path);
            parse_ejs_file($new_path);
            create_json_file($last, $php_path);
        }
    }
}

function create_json_file($last, $file)
{
    $content = file_get_contents($file);
    $vars = array();
    $tokens = token_get_all($content);
    foreach ($tokens as $token) {
        if (is_array($token) && $token[0] == T_VARIABLE) {
            $vars[] = $token[1];
        }
    }
    $vars = array_unique($vars);

    create_json($last, $vars);
}

function create_json($name, $vars = [])
{
    $fields = [];
    $group_name = "group_" . random_string();

    foreach ($vars as $var) {
        $fields[] = [
            "key"=> "field_" . random_string(),
            "label"=> str_replace('$', '', $var),
            "name"=> str_replace('$', '', $var),
            "aria-label"=> "",
            "type"=> "text",
            "instructions"=> "",
            "required"=> 0,
            "conditional_logic"=> 0,
            "wrapper"=> [
                "width"=> "",
                "class"=> "",
                "id"=> ""
            ],
            "default_value"=> "",
            "maxlength"=> "",
            "placeholder"=> "",
            "prepend"=> "",
            "append"=> ""
        ];
    }

    $json_data = [
        "key"=> $group_name,
        "title"=> "Блок: " . $name,
        "fields"=> [
            [
                "key"=> "field_" . random_string(),
                "label"=> "Блок: " . $name,
                "name"=> "",
                "aria-label"=> "",
                "type"=> "accordion",
                "instructions"=> "",
                "required"=> 0,
                "conditional_logic"=> 0,
                "wrapper"=> [
                    "width"=> "",
                    "class"=> "",
                    "id"=> ""
                ],
                "open"=> 0,
                "multi_expand"=> 0,
                "endpoint"=> 0
            ],
            ...$fields,
        ],
        "location"=> [
            [
                [
                    "param"=> "block",
                    "operator"=> "==",
                    "value"=> "acf/" . $name
                ]
            ]
        ],
        "menu_order"=> 0,
        "position"=> "normal",
        "style"=> "default",
        "label_placement"=> "top",
        "instruction_placement"=> "label",
        "hide_on_screen"=> "",
        "active"=> true,
        "description"=> "",
        "show_in_rest"=> 0,
        "modified"=> time()
    ];

    file_put_contents(__DIR__ . '/builds/json/' . $group_name . '.json', json_encode($json_data, JSON_PRETTY_PRINT));
}

function random_string($length = 13)
{
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $length);
}

function parse_ejs_file($file)
{
    $content = file_get_contents($file);

    $content = str_replace("<%-", "<?php echo $", $content);
    $content = str_replace("<%=", "<?php echo $", $content);
    $content = str_replace('%>', " ?>", $content);
    $content = str_replace('<%', "<?php ", $content);
    $content = str_replace('if(', "if($", $content);
    $content = str_replace('typeof ', "", $content);
    $content = str_replace("!== 'undefined'", "", $content);

    $content = add_vars_to_file($content);
    file_put_contents($file, $content);

    $new_file = substr($file, 0, strrpos($file, '.')) . '.php';

    print_r($new_file);
    print_r(strrpos($file, '.'));

    rename($file, $new_file);
}

function rglob($pattern, $flags = 0) {
    $files = glob($pattern, $flags);
    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        $files = array_merge(
            [],
            ...[$files, rglob($dir . "/" . basename($pattern), $flags)]
        );
    }
    return $files;
}

function add_vars_to_file($content)
{
    $vars = array();
    $tokens = token_get_all($content);
    foreach ($tokens as $token) {
        if (is_array($token) && $token[0] == T_VARIABLE) {
            $vars[] = $token[1];
        }
    }
    $vars = array_unique($vars);
    foreach ($vars as $var) {
        if ($var !== '$_') {
            $str = "<?php " . $var . " = get_field('" . str_replace('$', '', $var) . "'); ?>\n";
            $content = $str . $content;
        }
    }
    return $content;
}