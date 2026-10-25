<header>
    <h1>Форма обратного звонка</h1>
</header>

<div>
    <h2>Информация о заказчике</h2>
    <p>Client id: <?=$client_id?></p>
    <p>Имя: <?=$field_data['name']?></p>
    <p>Почта: <?=$field_data['email']?></p>
    <p>Должность: <?=$field_data['post']?></p>
    <p>Комментарий: <?=$field_data['comment']?></p>
</div>

<div>
    <h2>Дополнительные данные</h2>
    <p>Платформа: <?=$field_data['platform']?></p>
    <p>Стадия проекта: <?=$field_data['project_stage']?></p>
    <p>Отрасль компании: <?=$field_data['field_company']?></p>
    <p>Бюджет: <?=$field_data['budget']?></p>
</div>