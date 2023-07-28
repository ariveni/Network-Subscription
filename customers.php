<!doctype html>
<?php
    include 'connection.php';
    session_start();
    $user=$_SESSION['username'];
    if(empty($user))
    {
      header('Location: index.php');
    }
    $cust=$_GET['retreive'];
    
    if($cust==1)
    {
      $stmt = $conn->prepare('SELECT * FROM customers');
      $stmt->execute();
    }
    else{
      $stmt = $conn->prepare('SELECT * FROM customers where Status=:cust or PackagePrice=:cust ');
      $stmt->bindParam(':cust', $cust);
      $stmt->execute();
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
.list {
    position: relative;
    top: -100px;
  padding: 20px;
}

.tbl {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  position: relative;
  top: 20px;
}

.tbl thead {
  background-color: #6f42c1;
  color: #fff;
}

.tbl th,
.tbl td {
  padding: 12px 15px;
  text-align: center;
  color: black;
}

tr:hover {background-color: #E7DDDC;}
		</style>
  </head>
  <body >
		
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
	              <a href="customers.php?retreive=1" style="color:black" >Customers</a>
	          </li>
	          <li>
              <a href="payments.php"  aria-expanded="false" class="dropdown-toggle">Payments</a>
              
	          </li>
	          <li>
              <a href="complaints.php">Compliants</a>
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
        <div class="list">
        
        <table class="tbl">
    <thead>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>PackageName</th>
            <th>Expiry</th>
            <th>Status</th>
            <th>IP</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
                
            <td><a href="userinfo.php?user=<?php echo $row['Username']; ?>" ><?php echo $row['Username']; ?></a></td>
            <td><?php echo $row['Name']?></td>
            <td><?php echo $row['PackageName']?></td>

            <td><?php echo $row['Expiry']?></td>
            
            <?php
                if($row['Status']=="active")
                {
            ?>
                <td style="color: #32CD30;"><?php echo $row['Status']?></td>
                <td><?php echo $row['IP']?></td>

                <?php } 
               else if($row['Status']=='suspended') {
                # code...
                ?>
                <td style="color: #ff0022;"><?php echo $row['Status']?></td>
                <?php
               }
              else{
            ?>
            <td style="color: #f26430;"><?php echo $row['Status']?></td>;
        </tr>
        <?php }
      } ?>
    </tbody>
</table>

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

function changeURL() {
        if (typeof (history.pushState) != "undefined") {
        var url="customerpage"
        history.pushState(null, "", url);
    } else {
        alert("Browser does not support HTML5.");
    }
  }
</script>
</html>