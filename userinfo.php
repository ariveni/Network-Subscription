<!doctype html>
<?php
    include "connection.php";
    session_start();
    $user=$_SESSION['username'];
    if(empty($user))
    {
      header('Location: login.php');
    }
    if($_SERVER['REQUEST_METHOD']== 'POST')
    {
        $user=$_POST['User'];
    }
    else{
        $user=$_GET['user'];
    }
    ?>
<html lang="en">
  <head>
  <link
  rel="icon"
  type="image/png"
  href="favicon.png"/>
  <meta charset="UTF-8">
  <title>Network Subscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<style>
			/* Style for the search form */
.search {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.search_form {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #fff;
  padding: 10px;
  border-radius: 25px;
  box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
}

.search_form input[type="text"] {
  padding: 1px;
  border-radius: 25px;
  border: none;
  outline: none;
  font-size: 16px;
  width: 150px;
  margin-right: 10px;
  color: #3F51B5;
}

.search_form button[type="submit"] {
  padding: 10px 20px;
  background-color: #3F51B5;
  border: none;
  border-radius: 25px;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

.search_form button[type="submit"]:hover {
  background-color: #1A237E;
}

#suggestions {
    position: absolute;
    top: 500px;
    left: 0;
    z-index: 999;
    background-color: transparent;
    border: 1px solid #ccc;
    border-top: none;
    max-height: 200px;
    overflow-y: auto;
    width: 100%;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    text-align: center;
    color: #fff;
}

#suggestions ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

#suggestions li {
    padding: 10px;
    cursor: pointer;
}

#suggestions li:hover {
    background-color: #3F51B5;
}
td {
  text-align: center;
}
.tbl{
    align-content: center;
 
    margin: 40px auto;
    margin-top: 0px;
        background-color: #fff;
        padding: 30px 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        max-width: 800px;
    
}
.user_table {
    position: relative;
    left: 15%;
  width: 65%;
  border-collapse: collapse;
  border-spacing: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
  padding: 30px 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
}

th {
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  background-color: #f5f5f5;
  color: #444;
  text-align: left;
  font-size: 14px;
  font-weight: bold;
  text-transform: uppercase;
  padding: 12px;
  border-bottom: 2px solid #ddd;
}

td {
  font-size: 14px;
  padding: 10px 12px;
  border-bottom: 1px solid #ddd;
}

button {
  background-color: #6f42c1;
  color: white;
  border: none;
  padding: 8px 16px;
  font-size: 14px;
  cursor: pointer;
  border-radius: 4px;
}

button:hover {
  background-color: #16a085;
}

#pass {
  display: none;
  padding: 8px;
  margin-top: 8px;
  background-color: #f5f5f5;
  border-radius: 4px;
  border: 1px solid #ddd;
  font-size: 14px;
  line-height: 1.5;
}
		</style>
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
		  		<h1><a href="index.html" class="logo">NETWORK</a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="adminhome.php"  aria-expanded="false" class="dropdown-toggle">Dashboard</a>
	            
	          </li>
	          <li>
	              <a href="customers.php?retreive=1" style="color:black">Customers</a>
	          </li>
	          <li>
              <a href="payments.php"  aria-expanded="false" class="dropdown-toggle">Payments</a>
              
	          </li>
	          <li>
              <a href="complaints.php" >Compliants</a>
	          </li>
	          <li>
              <a href="#">Purchases</a>
	          </li>
            <li>
              <a href="logout.php?user=2">Logout</a>
	          </li>
	        </ul>

	        <div class="mb-5">
          <div class="search">
            <form class="search_form" action="userinfo.php" method="POST">
              
            <input type="text" id="searchInput" name="User" required placeholder="Username">
            <button type="submit">🔍</button></br>
            <div id="suggestions"></div>
               

                
            </form>
            

        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">
  <div class="tbl" >
  <?php
        $stmt=$conn->prepare('select * from customers where Username=:username');
        $stmt->bindParam(':username',$user);
        $stmt->execute();
        if($stmt->rowCount()>0)
        {
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        ?>
          <form action="reply.php" method="POST" >
            <input type="hidden" name="user" value="<?php echo $user ?>" >
            <button type="submit" > 🗣️</button>
          </form>
        <table class="user_table" >
            <tr>
                <th>UserName</th>
                <?php $_SESSION['customer']=$row['Username'];?>
                <td><?php echo $row['Username'];  ?></td>
            </tr>
            <tr>    
                <th>Password</th>
                <td>
                    <button onclick="show('<?php echo $row['Password']; ?>')">Password</button>
                    <div id="pass"></div>
                </td>
            </tr>
            <tr>    
                <th>Name</th>
                <td><?php echo $row['Name'];?></td>
                
            </tr>
            <tr>    
                <th>Mobile</th>
                <td><?php echo $row['Phone'];?></td>
                
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $row['Email'];?></td>
                
            </tr>
            <tr>    
                <th>Billing Address</th>
                <td><?php echo $row['BillingAddress'];?></td>
                
            </tr>    
            <tr>    
                <th>Registration Date</th>
                <td><?php echo $row['DateAdded'];?></td>
                
            </tr> 
            <tr>    
                <th>Purpose</th>
                <td><?php echo $row['Type'];?></td>
                
            </tr> 
            <tr>    
                <th>Package Name</th>
                <td><?php echo $row['PackageName'];?></td>
                
            </tr> 
            <tr>    
                <th>Expiry</th>
                <td><?php echo $row['Expiry'];?></td>
                
            </tr> 
            <tr>    
                <th>Last Renewal</th>
                <td><?php echo $row['Renewal'];?></td>
                
            </tr> 
            <tr>    
                <th>Status</th>
                <td><?php echo $row['Status'];?>
                <?php if($row['Status']!='active')
                {?>
                <a href="statuschange.php?text=1"><button onclick="return activate('activate')">Activate</button></a>

                <?php } else{?>
                    
                  <a href="statuschange.php?text=2"><button onclick="return activate('deactivate')">Deactivate</button></a>
                    <?php }?>
            </td>
                
                
            </tr> 
            <tr>    
                <th>IP</th>
                <?php if($row['Status']=='active')
                {?>
                <td><?php echo $row['IP'];?></td>
                <?php }?>
            </tr>
        </table>
        <?php }
        else{
          header('Location: adminhome.php');
        }
        ?>
        </div>    
    </div>
  </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    
  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
  $('#searchInput').on('input', function() {
    var query = $(this).val();
    $.ajax({
      url: 'search.php',
      type: 'GET',
      data: {query: query},
      dataType: 'json',
      success: function(data) {
        var suggestionsHtml = '';
        data.forEach(function(suggestion) {
          suggestionsHtml += '<div class="suggestion">' + suggestion + '</div>';
        });
        $('#suggestions').html(suggestionsHtml);

        // Fill search input with suggestion on click
        $('.suggestion').click(function() {
          var suggestion = $(this).text();
          $('#searchInput').val(suggestion);
          $('#suggestions').html('');
        });
      }
    });
  });
});
function show(password) {
        const dataDiv = document.getElementById("pass");
        if (dataDiv.style.display === "none") {
            dataDiv.innerText = password;
            dataDiv.style.display = "block";
            setTimeout(function() {
                dataDiv.style.display = "none";
            }, 5000); // Change 5000 to the number of milliseconds you want the div to be visible
        } else {
            dataDiv.style.display = "none";
        }
    }
function activate(msg) {
    var message = "Do you want to " + msg + " the user?";
    // Display a confirmation dialog to the user
    return confirm(message);
}
</script>
</html>