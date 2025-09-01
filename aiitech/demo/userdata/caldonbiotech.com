--- 
customlog: 
  - 
    format: combined
    target: /usr/local/apache/domlogs/caldonbiotech.com
  - 
    format: "\"%{%s}t %I .\\n%{%s}t %O .\""
    target: /usr/local/apache/domlogs/caldonbiotech.com-bytes_log
documentroot: /home3/cbt/public_html
group: cbt
hascgi: 1
homedir: /home3/cbt
ip: 192.185.52.186
owner: root
phpopenbasedirprotect: 1
phpversion: ea-php74
port: 80
scriptalias: 
  - 
    path: /home3/cbt/public_html/cgi-bin
    url: /cgi-bin/
serveradmin: webmaster@caldonbiotech.com
serveralias: www.caldonbiotech.com mail.caldonbiotech.com
servername: caldonbiotech.com
ssl: 1
usecanonicalname: 'Off'
user: cbt
userdirprotect: ''
