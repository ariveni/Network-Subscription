<!doctype html>
<?php
    include 'connection.php';
    session_start();
    $user=$_SESSION['username'];
    if(empty($user))
    {
      header('Location: index.php');
    }
    $stmt=$conn->prepare('select * from dailyamount where today_date=CURRENT_DATE');
    $stmt->execute();
    if($stmt->rowCount()==0){
      $stmt=$conn->prepare('insert into dailyamount(today_date,amount,complaints) values(CURRENT_DATE,0,0)');
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
  
}

.search_form {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #fff;
  padding: 10px;
  border-radius: 10px;
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
    top: 600px;
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
/* Define styles for the dashboard container */
.dashboard {
  width: 100%;
  position: relative;
  top: 10%;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #f5f5f5;
}

/* Define styles for the widget container */
.widget {
  width: 10%;
  min-width: 150px;
  height: 200px;
  margin-bottom: 20px;
  padding: 20px;
  text-align: center;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

/* Define styles for the widget header */
.widget h3 {
  margin-top: 0;
  margin-bottom: 10px;
  font-size: 1.2rem;
  font-weight: bold;
}

/* Define styles for the widget content */
.widget p {
  margin: 0;
  font-size: 2rem;
  font-weight: bold;
  color: #333;
}


#w_t{
  background-color: #800080;
}
#w_a{
  background-color: #00FF00;
}
#w_s{
  background-color: #FF0000;
}
#w_e{
  background-color: #FF4500;
}
#w_sl{
  background-color: #CD853F;
  
}
#w_b{
  background-color: #C0C0C0;
}
#w_g{
  background-color: #DAA520 ;
}
a{
  color: black;
  text-decoration: none;
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
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.chartjs-render-monitor {
    width: 100%;
    height: 100%;
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
.pmt{
  width: 145%;
}
.cmp{
  width: 145%;
}
img{
 
  
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
		  		<h1><a href="adminhome.php" class="logo"><img src="logop.png" alt=""></a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="adminhome.php"  aria-expanded="false" class="dropdown-toggle" style="color:black" >Dashboard</a>
	            
	          </li>
	          <li>
	              <a href="customers.php?retreive=1">Customers</a>
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
    <div class="dashboard">
        <div class="widget" id="w_t">
        <a href="customers.php?retreive=1"><h3>Total Customers</h3></a>
        <p>
          <?php
            $stmt = $conn->prepare('SELECT count(Username) as total FROM customers');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo $rows[0]['total'];
          ?>
        </p>
      </div>
      <div class="widget" id="w_a">
        <a href="customers.php?retreive=active"><h3>Active Customers</h3></a>
        <p>
        <?php
          $stmt = $conn->prepare('SELECT count(Username) as total FROM customers where status="active"');
          $stmt->execute();
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          echo $rows[0]['total'];
        ?>
        </p>
      </div>
    
      <div class="widget" id="w_s" >
        <a href="customers.php?retreive=suspended"><h3>Suspended Customers</h3></a>
        <p>
        <?php
          $stmt = $conn->prepare('SELECT count(Username) as total FROM customers where status="suspended"');
          $stmt->execute();
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          echo $rows[0]['total'];
        ?>
        </p>
      </div>
      <div class="widget" id="W_e" >
        <a href="customers.php?retreive=expired"><h3>Expired Customers</h3></a>
        <p>
        <?php
        $stmt = $conn->prepare('SELECT count(Username) as total FROM customers where status="expired"');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $rows[0]['total'];
        ?>
        </p>
      </div>
      <div class="widget" id="w_sl" >
        <a href="customers.php?retreive=430"><h3>Bronze Plan </h3></a>
        <p>
        <?php
        $stmt = $conn->prepare('SELECT count(Username) as total FROM customers where PackagePrice=430');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $rows[0]['total'];
        ?>
        </p>
      </div>
      <div class="widget" id="w_b" >
        <a href="customers.php?retreive=560"><h3>Silver Plan Customers </h3></a>
        <p>
        <?php
        $stmt = $conn->prepare('SELECT count(Username) as total FROM customers where PackagePrice=560');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $rows[0]['total'];
        ?>
        </p>
      </div>
      <div class="widget" id="w_g" >
        <a href="customers.php?retreive=710"><h3>Gold Plan Customers </h3></a>
        <p>
        <?php
        $stmt = $conn->prepare('SELECT count(Username) as total FROM customers where PackagePrice=710');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $rows[0]['total'];
        ?>
        </p>
      </div>

      <div class="payments">
      <canvas id="myChart" class="pmt" ></canvas>
      <?php
        try {
          $stmt = $conn->prepare('SELECT * FROM dailyamount WHERE DATEDIFF(CURRENT_DATE, today_date) <= 5 ORDER BY today_date ASC');
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
    <div class="complaints">
      <canvas id="myChart2" class="cmp" ></canvas>
    </div>
      </div>
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
const months = <?php echo json_encode($month); ?>;
const complaints = <?php echo json_encode($complaints); ?>;
new Chart("myChart2", {
  type: "line",
  data: {
    labels: months,
    datasets: [{
      label: 'Number of Complaints',
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: complaints
    }]
  },
  options: {
    title: {
      display: true,
      text: 'Complaints Per Month'
    },
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        scaleLabel: {
          display: true,
          labelString: 'Month'
        }
      }],
      yAxes: [{
        scaleLabel: {
          display: true,
          labelString: 'Number of Complaints'
        },
        ticks: {
          min: 6,
          max: 16
        }
      }]
    },
    tooltips: {
      callbacks: {
        label: function(tooltipItem, data) {
          var label = data.datasets[tooltipItem.datasetIndex].label || '';
          if (label) {
            label += ': ';
          }
          label += tooltipItem.yLabel;
          return label;
        }
      }
    }
  }
});


const month = <?php echo json_encode($month); ?>;
      const amount = <?php echo json_encode($amount); ?>;
      const data = {
        labels: month,
        datasets: [{
          label: 'Payments in Each Month',
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
                text: 'Payments',
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