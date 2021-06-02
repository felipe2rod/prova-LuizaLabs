<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Seus dados:</h2>
    <p>Nome: {{ $name }}</p>
    <p>Sexo: {{ $sex }}</p>
    <p>E-mail: {{ $email }}</p>
    <p>CPF: {{ $cpf }}</p>
    <p>Observação: {{ $observation }}</p>
    <p>Meio de pagamento: {{ $pay_method }}</p>
    <br />
    <br />
    <h2>Seu Pedido:</h2>
    @foreach ($itens as $item)
      <ul>
        <li>
          Produto: {{ $item['product']['name']}}
        </li>
        <li>
          Tamanho: {{ $item['product']['size']}}
        </li>
        <li>
          Cor: {{ $item['product']['color']}}
        </li>
        <li>
          Preço do produto: {{ $item['product']['price']}}
        </li>
        <li>
          Quantidade: {{ $item['quantity']}}
        </li>
        <li>
          Preço total: {{ $item['product']['price'] *  $item['quantity']}}
        </li>
      </ul>
    @endforeach
    <br />
    <br />
    <h2>Valor Total do pedido:</h2>
    <p>{{ $total_value }}</p>
  </body>
</html>
