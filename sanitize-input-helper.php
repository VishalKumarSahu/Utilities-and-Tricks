class Sanitize_input{
    /**
     * 
     * Created by: hello@vishalkumarsahu.in
     * Modified on: 2017/11/27 16:44:35
     * 
     * 
     * == Following types of sanitizations
     * 
     * coordinates
     * money
     * id
     * string
     * html
     * session
     * alphanumeric
     * password
     * mobile
     * date
     * email
     * datetime
     * html_array
     * multiple_select
     * 
     * 
     * If values are not filtered or validated then "NULL" is returned
     * else validated and filtered input is returned
     * 
     * 
     */

    public function __construct(){
        
    }

    private static function filters($var_type){

        $input_filters = array(
            'coordinates' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            $input = preg_replace("#[^0-9\.]#",'',$input);
                            $input = (float) sprintf("%.12f", $input);
                            return $input;
                        }
                    ),
            'money' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            $input = preg_replace("#[^0-9\.]#",'',$input);
                            $input = (float) sprintf("%.2f", $input);
                            return $input;
                        }
                    ),
            'id' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            $input = preg_replace("#[^0-9\.]#",'',$input);
                            return $input ? (int) $input : 0 ;
                        }
                    ),
            'string' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            $input = filter_var($input, FILTER_SANITIZE_STRING);
                            return $input;
                        }
                    ),
            'html' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            $input = htmlentities($input); 
                            return str_replace('\\\\', '\\',$input); 
                            // return htmlentities(stripslashes($input)); //htmlspecialchars_decode();
                        }
                    ),
            'session' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            return preg_replace("#[^0-9-]#",'',$input);
                        }
                    ),
            'alphanumeric' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            return preg_replace("#[^0-9a-z_]#i",'',$input);
                        }
                    ),
            'password' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            return $input;
                            // return md5($input);
                            // password_verify($input, PASSWORD_BCRYPT);
                            // return password_hash($input, PASSWORD_BCRYPT, ["cost" => 10]);
                        }
                    ),
            'mobile' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            $input = preg_replace("#[^0-9]#",'',$input);
                            $input = strlen($input) === 10 ? $input : NULL;
                            return $input;
                        }
                    ),
            'date' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {

                            // $input = preg_replace('/(\d{1,4})([^\d]{0,})(\d{1,2})([^\d]{0,})(\d{1,2})/',"$1-$3-$5", $input);

                            preg_match("/(\d{1,4})([^\d]{0,})(\d{1,2})([^\d]{0,})(\d{1,2})/", $input, $input_date);

                            $input = sprintf("%04d-%02d-%02d", $input_date[1], $input_date[3], $input_date[5]);
                            $format = 'Y-m-d';
                            $d = @DateTime::createFromFormat($format, $input);
                            // var_dump($d);
                            if($d && $d->format($format) == $input){
                                return $input;
                            }
                            return NULL;
                        }
                    ),
            'email' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            $input = filter_var($input, FILTER_SANITIZE_EMAIL);
                            if(filter_var($input, FILTER_VALIDATE_EMAIL)){
                                return $input;
                            }
                            return NULL;
                        }
                    ),
            'datetime' => array(
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($input) {
                            if(substr_count($input ,"00") > 1) return false;
                            return preg_replace("#[^0-9a-z\:\,\'\-\.\/]#i",'',$input);
                        }
                    ),
            'html_array' => array(
                        'filter' => FILTER_CALLBACK,
                        'flags' => FILTER_FORCE_ARRAY,
                        'options' => function ($input) {
                            $input = htmlentities($input); 
                            return str_replace('\\\\', '\\',$input);
                            // $filtered  = htmlentities(stripslashes($input)) ;
                          return $filtered ? $filtered: "";
                        }
                    ),
            'multiple_select' => array(
                        'filter' => FILTER_SANITIZE_STRING,
                        'flags' => FILTER_FORCE_ARRAY,
                    ),
        );

        $form_filter = array(
            'driverId'=> $input_filters['id'],
            'rideId'=> $input_filters['id'],
            'passengerId'=> $input_filters['id'],
        );

        // var_dump($var_type);
        if(is_associative($var_type)){
            foreach ($var_type as $key => $type){
                // var_dump($key , $type);
                if(in_array($type, array_keys($input_filters)) && preg_match("/[a-z]/i", $key)){
                    $form_filter = array_merge($form_filter, [$key => $input_filters[$type]]);
                }
            }
        }
        return $form_filter;
    }

    public static function process($data_array = [], $var_type = []){
        $form_filter = self::filters($var_type);
        // var_dump($form_filter);
        // var_dump($form_filter);
        $filter = filter_var_array($data_array, $form_filter, true);
        // var_dump($data_array);
        return $filter;
    }
}
