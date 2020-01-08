create schema birdsoffeathers;

CREATE USER 'bof_app_user'@'%' IDENTIFIED WITH mysql_native_password BY 'birdsoffeathers';


GRANT ALL PRIVILEGES ON birdsoffeathers.* To 'bof_app_user'@'%';

FLUSH PRIVILEGES;
