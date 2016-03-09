<!DOCTYPE html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Update Prefrences</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

    <?php
    // All to be uncommented and used when database is working/populated

    //    $uid = 001; //needs to be got through global data possibly???

    //$prefrences = DB::getInstance()->get('preference_details', ['User_id', '=', $uid])->results()[0];
    //    $dbvalue = array("Tag_Line"=>$prefrences->Tag_Line, "City"=>$prefrences->City, "Gender"=>$prefrences->Gender,
    //                      "Seeking"=>$prefrences->Seeking, "Intent"=>$prefrences->Intent, "Date_Of_Birth"=>$prefrences->Date_Of_Birth,
    //                      "Height"=>$prefrences->Height, "Ethnicity"=>$prefrences->Ethnicity,"Body_Type"=>$prefrences->Body_Type,
    //                      "Religion"=>$prefrences->Religion, "Marital_Status"=>$prefrences->Marital_Status,"Income"=>$prefrences->Income,
    //                      "Has_Children"=>$prefrences->Has_Children, "Wants_Children"=>$prefrences->Wants_Children,
    //                      "Smoker"=>$prefrences->Smoker, "Drinker"=>$prefrences->Drinker, "About__Me"=>$prefrences->About__Me);

    //hardcoded array to be replaced with code above when database working
    $dbvalue = array("Tag_Line"=>"I'm a cool guy", "City"=>"Dublin", "Gender"=>"Male","Seeking"=>"Female", "Intent"=>"Relationship",
        "Height"=>"140-150cm", "Ethnicity"=>"White Irish","Body_Type"=>"Slim",
        "Religion"=>"Athiest", "Marital_Status"=>"Single","Income"=>"40k to 60k per year",
        "Has_Children"=>"0", "Wants_Children"=>"1", "Smoker"=>"0", "Drinker"=>"Social Drinker",
        "About_Me"=>"Dublin guy looking for a relationship. Love long walks on the beach.");


    function generateSelect($name = '', $options = array(), $default = '') {
        $html = '<select name="'.$name.'" class="form-control">';
        foreach ($options as $option) {
            if ($option == $default) {
                $html .= '<option selected='.'"selected">'.$option.'</option>';
            } else {
                $html .= '<option'.'>'.$option.'</option>';
            }
        }
        $html .= '</select><br><br>';
        echo $html;
    }


    function generateSelectBoolean($name = '', $default = '') {
        $options = array("Yes"=>"1", "No"=>"0");
        $html = '<select name="'.$name.'" class="form-control">';
        foreach ($options as $option => $value) {
            if ($value == $default) {
                $html .= '<option value='.$value.' selected='.'"selected">'.$option.'</option>';
            } else {
                $html .= '<option value='.$value.'>'.$option.'</option>';
            }
        }
        $html .= '</select><br><br>';
        echo $html;
    }
    ?>


</head>

<body class="full">
<?php include("includes/navbar.html"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Update Prefrences</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br>
                <form id="prefrences" action="scripts/updatePrefrences.php" id="updateP" method="get">
                    <fieldset class="form-group">
                        <label for="Tag_Line">Tag Line</label>
                        <input type="text"  class="form-control" maxlength="256" name="Tag_Line" placeholder= "<?php echo ($dbvalue['Tag_Line']);?>" ><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="City">City</label>
                        <input type="text"  class="form-control" maxlength="64" name="City" placeholder="<?php echo ($dbvalue['City']);?>"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                    <fieldset class="form-group">
                        <label for="genderLabel">Gender</label>
                        <?php
                        $genders = array("Male", "Female");
                        generateSelect('Gender', $genders, $dbvalue['Gender'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="seekingLabel">Seeking</label>
                        <?php
                        $seekGenders = array("Male", "Female", "Both");
                        generateSelect('Seeking', $seekGenders, $dbvalue['Seeking'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="intentLabel">Intent</label>
                        <?php
                        $intents = array("Friendship", "Hook Up", "Casual Relationship", "Relationship", "ForeverLove");
                        generateSelect('Intent', $intents, $dbvalue['Intent'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="heightLabel">Height</label>
                        <?php
                        $heights = array("Less than 130cm", "130-140cm", "140-150cm", "150-160cm", "160-170cm", "More than 170cm");
                        generateSelect('Height', $heights, $dbvalue['Height'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="ethnicityLabel">Ethnicity</label>
                        <?php
                        $ethnicities = array("White Irish", "White Traveller Irish", "Other White", "Asian", "Black", "Other");
                        generateSelect('Ethnicity', $ethnicities, $dbvalue['Ethnicity'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="bodyTypeLabel">Body Type</label>
                        <?php
                        $bodyTypes = array("I'd rather not say", "Thin", "Overweight", "Skinny", "Average", "Fit",
                        "Athletic", "Jacked", "A little extra", "Curvy", "Full Figured", "Slim");
                        generateSelect('Body_Type', $bodyTypes, $dbvalue['Body_Type'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="religionLabel">Religion</label>
                        <?php
                        $religions = array("I'd rather not say", "Athiest", "Christianity", "Islam", "Hinduism",
                            "Buddhism", "Judaism", "Other");
                        generateSelect('Religion', $religions, $dbvalue['Religion'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="maritalStatusLabel">Marital Status</label>
                        <?php
                        $maritalStatuses = array("Single", "Married", "Seperated", "Divorced", "Widdowed",
                            "It's Complicated", "Other");
                        generateSelect('Marital_Status', $maritalStatuses, $dbvalue['Marital_Status'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="incomeLabel">Income</label>
                        <?php
                        $incomeBrackets = array("I'd rather not say", "Unemployed", "Less then 10k per year", "10k to 20k per year",
                            "20k to 40k per year", "40k to 60k per year", "60k to 80k per year", "80k to 100k per year",
                            "100k to 120k per year", "More than 120k per year");
                        generateSelect('Income', $incomeBrackets, $dbvalue['Income'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="hasChildrenLabel">Has Children</label>
                        <?php
                        generateSelectBoolean($name = 'Has_Children', $dbvalue['Has_Children']);
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="wantsChildrenLabel">Wants Children</label>
                        <?php
                        $wantsChildrenOptions = array("Yes", "No", "Maybe");
                        generateSelect('Wants_Children', $wantsChildrenOptions, $dbvalue['Wants_Children']);
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="smokerLabel">Smoker</label>
                        <?php

                        generateSelectBoolean('Smoker', $dbvalue['Smoker']);
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="Drinker">Drinker</label>
                        <?php
                        $drinkerOptions = array("Social Drinker", "Occasional Drinker", "Regular Drinker", "Doesn't drink");
                        generateSelect('Drinker', $drinkerOptions, $dbvalue['Drinker'] );
                        ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="About_Me">About Me</label>
                        <textarea class="form-control" name="About_Me" id= "About_Me" rows="3" form="updateP"><?php echo ($dbvalue['About_Me']);?></textarea><br />
                    </fieldset>
                    <br><br>
                    <input type="submit" name="Send" class="btn btn-primary" Value="Apply Changes">
                </form>

                    <br><br>
                    <br><br>
                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>