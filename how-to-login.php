<?php 
session_start();
if(isset($_SESSION["email"])){
  header("location:index.php");
}
include("navbar.php");

 ?>


    <section class="container-fluid sign-in-form-section">
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 sign-up" style="text-align: center;">
                    <h3 style="font-weight: bold;">How do you want to Login?</h3><hr>
                    <p>If you want to sign in as a student click on student login button otherwise click on owner login button.</p><br><br>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='student-login.php'" style="width:200px;">student Login</button>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='owner-login.php'" style="width:200px;">Owner Login</button>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='admin-login.php'" style="width:200px;">Admin Login</button>
                </div>
                
            </div>
        </div>
    </section>