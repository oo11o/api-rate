#### Directory Structure

```    .
    ├── config                  # Routes та DI конфігурація
    ├── docker                  # Конфігурації для Docker-контейнерів
    ├── public                  # index.php - Front-controller, стартова сторінка
    ├── src
       ├── Controllers          # Контролери, прийом request та видача response
       ├── Handlers             # Обробка Response, JSON 
       ├── Models               # Repository та Модель для Email (email.txt) 
       ├── Services             # Логіка, Обробка даних, Api, Sender
    ├── storage                   # Tools and utilities
  
```

Api - https://www.coingecko.com/


Деякі нюанси, які би хотілось доробити:
 - додати до всіх методів Type Hint
 - встановити причини, чому не спрацьовував в docker-контейнері composer
 - попрацювати з помилками в side effects функціях
