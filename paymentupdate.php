<html>
    <?php
    include "connection.php";
    
    $user=$_POST['user_id'];
    $msg=$_POST['msg'];
    $price=$_POST['price'];
    $stmt=$conn->prepare('select * from customers where Username=:username');
    $stmt->bindParam(':username',$user);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

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
    if($msg==1)
    {
        $stmt = $conn->prepare('update payments set status="reject", admin_id="manikanta440" where user_id=:user');
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $send='From Network'.'<br>'.'your payment of RS'.$price.' is rejected if you have any issue raise a compliant from portal';
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            '+91'.$row['Phone'],
            array(
                'from' => $twilio_number,
                'body' => $send,
            )
        );
        header('Location: payments.php');
        exit;
    }
    else{
        
        $stmt=$conn->prepare('select * from dailyamount where today_date=CURRENT_DATE');
        $stmt->execute();
        if($stmt->rowCount()>0)
        {
            $stmt=$conn->prepare('update dailyamount set amount=amount+ :price where today_date=CURRENT_DATE');
            $stmt->bindParam(':price',$price);
            $stmt->execute();
        }
        else{
            $stmt=$conn->prepare('insert into dailyamount(today_date,amount,complaints) values(CURRENT_DATE,:price,0)');
            $stmt->bindParam(':price',$price);
            $stmt->execute();
        }
        
        $stmt = $conn->prepare('SELECT * from customers where Username=:user');
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $rows=$stmt->fetch(PDO::FETCH_ASSOC);
        print_r($rows);
        $stmt=$conn->prepare('insert into usagedata(username,month,dataused) values(:user,:month,:data)');
            $stmt->bindParam(':user',$rows['Username']);
            $stmt->bindParam(':month',$rows['Expiry']);
            $stmt->bindParam(':data',$rows['Usage']);
            $stmt->execute();
        $stmt=$conn->prepare('UPDATE customers
        SET Expiry = 
            CASE
                WHEN CURRENT_DATE > Expiry THEN DATE_ADD(CURRENT_DATE, INTERVAL 1 MONTH)
                ELSE DATE_ADD(Expiry, INTERVAL 1 MONTH)
            END
        WHERE Username = :user
        ');
         $stmt->bindParam(':user',$rows['Username']);   
         $stmt->execute();
         $stmt = $conn->prepare('update payments set status="accept", admin_id="manikanta440" where user_id=:user');
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $send='From Network'.'<br>'.'your payment of RS'.$price.' is Accepted';
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            '+91'.$row['Phone'],
            array(
                'from' => $twilio_number,
                'body' => $send,
            )
        );
        header('Location: payments.php');
    }
    ?>
    <head>

    </head>
    <body>
        
    </body>
</html>