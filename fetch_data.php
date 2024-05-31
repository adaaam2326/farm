<?php
// Include the connection file
include('connection.php');

// Initialize an output array
$output= array();

// Define the SQL query to fetch all records from the 'stock' table
$sql = "SELECT * FROM stock ";

// Execute the query and store the result in a variable
$totalQuery = mysqli_query($con,$sql);

// Get the total number of rows from the query result
$total_all_rows = mysqli_num_rows($totalQuery);

// Define an array of column names
$columns = array(
	0 => 'id',
	1 => 'source',
	2 => 'prix',
	3 => 'QTE_dispo',
);

// Check if a search value is set in the POST request
if(isset($_POST['search']['value']))
{
	// Get the search value and add it to the SQL query with LIKE clauses for each column
	$search_value = $_POST['search']['value'];
	$sql.= " WHERE source like '%".$search_value."%'";
	$sql.= " OR prix like '%".$search_value."%'";
	$sql.= " OR QTE_dispo like '%".$search_value."%'";
}

// Check if an order is set in the POST request
if(isset($_POST['order']))
{
	// Get the column name and order direction from the POST request
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	
	// Add the ORDER BY clause to the SQL query using the specified column and order direction
	$sql.= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	// If no order is specified, order by id in descending order
	$sql.= " ORDER BY id desc";
}

// Check if a length is set in the POST request
if($_POST['length']!= -1)
{
	// Get the start and length values from the POST request
	$start = $_POST['start'];
	$length = $_POST['length'];
	
	// Add the LIMIT clause to the SQL query using the specified start and length values
	$sql.= " LIMIT  ".$start.", ".$length;
}	

// Execute the final SQL query
$query = mysqli_query($con,$sql);

// Get the number of rows returned by the query
$count_rows = mysqli_num_rows($query);

// Initialize an empty data array
$data = array();

// Loop through each row in the query result
while($row = mysqli_fetch_assoc($query))
{
	// Initialize an empty sub-array for each row
	$sub_array = array();
	
	// Add the id, source, prix, and QTE_dispo values to the sub-array
	$sub_array[] = $row['id'];
	$sub_array[] = $row['source'];
	$sub_array[] = $row['prix'];
	$sub_array[] = $row['QTE_dispo'];
	
	// Add edit and delete buttons to the sub-array
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	
	// Add the sub-array to the data array
	$data[] = $sub_array;
}

// Set the output array with the draw, recordsTotal, recordsFiltered, and data values
$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);

// Encode the output array as JSON and echo it
echo  json_encode($output);
?>