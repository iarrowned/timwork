<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $APPLICATION;
$APPLICATION->SetPageProperty('title', 'Timwork - создать обращение');
global $USER;

if (!$USER->IsAuthorized()) {
    LocalRedirect('/user/', false, '301 Moved Permanently');
}
?>

   <?php
   $APPLICATION->IncludeComponent(
           'custom:form',
           '',
       [

       ]
   );
   ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>