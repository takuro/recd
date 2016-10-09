<!DOCTYPE html>
<html lang='ja'>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo SITE_NAME; ?></title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
	<link href="styles/user.css" rel="stylesheet" />
</head>
<body>
  <div class="container mdl-layout mdl-js-layout mdl-layout--fixed-header">

    <header id="global-header" class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <a class="mdl-layout-title" href="./index.php"><?php echo SITE_NAME; ?></a>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation. We hide it in small screens. -->
        <nav class="mdl-navigation mdl-layout--large-screen-only">
          <?php
            if ($session->has_session()) {
          ?>
          <ul class="mdl-mini-footer__link-list">
            <li><a href="index.php?session=logout">Logout</a></li>
          </ul>
          <?php
            }
          ?>
        </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title"><?php echo SITE_NAME; ?></span>
      <nav class="mdl-navigation">
        <?php
          if ($session->has_session()) {
        ?>
        <ul class="mdl-mini-footer__link-list">
          <li><a href="index.php?session=logout">Logout</a></li>
        </ul>
        <?php
          }
        ?>
      </nav>
    </div>

