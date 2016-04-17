<?php
class AdminServiceMgr{

    public static function addReport($reportee, $source = []){
        $reporter = $_SESSION['user_id'];
        $db = DB::getInstance();
        $cid = 0;
        if($source['view_conversation']){
            $sql = "SELECT conversation_id FROM conversations WHERE ((user1_id = '$reporter' && user2_id = '$reportee') || (user1_id = '$reporter' && user2_id = '$reportee') && profile_visible = '1')";
            if($db->query($sql)->count()){
                $cid = $db->results()[0]->conversation_id;
            }
        }
        $db->insert(
            'banned_reports',
            [
                'reporter_id' => $reporter,
                'reportee_id' => $reportee,
                'conversation_id' => $cid,
                'priority' => $source['priority'],
                'content' => $source['content'],
                'view_conversation' => $source['view_conversation']
            ]
        );
    }

    public static function banUser($uid, $report_id, $ban_length){
        $n = 0;
        switch($ban_length){
            case 1: $n = 7; break;
            case 2: $n = 14; break;
            case 3: $n = 30; break;
            case 4: $n = 60; break;
            case 5: $n = 120; break;
        }
        $permanent = ($n != 0) ? 0 : 1;

        return DB::getInstance()->insert(
            'banned_users',
            [
                'user_id' => $uid,
                'report_id' => $report_id,
                'end_date' => (new DateTime())->add(new DateInterval('P'.$n.'D'))->format('Y-m-d H:i:s'),
                'permanent' => $permanent
            ]
        );
    }

    public static function getBannedUsers(){
        $db = DB::getInstance();
        $banned_uids = $db->query("SELECT user_id FROM banned_users WHERE permanent = 1")->results();
        $results = [];
        foreach($banned_uids as $uid){
            $results [] = $db->query("SELECT user_id,username,tag_line,city FROM registration_details JOIN preference_details USING(user_id) WHERE user_id = '$uid->user_id'")->results()[0];
        }
        return $results;
    }

    public static function getSuspendedUsers(){
        $db = DB::getInstance();
        $banned_uids = $db->query("SELECT user_id FROM banned_users WHERE permanent = 0")->results();
        $results = [];
        foreach($banned_uids as $uid){
            $results [] = $db->query("SELECT user_id,username,tag_line,city FROM registration_details JOIN preference_details USING(user_id) WHERE user_id = '$uid->user_id'")->results()[0];
        }
        return $results;
    }

    public static function login($source){
        $errors = [];
        if(isset($source['email']) && $source['email'] != ''){
            $email = $source['email'];
            if(preg_match('/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/', $email)){
                if($result = DB::getInstance()->query("SELECT admin_id, password FROM admin WHERE email = '$email'")->results()[0]){
                    if (isset($source['password']) && $source['password'] != ''){
                        if(password_verify($source['password'], $result->password)){
                            $_SESSION['permissions'] = 'admin';
                            $_SESSION['admin_id'] = $result->admin_id;
                            header('Location: adminHomePage.php');
                            die();
                        }
                        else { $errors['password'] = 'error_login';}

                    } else { $errors['password'] = 'error_required';}
                }
                else{ $errors['email'] = 'error_login';}
            }
            else{ $errors['email'] = 'error_regex';}
        }
        else{ $errors['email'] = 'error_required';}
        return $errors;
    }

    public static function logout(){
        if(isset($_SESSION['user_id'])){
            unset($_SESSION['user_id']);
        }
        if(isset($_SESSION['permissions'])){
            unset($_SESSION['permissions']);
        }
    }

    public static function registerAccount($source){
        $validate = new Validate();
        $validate->check(
            $source,
            [
                'email' => [
                    'required' => true,
                    'matches' => '/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
                    'unique' => 'registration_details'
                ],
                'confirm_email' => [
                    'required' => true,
                    'matches' => '/\b('.$_POST['email'].')\b/'
                ],
                'first_name' => [
                    'required' => true,
                    'matches' => '/^[a-zA-Z]{2,32}$/'
                ],
                'last_name' => [
                    'required' => true,
                    'matches' => '/^[a-zA-Z\'-]{2,32}$/'
                ],
                'password' => [
                    'required' => true,
                    'matches' => '/^[a-zA-Z0-9_-]{6,32}$/',
                ],
                'confirm_password' => [
                    'required' => true,
                    'matches' => '/\b('.$_POST['password'].')\b/'
                ]
            ]);

        if($validate->passed()){
            $fields = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'email' => $_POST['email']
            ];

            DB::getInstance()->registerUser('admin', $fields);
            return false;
        }
        else{ return $validate->getErrors();}
    }
}