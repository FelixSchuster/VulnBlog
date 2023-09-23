<div class="container">
    <div class="row">
        <h1>Home</h1>
    </div>
        <?php
		if(isset($_GET['url'])) {
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $_GET['url']);
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET' );
		    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		    curl_setopt($ch, CURLOPT_USERPWD, "TopSecretApiKey!");
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    $image = json_decode(curl_exec($ch), 1);
		    echo "<img src='" . $image['message'] . "'/>";
		}
        ?>
</div>
