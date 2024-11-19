<?php
	include_once 'oauth2.php';
	include_once 'getMeas.php';

	$test = getAccessToken();
	$data = getMeas($test)
?>

<html>
	<head>
		<title>Withings Oauth2</title>
	</head>
	<body>
		<h1>Hello world</h1>
		<a href="https://account.withings.com/oauth2_user/authorize2?response_type=code&client_id=a16837aaa8f536b229ce20fa8e90a2739885b640ff67de7b84562b6fe0e27513&redirect_uri=http://localhost:7070&state=withings_test&scope=user.metrics&mode=demo">sign in</a>
		<p>
		<?php
				if (isset($data)) {

					echo 'tu fais ' . $data . 'kg :)';
				}
				?>
		</p>
	</body>
</html>