
**Ответы на вопросы**
1. Если баннер отдается потоком со скрипта, то в самом скрипте мы можем произвести 
и определение уникальности пользователя и манипулировать счетчиком показов.
Например, если у нас баннер это сущность типа Banner, то у нее можно завести 
свойство showCount и инкрементировать ее при каждом выводе баннера в браузер.
Количество уников можно сделать так же как и общее число показов, 
через отдельное свойство-счетчик, но инкрементировать его, предварительно определив уникальность 
посетителя, через какую-либо, глобальную для проекта, систему отслеживания 
уникальности пользователя.
Эту же систему можно использовать в других подсистемах проекта для различных инфографик статистики. Сама подсистема определения уникальности посетителя может базироваться на различных показателях посетителя типа IP, UserAgent, идентификатора сессии, кукисах.

2. Струткура таблиц:

Таблица проектов: **projects**

| id | project_name |
|---|---|
|1 |first project |
|2 |second project|

Таблица должностей: **positions**

|id|position|
|---|---|
|1|programmer|
|2|tester|
|3|manager|

Таблица работников: **employees**

|id|name|position_id|project_id|
|---|---|---|---|
|1|Petya|1|1|
|2|Petya|1|1|
|3|Petya|1|1|
|4|Petya|1|2|
|5|Petya|2|1|
|6|Petya|2|2|
|7|Petya|3|1|
|8|Petya|3|1|
|9|Petya|3|1|
|10|Petya|3|2|
|11|Petya|3|2|

Запрос
```mysql
SELECT
    p.project_name,
    COUNT(e.id) as progCount
FROM  projects p
          LEFT JOIN employees e ON e.project_id = p.id
          LEFT JOIN positions pos ON e.position_id = pos.id
WHERE pos.position = 'programmer'
GROUP BY p.project_name
HAVING progCount >= 3
```

#3 задание

***Проект на symfony 5***
- БД SqLite
- composer install как обычно
- Поднять базу "./bin/console doctrine:database:create"
- Запустить миграции "./bin/console doctrine:migration:migrate"
- Заполнить демо-данными "./bin/console doctrine:fixtures:load"

Само задание выполнено через консольную команду "./bin/console app:parseProperties", это сделано для того, что бы можно было запускать в фоне на кроне или через систему очередей, т.к. на больших каталогах может выполнятся долго.

Структура таблиц немного дополнена, новая сущность категорий товаров с привязкой к товарам.

Общая структура:
- Есть сервис парсинга наименований товаров ParseProductTitleToPropertiesService, есть интерфейс ProductTitleParserInterface, есть конкретные модули парсинга, реализующие этот интерфейс.
- фреймворк сконфигурирован так, что все классы, реализующие интерфейс ProductTitleParserInterface, помечаются тегом service.product_title_parser. Далее в сервис ParseProductTitleToPropertiesService все эти классы передаются в первый аргумент итератором.
- В каждом модуле парсинга, через метод supports, идет прикрепление модуля парсинга к категориям товаров через поле code у категории товара. Таким образом можно на разные категории товаров навесить разные модули парсинга
- Регулярное выражение разбито на секции, для удобной правки и доработки
- Поменять БД не сложно, это реализуется самим фреймворком, добавить запись в файл можно прямо по месту в команде, это не сложная доработка.


Принцип работы:
1. Команда парсинга ищет все товары, обходит в цикле
2. Вызывает сервис парсинга наименований, передавая товар
3. Сервис парсинга, приняв товар, смотрит код категории товара
4. Обходит в цикле модули парсинга, проверяя есть ли код категории в поддерживаемых категориях, через метод supports
5. если модуль парсинга найден, отдает ему товар
6. Модуль парсинга через регулярное выражение вытаскивает данные из наименования 
7. Через именованные подгруппы, конструирует имя сеттера
8. Вызывает сеттер у объекта свойств товара
9. Если регулярка не срабатывает, вызывает сеттер и проставляет признак неправильности наименования
9. все это возвращается в команду, где происходит подсчет правильных и неправильных наименований
10. Происходит слив(flush) данных в БД.



