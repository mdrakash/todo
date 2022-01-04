<?php
  include('functions/db_config.php');
  session_start();
  if(!isset($_SESSION["user_id"])){
    header('location:index.php');
  };
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>



    <div class="container">
            <a class="btn btn-primary" href="functions/function.php?logout=true" role="button" style="float:right">Logout</a>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add to Contuct List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        if(isset($_SESSION['user_id'])){
                            $user_id= $_SESSION['user_id'];
                        }
                    ?>
                    <input type="hidden" id="user_id" value="<?php echo $user_id?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" autocomplete="off" class="form-control" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="Time" class="form-label">Time</label>
                        <input type="time" autocomplete="off" class="" id="time">
                    </div>
                    <div class="mb-3">
                        <label for="Color" class="form-label">Color</label>
                        <input type="color" autocomplete="off" class="" id="color">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" onclick="adduser()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateData" tabindex="-1" aria-labelledby="updateData" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDataLabel">Update ToDO List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        if(isset($_SESSION['user_id'])){
                            $username= $_SESSION['user_id'];
                        }
                    ?>
                    <input type="hidden" id="user_id" value="<?php echo $user_id?>">
                    <div class="mb-3">
                        <label for="updateTitle" class="form-label">Title</label>
                        <input type="text" autocomplete="off" class="form-control" id="updateTitle">
                    </div>
                    <div class="mb-3">
                        <label for="UpdateTime" class="form-label">Time</label>
                        <input type="time" autocomplete="off" class="" id="UpdateTime">
                    </div>
                    <div class="mb-3">
                        <label for="UpdateColor" class="form-label">Color</label>
                        <input type="color" autocomplete="off" class="" id="UpdateColor">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Update</button>
                    <input type="hidden" name="hiddenData" id="hiddenData">
                </div>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <h1 class="text-center">ToDo</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark m-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add List
        </button>
        <div id="displaytable"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
    <script>
        
        function DeleteData(deleteID){
            $.ajax({
                url:"functions/function.php",
                type:"post",
                data:{
                    deleteID:deleteID
                },
                success:function(data,status){
                    display();
                }
            })
        };

        function editData(editID) {
            
            $('#hiddenData').val(editID);
            $.post("functions/function.php",{editID:editID},function(data,status){
                //console.log(data);
               var userID =JSON.parse(data);
               //console.log(userID);
               $('#updateTitle').val(userID.title);
               $('#UpdateTime').val(userID.time);
               $('#UpdateColor').val(userID.color);
            });
            $('#updateData').modal('show');
        }
    </script>
</body>

</html>