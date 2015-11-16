@ECHO OFF
SET BIN_TARGET=%~dp0/../backplane/phpunit/phpunit
php "%BIN_TARGET%" %*
