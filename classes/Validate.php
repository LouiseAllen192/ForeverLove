<?php
class Validate{
    private $passed = false, $errors = [], $db = null;

    public function __construct(){
        $this->db = DB::getInstance();
    }

    public function check($source, $items = []){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $ruleValue){
                $value = (isset($source[$item])) ? $source[$item] : '';
                if($rule == 'required' && $value == ''){
                    $this->addError($item, 'error_required');
                }
                else if(!empty($value)){
                    if($rule == 'matches'){
                        if(!preg_match($ruleValue, $value)){
                            $this->addError($item, 'error_regex');
                        }
                    }
                    else if($rule == 'unique'){
                        $uid = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;
                        if($this->db->query("SELECT * FROM $ruleValue WHERE $item = '$value' && user_id != '$uid'")->count()){
                            $this->addError($item, 'error_unique');
                        }
                    }
                    else if($rule == 'over_18'){
                        if(!((new DateTime($value))->diff(new DateTime(date('Y-m-d')))->y >= 18)){
                            $this->addError($item, 'error_regex');
                        }
                    }
                    else if($rule == 'valid_date'){
                        $dateMonth = $source['month'];
                        $dateYear = $value;
                        $now = new \DateTime('now');
                        $curMonth = $now->format('m');
                        $curYear = $now->format('y');

                        if($curYear<$dateYear){$this->addError($item, 'error_valid_date');}
                        if($curYear == $dateYear && $dateMonth < $curMonth){$this->addError($item, 'error_valid_date');}
                    }
                }
            }
        }
        if(empty($this->errors)){
            $this->passed = true;
        }
    }

    private function addError($key, $error){
        $this->errors[$key] = $error;
    }

    public function passed(){
        return $this->passed;
    }

    public function getErrors(){
        return $this->errors;
    }
}
?>