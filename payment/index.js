paypal.Buttons({

style:{
    color:'blue',
    shape:'pill'
},
createOrder:function(data,actions){
   
    return actions.order.create({
        purchase_units:[{
            amount:{
                value:"2"
            }
        }]
    });

},
onApprove:function(data,actions){
    return actions.order.capture().then(function(details){
        console.log(details),
        window.location.replace('loader20.php')
    });
},
onCancel:function(data){
    window.location.replace('payment.php')
}
}).render("#paypal-payment-button");