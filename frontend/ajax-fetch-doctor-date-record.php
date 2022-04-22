<?php
$conn = mysqli_connect('localhost', 'pan', 'pan','hospital');
if (!$conn){
    echo 'connection error' . mysqli_connect_error();
}
$data = $_POST['id'];
$db=$conn;
// fetch query
function fetch_data(){
  global $data;
  global $db;
  $query="SELECT off_day FROM doctors WHERE user_id ='". $data ."'";
  $exec=mysqli_query($db, $query);
  if(mysqli_num_rows($exec)>0){
    $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
    return $row;  
        
  }else{
    return $row=[];
  }
}
$fetchData= fetch_data();
show_data($fetchData);


function show_data($fetchData){
  $Date = date('Y-m-d');
  // echo date('Y-m-d', strtotime($Date. ' + 1 days'));

    echo '
    <select class="form-control" id="date" name="ap_date">
        <option>Select date</option>';
        foreach($fetchData as $data){ 
          if(strtolower(date("l")) != strtolower($data['off_day'])){
            echo '<option value="'.$Date.'">'.$Date.'</option>';
          }
        }
        foreach($fetchData as $data){ 
          if(strtolower(date("l",strtotime($Date. ' + 1 days'))) != strtolower($data['off_day'])){
            echo '<option value="'.date('Y-m-d',strtotime($Date. ' + 1 days')).'">'.date('Y-m-d',strtotime($Date. ' + 1 days')).'</option>';
          }
        }
        foreach($fetchData as $data){ 
          if(strtolower(date("l",strtotime($Date. ' + 2 days'))) != strtolower($data['off_day'])){
            echo '<option value="'.date('Y-m-d',strtotime($Date. ' + 2 days')).'">'.date('Y-m-d',strtotime($Date. ' + 2 days')).'</option>';
          }
        }
        foreach($fetchData as $data){ 
          if(strtolower(date("l",strtotime($Date. ' + 3 days'))) != strtolower($data['off_day'])){
            echo '<option value="'.date('Y-m-d',strtotime($Date. ' + 3 days')).'">'.date('Y-m-d',strtotime($Date. ' + 3 days')).'</option>';
          }
        }
        foreach($fetchData as $data){ 
          if(strtolower(date("l",strtotime($Date. ' + 4 days'))) != strtolower($data['off_day'])){
            echo '<option value="'.date('Y-m-d',strtotime($Date. ' + 4 days')).'">'.date('Y-m-d',strtotime($Date. ' + 4 days')).'</option>';
          }
        }
        foreach($fetchData as $data){ 
          if(strtolower(date("l",strtotime($Date. ' + 5 days'))) != strtolower($data['off_day'])){
            echo '<option value="'.date('Y-m-d',strtotime($Date. ' + 5 days')).'">'.date('Y-m-d',strtotime($Date. ' + 5 days')).'</option>';
          }
        }
        foreach($fetchData as $data){ 
          if(strtolower(date("l",strtotime($Date. ' + 6 days'))) != strtolower($data['off_day'])){
            echo '<option value="'.date('Y-m-d',strtotime($Date. ' + 6 days')).'">'.date('Y-m-d',strtotime($Date. ' + 6 days')).'</option>';
          }
        }
    echo '</select>';
   }
?>