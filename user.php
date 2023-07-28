<!DOCTYPE html>
<?php
    include "connection.php";
    session_start();
    $user=$_SESSION['user'];
    if(empty($user))
    {
      header('Location: index.php');
    }
    $stmt=$conn->prepare('select * from customers where Username=:username');
        $stmt->bindParam(':username',$user);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
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
    .square {
    
    background: transparent;
    margin: 20px;
    display: flex;
    justify-content: space-between;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    width: 80%;
    position: absolute;
    top: 25%;
    left: 10%;
  }
  
  .p1, .p2, .p3 {
    padding: 20px;
  }
  
  .styled-table {
    border-collapse: collapse;
    width: 100%;
  }
  
  .styled-table td, .styled-table th {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  
  .styled-table th {
    background-color: #0077cc;
    color: #fff;
    font-weight: bold;
  }
  
  .styled-table tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  
  .styled-table tr:hover {
    background-color: #ddd;
  }
  
  .f1 {
    flex-grow: 1;
  }
  
  /* Password Reveal Styles */
  
  #pass {
    display: none;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 4px;
    width: 45%;
    position: absolute;
    z-index: 1;
    top: 50px;
    left: 45%;
    right: 0;
    text-align: center;
  }
  
  #pass::before {
    content: "";
    display: block;
    width: 80%;
    position: absolute;
    top: -5px;
    left: 20px;
    border: 5px solid transparent;
    border-bottom-color: #ccc;
  }
  
  button:hover + #pass {
    display: block;
  }
  
  /* Responsive Styles */
  
  @media (max-width: 768px) {
    .headtag {
      flex-direction: column;
      align-items: flex-start;
      padding: 10px;
    }
  
    .menu {
      margin-top: 10px;
    }
  
  }
  .f1{
      width: 50%;
      position: absolute;
      top: 20%;
      left: 50%;
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
      <li class="nav-item active">
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
            <div class="square" id="sq">
                <div class="p3">
                    <div class="p1">
                        <table class="styled-table" width="25%" border="2" height ="5">
                            <colgroup>
                                <col style="width: 50%" />
                                <col style="width: 50%" />
                            </colgroup>
                            <tbody>
                                <thead>
                                    <tr>
                                        <th colspan="2" align="center">User Plan</th>
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>Current plan</td>
                                        <td><?php echo $row['PackageName'];?></td> 
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td><?php echo $row['PackagePrice'];?></td> 
                                    </tr>
                                    <tr>
                                        <td>Expiry</td>
                                        <td><?php echo $row['Expiry'];?></td> 
                                    </tr>
                                    <tr>
                                        <td>Renual</td>
                                        <td><?php echo $row['Renewal'];?></td> 
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p2">
                        <table class="styled-table" width="25%" border="2" height ="5">
                            <colgroup>
                                <col style="width: 50%" />
                                <col style="width: 50%" />
                            </colgroup>
                            <tbody>
                                <thead>
                                    <tr>
                                        <th colspan="2" align="center">Network Information</th>
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>Status</td>
                                        <td><?php echo $row['Status'];?></td> 
                                    </tr>
                                    <tr>
                                        <td>IP</td>
                                        <td><?php echo $row['IP'];?></td> 
                                    </tr>
                                    <tr>
                                        <td>Usage</td>
                                        <td><?php echo $row['Usage'];?>GB</td> 
                                    </tr>
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="f1">
                    <table class="styled-table" width="25%" border="2" height ="5">
                        <colgroup>
                            <col style="width: 50%" />
                            <col style="width: 50%" />
                        </colgroup>
                        <tbody>
                            <thead>
                                <tr>
                                    <th colspan="2" align="center">User Information</th>
                                </tr>
                            </thead>
                                <tr>
                                    <td>User</td>
                                    <td><?php echo $row['Username'];?></td> 
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>
                                        <button onclick="show('<?php echo $row['Password']; ?>')">Password</button>
                                        <div id="pass"></div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo $row['Name'];?></td> 
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td><?php echo $row['Phone'];?></td> 
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $row['Email'];?></td> 
                                </tr>
                                <tr>
                                    <td>Registered Date</td>
                                    <td><?php echo $row['DateAdded'];?></td>
                                </tr>
                                <tr>
                                    <td rowspan="10%">Adress</td>
                                    <td rowspan="30%"><?php echo $row['BillingAddress'];?></td> 
                                </tr>
                                
                                
                        </tbody>
                    </table>
                </div>
            </div>

</body>
<script>
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
    </script>
</html>
