<?php
class PopulateDB{
    private $db;

    public function __construct(){
        $this->db = DB::getInstance();
    }

    public function populateDatabase($start = 26, $amount = 50){
        srand($start);
        $amount += $start;
        $fNamesArray = file("firstNames.txt");
        shuffle($fNamesArray);
        $fn = count($fNamesArray);
        $lNamesArray = file("lastNames.txt");
        shuffle($lNamesArray);
        $ln = count($lNamesArray);
        $citiesArray = file("cities.txt");
        shuffle($citiesArray);
        $hobbiesArray = file("uniqueHobbies.txt");
        shuffle($hobbiesArray);

        for($i = $start; $i < $amount; $i++){
            $registrationDetails = $this->getRegDetails($i, $fNamesArray, $fn, $lNamesArray, $ln);
            $this->db->insert('registration_details', $registrationDetails);
            $user_id = $registrationDetails['user_id'];
            $this->db->insert('account_details', $this->getAccountDetails($user_id));
            $this->db->insert('preference_details', $this->getPrefDetails($user_id, $citiesArray));
            $this->db->insert('unique_hobby', $this->getUniqueHobbies($user_id, $hobbiesArray));
            for($j = 1; $j < 36; $j++){
                $this->db->insert('user_hobby_preferences', ['user_id' => $user_id, 'hobby_id' => $j, 'hobby_preference' => mt_rand(0, 1)]);
            }
            $this->db->insert('images', ['user_id' => $user_id, 'image_id' => 1, 'image_path' => 'includes\pics\default-profile.png', 'image_name' => 'default-profile.png']);
            for($j = 2; $j <= 16; $j++){
                $this->db->insert('images', ['user_id' => $user_id, 'image_id' => $j, 'image_path' => '', 'image_name' => '']);
            }
        }
    }

    private function getRegDetails($i, $fNamesArray, $fn, $lNamesArray, $ln){
        $registrationDetails = [];
        $registrationDetails['user_id'] = $i;
        $registrationDetails['first_name'] = $fNamesArray[mt_rand(0, $fn - 1)];
        $registrationDetails['last_name'] = $lNamesArray[mt_rand(0, $ln - 1)];
        $registrationDetails['username'] = str_replace(' ', '', $registrationDetails['first_name'].$registrationDetails['last_name'].$i);
        $registrationDetails['password'] = password_hash('password', PASSWORD_DEFAULT);
        $registrationDetails['email'] = $registrationDetails['username'].'@gmail.com';
        return $registrationDetails;
    }

    private function getAccountDetails($user_id){
        return [
            'user_id' => $user_id,
            'account_type' => 'Premium',
            'account_expired' => $this->randomDate(
                date('Y-m-d', strtotime("-3 months", strtotime(date('Y-m-d')))),
                date('Y-m-d', strtotime("+12 months", strtotime(date('Y-m-d'))))
            )
        ];
    }

    private function getPrefDetails($user_id, $citiesArray){
        return [
            'user_id' => $user_id,
            'tag_line' => '',
            'city' => $citiesArray[array_rand($citiesArray)],
            'gender' => mt_rand(2, 3),
            'seeking' => mt_rand(2, 4),
            'intent' => mt_rand(2, 6),
            'date_of_birth' => $this->randomDate('1950-01-01', date('Y-m-d', strtotime("-18 years", strtotime(date('Y-m-d'))))),
            'height' => mt_rand(2, 7),
            'ethnicity' => mt_rand(2, 7),
            'body_type' => mt_rand(2, 13),
            'religion' => mt_rand(2, 9),
            'marital_status' => mt_rand(2, 8),
            'income' => mt_rand(2, 11),
            'has_children' => mt_rand(2, 3),
            'wants_children' => mt_rand(2, 4),
            'smoker' => mt_rand(2, 3),
            'drinker' => mt_rand(2, 5),
            'about_me' => ''
        ];
    }

    private function getUniqueHobbies($user_id, $hobbiesArray){
        return [
            'user_id' => $user_id,
            'unique_hobby' => $hobbiesArray[array_rand($hobbiesArray)]
        ];
    }

    private function randomDate($startDate, $endDate, $format = 'Y-m-d'){
        return date($format, mt_rand(strtotime($startDate), strtotime($endDate)));
    }
}
?>