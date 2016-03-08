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
                <form id="prefrences" method="post">
                    <fieldset class="form-group">
                        <label for="tagLineLabel">Tag Line</label>
                        <input type="text"  class="form-control" maxlength="256" name="TagLine" placeholder= "Tag Line" ><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="cityLabel">City</label>
                        <input type="text"  class="form-control" maxlength="64" name="City" placeholder="City"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="genderLabel">Gender</label>
                        <select name="gender" class="form-control" id="genderSelect">
                            <option value="">Unselected</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="seekingLabel">Seeking</label>
                        <select name="seeking" class="form-control" id="seekingSelect">
                            <option value="">Unselected</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="both">Both</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="intentLabel">Intent</label>
                        <select name="intent" class="form-control" id="intentSelect">
                            <option value="">Unselected</option>
                            <option value="friendship">Friendship</option>
                            <option value="hookup">Hook Up</option>
                            <option value="casual">Casual Relationship</option>
                            <option value="relationship">Relationship</option>
                            <option value="foreverLove">ForeverLove</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="heightLabel">Height</label>
                        <select name="height" class="form-control" id="heightSelect">
                            <option value="">Unselected</option>
                            <option value="less130">Less than 130cm</option>
                            <option value="130to140">130-140cm</option>
                            <option value="140to150">140-150cm</option>
                            <option value="150to160">150-160cm</option>
                            <option value="160to170">160-170cm</option>
                            <option value="more170">More than 170cm</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="ethnicityLabel">Ethnicity</label>
                        <select name="ethnicity" class="form-control" id="ethnicitySelect">
                            <option value="">Unselected</option>
                            <option value="whiteIrish">White Irish</option>
                            <option value="traveller">White Traveller Irish</option>
                            <option value="whiteOther">Other White</option>
                            <option value="asian">Asian</option>
                            <option value="black">Black</option>
                            <option value="other">Other</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="bodyTypeLabel">Body Type</label>
                        <select name="bodyType" class="form-control" id="bodyTypeSelect">
                            <option value="">Unselected</option>
                            <option value="ratherNotSay">I'd rather not say</option>
                            <option value="thin">Thin</option>
                            <option value="overweight">Overweight</option>
                            <option value="skinny">Skinny</option>
                            <option value="avg">Average</option>
                            <option value="fit">Fit</option>
                            <option value="athletic">Athletic</option>
                            <option value="jacked">Jacked</option>
                            <option value="aLittleExtra">A little extra</option>
                            <option value="curvy">Curvy</option>
                            <option value="fullFigured">Full Figured</option>
                            <option value="slim">Slim</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="religionLabel">Religion</label>
                        <select name="religion" class="form-control" id="religionSelect">
                            <option value="">Unselected</option>
                            <option value="ratherNotSay">I'd rather not say</option>
                            <option value="athiest">Athiest</option>
                            <option value="christianity">Christianity</option>
                            <option value="islam">Islam</option>
                            <option value="hinduism">Hinduism</option>
                            <option value="buddhism">Buddhism</option>
                            <option value="judaism">Judaism</option>
                            <option value="other">Other</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="maritalStatusLabel">Marital Status</label>
                        <select name="maritalStatus" class="form-control" id="maritalStatusSelect">
                            <option value="">Unselected</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="seperated">Seperated</option>
                            <option value="divorced">Divorced</option>
                            <option value="widdow">Widdowed</option>
                            <option value="other">Other</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="incomeLabel">Income</label>
                        <select name="income" class="form-control" id="incomeSelect">
                            <option value="">Unselected</option>
                            <option value="ratherNotSay">I'd rather not say</option>
                            <option value="unemployed">Unemployed</option>
                            <option value="less10">Less then €10k per year</option>
                            <option value="10to20">€10k - €20k per year</option>
                            <option value="20-40">€20k - €40k per year</option>
                            <option value="40-60">€40k - €60k per year</option>
                            <option value="60-80">€60k - €80k per year</option>
                            <option value="80-100">€80k - €100k per year</option>
                            <option value="100-120">€100k - €120k per year</option>
                            <option value="more120">More than €120k per year</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="hasChildrenLabel">Has Children</label>
                        <select name="hasChildren" class="form-control" id="hasChildrenSelect">
                            <option value="">Unselected</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="wantsChildrenLabel">Wants Children</label>
                        <select name="wantsChildren" class="form-control" id="wantsChildrenSelect">
                            <option value="">Unselected</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="smokerLabel">Smoker</label>
                        <select name="smoker" class="form-control" id="smokerSelect">
                            <option value="">Unselected</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="drinkerLabel">Drinker</label>
                        <select name="drinker" class="form-control" id="drinkerSelect">
                            <option value="">Unselected</option>
                            <option value="social">Social Drinker</option>
                            <option value="occasional">Occasional Drinker</option>
                            <option value="regular">Regular Drinker</option>
                            <option value="noDrink">Doesn't drink</option>
                        </select><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="aboutMeLabel">About Me</label>
                        <textarea class="form-control" id="aboutMeTextarea" rows="3" placeholder=" <?php echo ($dbvalue['About_Me']);?>"></textarea><br />
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