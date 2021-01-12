## Projekt grupowy

### Backend

W celu konfiguracji backendu wymagany jest PHP w wersji >= 7.2.5 oraz composer.
Przechodzimy do katalogu backendu, a następnie wykonujemy polecenia:

Instalacja zależności:
`composer install` 

Uruchomienie bazy danych:
`docker-compose up -d`

(można też ręcznie skonfigurować dane do bazy w pliku .env)

Uruchomienie migracji:

`./bin/console doctrine:migrations:migrate`

Po tym polecenie powinny utworzyć się tabele w bazie danych.

Uruchomienie serwera PHP:

`php -S localhost:<port>`

Inicjalizacja danych z API:

`./bin/console app:load:countries` lub w przeglądarce `localhost:<port>/load/countries`

Dokumentacja API:

`localhost:<port>/api/doc`

### Frontend

Instrukcja znajduje się wewnątrz katalogu frontend.