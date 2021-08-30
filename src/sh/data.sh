
 #!/bin/bash
 # crea una copia de seguridad de una base de datos y la envía a una dirección de correo electrónico
 ########################
 ##### variables a editar
 #
 DB_USER=root
 DB_PASS=Jitech40854085
 DB_NAME=daniel
 BACKUP_DIR=/home/jitech/
 MESSAGE_FILE=backup.mail.message # colocar este archivo en BACKUP_DIR
 USER_MAIL=rasta4ever09@hotmail.com
 #
 ##### fin de variables a editar
 ########################
 BACKUP_FILE=${BACKUP_DIR}$(date +%Y%m%d)-${DB_NAME}.sql
 # usamos mysqldump para hacer la copia de seguridad que se guarda en BACKUP_DIR
 mysqldump --opt -u ${DB_USER} -p${DB_PASS} ${DB_NAME} > ${BACKUP_FILE}
 # usamos bzip2 para comprimir el sql
 bzip2 ${BACKUP_FILE}
 # usamos mutt para enviar por correo electrónico el archivo sql
 mutt -s "Copia de seguridad base de datos ${DB_NAME}: $(date +%B) de $(date +%Y)" ${USER_MAIL} -a ${BACKUP_FILE}.bz2 < ${BACKUP_DIR}${MESSAGE_FILE}
