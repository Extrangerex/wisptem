#!/bin/sh
if uname -a | grep FreeBSD | grep -v grep
then
PHP_EXECUTABLE="/usr/local/bin/php"
SCRIPT_DIRECTORY="/usr/local/www/data-dist/admin"
SCRIPT_NAME="status.php"
PS_OP="-auxww"
else
PHP_EXECUTABLE="/usr/bin/php"
SCRIPT_DIRECTORY="/var/www/admin"
SCRIPT_NAME="status.php"
PS_OP="-fea"
fi
if ps $PS_OP | grep $SCRIPT_NAME | grep -v grep
then
echo "Tarea solapada"
else
$PHP_EXECUTABLE $SCRIPT_DIRECTORY"/"$SCRIPT_NAME > /dev/null 2>&1
fi