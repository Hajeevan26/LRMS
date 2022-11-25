<?php

//fetch.php

include('connection/config.php');

$column = array('ID', 'Department', 'Equipment & Instruments', 'From', 'To', 'Status');

//$query = "SELECT * FROM tbl_reservation ";
$query="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i ";

if(isset($_POST['search']['value']))
{
 $query .= '
 WHERE r.res_id LIKE "%'.$_POST['search']['value'].'%" 
 OR d.d_name LIKE "%'.$_POST['search']['value'].'%" 
 OR i.i_name LIKE "%'.$_POST['search']['value'].'%" 
 OR f.f_name LIKE "%'.$_POST['search']['value'].'%" 
 OR r.r_from LIKE "%'.$_POST['search']['value'].'%" 
 OR r.r_to LIKE "%'.$_POST['search']['value'].'%" 
 ';
}

if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY r.res_id DESC ';
}

$query1 = '';

if($_POST['length'] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['res_id'];
 $sub_array[] = $row['d_name'];
 $sub_array[] = $row['i_name'];
 $sub_array[] = $row['f_name'];
 $sub_array[] = $row['r_from'];
 $sub_array[] = $row['r_to'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM tbl_reservation";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'    => intval($_POST['draw']),
 'recordsTotal'  => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'    => $data
);

echo json_encode($output);

?>
