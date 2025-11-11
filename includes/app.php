<?php  

require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// connecting to bd
use Model\ActiveRecord;
ActiveRecord::setDB($db);