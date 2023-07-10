## Описание сервиса
Сервис с единственным API методом, возвращающим срез последовательности чисел
из ряда Фибоначчи и простым UI для проверок. Сервис записывает вычисленную последовательность в кэш (Redis).
Если запрашиваемая последовательность частично или полностью пересекается с тем, что есть в кэше, данные повторно не вычисляются.

## Установка
- Установить docker, docker-compose
- Склонировать проект
- Сбилдить `docker-compose up --build`
- Зайти по роуту `localhost/fibonacci`

## Ограничения
В сервисе есть 2 параметра: from и to - это с какого до какого индекса нужно вернуть последовательность. У них есть следующие ограничения:
- `From > 0`
- `To > From`
- `From:integer`
- `To:integer`
