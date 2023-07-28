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
<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/pricing-plan.css">
<style>
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
      <li class="nav-item active">
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
<main>
    <div class="container">
      <h1 class="text-center pricing-table-title">INTERNET PLANS</h1>
      <div class="row">
        <div class="col-md-4">
          <div class="card pricing-card pricing-plan-basic">
            <div class="card-body">
              <i class="mdi mdi-cube-outline pricing-plan-icon"></i>
              <p class="pricing-plan-title">Bronze </p>
              <h3 class="pricing-plan-cost ml-auto">RS 430</h3>
              <ul class="pricing-plan-features">
                <li>15 Mbps Unlimited Data</li>
                <li>4 participants max</li>
                <li>FULL HD streaming</li>
                <li>Best choice for cctv purpose</li>
              </ul>
              <a href="#!" class="btn pricing-plan-purchase-btn">Purchase</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card pricing-card pricing-card-highlighted  pricing-plan-pro">
            <div class="card-body">
                <i class="mdi mdi-trophy pricing-plan-icon"></i>
              <p class="pricing-plan-title">Silver</p>
              <h3 class="pricing-plan-cost ml-auto">RS 560</h3>
              <ul class="pricing-plan-features">
                <li>30 Mbps Unlimited Data</li>
                <li>7-8 participants max</li>
                <li>4K streaming</li>
                <li>Best choice for Home and Business purpose</li>
              </ul>
              <a href="#!" class="btn pricing-plan-purchase-btn">Purchase</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card pricing-card pricing-plan-enterprise">
            <div class="card-body">
              <i class="mdi mdi-wallet-giftcard pricing-plan-icon"></i>
              <p class="pricing-plan-title">GOLD</p>
              <h3 class="pricing-plan-cost ml-auto">RS 710</h3>
              <ul class="pricing-plan-features">
                <li>50 Mbps Unlimited Data</li>
                <li>8-10 participants max</li>
                <li>4K streaming</li>
                <li>Best choice for Work from Home</li>
                <li>1st priority in service</li>
              </ul>
              <a href="#!" class="btn pricing-plan-purchase-btn">Purchase</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script><script  src="./script.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
