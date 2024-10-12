<?php 

$url = "https://api.giphy.com/v1/gifs/trending?api_key=pLURtkhVrUXr3KG25Gy5IvzziV5OrZGa";
$response = file_get_contents($url);

if ($response !== false) {
    $data = json_decode($response, true);
    ?>
    <pre>
      <?php //var_dump($data);?>
    </pre>
    <?php 
} else {
    echo "Error fetching data.";
}

;?>