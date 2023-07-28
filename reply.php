<!doctype html>
<?php
    
    include "connection.php";
    session_start();
    $user=$_SESSION['username'];
    if(empty($user))
    {
      header('Location: login.php');
    }
    require 'vendor/autoload.php';
    use Twilio\Rest\Client;
    
    // Your Account SID and Auth Token from twilio.com/console
    // To set up environmental variables, see http://twil.io/secure
    $account_sid = 'AC60df12d0cc71a3ea9f4e01fa0a666a47';
    $auth_token = '79a98e2d2270acaf1b3f0aa58a2d3d74';
    // In production, these should be environment variables. E.g.:
    // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
    
    // A Twilio number you own with SMS capabilities
    $twilio_number = "+1 475 255 2697";
    
    
    $client = new Client($account_sid, $auth_token);
    if(!empty($_POST['reply']))
    {
        $msg=$_POST['reply'];
        $cst=$_POST['cust'];
        $id=$_POST['id'];
        $stmt=$conn->prepare('Update complaints set reply=:msg,admin_id="manikanta440" where user_id=:user and ID=:id');
        $stmt->bindParam(':msg',$msg);
        $stmt->bindParam(':user',$cst);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $stmt=$conn->prepare('SELECT Phone from customers where Username=:user');
        $stmt->bindParam(':user',$cst);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $send='You have received a reply for your compiant';
        $client->messages->create(
          // Where to send a text message (your cell phone?)
          '+91'.$row['Phone'],
          array(
              'from' => $twilio_number,
              'body' => $send,
          )
      );
        header('Location: complaints.php');
    }
    $cust=$_POST['user'];
   
    $stmt=$conn->prepare('SELECT * from complaints where user_id=:cust and DATEDIFF(CURRENT_DATE, issue_date) <= 5 ORDER BY issue_date ASC');
    $stmt->bindParam(':cust',$cust);
    $stmt->execute();
    ?>
<html lang="en">
  <head>
  <link
  rel="icon"
  type="image/png"
  href="favicon.png"/>
  <meta charset="UTF-8">
  <title>Network Subscription</title>
  <meta charset="UTF-8">
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
.main {
  padding: 20px;
}
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
  color: black;
}

th, td {
  text-align: left;
  padding: 8px;
  border: 1px solid #ddd;
}

th {
  background-color: #6f42c1;
  font-weight: bold;
}

tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

button {
  display: inline-block;
  background-color: transparent;
  color: #6f42c1;
  border: none;
  padding: 8px;
  cursor: pointer;
  border-radius: 4px;
  margin-right: 10px;
}

button:last-child {
  margin-right: 0;
}



button:active {
  background-color: #6f42c1;
  transform: translateY(1px);
}


tr:hover {background-color: #E7DDDC;}
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
		  		<h1><a href="index.php" class="logo">NETWORK</a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="adminhome.php"  aria-expanded="false" class="dropdown-toggle">Dashboard</a>
	            
	          </li>
	          <li>
	              <a href="customers.php?retreive=1">Customers</a>
	          </li>
	          <li>
              <a href="payments.php"  aria-expanded="false" class="dropdown-toggle">Payments</a>
              
	          </li>
	          <li>
              <a href="complaints.php" style="color:black">Compliants</a>
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
  <div class="main" >
            
            <table>
                <thead>
                    <th>Username</th>
                    <th>Speed</th>
                    <th>Date</th>
                    <th>Issue</th>
                    <th>Reply Given</th>
                </thead>
                <?php 
    
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['user_id']  ?></td>
                        <td><?php echo $row['speed']?></td>
                        <td><?php echo $row['issue_date'] ?></td>
                        <td><?php echo $row['issue'] ?></td>
                        <?php 
                        if($row['reply']!=NULL)
                        {
                        ?>
                        <td><?php echo $row['reply'] ?></td>
                        <?php }
                        else{
                        ?>
                        <td>
                            <form action="reply.php" method="POST" >
                                <input type="text" name="reply" placeholder="reply" >
                                <input type="hidden" name="cust" value="<?php echo $row['user_id']?>">
                                <input type="hidden" name="id" value="<?php echo $row['ID']?>" >
                                <button type="submit">send</button>
                            </form>
                        </td>
                        <?php } ?>
                    </tr>
                </tbody>
                <?php } ?>
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

</script>
</html>