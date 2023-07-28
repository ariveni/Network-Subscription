<!doctype html>
<?php
    
    include "connection.php";
    session_start();
    $user=$_SESSION['username'];
    if(empty($user))
    {
      header('Location: login.php');
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
.payments{
    width: 800px;
    height: 300px;
    position: relative;
    left: 15%;
}
.chartbox {
    margin: 40px auto;
    background-color: #fff;
    padding: 30px 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
    max-width: 800px;
}

canvas {
    width: 800px;
    max-width: 800px;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.chartjs-render-monitor {
    width: 800px;
    height: 500px;
    border-radius: 10px;
}

.chartjs-tooltip {
    background-color: #333;
    color: #fff;
    border-radius: 5px;
    padding: 5px;
    font-size: 12px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.chartjs-tooltip-key {
    display: inline-block;
    width: 10px;
    height: 10px;
    margin-right: 5px;
}

.chartjs-tooltip-value {
    display: inline-block;
    font-weight: bold;
}

.chartjs-tooltip-label {
    margin-top: 5px;
}

.chartjs-tooltip-body {
    margin-top: 5px;
    font-size: 12px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.chartjs-tooltip-title {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

@media screen and (max-width: 768px) {
    .chartbox {
        margin: 20px;
        padding: 20px;
        max-width: 100%;
    }
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
	              <a href="customers.php?retreive=1">Customers</a>
	          </li>
	          <li>
              <a href="payments.php"  aria-expanded="false" class="dropdown-toggle">Payments</a>
              
	          </li>
	          <li>
              <a href="complaints.php" style="color:black" >Compliants</a>
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
  <div class="payments">
      <canvas id="myChart" class="pmt" ></canvas>
      <?php
        try {
          $stmt = $conn->prepare('SELECT * FROM dailyamount WHERE DATEDIFF(CURRENT_DATE, today_date) <= 30 ORDER BY today_date ASC');
          $stmt->execute();
          if ($stmt->rowCount() > 0) {
            $month = array();
            $amount = array();
            $complaints = array(); // Initialize the $complaints array
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $month[] = $row['today_date'];
              $amount[] = $row['amount'];
              $complaints[] = $row['complaints'];
            }
          } else {
            echo "No records were found";
            exit();
          }
        } catch(PDOException $e) {
          die("ERROR: Could not execute query. " . $e->getMessage());
        }
      ?>
    </div>
  
  <div class="main" >
  
            <table>
                <thead>
                    <th>Username</th>
                    <th>Date</th>
                    <th>Action</th>
                </thead>
                <?php 
                $stmt = $conn->prepare('SELECT user_id,issue_date FROM complaints WHERE admin_id IS NULL ORDER BY issue_date ASC');
                $stmt->execute();
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['user_id'] ?></td>
                        <td><?php echo $row['issue_date']  ?></td>
                        <td>
                            <form action="reply.php" method="POST" >
                                <input type="hidden" name="user" value="<?php echo $row['user_id']?>">
                                <button type="submit" >Reply</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <?php }?>
            </table>

        </div>
    </div>
  </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
const month = <?php echo json_encode($month); ?>;
      const amount = <?php echo json_encode($complaints); ?>;
      const data = {
        labels: month,
        datasets: [{
          label: 'Complaints in Each DAY',
          data: amount,
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }]
      };
      const config = {
        type: 'bar',
        data: data,
        options: {
          scales: {
            x: {
              title: {
                display: true,
                text: 'Month',
                font: {
                  size: 16,
                  weight: 'bold'
                }
              }
            },
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Complaints',
                font: {
                  size: 16,
                  weight: 'bold'
                }
              }
            }
          }
        }
      };
      const ctx = document.getElementById('myChart').getContext('2d');
      const myChart = new Chart(ctx, config);
</script>
</html>