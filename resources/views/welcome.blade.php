<h1>suscripcion</h1>

<div class="content">
    <div class="title m-b-md">
        <h3>pago de suscripcion</h3>
    </div>
    <form action="{{route('payment')}}" method="post">
        @csrf
        <label for="reference">Referencia única para la solicitud de pago :</label>
        <input type="text" id="reference" name="reference">

        <label for="description">Descripción del pago :</label>
        <input type="text" id="description" name="description">

        <label for="amount">Monto a pagar :</label>
        <input type="number" id="reference" name="amount">

        <button id="amount" type="submit"> pagar suscripcion</button>
    </form>
</div>