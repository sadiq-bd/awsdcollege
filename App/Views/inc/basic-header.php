<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?php if (!empty($pageTabTitle)) echo $pageTabTitle . ' || '; echo !empty(CONFIG['page']['title']) ? CONFIG['page']['title'] : ''; ?></title>
	<meta content="<?= !empty(CONFIG['page']['description']) ? CONFIG['page']['description'] : '' ?>" name="descriptison">
	<meta content="<?= !empty(CONFIG['page']['keywords']) ? CONFIG['page']['keywords'] : '' ?>" name="keywords">
	<!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
	<!-- Favicons -->
	<link href="<?= !empty(CONFIG['page']['favicon']) ? CONFIG['page']['favicon'] : '' ?>" rel="icon">
	<link href="<?= !empty(CONFIG['page']['favicon']) ? CONFIG['page']['favicon'] : '' ?>" rel="apple-touch-icon">
	<!-- Google Fonts -->
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/css" rel="stylesheet">
	<!-- Vendor CSS Files -->
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/bootstrap.min.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/icofont.min.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/boxicons.min.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/animate.min.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/venobox.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/aos.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/jquery.fancybox.min.css" rel="stylesheet">
	<!-- Main CSS File -->
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/style.css" rel="stylesheet">
	
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css" integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- fontawsome css -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- JS App Config -->
	<script src="<?= CONFIG['base_url'] ?>/resources/scripts/config.js" type="text/javascript"></script>

	<script src="<?= CONFIG['base_url'] ?>/resources/scripts/custom-functions.js"></script>
	<noscript><center style="color:red; font-size:30px">Javascript must be enabled in this browser in order to use this application</center><meta HTTP-EQUIV="refresh" content=0;url="<?= CONFIG['base_url'] ?>/error/noscript"></noscript>
</head>

<body>
	