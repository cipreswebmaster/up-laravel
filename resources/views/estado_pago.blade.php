@extends('base')

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/estado_pago.css") }}">
@endsection

@php
    $ESTADOS_PAGO = [
      "1" => "Pago exitoso",
      "888" => "Pago pendiente por iniciar",
      "999" => "Pago pendiente por finalizar",
      "4001" => "Pendiente CR",
      "4000" => "Rechazado CR",
      "4003" => "Rechazado",
      "1000" => "Rechazado",
      "1001" => "Rechazado",
    ];
    $rejectionCodes = [4000, 4003, 1000, 1001, -1, 888, 999, 4001];
    $continueCodes = [];
@endphp

@section('body')
  <div class="payment_state">
    Estado del pago:
    @if ($estado["zona_pago_state"] == -1)
      No hay pagos existentes
    @else
      {{ $ESTADOS_PAGO[$estado["zona_pago_payment_info"]["estado_pago"]] }}
    @endif
  </div>
  <div class="advice">
    @if (
      isset($estado["zona_pago_payment_info"]) &&
      ($estado["zona_pago_payment_info"]["forma_pago"] == 29 && $estado["zona_pago_payment_info"]["estado_pago"] == 999)
    )
      En este momento su Numero de Referencia o Factura (id_Pago) presenta un proceso de pago cuya transacción se encuentra PENDIENTE de recibir confirmación por parte de su entidad financiera, por favor espere unos minutos y vuelva a consultar más tarde para verificar si su pago fue confirmado de forma exitosa. Si desea mayor información sobre el estado actual de su operación puede comunicarse a nuestras líneas de atención al cliente 318 3818314 o enviar un correo electrónico a administrativa@cipresdecolombia.com y preguntar por el estado de la transacción
    @endif
    @if (
      isset($estado["zona_pago_payment_info"]) &&
      ($estado["zona_pago_payment_info"]["forma_pago"] == 32 && $estado["zona_pago_payment_info"]["estado_pago"] == 4001)
    )
      En este momento su Numero de Referencia o Factura (id_Pago) presenta un proceso de pago cuya transacción se encuentra PENDIENTE de recibir confirmación por parte de su entidad financiera, por favor espere unos minutos y vuelva a consultar más tarde para verificar si su pago fue confirmado de forma exitosa. Si desea mayor información sobre el estado actual de su operación puede comunicarse a nuestras líneas de atención al cliente 318 3818314 o enviar un correo electrónico a administrativa@cipresdecolombia.com
    @endif
  </div>
  <div class="action_buttons">
    @if (!in_array($estado["zona_pago_state"], $rejectionCodes) )
      <button class="veri">
        <a href="/estado_pago">Verificar estado del pago</a>
      </button>  
    @else
      <button class="pagar">
        <a href="/membresias">Realizar un pago nuevo</a>
      </button>
    @endif
    {{-- {continueCodes.indexOf(estadoPago) > -1 && (
      <button onClick={continuePayment}>Continuar con el pago</button>
    )} --}}
  </div>
@endsection

@section('scripts')
@if (isset($token) && $estado["zona_pago_state"] != 1)
<script src="{{ asset("js/swal.min.js") }}"></script>
  <script>
    const a = window.open('https://www.zonapagos.com/t_Ciprespas/pago.asp?estado_pago=iniciar_pago&identificador={{ $token }}', '_blank');
    if (!a) {
      Swal.fire({
        icon: "warning",
        text: "Debes habilitar las ventanas emergentes para poder proceder al pago"
      });
    }
  </script>
@endif
@endsection
