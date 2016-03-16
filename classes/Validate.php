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
                    $this->addError($item, 'error_required');
                }
                else if(!empty($value)){
                    if($rule == 'matches'){
                        if(!preg_match($ruleValue, $value)){
                            $this->addError($item, 'error_regex');
                        }
                    }
                    else if($rule == 'unique'){
                        $unavailable = $this->db->get($ruleValue, [$item, '=', $value])->count();
                        if($unavailable){
                            $this->addError($item, 'error_unique');
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