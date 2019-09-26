echo off

FOR /F "tokens=1,2,3 delims=/ " %%i IN ('date /T') do (set DIA= %%k%%j%%i)
FOR /F "tokens=1,2 delims=: " %%n IN ('time /T') do (set HORA= %%n%%o) 

C:\xampp\mysql\bin\mysqldump.exe -h localhost -u root -p pizzanova -R> C:\Users\wwwge\Desktop\copia_pizzanova_"%dia%_%hora%".sql
exit