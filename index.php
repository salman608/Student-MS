<?php
include 'inc/header.php';
 include 'lib/student.php';
 ?>
 <script type="text/javascript">
   $(document).ready(function(){
      $("onclick").submit(function(){
         var roll = true;
         $(':radio').each(function(){
           name=$(this).attr('name');
           if(roll && !$(':radio[name="' + name + '"]:checked').length){
          $('.alert').show();
          var  roll=false;


           }
         });
         return roll;
      });

   });
 </script>
<?php

error_reporting(0);
$stu=new student();
$cur_date=date('Y-m-d');

if($_SERVER['REQUEST_METHOD']=='POST'){
  $attend=$_POST['attend'];


  $insertattend=$stu->insertAttendance($cur_date,$attend);
}
 ?>
 <?php
if(isset($insertattend)){
  echo $insertattend;
}
  ?>

     <div class="panel panel-default">
       <div class="panel-heading">
         <h3 class="panel-title">
           <a class="btn btn-success"href="add.php" style="color:white;">Add student</a>
           <a style="color:white;"class="btn btn-info pull-right"href="date_view.php" >View All</a>
         </h3>
       </div>

       <div class="panel-body">

         <div class="well text-center" style="font-size:20px;">
            <strong>Date:</strong><?php echo  $cur_date=date('Y-m-d');?>
         </div>
   <form action="" method="post">
     <table class="table table-striped">
       <tr>
         <th width="25%">Serial</th>
         <th width="25%">Student Name</th>
         <th width="25%">Student Role</th>
         <th width="25%">Attendance</th>
       </tr>

       <?php
           $get_student=$stu->getStudent();
           if($get_student){
             $i=0;
             while($stu=$get_student->fetch_assoc()){
               $i++;

        ?>

       <tr>
         <td><?php echo $i; ?></td>
         <td><?php echo $stu['name']; ?></td>
         <td><?php echo $stu['roll']; ?></td>
         <td>
           <input type="radio" name="attend[<?php echo $stu['roll']; ?>]" value="Present">P/
           <input type="radio" name="attend[<?php echo $stu['roll']; ?>]" value="Absent">A
         </td>
       </tr>
     <?php }} ?>
     <tr>
       <td>
         <input  type="submit" name="submit" value="submit" class="btn btn-primary">
       </td>
     </tr>


     </table>
   </form>
       </div>

     </div>
     <?php include 'inc/footer.php'; ?>
