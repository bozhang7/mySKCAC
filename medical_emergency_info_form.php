<?php
    // Bo is working on this file, DO NOT modify.
    include 'error_report.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <title>Medical & Emergency Information</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="">
        <style>.error {color: #FF0000;}</style>
    </head>

    <body>
        <?php
            $name = $date = $homeAddress = $phone = $email = "";
            $nameErr = $dateErr = $homeAddressErr = $phoneErr = $emailErr = $error = "";
            $success = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                // validates the name
                if (empty($_POST["name"]))
                {
                    $nameErr = $error = "Name is required";
                }
                else
                {
                    $name = $_POST["name"];
                    if (!preg_match("/^[a-zA-Z ]*$/",$name))
                    {
                        $nameErr = $error = "Only letters and white space allowed";
                    }
                }

                // validates the date
                if (empty($_POST["date"]))
                {
                    $dateErr = $error = "Date is required";
                }
                else
                {
                    $date = $_POST["date"];
                    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
                    {
                        $dateErr = $error = "Date entered does not match required format";
                    }
                }

                if (!empty($_POST["home"]))
                {
                    $homeAddress = $_POST["home"];
                }

                // validate the phone number if filled
                if (!empty($_POST["phone"]))
                {
                    $phone = $_POST["phone"];
                    if (!preg_match("/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/",$phone))
                    {
                        $phoneErr = $error = "Phone number format not valid";
                    }
                }

                // validates the email if filled
                if (!empty($_POST["email"]))
                {
                    $email = $_POST["email"];
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        $emailErr = $error = "Invalid email format";
                    }
                }
            }
        ?>

        <h2>MEDICAL & EMERGENCY INFORMATION</h2>
        <p><span class="error">* required field</span></p>
        <form action="" method="post">
            <!-- form group 1: participant -->
            <label>Participant: <input type="text" name="name" value="<?php echo $name; ?>"></label><span class="error"> * <?php echo $nameErr; ?></span><br>
            <label>Date: <input type="text" name="date" placeholder="YYYY-MM-DD" value="<?php echo $date; ?>"></label><span class="error"> * <?php echo $dateErr; ?></span><br>
            <label>Home Address: <input type="text" name="home" value="<?php echo $homeAddress; ?>"</label><br>
            <label>Phone: <input type="text" name="phone" placeholder="E.g. 123-456-7890" value="<?php echo $phone; ?>"></label><span class="error"> <?php echo $phoneErr; ?></span><br>
            <label>E-mail: <input type="text" name="email" placeholder="example@email.com" value="<?php echo $email; ?>"></label><span class="error"> <?php echo $emailErr; ?></span><br><br>

            <!-- form group 2: residential provider -->
            <label>Residential Provider: <input type="text" name="residentialProvider"></label><br>
            <label>Phone: <input type="text" name="providerPhone"></label><br>
            <label>Address: <input type="text" name="providerAddress"></label><br>
            <label>E-mail: <input type="text" name="providerEmail"></label><br><br>

            <!-- form group 3: guardian -->
            <label>Guardian: <input type="text" name="guardian"></label><br>
            <label>Phone: <input type="text" name="guardianPhone"></label><br>
            <label>Address: <input type="text" name="guardianAddress"></label><br>
            <label>E-mail: <input type="text" name="guardianEmail"></label><br><br>

            <!-- form group 4: NSA(client rep.) -->
            <label>NSA(Client Rep.): <input type="text" name="nsa"></label><br>
            <label>Phone: <input type="text" name="nsaPhone"></label><br>
            <label>Address: <input type="text" name="nsaAddress"></label><br>
            <label>E-mail: <input type="text" name="nsaEmail"></label><br><br>

            <!-- form group 5: emergency contact -->
            <label>Emergency Contact: <input type="text" name="emergContact"></label><br>
            <label>Emerg. Phone: <input type="text" name="emergPhone"></label><br>
            <label>Alternate Emergency Phone: <input type="text" name="alterEmergPhone"></label><br><br>

            <!-- form group 6: medical alerts, physical limitations, diet restrictions -->
            <label>Medical Alerts<textarea name="medicalAlerts"></textarea></label><br>
            <label>Physical Limitations<textarea name="physicalLimitations"></textarea></label><br>
            <label>Diet Restrictions<textarea name="dietRestrictions"></textarea></label><br><br>

            <!-- todo: form group 7: medications -->

            <input type="submit" name="submit" value="Submit">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && $error == "")
                {
                    $success = "<span style=\"color: green; \">Successfully</span>";
                    echo $success;
                }
            ?>
        </form>

        <?php
            // if the form is submitted and there is no error, print the updated info and send it to the email
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $error == "")
            {
                /*
                echo "<h2>Your updated info: </h2>";
                echo "<Strong>Participant:</Strong> $name<br>";
                echo "<Strong>Date:</Strong> $date<br>";
                echo "<Strong>Home Address:</Strong> $homeAddress<br>";
                echo "<Strong>Phone:</Strong> $phone<br>";
                echo "<Strong>E-mail:</Strong> $email<br>";
                */

                $recipient = "bbx719@hotmail.com";
                $subject = "$name Just Updated 'MEDICAL & EMERGENCY INFORMATION' form";
                //$sender = $_POST["name"];
                $senderEmail = "sender@email.address";
                //$name = $_POST["name"];
                //$message = $_POST["message"];
                $emailBody = "Participant: $name\n\nDate: $date\n\nHome Address: $homeAddress\n\nPhone: $phone\n\nE-mail: $email";

                mail($recipient, $subject, $emailBody, "From: SKCAC@example.com");
            }
        ?>
    </body>
</html>
