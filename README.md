1. Чтобы установить все необходимые зависимости вашего проекта, выполните команду composer install
2. Создание файла .env и настройка подключения к базе данных:
3. make .env file and write in the file db setting  - можно взять за пример .env.example
4. php artisan storage:link - Создание символической ссылки для доступа к хранилищу: чтобы создать символическую ссылку на папку storage/app/public. Это позволит обращаться к файлам в папке storage через URL.
5. php artisan migrate (--seed) -Выполнение миграций и заполнение базы данных 
