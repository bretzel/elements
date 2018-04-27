<?php
require_once 'elements/elements.inc';
require_once 'elements/user.inc';

/**
    Refresh the repo. 
*/
class service  {

    //function __construct($p, $iid){
    //    parent::__construct($p,$iid);
    //    
    // }
    
    static public function startup()
    {
        echo "OKAY, service up! :-)\n";
        if(!count($_GET)){
            
        }
        else{
            var_dump ($_GET);
            ?>
                <h4>GET method used [from external query], so $_GET must be 'visited' for each items!</h4>
            <?php
            echo "\n";
        }
        
        $e = element::div(NULL);
        $e->text("hello, world! ");
        $s = element::span($e,'span-id-test', null, "[from element:div]");
        $s->css('color', '#802020');
        
        echo $e->commit();
        exit();
    }
    static public function load_page() {
        error_log("page id to load:".$_POST['id']);
        $pgid = $_POST['id'];
        include  "pages/".$pgid.".php";
        switch($pgid){
            case 'home':
                home::load();
                return true;
            case 'blog':
                blog::load();
                return true;
            case 'userpage':
                userpage::load();
                return true;
            default:
                echo "$pgid: not yet implemented - please be patient!";
                return true;
        }
        return true;
    }

    static public function stat_filedate() {
        $pg = $_POST['id'] . ".php";
        $data = stat("mastermenu/" . $pg);
        $stream = "[$pg], " . date("l, F d Y, H:i", $data['mtime']) . " GMT: -5";
        echo $stream;
    }

    static public function login() {
        
//         $uname = $_POST['username'];
//         $pass = $_POST['password'];
//         $u = usr::login($uname, $pass);
//         if ($u)
//             service::post_login($u);   
//         else
//             object::throw_error(1, 'loginfailed', 'username or password mismatch');
//         return true;
           $response = array("error"=>"service not available");
           $response = obj::encode_array($response,true);
           echo $response;
           exit();
    }
    
    static public function post_login($u){
        $usr_stream = object::serialize_entity($u);
        
    }
    
    
    static public function create_login_form()
    {
        
    }
    
    static public function fill_locale()
    {
        require_once 'pages/ldictionary.inc';
        l_locale::get_locale($_POST['l']);
        return true;
    }

}


if(! isset($_POST["service"])){
    service::startup();
}
$f = $_POST["service"];
if (method_exists("service", $f)) {
    service::$f();
    exit();
}
else
    obj::throw_fatal(array('fatal error' => $f, 'unknown service command' => $f));

?>

