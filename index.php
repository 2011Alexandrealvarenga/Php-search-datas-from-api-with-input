<?php
// Sample array
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

// Initialize result variable
$result = null;

// Check if the form has been submitted
if (isset($_POST['search'])) {
    $input = $_POST['search'];
    
    // Function to search for a name in the array
    function searchArray($array, $input) {
        $matches = [];
        foreach ($array['data'] as $item) {
            if (stripos($item['title'], $input) !== false) {
                $matches[] = $item; // Collect all matches found
            }
        }
        return $matches; // Return all matches
    }

    // Call the search function
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
