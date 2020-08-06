<!DOCTYPE html>
<html>

<head>
  <title></title>
  <meta charset="utf-8">
</head>

<body>
  <h1>Hola, se ha generado la orden de compra con numero </h1>
  <table>
    <thead>
      <tr>
        <td>recipient_name</td>
        <td>line1</td>
        <td>line2</td>
        <td>city</td>
        <td>postal_code</td>
        <td>state</td>
        <td>country_code</td>
        <td>total</td>
        <td>guide_number</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>recipient_name</td>
        <td>line1</td>
        <td>line2</td>
        <td>city</td>
        <td>postal_code</td>
        <td>state</td>
        <td>country_code</td>
        <td>{{$order->total}}</td>
        <td>guide_number</td>
      </tr>
    </tbody>
  </table>
  <table>
    <thead>
      <tr>
        <td>producto</td>
        <td>Valor</td>
      </tr>
    </thead>
    <tbody>

      @foreach($products as $product)
      <tr>
        <td>{{$product->title}}</td>
        <td>{{$product->pricing}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>