<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check the integrity of a file</title>
    <link rel="stylesheet" href="style/app.css">
    <link rel="icon" href="icon.png" >
<body>
<div class="flex">
    <h1>Check the integrity of a file</h1>
    <form method="post" enctype="multipart/form-data" class="">
        <div>
            <input type="file" name="file" required>
        </div>
        <div>
            <label for="hash">Hash</label>
            <input id="hash" type="text" name="hash" autocomplete="off">
        </div>
        <div>
            <input type="submit" class="btn btn-primary" value="Valider" name="send">
        </div>
    </form>

    <?php if (!empty($_FILES) && isset($_FILES['file']) && $_FILES['file']['error'] === 0) : ?>
        <?php $algos = require 'algo.php'; ?>
        <div class="algo">
            <?php foreach ($algos as $algo) {
                $hash_file = hash_file($algo, $_FILES['file']['tmp_name']);
                echo '<p>';
                if(isset($_POST['hash']) && trim($_POST['hash']))
                    echo strcasecmp(trim($_POST['hash']),$hash_file) === 0 ? "&#9989;" : "&#10060;";
                echo "$algo : " .$hash_file . "</p>";
            }
            ?>
        </div>
    <?php endif ?>
</div>
</body>
</html>
