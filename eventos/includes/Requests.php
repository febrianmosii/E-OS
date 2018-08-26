<?php
include_once '/../config/database.php';
 
class Requests
{
    public function __construct()
    {
        $db = new DB_Class();
        error_reporting(0);
    }

    public function register_user($username, $email, $password, $full_name, $no_hp, $website )
    {
        $password = md5($password);
        $sql      = mysql_query("SELECT user_id from user WHERE username = '$username' or email = '$email'");
        $no_rows  = mysql_num_rows($sql);

        if ($no_rows == 0)
        {
            $result = mysql_query("INSERT INTO user(username, email, password, full_name, no_hp, website)
                                   values ('" . mysql_real_escape_string($username)."',
                                           '" . mysql_real_escape_string($email)."',
                                           '" . mysql_real_escape_string($password)."',
                                           '" . mysql_real_escape_string($full_name)."',
                                           '" . mysql_real_escape_string($no_hp)."',
                                           '" . mysql_real_escape_string($website)."'
                                           )") or die(mysql_error());
            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    public function check_login($email, $password)
    {
        $password = md5($password);
        $query    = "SELECT id_auth_user, name, email, level 
                     FROM auth_user 
                     WHERE email = '$email'
                     AND password ='$password'";

        $result    = mysql_query($query);
        $user_data = mysql_fetch_array($result);
        $no_rows   = mysql_num_rows($result);

        if ($no_rows == 1)
        {
            session_start();
            $_SESSION['login']        = true;
            $_SESSION['id_auth_user'] = $user_data['id_auth_user'];
            $_SESSION['level']        = $user_data['level'];
            $_SESSION['name']         = $user_data['name'];
            $_SESSION['email']        = $user_data['email'];
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function insert($table, $post = array())
    {
        session_start();

        $id_event       = $post['id_event_type'];
        $name           = $post['name'];
        $description    = $post['description'];
        $price          = ($post['price']) ? $post['price'] : 0;
        $user_id_create = $_SESSION['id_auth_user'];
        $user_id_modify = $_SESSION['id_auth_user'];
        $latitude       = $post['latitude'];
        $longitude      = $post['longitude'];
        $is_approve     = ($_SESSION['level'] == 1) ? 1 : 0;

        if ($name && $description && $id_event) 
        {
            $query = "INSERT INTO $table (id_event_type, name, description, price, user_id_create, 
                                        user_id_modify, latitude, longitude, is_approved)
                      VALUES ('".mysql_real_escape_string($id_event)."', 
                              '".mysql_real_escape_string($name)."', 
                              '".mysql_real_escape_string($description)."', 
                              '".mysql_real_escape_string($price)."', 
                              ".mysql_real_escape_string($user_id_create).", 
                              ".mysql_real_escape_string($user_id_modify).", 
                              '".mysql_real_escape_string($latitude)."', 
                              '".mysql_real_escape_string($longitude)."', 
                              '".mysql_real_escape_string($is_approve)."')";

            $result = mysql_query($query);

            return TRUE;
        }
    }

    public function get_event_type()
    {
        $query  = "SELECT * FROM event_type";
        $result = mysql_query($query);

        return $result;
    }

    public function get_newest_update()
    {
        $query  = "SELECT a.name, a.latitude, a.longitude, b.name as tipe 
                   FROM event a
                   LEFT JOIN event_type b 
                    ON b.id_event_type = a.id_event_type
                   WHERE a.is_delete = 0 
                   ORDER BY a.id_event DESC
                   LIMIT 5";
        $result = mysql_query($query);

        return $result;
    }

    public function load_markers()
    {
        $query  = "SELECT *
                   FROM event a
                   WHERE is_delete = 0";
        $result = mysql_query($query);

        return $result;
    }
}
?>