Add the following lines to your hosts file (/etc/hosts in Linux/Mac OS c:\Windows\System32\Drivers\etc\hosts in Windows):
```
127.0.0.1   dd.local
```
First change to .docker directory
````
cd .docker

Build -> docker-compose up --build
Stop -> docker-compose down or ctrl + c in --build terminal
````


### MySql

http://localhost:9001

Сервер: database

Пользователь: root

Пароль: root

### Route
Username/Password: alif/secret

http://dd.local/

```
if You use Linux and after Route you got 500 error
uncomment inside cmd.sh 
```
#500 error for
#sudo chmod -R 755 laravel_blog
#chmod -R o+w laravel/storage

```
if migrations failed to follow tips
```

```
cd cmd.sh

sleep 40 change to sleep 70 80 or 90

it depends on your comp operation system memory
```


BIRTHDAY USER КАК ИСПОЛЬЗОВАТЬ СНАЧАЛО НАСТРОИТЬЕ 

.env file

```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```






Здесь я покажу вам, как настроить команду задания cron на сервере. вам нужно установить crontab на сервер. если вы используете сервер Ubuntu, то он уже установлен
```
crontab -e
```
Теперь добавьте следующую строку в файл crontab. убедитесь, что вам нужно правильно указать путь к проекту

```
php artisan schedule:run
```

