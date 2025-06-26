# Инструкции по синхронизации ProcessWire Templates

Этот репозиторий предназначен для синхронизации шаблонов ProcessWire между несколькими проектами.

## Методы синхронизации

### 1. Git Subtree (Рекомендуемый)

#### Для существующего проекта (как этот):
```bash
# В папке templates вашего проекта
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/popskraft/koriphey-pw-template.git
git branch -M main
git push -u origin main
```

#### Для подключения к новому проекту:
```bash
# В корневой папке нового проекта
cd /path/to/new/project/site/
git subtree add --prefix=templates https://github.com/popskraft/koriphey-pw-template.git main --squash
```

#### Синхронизация изменений:
```bash
# Получить обновления из основного репозитория
git subtree pull --prefix=templates https://github.com/popskraft/koriphey-pw-template.git main --squash

# Отправить изменения в основной репозиторий
git subtree push --prefix=templates https://github.com/popskraft/koriphey-pw-template.git main
```

### 2. Git Submodule (Альтернативный способ)

#### Добавление submodule:
```bash
# В корневой папке проекта
cd /path/to/project/site/
git submodule add https://github.com/popskraft/koriphey-pw-template.git templates
git commit -m "Add templates submodule"
```

#### Синхронизация:
```bash
# Обновить submodule
git submodule update --remote templates

# Зафиксировать изменения
git add templates
git commit -m "Update templates submodule"
```

### 3. Прямая синхронизация (для одной папки)

#### Клонирование в новый проект:
```bash
cd /path/to/new/project/site/
git clone https://github.com/popskraft/koriphey-pw-template.git templates
cd templates
rm -rf .git  # Удалить связь с Git если нужно
```

## Исключения из синхронизации

Файл `.gitignore` настроен для исключения:
- Конфигурационных файлов проекта (`config.codekit3`, `.env`)
- Скомпилированных файлов (`dist/`, `*.min.js`, `*.min.css`)
- Кэша и временных файлов
- IDE файлов
- Системных файлов ОС
- Страниц ошибок (могут быть специфичными для проекта)

## Рабочий процесс

1. **Разработка**: Вносите изменения в любом из подключенных проектов
2. **Коммит**: Фиксируйте изменения локально
3. **Push**: Отправляйте в основной репозиторий
4. **Pull**: Получайте обновления в других проектах

## Конфликты

При возникновении конфликтов:
1. Решите конфликты вручную
2. Зафиксируйте изменения
3. Отправьте в репозиторий

## Автоматизация

Для автоматизации можно создать скрипты:

### sync-pull.sh
```bash
#!/bin/bash
git subtree pull --prefix=templates https://github.com/popskraft/koriphey-pw-template.git main --squash
```

### sync-push.sh
```bash
#!/bin/bash
git subtree push --prefix=templates https://github.com/popskraft/koriphey-pw-template.git main
```

## Примечания

- Всегда делайте резервные копии перед синхронизацией
- Тестируйте изменения на локальном окружении
- Используйте ветки для экспериментальных изменений
- Документируйте специфичные для проекта изменения 