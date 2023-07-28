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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'><link rel="stylesheet" href="./style.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
<style>
/* Set box dimensions and position */
.square {
  width: 50%;
  height: auto;
  margin: 50px auto;
  margin-top: 10px;
  padding: 20px;
  box-sizing: border-box;
}

/* Style table */
table {
  border-collapse: collapse;
  width: 100%;
  border-radius: 10px;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

th, td {
  text-align: left;
  padding: 8px;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Style form */
form {
  margin-top: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

input[type="number"], textarea {
  display: block;
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px 20px;
  margin-top: 10px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}
.compliants{
    width: 50%;
    position: relative;
    left: 25%;
    border-radius: 10px;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

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
      <li class="nav-item">
        <a class="nav-link" href="renewal.php"><i class="fas fa-undo"></i>RENEWAL</a>
      </li>
      <li class="nav-item active">
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
            
<div class="square" id="sq">
                <?php
                $stmt=$conn->prepare('SELECT * from complaints where user_id=:user and DATEDIFF(CURRENT_DATE, issue_date) <= 5 ORDER BY issue_date ASC');
                $stmt->bindParam(':user',$user);
                $stmt->execute();
                    
                ?>
                <table>
                  <thead>
                    <th>Speed</th>
                    <th>ISSUE</th>
                    <th>ISSUE_DATE</th>
                    <th>REPLY</th>
                    <th>ADMIN</th>
                  </thead>
                  <tbody>
                    <?php 
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                    {
                    ?>
                    <tr>
                        <td><?php echo $row['speed'] ?></td>
                        <td><?php echo $row['issue'] ?></td>
                        <td><?php echo $row['issue_date'] ?></td>
                        <td><?php echo $row['reply'] ?></td>
                        <td><?php echo $row['admin_id'] ?></td>
                    </tr>
                  </tbody>
                  <?php }?>
                </table>
            </div>
            <div class="cmp" >
            <div class="compliants">
  <a href="https://www.speedtest.net/" target="_blank"><button>Speed test</button></a>
  <form action="sms.php" method="post" id="complaint-form" >
    <input type="hidden" name="cust" value="<?php echo $user ?>">
    <input type="hidden" name="phone" value="<?php echo '9704645579' ?>">
    <input type="hidden" name="msg" value="<?php echo 'I have an issue' ?>">
    <input type="number" name="speed" id="speed" placeholder="Speed Test Result">
    <textarea name="issue" id="issue" cols="30" rows="10" placeholder="Enter your issue"></textarea>
    <button type="submit">Send</button>
  </form>
</div>
            </div>
</body>
<script>
    </script>
</html>
