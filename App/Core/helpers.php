<?php

function view($name, $data = array())
{
    $name = str_replace(".", "/", $name);

    echo app('blade')->run($name, $data);
}

function redirect($path)
{
    header("Location: /{$path}");
}

function dd()
{
    echo "<pre>";
    $trace = debug_backtrace();
    echo 'DD called in ' . $trace[0]['file'] .
        ' on line ' . $trace[0]['line'];

    foreach (func_get_args() as $arg) {
        var_dump( $arg);
    }

    die(1);
}

function trace()
{
    echo "<pre>";

    foreach (func_get_args() as $arg) {
        $trace = debug_backtrace();
        var_dump($trace, $arg);
    }

    die(1);
}

function app($abstract)
{
    return \App\Core\App::get($abstract);
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            if ($return = value($default)) {
                return $return;
            }

            throw new \Exception("ENV key {$key} not set in .env file");
        }

        return $value;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('old')) {

    function old($resource_key, $default = false) {
        if (!isset($_REQUEST[$resource_key]))
            return $default;

        return $_REQUEST[$resource_key];

    }
}

if (!function_exists('isSelected')) {

    function isSelected($key, $value)
    {
        return strtolower(old($key)) == strtolower($value) ? 'selected' : '';
    }
}

if (!function_exists('isChecked')) {

    function isChecked($key, $value)
    {
        return old($key) == $value ? 'checked' : '';
    }
}

if (!function_exists('currentPage')) {

    function currentPage(Array $resouces_to_change = [])
    {
        $parts = parse_url($_SERVER['REQUEST_URI']);

        if (!isset($parts['query']))
            return $parts['path'] . "?" . http_build_query($resouces_to_change);

        $get_vars = explode('&', trim($parts['query'], ' &'));

        $unique_vars = collect($get_vars)->reduce(function($unique_vars, $var) {
            if (strpos($var, '=') === false) {
                return $unique_vars;
            }

            $parts = explode('=', $var);

            if (!empty($parts[1]))
                $unique_vars[$parts[0]] = $parts[1];

            return $unique_vars;
        });

        $combined_query = array_merge($unique_vars->all(), $resouces_to_change);

        $http_query = http_build_query($combined_query);

        return ($parts['path'] . '?' . $http_query);

    }
}

if (!function_exists('show_pic')) {

    function show_pic($pic_id, $display_mode = "small", $alt_text = "", $img_class = "", $path = "")
    {
        $display_width = [
            'small' => 100,
            'thumbnail' => 100,
            'small-x' => 150,
            'medium' => 150,
            'medium-x' => 200
        ];

        $images = explode(",", $pic_id);

        if (empty($path))
            $path = isset($display_width[$display_mode]) ? '/thumbnails/' : '/uploaded_images/';

        $path .= "/" . $images[0] . ".jpg";

        $width = isset($display_width[$display_mode]) ? $display_width[$display_mode] : 300;
        $height = $width == 300 ? 250 : "";
        $img_class .= ($width == 300 ? " final-image" : "");

        if ($pic_id == "" || !file_exists(publicPath() . $path))
            return "<img src='/images/no_pic.gif' class='{$img_class}' width='{$width}' height='{$height}' alt='{$alt_text}'/>";

        return "<img src='{$path}' class='{$img_class}' width='{$width}' height='{$height}' alt='{$alt_text}'/>";
    }
}

if (!function_exists('request')) {

    function request($input)
    {
        if (is_array($input))
            return array_map(function($a_resource) {
                return resource($a_resource);
            }, $input);

        return htmlentities($_REQUEST[$input]);
    }
}

function basePath($path = '')
{
    return env('BASE_PATH') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * Get the path to the web directory.
 *
 * @return string
 */
function publicPath()
{
    return basePath() . DIRECTORY_SEPARATOR . 'public';
}

function adminPath()
{
    return publicPath() . DIRECTORY_SEPARATOR . "ADMIN";
}

function usersPath()
{
    return publicPath() . DIRECTORY_SEPARATOR . "USERS";
}

function imagesPath()
{
    return publicPath() . DIRECTORY_SEPARATOR . "uploaded_images";
}

function thumbnailsPath()
{
    return publicPath() . DIRECTORY_SEPARATOR . "thumbnails";
}

function app_path()
{
    return basePath() . DIRECTORY_SEPARATOR . "App";
}

function collect($items)
{
    return new App\Core\Database\Collection($items);
}

function sanitize($input)
{
    $strip_chars = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
        "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
        ",", "<", ".", ">", "/", "?");
    $output = trim(str_replace($strip_chars, " ", strip_tags($input)));
    $output = preg_replace('/\s+/', ' ', $output);
    $output = preg_replace('/\-+/', '-', $output);
    return $output;
}
