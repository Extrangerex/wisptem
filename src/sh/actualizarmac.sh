#!/bin/bash
if uname -a | grep FreeBSD | grep -v grep
then
PHP_EXECUTABLE="/usr/local/bin/php"
SCRIPT_DIRECTORY="/var/www/admin/html/pages/Ajax/actualizarmac.php"
else
PHP_EXECUTABLE="/usr/bin/php"
SCRIPT_DIRECTORY="/var/www/admin/html/pages/Ajax/actualizarmac.php"
fi
while true
do
$PHP_EXECUTABLE $SCRIPT_DIRECTORY > /dev/null 2>&1
sleep 1

done
fi