<?php
include 'inc/header.php';
 include 'lib/student.php';
 ?>

 <script type="text/javascript">
   $(document).ready(function(){
      $("form").submit(function(){
         var roll = true;
         $(':radio').each(function(){
           name=$(this).attr('name');
           if(roll && !$(':radio[name="' + name + '"]:checked').length){
          $('.alert').show();
           roll=false;


           }
         });
         return roll;
      });

   });
 </script>

 <?php
//error_reporting(0);
 $stu=new student();
 $dt=$_GET['dt'];

 if($_SERVER['REQUEST_METHOD']=='POST'){
   $attend=$_POST['attend'];
 $update_atn=$stu->updateAttendance($dt,$attend);
 }
  ?>
  <?php
 if(isset($update_atn)){
   echo $update_atn;
 }
   ?>

<div class="alert alert-danger"><strong>ERROR!</strong>Student ATTENDANCE Missing!!</div>
     <div class="panel panel-default">
       <div class="panel-heading">
         <h3 class="panel-title">
           <a class="btn btn-success"href="add.php" style="color:white;">Add student</a>
           <a style="color:white;"class="btn btn-info pull-right"href="date_view.php" >Back</a>
         </h3>
       </div>

       <div class="panel-body">

         <div class="well text-center" style="font-size:20px;">
            <strong>Date:</strong><?php echo $dt;?>
         </div>
   <form class="" action="" method="post">
     <table class="table table-striped">
       <tr>
         <th width="25%">Serial</th>
         <th width="25%">Student Name</th>
         <th width="25%">Student Role</th>
         <th width="25%">Attendance</th>
       </tr>

       <?php
       $stu=new student();
           $get_stu=$stu->getStuData($dt);
           if($get_stu){
             $i=0;
             while($stu=$get_stu->fetch_assoc()){
               $i++;

        ?>

        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $stu['name']; ?></td>
          <td><?php echo $stu['roll']; ?></td>
          <td>
            <input type="radio" name="attend[<?php echo $stu['roll']; ?>]" value="Present" <?php if($stu['attend']=="Present"){
              echo "checked";
            } ?>>P/
            <input type="radio" name="attend[<?php echo $stu['roll']; ?>]" value="Absent" <?php if($stu['attend']=="Absent"){
              echo "checked";
            } ?>>A
          </td>
        </tr>
     <?php }} ?>
     <tr>
       <td colspan="4">
         <input class="btn btn-primary"type="submit" name="submit"  value="Update">
       </td>
     </tr>


     </table>
   </form>
       </div>

     </div>
     <?php include 'inc/footer.php'; ?>
