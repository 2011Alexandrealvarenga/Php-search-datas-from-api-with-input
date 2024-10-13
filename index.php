<?php
// dados da api
$url = "https://api.giphy.com/v1/gifs/trending?api_key=pLURtkhVrUXr3KG25Gy5IvzziV5OrZGa";
$response = file_get_contents($url);

if ($response !== false) {
    $data = json_decode($response, true);
} else {
    echo "Error fetching data.";
}
// dados da api
?>
    <pre>
      <?php var_dump($data);?>
    </pre>
<?php 
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
<style>
  .external-content{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  .external-content .content{
    border: 1px solid black;
    margin: 10px;
    width: 500px;
    padding: 8px;
  }
  .external-content .social_media{
    display: flex;
    justify-content: space-between;
  }
  .img_avatar{
    border-radius: 50%;
  }
</style>
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
    <!-- begin - search results -->
    <h2>Results:</h2>
        <div class="external-content">
            <?php if ($result !== null): ?>
                <?php if (count($result) > 0): ?>
                    <?php foreach ($result as $item): ?>
                        <div class="content">
                            <p><?php echo htmlspecialchars($item['title']); ?></p>
                            <!--  -->
                            <a href="<?php echo $item['url'] ;?>">
                                <p>Titulo: <?php echo $item['title'] ;?></p>
                            </a>
                            <p class="">Id: <?php echo $item['id'] ;?></p>
                            <?php           
                                $new_image = $item['images']['480w_still']['url'];            
                                $image_new = substr($new_image, 0, -5);
                            ;?>
                            
                            <img src="<?php echo $image_new ;?>" width="270px" height="270px">
                            <br><br>
                            <hr>
                            <?php $user_data = $item['user']['username'];?>
                            
                                <?php
                                if($user_data){?>
                                    <p>User: <?php echo $user_data;?></p>
                                    <?php 
                                }          
                                ;?>
                            <p>Avatar: <img class="img_avatar" src="<?php echo $item['user']['avatar_url'] ;?>" width="50px" height="50px"></p>
                            <p>Description: <?php echo $item['user']['description'] ;?></p>
                            <p>Social media: </p>
                            <div class="social_media">
                                <a href="<?php echo $item['user']['profile_url'] ;?>">Portfolio </a> 
                                <a href="<?php echo $item['user']['instagram_url'] ;?>">Instagram </a> 
                                <a href="<?php echo $item['user']['website_url'] ;?>">Website </a> 
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No matches found.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <!-- end - search results -->
    <hr>
    <p>Item List</p>
    <ul>
        <?php foreach ($data['data'] as $item): ?>
            <li><?php echo htmlspecialchars($item['title']); ?></li>
        <?php endforeach; ?>
    </ul>
    <hr>

</body>
</html>
