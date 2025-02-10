<?php

define('BASE_PATH', '/Application_Forms/'); 

function getDashboardPath() {
    return BASE_PATH . 'admin/dashboard.php';
}

function getItem_ListPath() {
    return BASE_PATH . 'admin/item_list.php';
}

function getStockPath() {
    return BASE_PATH . 'admin/stocks.php';
}

function getLogOutPath() {
    return '../logout.php'; 
}


function getProfilePath() {
    return BASE_PATH . 'admin/profile.php';
}
