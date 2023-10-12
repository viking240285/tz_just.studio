## Краткое описание проекта

Проект собран на основе Bedrock (https://roots.io/bedrock), который расширяет функциональность Wordpress,
при этом структура файлов меняется относительно дефолтной установки Wordpress.

## Задачи

1. Установить данный проект

    **Подсказка:** Для того, чтобы проект корректно запустился ваш веб-сервер должен быть настроен так, чтобы он смотрел не на корень проекта, а на папку `/web`, иначе вы получите ошибку
    

2. Загрузить дамп базы данных из папки database (домен сайта может отличаться)


3. Установить плагин ACF. используя возможности Bedrock, чтобы при разворачивании нового проекта плагин был уже
   установлен (был в папке plugins)


6. Скрыть в меню админ-панели пункты: Комментарии, Медиафайлы, Записи


5. Реализовать с использованием кастомного типа записей каталог автомобилей по следующим требованиям. 
    - Создание и настройку кастомного типа записей необходимо реализовать кодом (не используя для его создания ACF)
    - Каждое авто должно содержать поля:
        - Модель,
        - Фото,
        - Бренд,
        - Год выпуска (число),
        - Тип двигателя (Значения: Бензиновый, Дизельный, Электрический),
        - Трансмиссия (Значения: Автоматическая, Ручная, Роботизированная) - показывается только если выбран тип
          двигателя "Бензиновый или Дизельный"
        - Запас хода в км - показывается только если выбран тип двигателя "Электрический"
    - Поля можно реализовать как стандартными средствами, так и используя ACF
    - Бренд авто должен задаваться через кастомную таксономию, к авто можно прикрепить только один бренд


8. **НЕ ОБЯЗАТЕЛЬНО, но будет большим плюсом**, если данные по автомобилю вы сохраните в кастомную
   таблицу `<prefix>_cars_properties` связанную с таблицей `<prefix>_posts` в которой хранятся сами автомобили

    ```
    post_id | car_model | car_brand | image | year | engine_type | transmission_type | range
   ``` 


9. Реализовать в публичной части каталог автомобилей с постраничной навигацией и возможностью отфильтровать записи по
   бренду и году выпуска
    - Адрес каталога должен быть /catalog


10. Реализовать в публичной части детальный просмотр автомобиля

    - Адрес страницы должен быть /catalog/<text-slug>, где text-slug - это уникальный текстовый идентификатор авто
    - На странице должны выводиться все данные, заданные в админке в формате `Свойство: значение`
    - В случае если какое то из значений не заполнено, должен выводиться прочерк
    - При клике на свойства модель или год выпуска, должен осуществляться переход на страницу /catalog с примененным
      фильтром (если кликнули на 2002 год, то должны отобразиться авто только 2002 года)


11. С главной страницы сделать принудительный редирект на страницу с каталогом автомобилей


12. Реализовать REST API средствами для создания, обновления, получения и удаления автомобилей.

    - Использовать структуру адресов
        - `<site_url>/api/catalog` Для получения всех записей
        - `<site_url>/api/manage/cars` Для создания
        - `<site_url>/api/manage/cars/{carId}` Для получения одной записи
        - `<site_url>/api/manage/cars/{carId}` Для обновления записи
        - `<site_url>/api/manage/cars/{carId}` Для удаления записи
    - Для загрузки изображения можно использовать отдельный эндпоинт (на ваше усмотрение)
    - При получении данных должны быть переданы все поля
    - Изображение должно быть передано ссылкой на полное изображение
    - Если какое то свойство не заполнено то должно быть передано значение NULL
    - Коды ответа должны соответствовать HTTP Status Codes

## Результат выполнения тестового задания

- Прислать **архив с кодом** (для уменьшения веса можно удалить папки /vendor, /web/wp и /web/app/uploads - они
  автоматически генерируются)
  - Прислать **архив с актуальной базой данных** для проверки выполнения задания (можно добавить в папку database)
  - По необходимости написать **сопроводительную записку** с информацией о том как развернуть проект, нюансы или всё что
    вы посчитаете важным
  - Если необходимо можно приложить архив с uploads

### Данные для входа в админку

Ссылка для входа: `<Адрес сайта>/wp/wp-admin`

Логин: `bedrock`

Пароль: `123456789`

### Тема проекта

Тема проекта располагается в директории `web/app/themes/juzt-test-theme`, она сейчас пустая, необходимо реализовать
структуру темы

