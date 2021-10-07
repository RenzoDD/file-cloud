<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Configuration file
 */

define("EM_HOST", "");    //Mail server address
define("EM_PORT", 465);   //Email Port
define("EM_SAVE", "ssl"); //Encryption

define("DB_HOST", "localhost"); //Database server address
define("DB_NAME", "file_cloud"); //Database name
define("DB_USER", "root"); //Database user
define("DB_PASS", ""); //Database password

define("GA_CODE", ""); //Universal Analytics Code

define("PK_reCAPTCHA_v2", ""); //reCAPTCHA v2 public key
define("SK_reCAPTCHA_v2", ""); //reCAPTCHA v2 private key

define("PK_reCAPTCHA_v3", ""); //reCAPTCHA v3 public key
define("SK_reCAPTCHA_v3", ""); //reCAPTCHA v3 private key

define("__MODEL__", __DIR__ . "/mvc/models");
define("__VIEW__", __DIR__ . "/mvc/views");
define("__CONTROLLER__", __DIR__ . "/mvc/controllers");

define("__FILES__", __DIR__ . "/files");

define("__ROUTE__", explode("?", $_SERVER['REQUEST_URI'])[0]);
?>