# akvan

Интернет-магазин строительных материалов
CMS: Opencart
Используемые технологии: PHP5, MySQL, Docker

Рекомендации по запуска сайта локально в докере (https://www.docker.com/):
- перейти в папку docker
- набрать в терминале: docker-compose up -d --build
- проверка статуса запущенных сервисов в докере: docker-compose ps (должны быть запущены сервисы mysql и web)
- в файл /etc/hosts добавить запись для домена, на котором запущен сайт в докере:
sudo nano /etc/hosts
127.0.0.1 akvan.local

Перед началом работы с сайтом необходимо утсановить права на папку storage:
chmod 777 -R /path_to_project/public_html/system/storage

Сайт будет доступен по адресу : http://akvan.local/
Доступ в админзону: http://akvan.local/admin
admin / akvan2017

При запуске в докере стартует сервис mysql и загружается дамп базы сайта
Доступ администратора базы: root / 111
Пользователь базы сайта: akvan_user / 111
Дамп базы лежит по адресу /path_to_project/docker/mysql_init/db_akvan.sql
