<?php
function app_configure(\yapf\Config $cfg){
    $cfg->setDebug(false);
    $cfg->setViewExtension('.tpl.php');
    $cfg->setDefaultController('home');
    $cfg->setBasePath('/~zsogdans');
}
