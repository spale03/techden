<?php
include 'sessionizer.php';
session_destroy();

header("Location:index.php");
