<?php 
include("baglanti.php");
$username_err=$parola_err="";

if(isset($_POST["giris"]))
{
    if(empty($_POST["kullaniciadi"]))
    {
        $username_err="Kullanıcı Adı Boş Geçilmez";
    }
    
    else{
        $username=$_POST["kullaniciadi"];
    }

 
    if(empty($_POST["parola"]))
    { 
        $parola_err="Parola Boş Geçilmez";
    }
    else{
        $parola=$_POST["parola"];
    }

    if(isset($username) && isset($parola)){



        $secim="SELECT * FROM kullanici WHERE kullanici_adi='$username'";
        $calistir=mysqli_query($baglanti,$secim);
        $kayitsayisi=mysqli_num_rows($calistir);

        if($kayitsayisi>0){
            $ilgilikayit=mysqli_fetch_assoc($calistir);
            $hashlisifre=$ilgilikayit["parola"];

   
            if(password_verify($parola,$hashlisifre)){
                session_start();
                $_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
                $_SESSION["email"]=$ilgilikayit["email"];
                header("location:profile.php");
            }
            else{
                echo '<div class="alert alert-danger" role="alert">
            Parola Yanlış
            </div>';
            }
            
         
        }
        
         
        else{
            echo '<div class="alert alert-danger" role="alert">
            Kullanıcı Adı Yanlış
            </div>';
        }


    mysqli_close($baglanti);

}
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GİRİŞ YAP</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
        <div class="signup-form">
            <form action="login.php" method="POST">
                <h1>GİRİŞ YAP </h1>
                <input type="text" placeholder="kullanıcı adı" class="txt" id="login-name" name="kullaniciadi">
                <label class="login-field-icon fui-user" for="login-name"
               <?php
               if(!empty($username_err))
               {
                echo"is-invalid";
               }
               ?>
               ></label>
                <input type="password" placeholder="Sifre" class="txt" id="login-pas" name="parola">
                <label class="login-field-icon fui-user" for="login-pass"></label>
             <?php
             echo $parola_err;
             ?>
             
             
             
              
                <input type="submit" value="GİRİŞ YAP" class="signup-btn signup-btn-primary" name="giris"></input>
                
            </form>
        </div>
</body>
</html>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>