<?php
class DB{
    private static $instance = null;
    private $pdo, $query, $error = false, $results, $count = 0;

    //Connect to database
    private function __construct(){
        try{
            $this->pdo = new PDO(
                'mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),
                Config::get('mysql/username'),
                Config::get('mysql/password')
            );
        }catch (PDOException $e){
            die($e->getMessage());
        }
    }

    //Only one connection ever needed
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new DB();
        }
        return self::$instance;
    }

    /*
     * Query database with either a single sql query or combined with an array
     * in which each element of the array is binded to a "?"
     * e.g. query("SELECT username FROM users WHERE username='alex' || username='joe'", [])
     * e.g. query("SELECT username FROM users WHERE username=? || username=?", ['alex', 'joe'])
     */
    public function query($sql, $params = []){
        $this->error = false;
        if($this->query = $this->pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->query->bindValue($x, $param);
                    $x++;
                }
            }

            //echo $this->query->queryString;

            //Returns the result as an object
            if($this->query->execute()){
                $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
                $this->count = $this->query->rowCount();
            }
            else{
                $this->error = true;
            }
        }
        return $this;
    }

    //An automated query
    public function action($action, $table, $where = []){
        if(count($where) === 3){
            $operators = ['=', '>', '<', '>=', '<='];

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if(!$this->query($sql, [$value])->error()){
                    return $this;
                }
            }
        }
        return false;
    }

    /*
     * Shortcut query to get all matching criteria
     * e.g. get('users', ['username', '=', 'alex'])
     * e.g. get('users', ['joined', '>', '01/01/2016'])
     */
    public function get($table, $where){
        return $this->action('SELECT *', $table, $where);
    }

    public function results(){
        return $this->results;
    }

    public function first(){
        return $this->results()[0];
    }

    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }

    /*
     * Insert new tuple into tables
     * e.g. insert('registration_details', ['Username' => 'Kevin', 'Password' => 'password']);
     */
    public function registerUser($table, $fields = [], $dob = null){
        $n = count($fields);
        if($n){
            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            foreach($fields as $field){
                $values .= '?';
                if($x++ < $n)
                    $values .= ', ';
            }
            $sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES ({$values})";
            if($this->query($sql, $fields)->error()) return false;
            else if($table === 'registration_details'){
                $user_id = $this->get('registration_details', ['username', '=', $fields['username']])->results()[0]->user_id;
                $this->registerUser('account_details', ['user_id' => $user_id]);
                $this->registerUser('preference_details', ['user_id' => $user_id, 'date_of_birth' => $dob]);
                $this->registerUser('unique_hobby', ['user_id' => $user_id]);
                $hobbies = $this->get('user_hobbies', ['hobby_id', '>' , 0])->results();
                foreach($hobbies as $hobby){
                    $this->insert('user_hobby_preferences', ['user_id' => $user_id, 'hobby_id' => $hobby->hobby_id, 'hobby_preference' => null]);
                }
                $this->insert('images', ['user_id' => $user_id, 'image_id' => 1, 'image_path' => 'includes\pics\default-profile.png', 'image_name' => 'default-profile.png',]);
                for($i = 2; $i <= 16; $i++){
                    $this->insert('images', ['user_id' => $user_id, 'image_id' => $i, 'image_path' => '', 'image_name' => '',]);
                }
            }
            else return true;
        }
        return false;
    }

    /*
     * Insert new tuple into table
     * e.g. insert('messages', ['Username' => 'Kevin', 'Password' => 'password']);
     */
    public function insert($table, $fields = []){
        $n = count($fields);
        if($n){
            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            foreach($fields as $field){
                $values .= '?';
                if($x++ < $n)
                    $values .= ', ';
            }
            $sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES ({$values})";
            if(!$this->query($sql, $fields)->error()){ return true;}
            else{ return true;}
        }
        return false;
    }

    /*
     * Update tuple in table
     * e.g. update('user_hobbies', 'hobby_id = 1', ['hobby_name' => 'reading']);
     */
    public function update($table, $where, $fields = []){
        $n = count($fields);
        if($n){
            $set = '';
            $x = 1;

            foreach($fields as $fieldName => $fieldValue) {
                $set .= "{$fieldName} = ?";
                if ($x++ < $n)
                    $set .= ', ';
            }

            $sql = "UPDATE {$table} SET {$set} WHERE {$where}";
            if (!$this->query($sql, $fields)->error()) return true;
        }
        return false;
    }

    public function count(){
        return $this->count;
    }

    public function error(){
        return $this->error;
    }
}