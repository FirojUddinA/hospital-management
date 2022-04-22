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
  $query="SELECT dl.f_name, dl.l_name, d.user_id FROM details dl, doctors d WHERE dl.user_id = d.user_id AND d.specialist_at = '". $data ."'";
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
    echo '
    <select class="form-control" id="doctors" name="doctor_id">
        <option>Doctor</option>';
        if(count($fetchData)>0){
            $sn=1;
            foreach($fetchData as $data){ 
                echo '<option value="'.$data['user_id'].'">'.$data['f_name'].' '.$data['l_name'].'</option>';
                $sn++; 
            }
        }
    echo '</select>';
   }
?>