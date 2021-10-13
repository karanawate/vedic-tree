<html lang="en">
<head>
  <title>how to Integrate Razorpay payment gateway in Codeigniter - XpertPhp</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
        <h4>Product 1</h4>
        <h5>500 Rs.</h5>
    	<a href="javascript:void(0)" class="btn btn-sm btn-primary buy_now" data-amount="500" data-id="1" data-product="Product 1">Order Now</a> 
    </div>
    <div class="col-sm-4">
        <h4>Product 2</h4>
        <h5>1000 Rs.</h5>
    	<a href="javascript:void(0)" class="btn btn-sm btn-primary buy_now" data-amount="1000" data-id="2" data-product="Product 2">Order Now</a> 
    </div>
    <div class="col-sm-4">
        <h4>Product 3</h4>
        <h5>1500 Rs.</h5>
    	<a href="javascript:void(0)" class="btn btn-sm btn-primary buy_now" data-amount="1500" data-id="3" data-product="Product 3">Order Now</a> 
    </div>
  </div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$('body').on('click', '.buy_now', function(e){
    var totalAmount = $(this).attr("data-amount");
    console.log(totalAmount);
    var product_id =  $(this).attr("data-id");
    console.log(product_id);
    var product_name =  $(this).attr("data-product");
    console.log(product_name);
    var options = {
    "key": "YOUR_KEY_ID",
    "currency": "INR",
    "amount": totalAmount,
    "name": product_name,
    "description": "Test Transaction",
    "handler": function (response){
          $.ajax({
            url: '<?php echo base_url() ?>'+'Razor/razorPaySuccess',
            type: 'post',
            dataType: 'json',
            data: {
                razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
            }, 
            success: function (msg) {
               window.location.href = '<?php echo base_url() ?>'+'Razor/RazorThankYou';
            }
        });
    },
    "theme": {
        "color": "#F37254"
    }
};



var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}

});

</script>
</body>
</html>