<?php
include 'inc/header.php';
 include 'lib/student.php';
 ?>


     <div class="panel panel-default">
       <div class="panel-heading">
         <h3 class="panel-title">
           <a class="btn btn-success"href="add.php" style="color:white;">Add student</a>
           <a style="color:white;"class="btn btn-info pull-right"href="index.php" >Take Attendance</a>
         </h3>
       </div>

       <div class="panel-body">

         <div class="well text-center" style="font-size:20px;">
            <strong>Date:</strong><?php echo  $cur_date=date('Y-m-d');?>
         </div>
   <form class="" action="" method="post">
     <table class="table table-striped">
       <tr>
         <th width="30%">Serial</th>
         <th width="50%">Attendance Date</th>
         <th width="20%">Action</th>

       </tr>

       <?php
       $stu=new student();
           $get_date=$stu->getDateList();
           if($get_date){
             $i=0;
             while($stu=$get_date->fetch_assoc()){
               $i++;

        ?>

       <tr>
         <td><?php echo $i; ?></td>
         <td><?php echo $stu['attend_time']; ?></td>

         <td>
           <a class="btn btn-warning" href="student_view.php?dt=<?php echo $stu['attend_time']; ?>">View</a>
         </td>
       </tr>
     <?php }} ?>
     <tr>
       <td colspan="4">
         <input class="btn btn-primary"type="submit" name="submit" value="Add Student">
       </td>
     </tr>


     </table>
   </form>
       </div>

     </div>
     <?php include 'inc/footer.php'; ?>
