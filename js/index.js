
function adduser(){
    var title=$('#title').val();
    var time=$('#time').val();
    var color=$('#color').val();
    var user_id=$('#user_id').val();

$.ajax({
    url:"functions/function.php",
    type:"post",
    data:{
        
        title:title,
        time:time,
        color:color,
        user_id:user_id,
    },
    success:function(data,status){
        $('#exampleModal').modal('hide');
        display();
    }
});

};

function display(){
    var user_id=$('#user_id').val();
    var display="true";
    $.ajax({
        url:"functions/function.php",
        type:"post",
        data:{
            display:display,
            user_id:user_id
        },
        success:function(data,status){
            $('#displaytable').html(data);
        }
    });
};



$(document).ready(function(){
    display();
});
