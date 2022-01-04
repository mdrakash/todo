<?php
    include('db_config.php');
	session_start();

    /*REGISTER PORTION START*/

	if(isset($_POST['signup'])){
		// print_r($_POST);
        // die();
		$name = $_POST['name'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		$error = 0;
		if($name == ""){
			$error = $error + 1;
		}
		if($email == ""){
			$error = $error + 1;
		}
		if($pass == ""){
			$error = $error + 1;
		}
		if($error == 0){

			$connection = db_config::DBConnect();
			$sql = "INSERT INTO users VALUES('','$name','$email','$pass')";
			$connection->insert($sql);


			$_SESSION["msg"] = "User Registed Successfully";
			header('location:../index.php');

		}else{

		}

	}
// LOGIN
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		//  print_r($_POST);
        // die();
		$error = 0;
		if($email == ""){
			$error = $error + 1;
		}
		if($pass == ""){
			$error = $error + 1;
		}

		if($error == 0){

			$sql = "SELECT * FROM users where email='$email' && pass ='$pass'";
	        $connection = db_config::DBConnect();
	        $resource_data = $connection->view($sql);
		    $resource_obj = $resource_data->fetch_object();
		    if(count((array)$resource_obj) == 0){
		    	$_SESSION["msg"] = "Username or password invalid";
				header('location:../index.php');
		    }
            else{
				$_SESSION["user_id"]=$resource_obj->id;
				header('location:../ToDo.php');
			}
		    

		}
		// if ($error>0) {
		// 	$_SESSION["msg"] = "Username or password field empty";
		// 	header('location:../index.php');
        // }
	

	}

	if(isset($_GET['logout'])){
		session_destroy();
		header('location:../index.php');
	}





if(isset($_POST['title']) && isset($_POST['time']) && isset($_POST['user_id']) && isset($_POST['color'])){
	$title=$_POST['title'];
	$time=$_POST['time'];
	$color=$_POST['color'];
	$user_id=$_POST['user_id'];
	$connection = db_config::DBConnect();
	$sql = "INSERT INTO tasks VALUES('','$user_id','$title','$time','$color')";
	$connection->insert($sql);

}

if(isset($_POST['display']) && isset($_POST['user_id'])){
	$user_id=$_POST['user_id'];
	$number=1;
	$table='<div class="table-responsive">
	<table class="table thead-light">
	<thead>
	  <tr>
		<th style="width: 30%">SI No.</th>
		<th style="width: 30%">Title</th>
		<th style="width: 30%">Action</th>
	  </tr>
	</thead>';
	$sql = "SELECT * FROM tasks where user_id='$user_id'";
	$connection = db_config::DBConnect();
	$resource_data = $connection->view($sql);
	while($resource_obj = $resource_data->fetch_object()){
	$table.='
    <tr class="text-white" style="background-color:'.$resource_obj->color.';">
      <td>'.$number.'</td>
      
	  <td>
		<p style="font-size:30px">'.$resource_obj->title.'</p>
		<p style="font-size:15px">'.$resource_obj->time.'</p>
	  </td>
	  <td>
		<button class="btn btn-info" onclick="editData('.$resource_obj->id.')">Edit</button>
		<button class="btn btn-success" onclick="DeleteData('.$resource_obj->id.')">Complete</button>
	  </td>
    </tr>
	';
	$number++;
	}

	$table.='
	</table>
	</div>
	';
	echo $table;
};


if(isset($_GET['logout'])){
	session_destroy();
	header('location:../index.php');
}

if(isset($_POST['deleteID'])){
	$connection = db_config::DBConnect();
	$id = $_POST['deleteID'];
	$sql = "delete from tasks where id='$id'";
	$connection->delete($sql);
	$_SESSION["test_sess"] = "Deleted successfully";
}

if(isset($_POST['editID'])){
	$editID=$_POST['editID'];
	$response=array();
	$connection = db_config::DBConnect();
	$sql = "select * from tasks where id='$editID'";
	$resource_data = $connection->view($sql);
	while($resource_obj = $resource_data->fetch_object()){
		$response=$resource_obj;
	}

	echo json_encode($response);
}

?>