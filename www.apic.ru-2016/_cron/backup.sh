#!/bin/csh

echo "--------------------------------------"`date +%Y%m%d-%H:%M:%S`
foreach DB ( apic2016 )
	echo "Processing DB=$DB"
	set CURTIME=`date +%Y%m%d-%H%M%S`
	set A1="/www/www.apic.ru-2016/_backup/$DB-from-`hostname`-$CURTIME.sql"
	/usr/local/bin/mysqldump -uroot  --default-character-set=cp1251 --add-drop-table $DB > $A1
	ls -la $A1
	gzip $A1
end
echo "Finished!"
echo "--------------------------------------"`date +%Y%m%d-%H:%M:%S`
