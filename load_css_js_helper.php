/*
 * Created: 2017/12/14 00:28:30
 * Updated: 2017/12/14 00:28:39
 * @params
 * $url_structure = 'assets/js/%s.js'
 * $files = ['main.min', 'social']
 * $echo = FALSE
 *
 */

function load_js($files = [], $url_structure = NULL, $version = '1.0', $echo = FALSE){
    $html = "";
    foreach ($files as $file) {
        if($url_structure){
            $file = sprintf($url_structure, $file);
        }
        $file_url = base_url($file);
        $html .= "<script src=\"{$file_url}?v={$version}\"></script>";
    }
    if($echo) {
        echo $html;
    }
    return $html;
}

/*
 * Created: 2017/12/14 00:28:48
 * Updated: 2017/12/14 00:28:51
 * @params
 * $version = '1.0' // Later load from configuration
 * $url_structure = 'assets/js/%s.css'
 * $files = ['main.min', 'social']
 * $echo = FALSE
 *
 */

function load_css($files = [], $url_structure = NULL, $version = '1.0', $echo = FALSE){
    $html = "";
    foreach ($files as $file) {
        if($url_structure){
            $file = sprintf($url_structure, $file);
        }
        $file_url = base_url($file);
        echo "<link rel=\"stylesheet\" href=\"{$file_url}?v={$version}\">";
    }
    if($echo) {
        echo $html;
    }
    return $html;
}
