<?php
class Validate{
    private $passed = false, $errors = [], $db = null;

    public function __construct(){
        $this->db = DB::getInstance();
    }

    public function check($source, $items = []){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $ruleValue){
                $value = $source[$item];
                if($rule == 'required' && empty($value)){
                    $this->addError($item, 'Error_Required');
                }
                else if(!empty($value)){
                    if($rule == 'matches'){
                        if(!preg_match($ruleValue, $value)){
                            $this->addError($item, 'Error_Regex');
                        }
                    }
                    else if($rule == 'unique'){
                        $available = $this->db->get($ruleValue, [$item, '=', $value])->count();
                        if(!$available){
                            $this->addError($item, 'Error_Unique');
                        }
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