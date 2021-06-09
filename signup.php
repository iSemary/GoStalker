<?php
session_start();
if (isset($_SESSION['username'])) {
  header('location: home');
  exit();
} elseif (isset($_COOKIE['GS'])) {
  require 'api/classes/logged.php';
  header('location: home');
  exit();
} else { 
  
}
include 'connect.php';
include 'init.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta lang="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GoStalker | Sign up</title>
    <link rel="stylesheet" href="<?php echo $css; ?>style.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>normalize.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css" />
    <style media="screen">
        .col-12 {
          -webkit-box-flex: 0;
          -ms-flex: 0 0 100%;
          flex: 0 0 100%;
          max-width: 100%;
          position: relative;
          width: 100%;
          min-height: 1px;
          padding-right: 15px;
          padding-left: 15px;
        }
        .section1 .formy .inputform {
        padding: 0px 9px 0px 8px !important;
        }
        </style>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <meta name="description" content="SignUp on GoStalker helps you to get freinds feedback as votes, good or bad anonymous messages and others !">
    <link href="favico.ico" rel="icon" type="image/x-icon">
    <meta name="keywords" content="GoStalker, gostalker, Go Stalker, Social Networking, Social Network, voting, votes, evilorgood, stalker, stalkers">
    <!--[if It IE 9]>
        <script src="<?php echo $js; ?>html5shiv.min.js"></script>
        <script src="<?php echo $js; ?>respond.min.js"></script>
            <![endif]-->
</head>

