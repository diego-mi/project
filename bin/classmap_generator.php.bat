@ECHO OFF
SET BIN_TARGET=%~dp0/../vendor/zendframework/zendframework/bin/classmap_generator.php
php "%BIN_TARGET%" %*
