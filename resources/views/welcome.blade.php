<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <img src="https://static.placetopay.com/placetopay-logo.svg" class="attachment-0x0 size-0x0" alt=""
            loading="lazy" style="width: 50%">
        <div class="content">
            <div class="title m-b-md">
                <h3>Pago de suscripción</h3>
            </div>
            <form action="{{route('payment')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción del pago :</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                        rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Monto a pagar
                        :</label>
                    <input type="number" name="amount" class="form-control" id="exampleFormControlInput2"
                        value="500000">
                </div>

                <button class="btn btn-info" id="amount" type="submit"> pagar suscripcion</button>
            </form>
        </div>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <td>Referencia</td>
                        <td>Estado</td>
                        <td>Descripción</td>
                        <td>Monto original</td>
                        <td>Fecha de expedición</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$payment->reference}}</td>
                        <td>{{$payment->status}}</td>
                        <td>{{$payment->description}}</td>
                        <td>{{$payment->amount}}</td>
                        <td>{{$payment->created_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>