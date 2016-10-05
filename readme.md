# Initial setup

<VirtualHost *:80>
       ServerAdmin admin@grocilist.dev
       DocumentRoot "C:/xampp/htdocs/grocilist/public"
       ServerName grocilist.dev
       ErrorLog "logs/grocilist.dev-error.log"
   CustomLog "logs/grocilist.dev-access.log" common
       <Directory "C:/xampp/htdocs/grocilist/public">
           Order allow,deny
        Allow from all
        Require all granted
   AllowOverride All
       </Directory>
</VirtualHost>
