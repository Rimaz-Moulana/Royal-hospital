<?php
require_once("DBconnect.php");

if(isset($_POST["nic"])){
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $cpassword = $_POST['cpassword'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $ecn = $_POST['ecn'];
    $cmed = $_POST["cmed"];
    $allergies = $_POST['allergies'];
    $illness = $_POST['illness'];
    $oillness = $_POST['oillness'];
    $comments = $_POST['comments'];

    $ill = " ";
    foreach($illness as $ill1){
        $ill .= $ill1.",";
    }
    $ill .= $oillness.".";

    $select = "SELECT * FROM user WHERE email = '$email' && password = '$password' && user_role = 'patient";
    $res = mysqli_query($con, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'user already exist!';
    }
    else{
        if($password != $cpassword)
        {
            $error[] = 'passowrd not matched';
        }
        else{
            $query1 = "INSERT INTO `user`(`nic`, `name`, `address`, `email`, `contact_num`, `gender`, `password`, `user_role`, `profile_image`, `DOB`) VALUES 
            ('$nic','$name','$address','$email','$phone','$gender','$hash','patient','','$dob')";
        
            $query2 = "INSERT INTO `patient`(`patientID`, `nic`, `weight`, `receptionistID`, `patient_type`, `height`, `illness`, `drug_allergies`, `medical_history_comments`, `currently_using_medicine`, `emergency_contact`) VALUES 
            ('','$nic','---','---','---','---','---','$ill','$hash','---','$dob')";
        
            $result1 = mysqli_query($con,$query1);
            $result2 = mysqli_query($con,$query2);
            if($query1 & $query2){echo "Query is successful";}
        
            header('location:login_form.php');
        }
    }
}
?>
<?php include "./component/header.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css1/registration.css">
    <script src="./js/appointment.js"></script>
    
    <title>MakeAppointment</title>
</head>
<body>
    <section class="header">
    

    <div class="heading">
        <h3>Registration</h3>
    </div>
    <div class="Form">
        <form action=" " method="post">
            <br><br>
            <label for="">Name</label><br><br>
            <input type="text" name="name" id="name" placeholder="eg:- S.W.A.Siriwardana"><br><br>
            <label for="">NIC(if you have not NIC please enter your gurdian's NIC number)</label><br><br>
            <input type="text" name="nic" id="nic" placeholder="eg:- 19XXXXXXXXX/99XXXXXXXV"><br><br>
            <label for="">Email</label><br><br>
            <input type="email" name="email" id="email" placeholder="eg:- kumarsanga84@gmail.com"><br><br>
            <label for="">Password</label><br><br>
            <input type="password" name="password" id="password" placeholder="XXXXXXXXXXX"><br><br>
            <label for="">Confirm Password</label><br><br>
            <input type="password" name="cpassword" id="cpassword" placeholder="XXXXXXXXXXX"><br><br>
            <label for="">Phone</label><br><br>
            <input type="text" name="phone" id="phone" placeholder="eg:- 07XXXXXXXX"><br><br>
            <label for="">Date of Birth</label><br><br>
            <input type="date" name="dob" id="dob"><br><br>
            <label for="">Address</label><br><br>
            <input type="text" name="address" id="address" placeholder="eg:- 119/1/A, Willmot Street, Colombo-07"><br><br>
            <label for="">Gender</label><br><br>
            <select name="gender" id="gender">
                <option value="">Please A Select</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Others</option>
            </select><br><br>
            <label for="">Emergency Contact Number</label><br><br>
            <input type="text" name="ecn" id="ecn" placeholder="eg:- 07XXXXXXXX"><br><br>
            <label for="">Currently Using Medicines</label><br><br>
            <textarea name="cmed" id="cmed" cols="30" rows="50" placeholder="If you currently use any medicines please mention"></textarea><br><br>
            <label for="">Drug Allergies</label><br><br>
            <textarea name="allergies" id="allergies" cols="30" rows="50" placeholder="If you have any drug allergies please mention"></textarea><br><br>
            <label for="">Illness</label><br><br>
            <input type="checkbox" name="ilness[]" id="illness" value="Asthma"><a>&numsp;Asthma</a><br>
            <input type="checkbox" name="ilness[]" id="illness" value="Asthma"><a>&numsp;Asthma</a><br>
            <input type="checkbox" name="ilness[]" id="illness" value="Asthma"><a>&numsp;Asthma</a><br>
            <input type="checkbox" name="ilness[]" id="illness" value="Asthma"><a>&numsp;Asthma</a><br>
            <input type="checkbox" name="ilness[]" id="illness" value="Asthma"><a>&numsp;Asthma</a><br><br>
            <label for="">Other Illness</label><br><br>
            <textarea name="oillness" id="oillness" cols="30" rows="50" placeholder="If you have any other illness please mention"></textarea><br><br>
            <label for="">Any Medical Comments</label><br><br>
            <textarea name="comments" id="comments" cols="30" rows="50" placeholder="If you have any drug allergies please mention"></textarea><br><br>
            <!-- <br><br><input type="submit" value="Submit" id="btn" name="btn" class="btn"> -->
            <button type="submit" name="submit" id="btn" value="submit" onclick="">Submit</button>
        </form> 
        
    </div>

    <!-- <div class="footer">
    <?php include"./component/footer.php" ?>
    </div> -->
    </section>
</body>
</html>

