<?php
/*
CONSUMI DADOS DE ARRAY ... AGORA PRECISO FAZER COM API


$data = [
    ['id' => 1, 'name' => 'Alice'],
    ['id' => 2, 'name' => 'Bob'],
    ['id' => 3, 'name' => 'Charlie'],
];

*/


// dados da api
$url = "https://api.giphy.com/v1/gifs/trending?api_key=pLURtkhVrUXr3KG25Gy5IvzziV5OrZGa";
$response = file_get_contents($url);

if ($response !== false) {
    $data = json_decode($response, true);
} else {
    echo "Error fetching data.";
}
// dados da api

$result = null;

if (isset($_POST['search'])) {
    $input = $_POST['search'];
    
    function searchArray($array, $input) {
        $matches = [];
        foreach ($array['data'] as $item) {
            if (stripos($item['title'], $input) !== false) {
                $matches[] = $item;
            }
        }
        return $matches; 
    }

    $result = searchArray($data, $input);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Example</title>
</head>
<body>
    <p>List</p>
    <ul>
        <?php foreach ($data['data'] as $item): ?>
            <li><?php echo htmlspecialchars($item['title']); ?></li>
        <?php endforeach; ?>
    </ul>
    <hr>
    <h1>Search</h1>
    <form method="POST">
        <input type="text" name="search" placeholder="Type a name..." required>
        <button type="submit">Search</button>
    </form>

    <?php if ($result !== null): ?>
        <h2>Results:</h2>
        <?php if (count($result) > 0): ?>
            <ul>
                <?php foreach ($result as $item): ?>
                    <li><?php echo htmlspecialchars($item['title']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No matches found.</p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>
