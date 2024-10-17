<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

include_once 'inc/function.php';

include 'template/frontend/partials/head.php';

include 'template/frontend/partials/header.php';
include 'template/frontend/partials/searchForm.php';
include 'template/frontend/partials/main.php';

include_once 'template/frontend/partials/pageController.php';
include_once 'template/frontend/partials/footer.php';

include 'template/frontend/partials/scripts.php';




require __DIR__ . "/vendor/autoload.php";

use MinasRouter\Router\Route;

// The second argument is optional. It separates the Controller and Method from the string
// Example: "Controller@method"
Route::start("http://localhost:63342/1135.test", "@");

Route::get("/", function() {
    // ...
});

// ... all routes here

// You will put all your routes before this function
Route::execute();