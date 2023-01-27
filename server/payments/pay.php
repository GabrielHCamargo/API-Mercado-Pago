<?php

    header('Access-Control-Allow-Origin: *');

    // SDK de Mercado Pago
    require __DIR__ .  '/vendor/autoload.php';

    if(
        isset($_REQUEST['quantidade']) && 
        isset($_REQUEST['preco']) && 
        isset($_REQUEST['currency']) && 
        isset($_REQUEST['access_key'])
    ) {

        $quantidade = $_REQUEST['quantidade'];
        $preco = $_REQUEST['preco'];
        $currency = $_REQUEST['currency'];
        $access_key = $_REQUEST['access_key'];

        $access_token = 'SEU ACCESS TOKEN';

        // Configura credenciais
        MercadoPago\SDK::setAccessToken($access_token);

        // Cria um objeto de preferência
        $preference = new MercadoPago\Preference();

        // Cria um item na preferência
        $item = new MercadoPago\Item();
        $item->title = 'SEU PRODUTO';
        $item->currency_id = $currency;
        $item->quantity = $quantidade;
        $item->unit_price = $preco;
        $preference->items = array($item);
        
        // URLs de retorno de status
        $preference->back_urls = array(
            "success" => 'https://api.seusite.com/pay/notification.php',
            "failure" => 'https://api.seusite.com/pay/notification.php',
            "pending" => 'https://api.seusite.com/pay/notification.php'
        );

        //Notificações de pagamento
        $preference->notification_url = 'https://api.seusite.com/pay/notification.php';
        $preference->external_reference = 'SEU PRODUTO';

        $preference->save();

        $link = $preference->init_point;

        echo (
            json_encode(
                array(
                    "link" => $link
                )
            )
        );

    } else {

        header("HTTP/1.0 404 Not Found");

    }
    
?>
