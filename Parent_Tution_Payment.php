<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validParent") || isset($_COOKIE['rm']) ){
        
        $student_id = $_POST["student_id"];
        $tutor_id = $_POST["tutor_id"];
        $tutor_tution_info_id = $_POST["tutor_tution_info_id"];
        $tution_id = $_POST["tution_id"];

        //parent info
             $parent_id = $_SESSION['id']; 

                 $query = "SELECT * FROM parentregistration WHERE id='$parent_id' ";  
                 $result = mysqli_query($conn, $query);
                   while($row = mysqli_fetch_array($result))  
                    {
                        $parent_name = $row["username"];
                        $parent_email = $row["email"];
                        $parent_mobile = $row["mobile"];
                       
                    }
         //parent info end
     
        //ssl commerz payment integration
                /* PHP */
        $post_data = array();
        $post_data['store_id'] = "solut60ccb3c6e5805";
        $post_data['store_passwd'] = "solut60ccb3c6e5805@ssl";
        $post_data['total_amount'] = $_POST['parent_payment_amount'];
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
        $post_data['success_url'] = "http://localhost/PHP/dicchi-nicchi-tutor/Parent_Tution_Payment_Success.php";
        $post_data['fail_url'] = "http://localhost/new_sslcz_gw/fail.php";
        $post_data['cancel_url'] = "http://localhost/PHP/dicchi-nicchi-tutor/ParentLogin.php";
        # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE


        # CUSTOMER INFORMATION
        $post_data['cus_name'] = "$parent_name";
        $post_data['cus_email'] = "$parent_email";
        $post_data['cus_add1'] = "Dhaka";
        $post_data['cus_add2'] = "Dhaka";
        $post_data['cus_city'] = "Dhaka";
        $post_data['cus_state'] = "Dhaka";
        $post_data['cus_postcode'] = "1000";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = "$parent_mobile";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "testsolutej9z";
        $post_data['ship_add1 '] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_country'] = "Bangladesh";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $_SESSION['abc'];
        $post_data['value_b'] = $tution_id;

        # CART PARAMETERS
        $post_data['cart'] = json_encode(array(
            array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
            array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
            array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
            array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")
        ));

        // $post_data['product_amount'] = "100";
        // $post_data['vat'] = "5";
        // $post_data['discount_amount'] = "5";
        // $post_data['convenience_fee'] = "3";

        //ssl commerz payment integration end


        //sslcommerz request         

                # REQUEST SEND TO SSLCOMMERZ
        $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url );
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1 );
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


        $content = curl_exec($handle );

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($code == 200 && !( curl_errno($handle))) {
            curl_close( $handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close( $handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }

        # PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true );

        if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
                # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
            echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
            # header("Location: ". $sslcz['GatewayPageURL']);
            exit;
        } else {
            echo "JSON Data parsing error!";
        }

        //sslcommerz request end

			 
    }else {
        header('location: ParentLogin.php?status=login-first');
    }
	
	if(isset($_GET['status']))
		{
			$status = $_GET['status'];
            echo $status;
		}

//mysqli_close($conn);
?>

