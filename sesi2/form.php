<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pertemuan 2</title>
</head>
<body>
    <?php
        // untuk melihat input menggunakan var_dump
        // kalau pake get bila submit akan kelihatan di browser bila lihat input menggunakan var_dump untuk get
        // form biasanya menggunakan post
        var_dump($_POST);
            //untuk menunjukkan eror disamping bisa menggunakan associative array
            $error = [
                "name" => "",
                "email" => "",
                "password" => "",
                "confirm-password" => "",
                "gender" => "",
                "agree" => ""
            ];        
        if (count($_POST) !=0){

    
                if(empty($_POST["name"])){
                    $error["name"] = "Name Must not be empty";
                }
    
                //filter_var yang ingin divalidasi yaitu email dan filter berdasarkan apa pada case ini berdasar email
                if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false){
                    $error["email"] = "Email must be valid format" ;
                }
    
                //pada password menggunakan validasi panjang jadi menggunakan strlen
                if(strlen($_POST["password"]<5)){
                    $error["password"] = "Password must be 5 char";
                }
    
                //untuk confirm password bisa menggunakan strcmp karena ingin mengetahui apabila sama dengan password
                if(strlen($_POST["password"] != $_POST["confirm-password"])){
                    $error["confirm-password"] = "Confirm password and Password must be same";
                }
    
                //untuk cek gender menggunakan isset untuk cek billa dia masukkan data atau tidak
                if (isset($_POST["gender"])==false) {
                    $error["gender"] = "Gender must be chosen";
                }
    
                if(isset($_POST["agree"])==false){
                    $error["agree"] = "Must agree";
                }
        }

    ?>
    <!-- $_SERVER["PHP_SELF"] hanya untuk dapatkan nama file sekarang -->
    <!-- bisa menggunakan form.php -->
    <form method="POST" action="form.php"> 
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <?php echo $error["name"]?>
        <br />
        <br />
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <?php echo $error["email"]?>
        <br />
        <br />
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <?php echo $error["password"]?>
        <br />
        <br />
        <label for="confirm-password">Confirm Password</label>
        <input type="password" name="confirm-password" id="confirm-password">
        <?php echo $error["confirm-password"]?>
        <br />
        <br />
        <label>Gender</label>
        <input type="radio" name="gender" id="gender-male" value="Male">
        <label for="gender-male">Male</label>
        <input type="radio" name="gender" id="gender-female" value="Female">
        <label for="gender-female">Female</label>
        <?php echo $error["gender"]?>
        <br />
        <br />
        <input type="checkbox" name="agree" id="agree">
        <label for="agree">I Agree to terms and condition</label>
        <?php echo $error["agree"]?>
        <br />
        <br />
        <button>Submit</button>
    </form>
</body>
</html>