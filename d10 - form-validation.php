<?php 
    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

    if (isset($_POST['reg123'])) {
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'] ?? null;
        $hobbies = $_POST['hobbies'] ?? null;
        $country = $_POST['country'];

        if(empty($uname)){
            $errName = "Name is required";
        }elseif(!preg_match("/^[A-Za-z. ]*$/", $uname)){
            $errName = "Invalid name";
        }else{
            $crrUname = $uname;
        }

        if(empty($email)){
            $errEmail = "Email is required";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errEmail = "Invalid email";
        }else{
            $crrEmail = $email;
        }

        if(empty($gender)){
            $errGender = "Please select your gender";
        }else{
            $crrGender = $gender;
        }

        if(empty($hobbies)){
            $errHobbies = "Please select your hobbies";
        }else{
            $crrHobbies = $hobbies;
        }

        if(empty($country)){
            $errCountry = "Please select your country";
        }else{
            $crrCountry = $country;
        }

        if(isset($crrUname) && isset($crrEmail) && isset($crrGender) && isset($crrHobbies) && isset($crrCountry)){
            $uname = $email = $gender = $hobbies = $country = null;
        }
    }

    // implode and explode
?>

<form action="" method="post">
    <input type="text" placeholder="Your Name" name="uname" value="<?= $uname ?? null ?>">
    <span style="color: red">
        <?= $errName ?? null ?>
    </span>
    <br><br>
    <input type="text" placeholder="Your Email" name="email" value="<?= $email ?? null ?>">
    <span style="color: red">
        <?= $errEmail ?? null ?>
    </span>
    <br><br>
    <label for="">Gender : </label>
    <label for="male">
        <input type="radio" name="gender" value="Male" id="male" <?= isset($gender) && $gender == "Male" ? "checked":null ?> >Male
    </label>
    <label for="Female">
        <input type="radio" name="gender" value="Female" id="Female" <?= isset($gender) && $gender == "Female" ? "checked":null ?>>Female
    </label>
    <span style="color: red">
        <?= $errGender ?? null ?>
    </span>
    <br><br>
    <label for="">Hobbies : </label>
    <label for="reading">
        <input type="checkbox" name="hobbies[]" value="Reading" id="reading" <?= isset($hobbies) && in_array("Reading", $hobbies) ? "checked":null ?> >Reading
    </label>
    <label for="writing">
        <input type="checkbox" name="hobbies[]" value="Writing" id="writing" <?= isset($hobbies) && in_array("Writing", $hobbies) ? "checked":null ?> >Writing
    </label>
    <label for="coding">
        <input type="checkbox" name="hobbies[]" value="Coding" id="coding" <?= isset($hobbies) && in_array("Coding", $hobbies) ? "checked":null ?> >Coding
    </label>
    <span style="color: red">
        <?= $errHobbies ?? null ?>
    </span>
    <br><br>
    <select name="country" id="">
        <option value="">--Select Country--</option>
        <?php foreach($countries as $ctr){ ?>
            <option value="<?= $ctr ?>" <?= isset($country) && $country == $ctr ? "selected":null ?>><?= $ctr ?></option>
        <?php } ?>
    </select>
    <span style="color: red">
        <?= $errCountry ?? null ?>
    </span>
    <br><br>
    <button type="submit" name="reg123" >Submit</button>
</form>

<?php  
    if(isset($crrUname) && isset($crrEmail) && isset($crrGender) && isset($crrHobbies) && isset($crrCountry)){
?>
    <h4>Name : <?= $crrUname ?></h4>
    <h4>Email : <?= $crrEmail ?></h4>
    <h4>Gender : <?= $crrGender ?></h4>
    <h4>Hobbies : <?= implode(", ", $crrHobbies) ?></h4>
    <h4>Country : <?= $crrCountry ?></h4>
<?php
    }
?>