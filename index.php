<?php 
   
    require_once __DIR__ . '/vendor/autoload.php';
    use Symfony\Component\HttpFoundation\Session\Session;
    $session = new \Symfony\Component\HttpFoundation\Session\Session();
    $session->start();
    
    $artistQuery = new \Itp\Music\artistQuery();
    $artists = $artistQuery->getAll();
    
    $genreQuery = new \Itp\Music\genreQuery();
    $genres = $genreQuery->getAll();
    




    
    if (isset($_POST['submit'])) {
        
       
        $title = $_POST['title'];
        $artist_Id = $_POST['artist'];
        $genre_Id = $_POST['genre'];
        $price = $_POST['price'];
        
        $song = new \Itp\Music\song();
        $song->setTitle($title);
        $song->setArtistId($artist_Id);
        $song->setGenreId($genre_Id);
        $song->setPrice($price);
        $song->save();
        
        $message = "<center><p class='message'> The song: ". $song->getTitle()." with ID: ". $song->getId()." was inserted successfully</p></center>";        
	$session->getFlashBag()->add('contact-success', $message);      
        header('Location: index.php');
        exit;          
        

    }    
    
    
    
    
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Songs</title>
	<link rel="stylesheet" href="main.css">        
    </head>
    <body style="text-align: center; padding-top: 10%;">
        <?php foreach ($session->getFlashBag()->get('contact-success') as $message) : ?>
                <p><?php echo $message ?></p>
        <?php endforeach; ?>        
        <form action="index.php" method="POST">
            <input type="text" name="title" class="songInput" placeholder="Song Title">
            <select name="artist" style="height: 200px;">
                <?php foreach($artists as $artist) : ?>
                    <option value="<?php echo $artist->id ?>">
                        <?php echo $artist->artist_name ?>
                    </option>
                <?php endforeach ?>                    
            </select>
            <select name="genre">
                <?php foreach($genres as $genre) : ?>
                    <option value="<?php echo $genre->id ?>">
                        <?php echo $genre->genre ?>
                    </option>
                <?php endforeach ?>                    
            </select> 
            <input type="text" name="price" class="songInput" placeholder="Price"> 
            <input type="submit" name="submit" value="Add!" class="addButton">            
        </form>
    </body>
</html>

