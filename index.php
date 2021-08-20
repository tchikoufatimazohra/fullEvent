<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

#myInputa {
  
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}
</style>
</head>
<body>


<?php
    //connect to mysql db
    //$con = mysql_connect("username","password","") or die('Could not connect: ' . mysql_error());
	 include_once("cnx.php");
    //connect to the employee database
    mysql_select_db("eventfulla", $con);

    //read the json file contents
    $jsondata = file_get_contents('eventfull.json');
    
    //convert json object to php associative array
    $data = json_decode($jsondata, true);
    
    //get the employee details
    $id = $data['participation_id'];
    $name = $data['employee_name'];
    $mail = $data['employee_mail'];
    $eventid = $data['event_id'];
    $eventname = $data['event_name'];
    $participationfee = $data['participation_fee'];
    $eventdate = $data['event_date'];
   
    $version = $data['version'];
    
    //insert into mysql table
	// we insert the first row in the first table " Participation"
    $sql = "INSERT INTO participations(id, participationfee, version)
    VALUES('$id', '$participationfee', '$version')";
    if(!mysql_query($sql,$con))
    {
        die('Error : ' . mysql_error());
    }
	
	//we insert the second info of json file into Events table
	 $sql = "INSERT INTO events(eventid, eventname, eventdate)
    VALUES('$eventid', '$eventname', '$eventdate')";
    if(!mysql_query($sql,$con))
    {
        die('Error : ' . mysql_error());
    }

	//we insert the last info of json file into "Employees" table
	 $sql = "INSERT INTO employees(name, mail)
    VALUES('$name', '$mail')";
    if(!mysql_query($sql,$con))
    {
        die('Error : ' . mysql_error());
    }
	
?>


<h2>My Search</h2>

<input type="text" id="myInputa" onkeyup="myFunctiona()" placeholder="Search for employee name.." title="Type in a  employee name">

<ul id="myULa">
  <li><a href="#">Reto Fanzen</a></li>
  <li><a href="#">Leandro Bußmann</a></li>

  
</ul>


<script>
function myFunctiona() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInputa");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myULa");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>




<input type="text" id="myInputb" onkeyup="myFunctionb()" placeholder="Search for event name.." title="Type in a  event name">

<ul id="myULb">
  <li><a href="#">International PHP Conference</a></li>
  <li><a href="#">PHP 7 crash course</a></li>

  
</ul>


<script>
function myFunctionb() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInputb");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myULb");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>








<input type="text" id="myInputc" onkeyup="myFunctionc()" placeholder="Search date.." title="Type in a event date">

<ul id="myULc">
  <li><a href="#">2019-10-21 08:00:00</a></li>
  <li><a href="#">PHP 7 crash course</a></li>

  
</ul>


<script>
function myFunctionc() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInputc");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myULc");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>





<!--Create a simple page with filters for the employee name, event name and date-->
 <h2>table of filtered results</h2>
 <!-- <meta charset="utf-8">-->
 
 
 
 <table>
		  
             <thead>
                    <tr>
                      <th style="width:5%">Name</th>
                      <th style="width:5%">EventName</th>
                      <th style="width:5%">Date</th>
					  
                      
                    </tr>
                  </thead>
                 
                  <tbody>
				  
				  <!--tab begin2-->
		     <?php
               //la connexion
              include_once("cnx.php");
            //lancement de la rqt
            $sql="SELECT name, eventname, eventdate FROM employees, events ORDER BY name";
   
          
            $req = mysqli_query($conn,$sql);

          //select DB
           mysqli_select_db($conn, "eventfull");
         
          while ($data = mysqli_fetch_array($req)) {
   
         
         echo"<table width=100% border=0 >";
         echo "<tr height=20px bgcolor=#E8E8E8 border-bottom=0px solid #E8E8E8>";
         echo "<td width=5%>".$data['name']."</td>
	     <td width=2% border-bottom=1px solid #CC0066>".$data['eventname']."</td>
		  
		  <td width=2% border-bottom=1px solid #CC0066>".$data['eventdate']."</td>";
      
         echo "</tr>";
         echo"</table>";	
   
   
   
} 
     //
   
     //end of table

 

?>
				  
				  </tbody>
				  </table>
		   

		   
 <!-- add a last row for the total price of all filtered entries-->
 
 <?php
     include_once("cnx.php");
	 SELECT COUNT(idp) AS NumberOfParticipations FROM participations;
	  SELECT COUNT(idev) AS NumberOfEvents FROM events;
	   SELECT COUNT(idemp) AS NumberOfEmployees FROM employees;
	 
 
 ?>
 
</body>
</html>
