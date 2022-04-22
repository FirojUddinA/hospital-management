<?php
$conn = mysqli_connect('localhost', 'pan', 'pan','hospital');
if (!$conn){
    echo 'connection error' . mysqli_connect_error();
}
$data = $_POST['id'];
$datatime = $_POST['time'];
$db=$conn;
// fetch query
function fetch_data(){
  global $datatime;
  global $db;
    global $data;
  $query="SELECT ap_date,ap_time FROM appointment WHERE ap_date ='". $datatime ."' AND doctor_id ='". $data ."'";
  $exec=mysqli_query($db, $query);
  if(mysqli_num_rows($exec)>0){
    $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
    return $row;  
  }else{
    return $row=[];
  }
}
// fetch query 2
function fetch_data2(){
  global $data;
  global $db;
  $query="SELECT starting_time, end_time FROM doctors WHERE user_id ='". $data ."'";
  $exec=mysqli_query($db, $query);
  // Associative array
  return $row2 = $exec -> fetch_assoc();
}
$fetchData= fetch_data();
$fetchData2= fetch_data2();
show_data($fetchData,$fetchData2);






function getTimeSlot($interval, $start_time, $end_time)
{
    $start = new DateTime($start_time);
    $end = new DateTime($end_time);
    $startTime = $start->format('H:i:s');
    $endTime = $end->format('H:i:s');
    $i=0;
    $time = [];
    while(strtotime($startTime) <= strtotime($endTime)){
        $start = $startTime;
        $end = date('H:i:s',strtotime('+'.$interval.' minutes',strtotime($startTime)));
        $startTime = date('H:i:s',strtotime('+'.$interval.' minutes',strtotime($startTime)));
        $i++;
        if(strtotime($startTime) <= strtotime($endTime)){
            $time[$i]['slot_start_time'] = $start;
            $time[$i]['slot_end_time'] = $end;
        }
    }
    return $time;
}





function show_data($fetchData,$fetchData2){
    echo '
    <select class="form-control" id="time" name="ap_time">
        <option>Select time</option>';
        $slots = getTimeSlot(15, $fetchData2['starting_time'], $fetchData2['end_time']);

        if(count($fetchData) >= count($slots)){
          echo '<option value="">No slot available</option>';
        }
        echo count($slots);

        foreach($slots as $slot){
          $write = 1;
          if(count($fetchData)>0){
            $sn=1;
              foreach($fetchData as $data){ 
                if($slot['slot_start_time'] == $data['ap_time']){
                  $write = 2;
                }
                  $sn++; 
              }
          }
          if($write == 1){
            echo '<option value="'. $slot['slot_start_time'] .'">'. $slot['slot_start_time'] .'</option>';
          }
        }
    echo '</select>';
   }
?>