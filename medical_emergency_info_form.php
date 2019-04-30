<?php
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
            <label>Participant: <input type="text" name="name" value="<?php echo $name; ?>"></label><span class="error"> * <?php echo $nameErr; ?></span><br>
            <label>Date: <input type="text" name="date" placeholder="YYYY-MM-DD" value="<?php echo $date; ?>"></label><span class="error"> * <?php echo $dateErr; ?></span><br>
            <label>Home Address: <input type="text" name="home" value="<?php echo $homeAddress; ?>"</label><br>
            <label>Phone: <input type="text" name="phone" placeholder="E.g. 123-456-7890" value="<?php echo $phone; ?>"></label><span class="error"> <?php echo $phoneErr; ?></span><br>
            <label>E-mail: <input type="text" name="email" placeholder="example@email.com" value="<?php echo $email; ?>"></label><span class="error"> <?php echo $emailErr; ?></span><br>
            <input type="submit" name="submit" value="Submit">
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $error == "")
            {
                echo "<h2>Your updated info: </h2>";
                echo "<Strong>Participant:</Strong> $name<br>";
                echo "<Strong>Date:</Strong> $date<br>";
                echo "<Strong>Home Address:</Strong> $homeAddress<br>";
                echo "<Strong>Phone:</Strong> $phone<br>";
                echo "<Strong>E-mail:</Strong> $email<br>";

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
