
<?php require_once('inc/header.php');?>

<div class="card">
<form id="loginFrm" method="post" action="">
<input type="email" name="email" placeholder="email" required><br><br>
<input type="password" name="password" id="password" placeholder="password" required><br><br>
<button id="registerBtn" type="submit" name="submit"> Login </button>
</form>
<br><br><br>
<a href='register.php'>Register</a>
</div>
<script>
    $(document).ready(function(){
        $('#loginFrm').submit(function(e){
            e.preventDefault();

            $.ajax({
                url:"http://localhost/Php/classes/routes/user.php?f=login",
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
                        location.replace('http://localhost/Php/client/home.php')
                    }else{
                       alert(resp.msg)
                    }
                }
            })
        })
    })
    </script>
