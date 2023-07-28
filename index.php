<html>
<?php
// start session
session_start();

// connect to database using PDO
include 'connection.php';

// check if form submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // get form data using $_POST superglobal
    $username = $_POST['username'];
    $password = $_POST['password'];

    // retrieve user from database using PDO
    $stmt = $conn->prepare('SELECT * FROM customers WHERE Username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // check if user exists and password is correct
    $has=password_hash($user['Password'], PASSWORD_DEFAULT);
    if ($user && password_verify($password,$has)) {
        // login successful
        $_SESSION['user'] = $username;
        header('Location: user.php');
        exit;
    } else {
        // login failed
        $error = 'Invalid username or password';
        header('Location: index.php');
    }
}

?>
<head>
<style>
    html {
    height: 100%;
  }
  body {
    margin:0;
    padding:0;
    font-family: sans-serif;
    background-image: url(city.jpg);
    background-repeat: no-repeat;
    background-size: cover;
  }
  
  .login {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 400px;
    padding: 40px;
    transform: translate(-50%, -50%);
    background: rgba(0,0,0,.5);
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
  }
  

  .login h2 {
    margin: 0 0 30px;
    padding: 0;
    color: #fff;
    text-align: center;
  }
  
  .login .user-box {
    position: relative;
  }
  
  .login .user-box input {
    width: 100%;
    padding: 10px 0;
    font-size: 16px;
    color: #fff;
    margin-bottom: 30px;
    border: none;
    border-bottom: 1px solid #fff;
    outline: none;
    background: transparent;
  }
  .login .user-box label {
    position: absolute;
    top:0;
    left: 0;
    padding: 10px 0;
    font-size: 16px;
    color: #fff;
    pointer-events: none;
    transition: .5s;
  }
  
  .login .user-box input:focus ~ label,
  .login .user-box input:valid ~ label {
    top: -20px;
    left: 0;
    color: #03e9f4;
    font-size: 12px;
  }
  
  .login form a {
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    color: #03e9f4;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    overflow: hidden;
    transition: .5s;
    margin-top: 10px;
    letter-spacing: 4px
  }

  .login a:hover {
    background: #03e9f4;
    color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px #03e9f4,
                0 0 25px #03e9f4,
                0 0 50px #03e9f4,
                0 0 100px #03e9f4;
  }
  
  .login a span {
    position: absolute;
    display: block;
  }
  
  .login a span:nth-child(1) {
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #03e9f4);
    animation: btn-anim1 1s linear infinite;
  }
  
  @keyframes btn-anim1 {
    0% {
      left: -100%;
    }
    50%,100% {
      left: 100%;
    }
  }
  
  .login a span:nth-child(2) {
    top: -100%;
    right: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg, transparent, #03e9f4);
    animation: btn-anim2 1s linear infinite;
    animation-delay: .25s
  }
  
  @keyframes btn-anim2 {
    0% {
      top: -100%;
    }
    50%,100% {
      top: 100%;
    }
  }
  
  .login a span:nth-child(3) {
    bottom: 0;
    right: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(270deg, transparent, #03e9f4);
    animation: btn-anim3 1s linear infinite;
    animation-delay: .5s
  }
  
  @keyframes btn-anim3 {
    0% {
      right: -100%;
    }
    50%,100% {
      right: 100%;
    }
  }
  
  .login a span:nth-child(4) {
    bottom: -100%;
    left: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(360deg, transparent, #03e9f4);
    animation: btn-anim4 1s linear infinite;
    animation-delay: .75s
  }
  
  @keyframes btn-anim4 {
    0% {
      bottom: -100%;
    }
    50%,100% {
      bottom: 100%;
    }
  }
.hellos{
     text-align: center;
     color: #fff;
}
.form-wrapper {
  transition: 1s ease-in-out;
  }

.wrapper.active .form-wrapper.sign-in {
      transform: scale(0) translate(-300px, 500px);
      }
.wrapper .form-wrapper.sign-up {
      position: absolute;
      top: 15px;
      transform: scale(0) translate(200px, -500px);
      }
.wrapper.active .form-wrapper.sign-up {
transform: scale(1) translate(0,0);
          }
 button{
    background: transparent;
    border: none;
    position: relative;
    display: inline-block;
    color: black;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    overflow: hidden;
    transition: .5s;
    margin-top: 10px;
    letter-spacing: 4px
 }
          
</style>
</head>
<body >
    <div class="login" >
    <div class="wrapper">
    <div class="form-wrapper sign-in">
    <form action="index.php" method="POST" >
    <h2>User Login</h2>
    <form>
    <div class="user-box">
    <input type="text" required name="username">
    <label for="">Username</label>
    </div>
    <div class="user-box">
    <input type="password" required name="password">
    <label for="">Password</label>
    </div>
    <a href=""><button type="submit" >
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Submit
        </button>
        </a>
    </form>
    <div class="hellos">
    <div class="signUp-link">
    <p>Are you an Admin? <a href="#"
    class="signUpBtn-link">Login</a></p>
    </div>
    <div class="signUp-link">
        <p>Forgot Password? <a href="#"
        class="signUpBtn-link">Click Here</a></p>
        </div>
    <div class="signUp-link">
        <p>Dont have an account? <a href="#"
        class="signUpBtn-link">Sign Up</a></p>
        </div>
      </div>
  </form>
    </div>
    <div class="form-wrapper sign-up">
    <form action="logincheck.php" method="POST" >
        <h2>Admin Login</h2>
        <form>
        <div class="user-box">
        <input type="text" required name="username">
        <label for="">Username</label>
        </div>
        <div class="user-box">
        <input type="password" required name="password">
        <label for="">Password</label>
        </div>
        <a href=""><button type="submit" >
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Submit
        </button>
        </a>  
        </form>
        <div class="hellos">
        <div class="signUp-link">
        <p>Are you a User? <a href="#"
        class="signInBtn-link">Login</a></p>
        </div>
      </div>
        </form>
      </div>
  </div>
    </div>

</body>
<script>
    const signUpBtnLink = document.querySelector('.signUpBtn-link');
const signInBtnLink = document.querySelector('.signInBtn-link');
const wrapper = document.querySelector('.wrapper');
signUpBtnLink.addEventListener('click', () => {
wrapper.classList.toggle('active');
});

signInBtnLink.addEventListener('click', () => {
    wrapper.classList.toggle('active');
    });
</script>
<html>