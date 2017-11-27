
#class Test_controller extends CI_Controller{
class Test_controller {
    protected $_var_type = [
        'user_d' => 'id', //Validate and filter it as id. So that it always returns an integer
        'amount' => 'money', // Format like money upto two digits
        'username' => 'alphanumeric', //Filter and validate to contain alphabets and numbers and spaces
        'firstName' => 'alphanumeric',
        'lastName' => 'alphanumeric',
        'dob' => 'date', //Modified date function in the libraray will return the desired function
        'mobile' => 'mobile',
        'password' => 'password',
        'lat' => 'coordinates',
        'long' => 'coordinates',
        'email' => 'email', //Validates email, and sanitizes if worth validating
    ];
    protected $_input = [];

    public function __construct(){
        parent::__construct();
       // $this->load->helper(['Sanitizing_input']); //Load the helper or the Sanitize_input class in your own way
        // $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));;
        $this->store_input();
    }

    protected function store_input(){
        $post = $this->input->post(NULL, TRUE);
        $get = $this->input->get(NULL, TRUE);
        $this->_var_type = array_merge($this->_var_type, array_change_key_case($this->_var_type, CASE_LOWER));

        $post = Sanitize_input::process($post, $this->_var_type); // Here the sanitized data will be returned
        $get = Sanitize_input::process($get, $this->_var_type);

        $this->_input = array_merge( $post, $get);

        return true;
    }

}
