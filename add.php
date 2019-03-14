<?php include 'inc/header.php';
include 'lib/student.php';
 ?>
<?php
$stu= new student();
if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['submit']){
  $name=$_POST['name'];
  $roll=$_POST['roll'];
  $insertdata=$stu->insertStudent($name,$roll);
}
 ?>
 <?php
if(isset($insertdata)){
  echo $insertdata;
}

  ?>
     <div class="panel panel-default">
       <div class="panel-heading">
         <h3 class="panel-title">
           <a class="btn btn-success"href="add.php" style="color:white;">Add student</a>
           <a style="color:white;"class="btn btn-info pull-right" href="index.php" >Back</a>
         </h3>
       </div>

       <div class="panel-body">


   <form action="" method="post" style="width:60%; margin:auto;">
     <div class="form-group">
       <label for="">Student Name</label>
       <input type="text" class="form-control" id="name" name="name">
     </div>
     <div class="form-group">
       <label for="">Student Roll</label>
       <input type="text" class="form-control" id="roll"  name="roll">
     </div>
     <div class="form-group">

       <input type="submit" class="btn btn-success" name="submit" value="Add Student">
     </div>

   </form>
       </div>

     </div>
     <?php include 'inc/footer.php'; ?>