<body>
    <header>
        <div class="gostalkericon">
            <a href="#">
                <img src="img/GoStalker45.png" title="GoStalker ! Do it !"></a>
        </div>
        <div class="nav-stalk">
            <a class="sign-top" href="login">Login</a>
        </div>
    </header>
    <div class="section1">
        <div class="signup-form">
            <form action="" method="POST" id="signup-form">
                <div class="formy">
                    <label>Full Name</label>
                    <input type="text" name="fullname" pattern=".{2,}" title="You must type at least 2 letters" class="inputform stalk-form" id="fullnameid" value="<?php if (isset($name)) {echo $name;} ?>" maxlength="30" placeholder="First Name" autofocus="on" required="required">
                </div>
                <div class="formy">
                    <label>Username</label>
                    <input type="text" name="username" pattern=".{3,}" title="You must type at least 3 letters" class="inputform stalk-form" id="usernameid" value="<?php if (isset($username)) {echo $username;} ?>" minlength="3" maxlength="40" placeholder="Username" required="required">
                </div>
                <div class="formy">
                    <label>Email</label>
                    <input type="email" name="email" class="inputform stalk-form" id="emailid" value="<?php if (isset($email)) {echo $email;} ?>" maxlength="200" placeholder="Email" autocomplete="off" required="required">
                </div>
                <div class="formy">
                    <label>Password</label>
                    <input type="password" pattern=".{8,}" title="You must type at least 8 character" name="password" id="password" class="inputform stalk-form" placeholder="Password" autocomplete="off" required="required">
                </div>
                <div class="formy">
                    <label>Re-type Password</label>
                    <input type="password" name="re-password" id="confirm_password" class="inputform stalk-form" placeholder="Re-type Password" autocomplete="off" required="required">
                </div>
                <br>
                <div class="simplegenderform">
                    <label>Gender</label>
                    <select class="genderform" required="required" name="gender" required="required">
                        <option value="">Gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </div>
                <br>
                <div class="birthdate">
                    <label>Birthday</label>
                    <tbody>
                        <tr>
                            <td class="leftSideCellFill">
                                <select class="birthform" name="day" required="required">
                                    <option value="">Day</option>
                                    <?php
                                    for ($i = 1; $i <= 31; $i++) {
                                      echo '<option value=' . $i . '>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <label>
                                    <select class="birthform" name="month" required="required">
                                        <option value="">Day</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </label>
                            </td>
                            <td>
                                <select class="birthform" name="year" required="required">
                                    <option value="">Year</option>
                                    <?php
                                    for ($i = 2013; $i >= 1918; $i--) {
                                      echo '<option value=' . $i . '>' . $i . '</option>';
                                    }

                                    ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </div>
                <br>
                <div class="simplelanguageform">
                    <label>Language</label>
                    <select class="languageform" name="language" required="required">
                        <option value="AF">Afrikanns</option>
                        <option value="SQ">Albanian</option>
                        <option value="AR">Arabic</option>
                        <option value="EU">Basque</option>
                        <option value="BN">Bengali</option>
                        <option value="BG">Bulgarian</option>
                        <option value="CA">Catalan</option>
                        <option value="KM">Cambodian</option>
                        <option value="ZH">Chinese</option>
                        <option value="HR">Croation</option>
                        <option value="CS">Czech</option>
                        <option value="DA">Danish</option>
                        <option value="NL">Dutch</option>
                        <option value="EN" selected="selected">English</option>
                        <option value="ET">Estonian</option>
                        <option value="FJ">Fiji</option>
                        <option value="FI">Finnish</option>
                        <option value="FR">French</option>
                        <option value="KA">Georgian</option>
                        <option value="DE">German</option>
                        <option value="EL">Greek</option>
                        <option value="GU">Gujarati</option>
                        <option value="HE">Hebrew</option>
                        <option value="HI">Hindi</option>
                        <option value="HU">Hungarian</option>
                        <option value="IS">Icelandic</option>
                        <option value="id">Indonesian</option>
                        <option value="GA">Irish</option>
                        <option value="IT">Italian</option>
                        <option value="JA">Japanese</option>
                        <option value="KO">Korean</option>
                        <option value="LA">Latin</option>
                        <option value="LV">Latvian</option>
                        <option value="LT">Lithuanian</option>
                        <option value="MK">Macedonian</option>
                        <option value="MS">Malay</option>
                        <option value="ML">Malayalam</option>
                        <option value="MT">Maltese</option>
                        <option value="MI">Maori</option>
                        <option value="MR">Marathi</option>
                        <option value="MN">Mongolian</option>
                        <option value="NE">Nepali</option>
                        <option value="RU">Russian</option>
                        <option value="ES">Spanish</option>
                        <option value="SW">Swahili</option>
                        <option value="SV">Swedish </option>
                        <option value="TA">Tamil</option>
                        <option value="TT">Tatar</option>
                        <option value="TE">Telugu</option>
                        <option value="TH">Thai</option>
                        <option value="BO">Tibetan</option>
                        <option value="TO">Tonga</option>
                        <option value="TR">Turkish</option>
                    </select>
                </div>
                <br>
                <div class="agree">By signing up you agree to our <a href="conditions#list-item-2">Terms</a> and <a href="conditions#list-item-3">Privacy policy</a>.</div>
                <div class="g-recaptcha" data-sitekey="6Ldjt10UAAAAAPcdVl-KHQCUPAdH0l_KZ5dOQ0Ph"></div>
                <input class="signupbtn" type="submit" id="signup" name="Signup" value="Signup">
            </form>
            <div class="login-with">
                <h4>Login with:</h4>
                <ul>
                    <li><img src="img/facebook_api.svg" height="50px" width="50px" /></li>
                    <li><img src="img/twitter_api.svg" height="50px" width="50px" /></li>
                    <li><img src="img/vk_api.svg" height="50px" width="50px" /></li>
                    <li><img src="img/gmail_api.svg" height="50px" width="50px" /></li>
                </ul>
            </div>
        </div>
        <div class="form-right-img">
            <img src="img/right.png" title="Welcome to GoStalker!" width="446px" height="550px">
        </div>
    </div>
    <?php include $template . 'footer.php';
    include $template . 'error-section.php';
    ?>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/validationSignup.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-signup.js"></script>

</body>

</html> 