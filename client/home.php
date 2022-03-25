<?php
session_start();
require_once('inc/header.php');
?>
<h1>Hello <?php echo $_SESSION['name']; ?></h1><br>

<h3>Add/Update User</h3><br>
<div class="card">
<form id="userFrm" method="post" action="">

<input type="text" name="name" placeholder="name" required ><br>
<input type="text" name="phone" placeholder="phone" required ><br>
<input type="email" name="email" placeholder="email" required><br>
<input type="password" name="password" id="password" placeholder="password" required><br>
<input type="password" name="cpassword" id="cpassword" placeholder="confirm password" required ><br>

<button id="registerBtn"> Add </button>
</form>
</div>

<h3>Post List</h3><br>
<table class="table table-hover table-striped table-bordered" id="list">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phome</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="tbody">

    </tbody>
</table><br>


<p><a href="logout.php">Log Out</a></p>

<script>
	$(document).ready(function(){

        showUserList();

    function showUserList(){
        output = "";
        $.ajax({
			url:"http://localhost/Php/classes/routes/user.php?f=get-all-user",
			method:"GET",
            dataType:"json",
			error:err=>{
				console.log(err)
				alert("An error occured.",'error');
			},
			success:function(resp){
				if(resp){
                    x=resp;
                }else{
                    x="";
                }
                for (i = 0; i < x.length; i++) {
                    output +=   "<tr><td>" + 
                                i +"</td><td>" + 
                                x[i].name +
                                "</td><td>" + 
                                x[i].phone +
                                "</td><td>" + 
                                x[i].email +
                                "</td><td>" + 
                                x[i].password +
                                "</td><td>" + 
                                      "<a class='updateBtn' href='javascript:void(0)' data-id=" +x[i].id + "><button>Update</button></a>"+
                                     "<a class='deleteBtn' href='javascript:void(0)' data-id=" +x[i].id + "><button>Delete</button></a>"+
                                "</td></tr>";
                                
                }
                $("#tbody").html(output);
			}
		})
    }

    $('#userFrm').submit(function(e){
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
                        $("#userFrm")[0].reset();
                        showUserList();
                    }else{
                       alert(resp.msg)
                    }
                }
            })
        })

        $('#tbody').on("click", ".deleteBtn", function (){
            let confirmAction = confirm("Are you sure to delete this User permanently?");
            if (confirmAction) {
                delete_user($(this).attr('data-id'));
            }
        })
       
    })


    function delete_user($id){
        mythis = this;
		$.ajax({
			url:"http://localhost/Php/classes/routes/user.php?f=delete-user",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert("An error occured.",'error');
			},
			success:function(resp){
				if(resp.status == 'success'){
                    showUserList();
				}else{
					alert(resp.msg);
				}
			}
		})
	}
  
</script>