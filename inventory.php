<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right"></br></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar">
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-dashboard fa-fw"></i>  Overview</a>
    <a href="manufacturer.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Add Manufacturer</a>
    <a href="model.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Add Model</a>
    <a href="inventory.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-eye fa-fw"></i>  View Inventory</a>
  </div>
</nav>
<?php
//including the database connection file
include_once("classes/Database.php");

$database = new Database();

//fetching data in descending order (lastest entry first)
$query = "SELECT car_id,manufacturer_name,model_name,total_count
FROM model
INNER JOIN manufacturer
ON model.manufacturer_id = manufacturer.manufacturer_id";
$result = $database->getData($query);
//echo '<pre>'; print_r($result); exit;
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-eye"></i> View Inventory</b></h5>
  </header>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      
      <div class="w3-twothird">
        <h5>Inventory</h5>
        <table id="myform" class="w3-table w3-striped w3-white">
          <tr>
            <td>Sr. No.</i></td>
            <td>Manufacturer Name</td>
            <td><i>Model Name</i></td>
			<td><i>Count</i></td>
			<td><i>Sold Button</i></td>
          </tr>
         <!-- <tr>
            <td>1</i></td>
            <td>Maruti</td>
            <td><i>Namo</i></td>
			<td><i>1</i></td>
			<td><i><button type="reset" value="Reset">Sold</button></i></td>
          </tr>
		  -->
		  <?php 
		  $table_validation_check=0;
		  $count=1;
	foreach ($result as $key => $res) {
	//while($res = mysqli_fetch_array($result)) { 		
	echo "<tr id=".$res['car_id'].">";
		echo "<td>".$count."</td>";
		echo "<td>".$res['manufacturer_name']."</td>";
		echo "<td>".$res['model_name']."</td>";
		echo "<td id='".$res['car_id']."_count' ><i>".$res['total_count']."</i></td>
		<td><i><button type='submit' id='button' onclick='myFunction(".$res['total_count'].",".$res['car_id'].")' value='".$res['car_id']."'>SOLD</button>   </i></td>
		</tr>";
		$count++;
		$table_validation_check=1;
		}
		
	?>
	 </table>
	 <?php
	 if($table_validation_check==0)
		echo "No records found";
	?>
	<script>
	function myFunction(count_val,id_val) {
   // alert(count_val+id_val);
   var copy_count_val=count_val;
	var button=$("#button").val();
				console.log(name);
				console.log(button);
				
				if(count_val>1)
				{
					count_val--;
				document.getElementById(id_val+'_count').innerHTML = count_val;
				}
				else{
					$('#'+button).remove();
				}
				
                $.ajax({
                    url:'delete.php',
                    method:'POST',
                    data:{
                        name:button,
						copy_count_val:copy_count_val,
                    },
                   success:function(data){
                       alert(data);
                   }
                });
	
}
	

    </script>
       
		
 
    
      </div>
    </div>
  </div>
  <hr>


 




  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
