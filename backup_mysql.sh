USER="artermes27"
PASSWORD="Ubuntu2025"
Database="main_v2"

BACKUP_DIR="/home/artermes27/backups"
DATE=$(date +%F)
BACKUP_FILE="${BACKUP_DIR}/${DATABASE}_${DATE}.sql"

mkdir -p $BACKUP_DIR

mysqldump -u$USER -p$PASSWORD > $BACKUP_FILE

find $BACKUP_DIR -type f -name "*.sql" -mtime +7 -exec rm{} \;
