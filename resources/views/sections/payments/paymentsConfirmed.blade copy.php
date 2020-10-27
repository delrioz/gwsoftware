<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

PAYMENT WAS SUCCESSFUL
<br>

The product was:
{{$dataConfirmPay->title}}
<br>
The price was:
{{$dataConfirmPay->amount}}

<br>
Method payment:
{{$dataConfirmPay->typeofpayment}}

<br>
<!-- <a href="/paypal/pay/{{$dataConfirmPay->amount}}" class="btn btn-primary btn-group">CARTAO / PAYPAL</a>
<a href="/paypal/pay">CARTAO / PAYPAL</a>
<a href="/DINHEIRO">DINHEIRO</a> -->
<a href="/">Finish </a><br>
<a href="/section/print">Print </a>
</body>
</html>