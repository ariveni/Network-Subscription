<!DOCTYPE html>
<?php
    include "connection.php";
    session_start();
    $user=$_SESSION['user'];
    if(empty($user))
    {
      header('Location: index.php');
    }
    
    ?>
<html lang="en" >
<head>
<link
  rel="icon"
  type="image/png"
  href="favicon.png"/>
  <meta charset="UTF-8">
  <title>Network Subscription</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'><link rel="stylesheet" href="./style.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
<style>
   /* Style for the graph container */
.graph {
  max-width: 1000px;
  margin: 0 auto;
  margin-top: 5%;
  text-align: center;
}

/* Style for the chart box */
.chartbox {
    margin: 40px auto;
    background-color: #fff;
    padding: 30px 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
    max-width: 800px;
}

canvas {
    width: 900px;
    max-width: 1000px;
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

/* Style for the suggest box */
.suggest {
  max-width: 600px;
  margin: 20px auto;
  text-align: center;
}

/* Style for the suggest heading */
.suggest h2 {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 10px;
}
.main {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 50px;
}

#plans {
  padding: 10px;
  margin-bottom: 20px;
  font-size: 16px;
}

.upi {
  display: flex;
  justify-content: center;
  margin-top: 50px;
}

.fm {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 50px;
}

input[type="text"] {
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

button[type="submit"] {
  padding: 10px 20px;
  background-color: #008CBA;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #00698C;
}


</style>
</head>
<body>
<!-- partial:index.partial.html -->
<nav class="navbar navbar-expand-custom navbar-mainbg">
  <a class="navbar-brand navbar-logo" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars text-white"></i>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
      <li class="nav-item ">
        <a class="nav-link" href="user.php"><i class="fas fa-home"></i>HOME</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="shop.php"><i class="fas fa-shopping-cart"></i>SHOP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="plans.php"><i class="fas fa-calendar-alt"></i>PLANS</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="renewal.php"><i class="fas fa-undo"></i>RENEWAL</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="usercomp.php"><i class="fas fa-exclamation-triangle"></i>COMPLAINTS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php?user=1"><i class="fas fa-sign-out-alt"></i>LOGOUT</a>
      </li>
    </ul>
  </div>
</nav>

<!-- partial -->
  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script><script  src="./script.js"></script>
         <div class="graph">
         <?php
    try{

        $stmt=$conn->prepare('select * from usagedata where username=:user ');
        $stmt->bindParam(':user',$user);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $month=array();
            $usage=array();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                 $month[]=$row["month"];
                 $usage[]=$row["dataused"];
            }
         unset($result);
        }
        else{
            echo "No records are founded";
            exit();
        }
        
        $stmt=$conn->prepare('SELECT AVG(dataused) as average FROM usagedata where username=:user');
        $stmt->bindParam(':user',$user);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $res=$row['average'];
    }
    catch(PDOException $e){
        die("ERROR: not able to execute sql".$e->getMessage());
    }
    unset($conn);
    ?>
<h2>Average Data Usage of last 6 months: <?php echo $res;?> GB</h2>
<div class="chartbox">
<canvas id="myChart"></canvas>
</div>
<div class="suggest" >
  <?php
  if($res<200)
  { ?>
  <h2>Based on your Past Usage We Suggest you Bronze Plan</h2>
  <?php }
  else if($res<400)
  {?>
  <h2>Based on your Past Usage We Suggest you Silver Plan</h2>
  <?php }
  else{ ?>
<h2>Based on your Past Usage We Suggest you Gold Plan</h2>
  <?php }?>
  <div class="main">
  <select name="plns" id="plans">
    <option value="0">Select plan</option>
    <option value="430">Bronze Plan RS 430</option>
    <option value="560">Silver Plan RS 560</option>
    <option value="710">Gold Plan RS 710</option>
  </select>
</div>

<div class="upi">
  <h1>UPI ID **********************</h1>
</div>

<div class="fm">
  <form action="./onlinepay/Razorpay.php" method="post">
    <input type="hidden" name="user" value="<?php echo $user ?>">
    <input type="hidden" name="price" id="price" placeholder="Amount paid">
    <button type="submit">PAY</button>
  </form>
</div>
         </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const month=<?php echo json_encode($month);?>;
    const usage=<?php echo json_encode($usage);?>;
    const data={
    labels: month,
        datasets: [{
            label: 'data uasge in each month',
            data: usage,
            backgroundColor: [
                ' #e74c3c ',
                ' #3498db ',
                ' #27ae60  ',
                '  #e67e22  ',
                ' #212f3d ',
                '#239b56 '
            ],
            borderColor: [
                'black'
            ],
            borderWidth: 1

        }]
    };
    const config = {
  type: 'bar',
  data,
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
          text: 'Data Usage (GB)',
          font: {
            size: 16,
            weight: 'bold'
          }
        }
      }
    }
  }
};


    const myChart=new Chart(
        document.getElementById('myChart'),
        config
    );
    const select = document.querySelector('#plans');
  const priceInput = document.querySelector('#price');

  select.addEventListener('change', (event) => {
    const selectedOption = event.target.selectedOptions[0];
    const price = selectedOption.value;
    priceInput.value = price;
  });
</script>
</html>
