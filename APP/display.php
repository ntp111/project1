
<?php
$mng = new MongoDB\Driver\Manager("mongodb+srv://admin:admin@cluster0-xkizr.mongodb.net/test?retryWrites=true&w=majority");
					$listdatabases = new MongoDB\Driver\Command(["listDatabases" => 1]);
					$res = $mng->executeCommand("admin", $listdatabases);
					$query = new MongoDB\Driver\Query([]); 

					$rows = $mng->executeQuery("aids.input_videos", $query);
?>

<?php 

$output = shell_exec("");
echo "$output";

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css">
<?php include 'css.css'; ?>
	th, td {
  	padding: 4px;
  	text-align: center;
  	border-bottom: 1px solid #ddd;
	}

	tr:hover {background-color:#9a9fa6;}
	th:hover {color:black;}

	a:hover{
		color: black;
		
	}
</style>
</head>
<body>
<div class="container">
	<div class="row">
    	<div class="column" style=" width: 20%; background-color: white; margin-left: 10px;">
  			<input class="form-control" type="text" placeholder="Search File" aria-label="Search File">
  			<br><br>			  	
			       <div style="width:95%; height:420px; overflow:auto; background-color: #323740">
				        <table style="border-collapse: collapse; width: 96%;">
				           	<?php
				           		echo ' 
				           			<tr style="color:white;background-color:#323740">
				            			<th>Name</th>
				            			<th>FPS</th>
				            			<th>Duration</th>
				         			</tr>';
								foreach ($rows as $row) {
									echo '
						                <tr class="clickable-row" href="'.$row->VidID.'" style="color: white">
						                    <th style="text-align:left;"><a href="'.$row->VidID.'" style =" color: white;">'.$row->Name.'</a></th>
						                    <th><a href="'.$row->VidID.'" style ="color: white; text-decoration:none">'.$row->FPS.'</a></th>
						                    <th><a href="'.$row->VidID.'" style ="color: white; text-decoration:none">'.$row->Duration.'</a></th>
						                </tr>
						            '; 
									}
							?>
				        </table>  
			       </div>
    	</div>
    	<div class="column" style=" width: 46%; background-color: white;">
      	
		  	<div class="center-container" style="margin-top: 5px;">
	 		 	<div class="center">
	 		 		<div style=>
	      				<iframe id="view" src="" style="display: inline-block; width: 100%; max-height: 500px; height: 400px; "></iframe>
	    			</div><br>
	 		 		<div class="col-sm" style=" float: left; color: white; background-color: black">00:00:10:20 </div>
		      		<div class="col-sm" style=" float: right; color: white; background-color: black">00:00:50:20</div>
	 		 	</div>
			</div>
    	</div>
    	<div class="column" style=" width: 30%; background-color: white;">
     		 <h3>Suggested Stock Videos</h3>
    	</div>
	</div>
</div>


<div class="center-container" style="background-color: gray; padding: 5px; height: 300px; width: 78vw">
		<div class="small-container">
			<div class="col" style="margin-left: 40px;">
				<h3>Object List</h3>

			</div>

			<div class="col">
				<h3>Character List</h3>
			</div>

			<div class="col">
				<h3>Image Analysis</h3>
			</div>

			<div class="col">
				<h3>Sound Analysis</h3>
			</div>

			<div class="col">
				<h3>Other Information</h3>
			</div>
		</div>
</div>
</div>
<script>


//function to get url when click
 jQuery(document).ready(function(){
       jQuery('.clickable-row').click(function( e ){
      e.preventDefault();
         
         var videoID= jQuery(this).attr('href');
         var preview= "https://drive.google.com/file/d/" + videoID + "/preview"
         document.getElementById("view").src = preview;
    });


})



 
</script>
</body>
</html>



