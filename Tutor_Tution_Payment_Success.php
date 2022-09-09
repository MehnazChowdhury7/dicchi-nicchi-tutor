<?php
	require('db_rw.php');
    session_start();

     if($_POST['value_a'] == "validTutor"){
         
        $tution_id = $_POST['value_b'];

        $val_id=urlencode($_POST['val_id']);
        $store_id=urlencode("solut60ccb3c6e5805");
        $store_passwd=urlencode("solut60ccb3c6e5805@ssl");
        $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $requested_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

        $result = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($code == 200 && !( curl_errno($handle)))
        {

            # TO CONVERT AS ARRAY
            # $result = json_decode($result, true);
            # $status = $result['status'];

            # TO CONVERT AS OBJECT
            $result = json_decode($result);
            

            # TRANSACTION INFO
            $status = $result->status;
            $tran_date = $result->tran_date;
            $tran_id = $result->tran_id;
            $val_id = $result->val_id;
            $amount = $result->amount;
            $store_amount = $result->store_amount;
            $bank_tran_id = $result->bank_tran_id;
            $transaction_type = $result->card_type;

            // # EMI INFO
            // $emi_instalment = $result->emi_instalment;
            // $emi_amount = $result->emiamount;
            // $emi_description = $result->emi_description;
            // $emi_issuer = $result->emi_issuer;

            // # ISSUER INFO
            // $card_no = $result->card_no;
            // $card_issuer = $result->card_issuer;
            // $card_brand = $result->card_brand;
            // $card_issuer_country = $result->card_issuer_country;
            // $card_issuer_country_code = $result->card_issuer_country_code;

            # API AUTHENTICATION
            $APIConnect = $result->APIConnect;
            $validated_on = $result->validated_on;
            $gw_version = $result->gw_version;

            //insert payment
            if($conn){
                $sql = " INSERT INTO tutor_tution_payment(id, tution_id, amount, transaction_id, transaction_date, transaction_type) VALUES ( '' , '$tution_id' , '$amount', '$tran_id', '$tran_date', '$transaction_type' ) ";                 
                $result = mysqli_query($conn , $sql);
                
                if($result != null){
                    $sql_tutor_tution_payment = "SELECT * FROM tutor_tution_payment WHERE  tution_id='$tution_id' ";
                    $result_tutor_tution_payment = mysqli_query($conn , $sql_tutor_tution_payment);
                    $row_tutor_tution_payment = mysqli_fetch_array($result_tutor_tution_payment);

                    $tutor_payment_id = $row_tutor_tution_payment['id'];
                    $tution_id = $row_tutor_tution_payment['tution_id'];

                    $sql_tution_Upadet =  " UPDATE  tution SET tutor_is_pay ='1' , tutor_payment_id = '$tutor_payment_id'  where id='$tution_id' ";
                    $result_tution_Upadet = mysqli_query($conn , $sql_tution_Upadet);

                    if($result_tution_Upadet == null){
                        echo "Tution Upadet.... Failed";
                      }

                }else {
                    echo "Data Not Inserted.... Failed";
                }
                
            }else{
                echo "Failed to connect with DB";
            }
            //insert paymnet end
    

        } else {

            echo "Failed to connect with SSLCOMMERZ";
        }

     }else {
        header('location: TutorLogin.php?status=login-first');
     }
        

	
	
	if(isset($_GET['status']))
		{
			$status = $_GET['status'];
            echo $status;
		}

//mysqli_close($conn);
?>

<html>
<head>
        <title>Parent Payment</title>

        <script src="js/jquery-1.10.2.min.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">

		
	
<style> 
.div1 {
    background-image: url(white-wood-texture-background-design_1022-75.jpg);
    text-align: center;
    width: 1330px;
    height: 100px;
    border: 1px solid blue;
    box-sizing: border-box;
	front-colar:white-space;
}

.div2 {
    background-image: url(white-wood-texture-background-design_1022-75.jpg);
    text-align: center;
    width: 1330px;
    height: 70px;    
    padding: 1px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div3 {
    text-align: center;
    width: 430px;
    height: 170px;    
    padding: 5px;
    margin: 4px 120px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div4 {
    text-align: center;
    width: 310px;
    height: 280px;    
    padding: 5px;
    margin: -285 320px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div5 {
    text-align: center;
    width: 310px;
    height: 170px;    
    padding: 5px;
    margin: 310px 320px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div6 {
    text-align: center;
    width: 310px;
    height: 90px;    
    padding: 5px;
    margin: -400px 2px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div7 {
    text-align: center;
    width: 430px;
    height: 70;    
    padding: 5px;
    margin: 50px 50px;
  
	} 
.div8 {
    text-align: center;
    width: 500px;
    height: 170px;    
    padding: 5px;
    margin: 40px 80px;
    border: 1px solid red;
    box-sizing: border-box;
   
	}
.div9 {
    text-align: center;
    width: 500px;
    height: 70px;    
    padding: 5px;
    margin: -20px 80px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div10 {
    text-align: center;
    width: 320px;
    height: 130px;    
    padding: 5px;
    margin: -312px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div11 {
    text-align: center;
    width: 320px;
    height: 130px;    
    padding: 5px;
    margin: 310px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div12 {
    text-align: center;
    width: 320px;
    height: 90px;    
    padding: 5px;
    margin: -310px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div13 {
    text-align: center;
    width: 20px;
    height: 50px;    
    padding: 5px;
    margin: 320px 240px;
  
	}
.div14 {
    text-align: center;
    width: 500px;
    height: 50px;    
    padding: 5px;
    margin: 50px 50px;
  
	}                                                 
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}

.button1 {
    
}

.button2:hover {
   
}

.flex-container {
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: row-reverse;
    flex-direction: row-reverse;
    width: 1330px;
    height: 550px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
    height: 550px;
    margin: 2px;
}

h1 {
   color: black;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

</style>

</head>
<body>

<div class="div1"><h1>DICCI NICCI TUTOR</h1></div>
<div class="div2">

<a href="http://localhost/PHP/dicchi-nicchi-tutor/dnt.html" class="button">Home</button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Search%20a%20tutor.php" class="button">Search tutor</button></a> -->
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Tutorhome.php" class="button">Tutor Home</button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
<a href='Parentlogout.php' class="button"> logout </button></a> <br/><br/>;

</div>


<div class="flex-container">
   

    <div class="flex-item">
     <h1> Transaction Info   </h1> 
    
        <div class="container">
          <!-- div 3 -->
          <div class="div3">
              <table class="table table-bordered">  
                   
                   <tr>  
                      <th width="40%"> Status :</th>
                      <th width="20%"><?php echo $status; ?></th>
                  </tr>
                  <tr>  
                      <th width="40%"> Amount :</th>
                      <th width="20%"><?php echo $amount; ?></th>
                  </tr>
                  <tr>  
                      <th width="40%"> Transaction id :</th>
                      <th width="20%"><?php echo $tran_id; ?></th>
                  </tr>
                  <tr>  
                      <th width="40%"> Transaction Date :</th>
                      <th width="20%"><?php echo $tran_date; ?></th>
                  </tr>
              
              </table>
           </div>
            <!-- div 3 end                -->
                    
        </div>
            
            
    </div>

    <div class="flex-item">
    
       <div class="container" >
           <!-- div 7 -->
            <div class="div7">
                <h1>Payment Complete</h1>
            </div>
           <!-- div 7 end  -->
          
    
        </div>
        
    </div>

</div>


</body>
</html>



