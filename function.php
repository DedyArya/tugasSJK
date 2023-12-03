<?php

//koneksi
$koneksi = mysqli_connect('localhost','root','','tugasSJK');

//daftar
if(isset($_POST['register'])){
    //jika tombol register diklik

    $username =$_POST['username'];
    $password =$_POST['password']; //pure inputan user--blum dienkripsi

    //fungsi enkripsi
    $epassword = password_hash($password, PASSWORD_DEFAULT);

    //insert to db
    $insert = mysqli_query($koneksi,"INSERT INTO user (username,password) values ('$username','$epassword')");

    if($insert){
        //jika berhasil
        header('location:login.php'); //redirect ke halaman login
    }else{
        //jika gagal
        echo'
        <script>
            alert("Registrasi Gagal");
            window.location.href = "register.php";
        </script>';
    }
}

//login
if(isset($_POST['login'])){
    //jika tombol login diklik

    $username =$_POST['username'];
    $password =$_POST['password']; //pure inputan user--blim dienkripsi

    //fungsi enkripsi
    $epassword = password_hash($password, PASSWORD_DEFAULT);

    //insert to db
    $cekdb = mysqli_query($koneksi,"SELECT * FROM user where username = '$username'");
    $hitung = mysqli_num_rows($cekdb);
    $pw = mysqli_fetch_array($cekdb);
    $passwordsekarang = $pw['password'];

    if($hitung){
        //jika ada
        //verifikasi password
        if(password_verify($password,$passwordsekarang)){
            //jika password benar
        header('location:home.php'); //redirect ke halaman home
        }else{
            //jika password salah
            echo'
            <script>
                alert("Password salah");
                window.location.href = "login.php";
            </script>';
        }
    }else{
        //jika gagal
        echo'
        <script>
            alert("Login Gagal");
            window.location.href = "login.php";
        </script>';
    }
}
?>