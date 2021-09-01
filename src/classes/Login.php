<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
               
        }
        if (isset($_GET["logout2"])) {
            $this->doLogout2();
        }
        if (isset($_GET["logout3"])) {
            $this->doLogout3();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                $sql = "SELECT * FROM users
                        WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1) {

                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {

                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['user_id'] = $result_row->user_id;
						$_SESSION['user_name'] = $result_row->user_name;
                        $_SESSION['firstname'] = $result_row->firstname;
                        $_SESSION['lastname'] = $result_row->lastname;
                        $_SESSION['nivel'] = $result_row->nivel;
                        $_SESSION['estado'] = $result_row->estado;
                        $_SESSION['cargo'] = $result_row->cargo;
                        $_SESSION['fing'] = $result_row->date_added;
                        $_SESSION['chk_act'] = $result_row->chk_act;
                        $_SESSION['chk_fec'] = $result_row->chk_fec;
                        $_SESSION['chk_plan'] = $result_row->chk_plan;
                        $_SESSION['chk_mac'] = $result_row->chk_mac;
                        $_SESSION['user_login_status'] = 1;
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (120 * 60);

                        
                    

                    } else {
                        $this->errors[] = "Usuario y/o contraseña no coinciden.";
                    }
                } else {
                    $this->errors[] = "Usuario y/o contraseña no coinciden.";
                }
            } else {
                $this->errors[] = "Problema de conexión de base de datos.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "Has sido desconectado.";

    }
    public function doLogout2()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->errors[] = "No tienes permisos para acceder al Sistema.";

    }
     public function doLogout3()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->errors[] = "Este Usuario ha sido desactivado, por favor póngase en contacto  con el administrador.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            
            return true;
        }
        // default return
        return false;
    }
    public function nivel_seguridad()
    {
        if ($_SESSION['estado']=="no"){
           $niv = 4;
        }else{


        $niv=$_SESSION['nivel'];
        }
        
        // default return
        return $niv;
    }

}
