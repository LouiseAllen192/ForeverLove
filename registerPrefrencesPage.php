<!DOCTYPE html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Register Prefrences</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

    <?php
    function generateSelect($name = '', $options = array()) {
        $html = '<select name="'.$name.'" class="form-control default="Unselected"">"';
        foreach ($options as $option) {
                $html .= '<option'.'>'.$option.'</option>';
        }

        $html .= '</select><br><br>';
        echo $html;
    }

    function generateSelectBoolean($name = '') {
        $options = array("Unselected"=>"", "Yes"=>"1", "No"=>"0");
        $html = '<select name="'.$name.'" class="form-control default="Unselected"">"';
        foreach ($options as $option => $value) {
                $html .= '<option value='.$value.'>'.$option.'</option>';
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
                        <strong>Register Prefrences</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br>
                <form id="prefrences" action="scripts/registerPrefrences.php" id="updateP" method="get">
                    <fieldset class="form-group">
                        <label for="Tag_Line">Tag Line</label>
                        <input type="text"  class="form-control" maxlength="256" name="Tag_Line" placeholder= "Enter Tag Line here" ><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="City">City</label>
                        <input type="text"  class="form-control" maxlength="64" name="City" placeholder="Enter City here"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <fieldset class="form-group">
                            <label for="genderLabel">Gender</label>
                            <?php
                            $genders = array("Unselected", "Male", "Female");
                            generateSelect('Gender', $genders);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="seekingLabel">Seeking</label>
                            <?php
                            $seekGenders = array("Unselected", "Male", "Female", "Both");
                            generateSelect('Seeking', $seekGenders);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="intentLabel">Intent</label>
                            <?php
                            $intents = array("Unselected", "Friendship", "Hook Up", "Casual Relationship", "Relationship", "ForeverLove");
                            generateSelect('Intent', $intents);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="heightLabel">Height</label>
                            <?php
                            $heights = array("Unselected", "Less than 130cm", "130-140cm", "140-150cm", "150-160cm", "160-170cm", "More than 170cm");
                            generateSelect('Height', $heights );
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="ethnicityLabel">Ethnicity</label>
                            <?php
                            $ethnicities = array("Unselected", "White Irish", "White Traveller Irish", "Other White", "Asian", "Black", "Other");
                            generateSelect('Ethnicity', $ethnicities);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="bodyTypeLabel">Body Type</label>
                            <?php
                            $bodyTypes = array("Unselected", "I'd rather not say", "Thin", "Overweight", "Skinny", "Average", "Fit",
                                "Athletic", "Jacked", "A little extra", "Curvy", "Full Figured", "Slim");
                            generateSelect('Body_Type', $bodyTypes);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="religionLabel">Religion</label>
                            <?php
                            $religions = array("Unselected", "I'd rather not say", "Athiest", "Christianity", "Islam", "Hinduism",
                                "Buddhism", "Judaism", "Other");
                            generateSelect('Religion', $religions);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="maritalStatusLabel">Marital Status</label>
                            <?php
                            $maritalStatuses = array("Unselected", "Single", "Married", "Seperated", "Divorced", "Widdowed",
                                "It's Complicated", "Other");
                            generateSelect('Marital_Status', $maritalStatuses);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="incomeLabel">Income</label>
                            <?php
                            $incomeBrackets = array("Unselected", "I'd rather not say", "Unemployed", "Less then 10k per year", "10k to 20k per year",
                                "20k to 40k per year", "40k to 60k per year", "60k to 80k per year", "80k to 100k per year",
                                "100k to 120k per year", "More than 120k per year");
                            generateSelect('Income', $incomeBrackets);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="hasChildrenLabel">Has Children</label>
                            <?php
                            generateSelectBoolean($name = 'Has_Children');
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="wantsChildrenLabel">Wants Children</label>
                            <?php
                            $wantsChildrenOptions = array("Unselected", "Yes", "No", "Maybe");
                            generateSelect('Wants_Children', $wantsChildrenOptions);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="smokerLabel">Smoker</label>
                            <?php

                            generateSelectBoolean('Smoker');
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="Drinker">Drinker</label>
                            <?php
                            $drinkerOptions = array("Unselected", "Social Drinker", "Occasional Drinker", "Regular Drinker", "Doesn't drink");
                            generateSelect('Drinker', $drinkerOptions);
                            ?>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="About_Me">About Me</label>
                            <textarea class="form-control" name="About_Me" id= "About_Me" rows="3" form="updateP"></textarea><br />
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