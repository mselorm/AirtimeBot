<?php


include 'engine.php';
session_start();

// if (!isset($_SESSION['staff_id'])) {
//     echo '<script>window.location.href="../../../index.php"</script>';
// }


if (isset($_SESSION['update'])){    
  $result_= $_SESSION['update'];
      unset($_SESSION['update']);

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="logo.png" rel="icon" /> <link href="logo.png" rel="apple-touch-icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">


<title>Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<link href = "jquery-ui-1.12.1/jquery-ui.css"  rel = "stylesheet">
      <link href = "jquery-ui-1.12.1/jquery-ui.min.css"  rel = "stylesheet">
      <link href = "jquery-ui-1.12.1/jquery-ui.structure.css"  rel = "stylesheet">
      <link href = "jquery-ui-1.12.1/jquery-ui.structure.min.css"  rel = "stylesheet">
      <link href = "jquery-ui-1.12.1/jquery-ui.theme.css"  rel = "stylesheet">
      <link href = "jquery-ui-1.12.1/jquery-ui.theme.min.css"  rel = "stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<link href="admin.css" rel="stylesheet"><!--	<link rel="stylesheet" type="text/css" href="css/main.css">-->
<link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="media.css">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="table.css">

<link rel="stylesheet" href="signup.css">
<link rel="stylesheet" href="lastone.css">

<script src="clickevents.js"></script>

</head>

<body>
<a class="navbar-brand brand-logo" href="#">
    
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
    
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">

                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
                <p class="profile-name">Admin</p>
              
              </div>



            </a>
          </li>
          <li class="nav-item nav-category">Main Menu</li>
          <li class="nav-item active">
            <a class="nav-link" href="#" id="all">
              <i class="menu-icon typcn document-text" id="all"></i>
              <span class="menu-title" id="all">View  All Records</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="modifycustomer">
              <i class="menu-icon typcn typcn-shopping-bag" id="modifycustomer"></i>
              <span class="menu-title" id="modifycustomer">View Pending Deliveries</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"  id="viewrecent_signup_">
              <i class="menu-icon typcn typcn-coffee1" id="viewrecent_signup_"></i>
              <span class="menu-title" id="viewrecent_signup_">Sign Up new Customer</span>
              
            </a>
    
          </li>
     
          <li class="nav-item">
            <a class="nav-link" href="#" id="viewrecent_signup">
              <i class="menu-icon typcn typcn-document-text" id="viewrecent_signup"></i>
              <span class="menu-title" id="viewrecent_signup">View Recent Sign Ups</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon typcn typcn-th-large-outline" id="recent_collections"></i>
              <span class="menu-title" id="recent_collections">View Recent Collections</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="collect_add">
              <i class="menu-icon typcn typcn-bell" id="collect_add"></i>
              <span class="menu-title" id="collect_add">Add New Collection</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="agent_activity">
              <i class="menu-icon typcn typcn-user-outline" id="agent_activity"></i>
              <span class="menu-title" id="agent_activity">View Sales Agent Activity</span>     
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="auth" id="new_member" data-toggle="modal">
              <i class="menu-icon typcn typcn-document-add" id="new_member" data-toggle="modal" ></i>
              <span class="menu-title" id="new_member" data-toggle="modal" >Add Signup/Collection Agent</span>
              <i class=""></i>
            </a>
  
          </li>
        </ul>
      </nav>

      <a href="logoutstaff.php"><img id="uimg_" src="logout.png" alt="" srcset=""></a>
  <img id="uimg2_" src="../assets/user.png" alt="" srcset="">
  <div class="uname_"><?php echo $_SESSION['staff_name'] = 'Admin'; ?></div>
  
<div class="total">
<span id="balance"> <h4 id="ap_"  style="color: var (--main-color1);">Total Amount Paid:</h4> <h4 id="ap"> 1000</h4></span>
<span id="amount"><h4 id="ap_">Total Balance Left:</h4> <h4 id="ap1">200</h4> </span>

</div>
<div class="side_">
<div class="logobox">
            </div>
            </div>
<div class="signups">
<div class="limiter" style="display: none">
    <div class="container-table100">
      <div class="wrap-table100">
       
        <div class="table100">
        <div>
          <table id="tablewidth">
            <thead>
              <tr class="table100-head">
              <th>CustomerID</th>
            <th>Name</th>
         
             <th>Balance</th>
       

           
            
              <th>Update</th>

              </tr>
            </thead>

            <tbody>
                <tr>
                <?php fetch_details1()?>
                </tr>


            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="agent_report" style="position: absolute;
    top: 100px; display: none">
    <div class="container-table100">
      <div class="wrap-table100">
       
        <div class="table100">
        <div>
          <table id="tablewidth">
            <thead>
              <tr class="table100-head">
         
              <th>CustomerID</th>
            <th>Name</th>
  
            <th>Amount paid</th>
             <th>Balance</th>
       

           
            
              <th>Update</th>
   


              </tr>
            </thead>

            <tbody>
                <tr>
                <?php agent_report()?>
                </tr>


            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  

<div class ="recent_signups" style="display: none">
    <div class="container-table100">
      <div class="wrap-table100">
        <div class="table100">
          <table>
            <thead>
              <tr class="table100-head">
           
              <th>CustomerID</th>
            <th>Name</th>
        
             <th>Balance</th>
            

           
            
              <th>Update</th>


              </tr>
            </thead>

            <tbody>
                <tr>
                <?php recent_signups()?>
                </tr>


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class ="pending_delivery" style="display: none">
    <div class="container-table100">
      <div class="wrap-table100">
        <div class="table100">
          <table>
            <thead>
              <tr class="table100-head">
           
              <th>CustomerID</th>
            <th>Name</th>
       
         
             <th>Balance</th>
      

           
            
              <th>Update</th>
              </tr>
            </thead>

            <tbody>
                <tr>
                <?php pending_delivery()?>
                </tr>


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<div class="searchagent" style="margin-top: 140px; display: none">

<div class="container">
    <br/>
	<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8" style="width:4000px">
                            <form class="card card-sm" >
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                       
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Enter ttg agent id" id="agent_" style="width:400px">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                    <button id="searchbtn_" style=" background-color: rgb(0, 195, 255);" type="button" class="btn btn-lg btn-success">Search</button>
                                        
                                    </div>


</div>
                            </form>
</div>
</div>
</div>
</div>
<div class="report"></div>

<form id="collect" action="" method="post" style="display: none">
        <p><input type="text" name="cid" id="cid" placeholder="Enter Customer Id..."></p> <br>

        <button type="submit" id="gonna" style="border-radius: 10px;
    height: 40px;
    width: 300px;
    position: relative;
    left: px;
    left: 500px;
    top: 100px;
    background: white;
">SUBMIT</button> <br> <br>
        <div class="dis12" style="      border-radius: 10px;
    height: 40px;
    width: 300px;
    position: relative;
    left: px;
    left: 500px;
    top: 100px;
    background: white;
">
          Results will display here...
        </div>
      </form>
      <!-- end of form -->
      <div id="signup_msg" style="display: none"></div>
  <form class="tablecontent" action="" method="post"  style="display: none">
        <!-- border-frame -->
    
        <div class="frame">
            <!-- Slider -->
            <div class="slider">
                <!-- inputs -->
                <div id="receive">
                <p><button type="button" class="genid_" name="cusid" id="id">Generate Customer Id</button></p>

                <p><input type="text" class="inp" name="cusid" id="cusid1" placeholder="Customer Id" required></p>
                <p><input type="text" class="inp" name="name" id="" placeholder="Name" required></p>
                <p><input type="text" class="inp" name="location" id="" placeholder="Location" required></p>
                <p><input type="text" class="inp" name="phonum" id="" placeholder="Phone Number" required></p>
                <p><input type="text" class="inp" name="occupation" id="" placeholder="Occupation" required></p>
                <input type='button' class='sii' value='Next' onClick='submitDetailsForm()' />
                </div>
                <div id="give">
                <input type='button' class='sii_' value='<--' onClick='submitnext1()' /> <br>

                <p><h3><span id="d3">Item</span></h3>
                  <!--
                <select name="cate" class="inp" id="">
                 <option  value="---">Enter Category</option>
                 <option id="order" value="order">Order</option>
                 <option id="order2" value="phone">Phone</option>
                 <option id="order3" value="fridge">Fridge</option>
                 <option id="order4" value="tv">Tv</option>

                </select>
                    -->
                <div id="pi1">
                <div class="title"></div>
                                <p><input type="text" class="inp" name="item_type" id="" placeholder="Item type" required></p>
                <input type="text" class="inp" name="item" id="" placeholder="Product Name" required><br>
                <input class="inp" type="text" name="price" id="" placeholder="Price of the product" required> <br> <br>
                <input type='button' class='sii' value='Next' onClick='submitDetailsFo()' />
                </div> </div>
                <div id="take">
                <input type='button' class='sii_' value='<--' onClick='submitnext2()' /><br>
                <p><h4><span id="d4">Amount</span></h4>
                <input type="text" class="inp" name="amount_paid" id="" placeholder="Enter amount paid" required> 
                    <label ><span id="d4">Date Registered</label> 
                <input type="date" class="inp" name="date_initiated" id="" placeholder="Enter date of registration" required>
                <label ><span id="d4">Date To Finish Payment</label>
                <input type="date" class="inp" name="date_completion" id="" placeholder="Enter date to finish payment" required>

                </p>
                <input type="submit" class="siadmin" name="" id="" value="Submit" onClick='submit2()'>
      
                </div>
            </div>
            </div>
  </form>
      <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all" /> 
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script   type="text/javascript" src="showtable.js"></script>

<script   type="text/javascript" src="clickevents.js"></script>
</body>
</html>