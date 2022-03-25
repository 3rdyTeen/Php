<?php
 require_once('inc/header.php');
 session_start();
 echo $_SESSION['data-id'];
 ?>

<div class="card">
<form id="registerFrm" method="post" action="">

<input type="text" name="name" placeholder="name" required ><br>
<input type="text" name="phone" placeholder="phone" required ><br>
<input type="email" name="email" placeholder="email" required><br><br>
<input type="password" name="password" id="password" placeholder="password" required><br><br>
<input type="password" name="cpassword" id="cpassword" placeholder="confirm password" required ><br><br>

<button id="registerBtn"> Register </button>
</form>
</div>
<script>
    $(document).ready(function(){
        $('#registerFrm').submit(function(e){
            e.preventDefault();

            if($('#password').val() != $('#cpassword').val()){
                alert("Password did not match")
                return false;
            }

            $.ajax({
                url:"http://localhost/Php/classes/routes/user.php?f=register",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                method: 'POST',
                type: 'POST',
                error:err=>{
                    console.log(err)
                    alert("An error occured",'error');
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        alert(resp.msg)
                        location.replace('http://localhost/Php/client/login.php')
                    }else{
                       alert(resp.msg)
                    }
                }
            })
        })
    })
    </script>

Hello updae user