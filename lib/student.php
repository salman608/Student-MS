<?php
$filepath=realpath(dirname(__FILE__));
include_once($filepath.'/database.php');
 ?>
<?php
/**
 * student
 */
class Student
{
  private $db;

public function __construct()
  {
  $this->db=new database();
  }
  public function getStudent(){
    $query="SELECT * FROM tbl_stu";
    $result=$this->db->select($query);
    return $result;
  }

  public function insertStudent($name,$roll){
    $name=mysqli_real_escape_string($this->db->link,$name);
    $roll=mysqli_real_escape_string($this->db->link,$roll);
    if(empty($name) || empty($roll)){
      $msg= '<div class="alert alert-danger"><strong>ERROR!</strong>Field Muat not be empty!!</div>';
      return $msg;
    }else{
      $stu_query="INSERT INTO tbl_stu(name,roll) VALUES('$name','$roll')";
      $stu_insert=$this->db->insert($stu_query);

      $stu_query="INSERT INTO tbl_attend(roll) VALUES('$roll')";
      $stu_insert=$this->db->insert($stu_query);

      if($stu_insert){
        $msg= '<div class="alert alert-success"><strong>SUCCESS!</strong>Student Data Insert successfully!!</div>';
        return $msg;
      }else{
        $msg= '<div class="alert alert-danger"><strong>ERROR!</strong>Student not insert!!</div>';
        return $msg;
      }
    }
  }

  public function insertAttendance($cur_date ,$attend = array()){
    $query="SELECT DISTINCT attend_time FROM tbl_attend ";
    $getdata=$this->db->select($query);
    while($result=$getdata->fetch_assoc()){
      $db_data=$result['attend_time'];
      if($cur_date==$db_data){
          $msg= '<div class="alert alert-danger"><strong>ATTENDANCE!</strong>Already Taken!!</div>';
          return $msg;

      }
    }

    foreach ($attend as $atn_key => $atn_value){
      if($atn_value=="Present"){
        $stu_query="INSERT INTO tbl_attend(roll,attend,attend_time) VALUES('$atn_key','Present',now())";
        $data_insert=$this->db->insert($stu_query);
      }elseif($atn_value=="Absent"){
        $stu_query="INSERT INTO tbl_attend(roll,attend,attend_time) VALUES('$atn_key','Absent',now())";
        $data_insert=$this->db->insert($stu_query);
      }
    }


        if($data_insert){
          $msg= '<div class="alert alert-success"><strong>SUCCESS!</strong>Student Attendence Insert successfully!!</div>';
          return $msg;
        }else{
          $msg= '<div class="alert alert-danger"><strong>ERROR!</strong>Student ATTENDANCE not insert!!</div>';
          return $msg;
        }
  }

public function getDateList(){
  $query="SELECT DISTINCT attend_time FROM tbl_attend ";
  $getresult=$this->db->select($query);
  return $getresult;
}

public function getStuData($dt){
  $query="SELECT tbl_stu.name, tbl_attend.*
  FROM tbl_stu
  INNER JOIN tbl_attend
  ON tbl_stu.roll=tbl_attend.roll
  WHERE attend_time='$dt' ";
  $getresult=$this->db->select($query);
  return $getresult;
}

public function updateAttendance($dt,$attend){

  foreach ($attend as $atn_key => $atn_value){
    if($atn_value=="Present"){
       $query="UPDATE tbl_attend
       SET attend='Present'
       WHERE roll='".$atn_key."' AND attend_time ='".$dt."' ";
       $data_update=$this->db->update($query);

    }elseif($atn_value=="Absent"){
      $query="UPDATE tbl_attend
      SET attend='Absent'
      WHERE roll='".$atn_key."' AND attend_time ='".$dt."' ";
      $data_update=$this->db->update($query);

    }
  }


      if($data_update){
        $msg= '<div class="alert alert-success"><strong>SUCCESS!</strong>Student Attendence Updated successfully!!</div>';
        return $msg;
      }else{
        $msg= '<div class="alert alert-danger"><strong>ERROR!</strong>Student ATTENDANCE not Updated!!</div>';
        return $msg;
      }
}






}


 ?>
