<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Bootstrap/assets/fonts/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Fan2Stage</title>

</head>
<body>
   <style>

    .wrapper {
    max-width: 410px;
    margin: 0 auto;
    padding: 20px;
    border: 10px solid #f7987b;
    border-width: 15px;
}


    .code {
    border: 1px dashed #CCD4D6;
    border-radius: 5px;
    box-sizing: border-box;
    padding: 5px 15px;
    width: 340px;
    max-width: 100%;
    margin-left: 12px;
    background: #fdf6ee
}
.logo img {
    width: 250px;
    background: none;
    max-width: 100%;
    
}
h3, h5, p {
    font-family: system-ui;
}
p {
    font-size: 14px;
    margin-bottom: 40px;
}
h3.heading {
    border-bottom: 1px solid;
    width: 100%;
    max-width: 415px;
    padding-bottom: 5px;
    text-align:center;
}
    .cn {
    width: 30%;
    display: inline-block;
    border-left: 3px solid #f55d3b;
    }
    .cn h3 {
    margin: 10px 10px;
}
    .copy {
    float: right;
    width: 100px;
    background: #f55d3b;
    padding: 10px 10px;
    margin-top: 4px;
    font-size: 13px;
}
.copy i.fa.fa-clone {
    margin-right: 10px;
    color: #fff;
}
.copy span {
    color: #fff;
}
.logo{
    text-align:center;
    margin-bottom:40px
}

.link{
    border: 1px solid #f7987b;
    passing: 2px;
    padding: 10px 2px;
    width: 200px;
    text-align: center;
    float: center;
    margin: 0px 25%;
}

.passwordToken{
    float: center;
    text-align: center;
}
    </style>

    <div class="wrapper">
        <div class="logo">
            <img src="{{asset('assets/dist/images/mbl-Logo.png')}}">
        </div>
        <h3 class="heading">OTP for Password Reset !!</h3>

        <h5 style="margin:top:10px">Hello {{$user['name']}} !</h5>
        <p>Please use this OTP for <b>{{$user['otp']}}</b></p>
     <!-- <h5 class="passwordToken">This is your password token {{$user['passwordToken']}}</h5> -->
        
        <!-- <div class ="link"><a href = "{{env('FRONTEND_URL').'/landings/forget-password'}}">Set New Password</a></div> -->

        <p>Thank you,<br>Fan2Stage Team</p>
    </div>
</body>
</html>