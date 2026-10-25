
var _user = {
	'city_ru': document.getElementById('_smartForm').getAttribute('data-city-ru'),
	'city_en': document.getElementById('_smartForm').getAttribute('data-city-en'),
	'country': document.getElementById('_smartForm').getAttribute('data-country')
};

var cityList = ['Абакан', 'Абан', 'Абатский', 'Абрамовский маяк', 'Агата', 'Агаякан', 'Агзу', 'Агинское', 'Агинское', 'Айхал', 'Акша', 'Акьяр', 'Алапаевск', 'Алатырь', 'Алдан', 'Алейская', 'Александров', 'Александров-Гай', 'Александровск-Сахалинский', 'Александровский Шлюз', 'Александровский з-д', 'Александровское', 'Александровское', 'Аллах-Юнь', 'Алтай', 'Алыгджер', 'Амазар', 'Амга', 'Амдерма', 'Анабар', 'Анадырь', 'Анапа', 'Андрея', 'Андрюшкино', 'Анна', 'Антипаюта', 'Анучино', 'Апатиты', 'Апука', 'Аргаяш', 'Арзгир', 'Арка', 'Армавир', 'Армань', 'Арсеньев', 'Артезиан', 'Артем', 'Артемовск', 'Артемовский', 'Архангельск', 'Архара', 'Аршан', 'Аскиз', 'Астраханка', 'Астрахань', 'Ахты', 'Ачинск', 'Аян', 'Бабаево', 'Бабушкин', 'Баган', 'Багдарин', 'Баево', 'Байдуков', 'Байкальск', 'Байкит', 'Бакалы', 'Бактор', 'Бакчар', 'Балаганск', 'Баладек', 'Балаково', 'Балахта', 'Балашов', 'Балей', 'Балтийск', 'Балыгычан', 'Барабаш', 'Барабинск', 'Бараниха', 'Баргузин', 'Баргузинский Заповедник    \t', 'Барзас', 'Барнаул', 'Батагай', 'Батагай-Алыта', 'Батамай', 'Батомга', 'Батурино', 'Бахта', 'Баяндай', 'Беклемишево', 'Белая Гора', 'Белая глина', 'Белгород', 'Белово', 'Белогорка', 'Белогорск', 'Белозерск', 'Белый Яр', 'Белый', 'Беля', 'Бердигестях', 'Березники', 'Березняки', 'Березовка', 'Березово', 'Березово', 'Бестяхск', 'Бея', 'Бийск', 'Бийск-Зональная', 'Бикин', 'Билибино', 'Биробиджан', 'Бирск', 'Бисер', 'Бисер', 'Бисерть', 'Бичевая', 'Бичура', 'Благовещенск', 'Благодарный', 'Богородское', 'Боготол', 'Богучаны', 'Бодайбо', 'Боковская', 'Бологое', 'Болотное', 'Болхов', 'Большая Глушица', 'Большая Лепринда', 'Большая Мурта', 'Большерецк', 'Большеречье', 'Большие Кайбицы', 'Большие Уки', 'Большое Голоустное', 'Большой Он', 'Большой Порог', 'Большой Улуй', 'Бомнак', 'Бор', 'Борзя', 'Борисоглебск', 'Борогонцы', 'Бохан', 'Бохапча', 'Братолюбовка', 'Братск', 'Братск', 'Бреды', 'Бродокалмак', 'Брохово', 'Брянск', 'Бугрино', 'Бугульма', 'Бугуруслан', 'Буденновск', 'Бузулук', 'Буй', 'Буйнакск', 'Букукун', 'Бурукан', 'Бухта Амбарчик', 'Бухта Провидения', 'Буяга', 'Быково', 'Бысса', 'Вайда Губа', 'Вал', 'Валькаркай', 'Ванавара', 'Ванжиль-Кынак', 'Ваховск', 'Великие Луки', 'Великий Новгород', 'Великий Устюг', 'Вельмо', 'Вельск', 'Венгерово', 'Верещагино', 'Верещагино', 'Верхневилюйск', 'Верхнее Дуброво', 'Верхнее Пенжино', 'Верхнеимбатск', 'Верхний Амыл', 'Верхний Баскунчак', 'Верхний Уфалей', 'Верхняя Гутара', 'Верхняя Тойма', 'Верхняя Томь', 'Верховье Умри', 'Верховье р. Лотты', 'Верховье', 'Верхотурье', 'Верхоянск', 'Верхоянский Перевоз', 'Веселая Горка', 'Весляна', 'Ветлуга', 'Викулово', 'Вилюйск', 'Винницы', 'Висим', 'Витим', 'Владивосток', 'Владикавказ', 'Владимир', 'Внуково', 'Водопадная', 'Вожега', 'Вознесенье', 'Волгоград', 'Волжская ГМО', 'Волово', 'Вологда', 'Волоколамск', 'Волосово', 'Волчиха', 'Воньеган', 'Воркута', 'Ворогово', 'Воронеж', 'Воскресенское', 'Восток', 'Восточная', 'Воткинск', 'Вохма', 'Вуктыл', 'Выборг', 'Выкса', 'Вытегра', 'Вышний Волочек', 'Вяземская', 'Вязники', 'Вязьма', 'Вятские Поляны', 'ГМО им. Е.К.Федорова', 'ГМО им. Е.Т.Кренкеля', 'Гагарин', 'Гайны', 'Гамов', 'Гари', 'Гвасюги', 'Гдов', 'Геленджик', 'Георгиевка', 'Гигант', 'Гижига', 'Глазов', 'Глубинное', 'Голышманово', 'Горекацан', 'Горин', 'Горно-Алтайск', 'Городище', 'Городовиковск', 'Горячий Ключ', 'Горячинск', 'Готня', 'Гоуджекит', 'Гридино', 'Грозный', 'Губа Дроздовка', 'Губаха', 'Гуга', 'Гусь-Хрустальный', 'Гыдоямо', 'Далматово', 'Дальнереченск', 'Даниловка', 'Дарасун', 'Даровское', 'Двинский Березняк', 'Дебессы', 'Делянкир', 'Демьянское', 'Депутатский', 'Дербент', 'Джалинда', 'Джалинда', 'Джана', 'Джарджан', 'Джека Лондона', 'Джикимда', 'Джубга', 'Дзержинское', 'Дивное', 'Дмитров', 'Дмитровск-Орловский', 'Дно', 'Довольное', 'Должанская', 'Долиновка', 'Домодедово', 'Доно', 'Дорожный', 'Дуван', 'Дудинка', 'Егорьевск', 'Ейск', 'Екатеринбург', 'Екатерино-Никольское', 'Елабуга', 'Елань', 'Елатьма', 'Елец', 'Емеск', 'Енисейск', 'Ербогачен', 'Ермаковское', 'Ерофей Павлович', 'Ершов', 'Ессей', 'Ефимовская', 'Ефремов', 'Железнодорожный', 'Жердевка', 'Жигалово', 'Жиганск', 'Жижгин', 'Жиздра', 'Жуковка', 'Забайкальск', 'Завитая', 'Залари', 'Замакта', 'Заметчино', 'Зареченск', 'Заринск', 'Зашеек', 'Заярск', 'Звериноголовское', 'Здвинск', 'Зерноград', 'Зея', 'Зилаир', 'Зима', 'Зимовники', 'Златоуст', 'Змеиногорск', 'Золотой', 'Зырянка', 'Иваново', 'Ивдель', 'Игарка', 'Игнашино', 'Игрим', 'Идринское', 'Ижевск', 'Ижма', 'Ика', 'Илирней', 'Иловля', 'Ильинский', 'Им. М.В. Попова', 'Им. Полины Осипенко', 'Им.Е.К.Федорова', 'Инга', 'Индига', 'Индигирская', 'Инза', 'Инсар', 'Иоли', 'Ирбейское', 'Ирбит-Фомино', 'Иркутск', 'Исилькуль', 'Исить', 'Искитим', 'Ича', 'Ишим', 'Иэма', 'Йошкар-Ола', 'Кабанск', 'Кавалерово', 'Казань', 'Казачинское', 'Казачинское', 'Казым', 'Казыр', 'Кайластуй', 'Калакан', 'Калач', 'Калачинск', 'Калгачиха', 'Калевала', 'Калининград', 'Калининск', 'Калуга', 'Каменск-Уральский', 'Каменск-Шахтинский', 'Каменское', 'Камень-на-Оби', 'Камышлов', 'Канадей', 'Канаш', 'Кандалакша', 'Каневка', 'Каневская', 'Канин Нос', 'Канку', 'Канск', 'Кантегир', 'Каньон', 'Карасук', 'Каратузское', 'Карафтит', 'Карачев', 'Каргасок', 'Каргат', 'Каргополь', 'Карпогоры', 'Карталы', 'Карымская', 'Катав-Ивановск', 'Катанда', 'Катугино', 'Кача', 'Качуг', 'Кашин', 'Кашира', 'Кашкаранцы', 'Кегали', 'Кедва-Вом', 'Кедон', 'Келлог', 'Кемерово', 'Кемчуг', 'Кемь-Порт', 'Кербо', 'Кизильское', 'Кизляр', 'Килеер', 'Кильмезь', 'Кингисепп', 'Кинешма', 'Киренск', 'Кириши', 'Киров', 'Кировский', 'Кирс', 'Кирсанов', 'Киселевск', 'Клин', 'Клухорский перевал', 'Ключи', 'Ключи', 'Ковда', 'Ковдор', 'Когалым', 'Кожевниково', 'Козыревск', 'Козьмодемьянск', 'Койнас', 'Колба', 'Колгуев Северный', 'Колежма', 'Колмъявр', 'Кологрив', 'Коломна', 'Колпашево', 'Колывань', 'Кольцово', 'Комака', 'Коммунар', 'Комрво', 'Комсомольск-на-Амуре', 'Комсомольский', 'Кондома', 'Кондопога', 'Конево', 'Константиновск', 'Конь-Колодезь', 'Коркодон', 'Корсаков', 'Корф', 'Коса', 'Кослан', 'Кострома', 'Котельнич', 'Коткино', 'Котлас', 'Кочево', 'Коченёво', 'Кочки', 'Кочубей', 'Кош-Агач', 'Крапивино', 'Красная Гора', 'Красногвардейское', 'Краснодар', 'Красное поселение', 'Красное', 'Красноозерск', 'Красноселькупск', 'Краснослободск', 'Красноуфимск', 'Краснощеково', 'Краснощелье', 'Красноярск', 'Красные Баки', 'Красный Кут', 'Красный Холм', 'Красный Чикой', 'Красный Яр', 'Красный Яр', 'Крест-Хальджай', 'Кресты Таймырские', 'Крестях', 'Крещенка', 'Кроноки', 'Кропоткин', 'Крымск', 'Ксеньевская', 'Кубанская', 'Куганаволок', 'Кудымкар', 'Кузедеево', 'Кузьмовка', 'Култук', 'Кулу', 'Кумены', 'Куминская', 'Кунгур', 'Купино', 'Кур', 'Курагино', 'Курган', 'Курейка', 'Курильск', 'Курск', 'Куртамыш', 'Курумкан', 'Курун-Урях', 'Кушва', 'Кущевская', 'Кызыл', 'Кызыл-Озек', 'Кыкер', 'Кыра', 'Кырен', 'Кытлым', 'Кыштовка', 'Кюсюр', 'Кяхта', 'Лабазная', 'Лаган', 'Лазо', 'Лаишево', 'Лальск', 'Ларьяк', 'Лебяжье', 'Лебяжье', 'Лев Толстой', 'Ленинское', 'Ленск', 'Лермонтовка', 'Лесозаводск', 'Леуши', 'Лешуконское', 'Ливны', 'Липецк', 'Лиски', 'Литке', 'Ловозеро', 'Лодейное поле', 'Локшак', 'Лопча', 'Лосиноборское', 'Лукоянов', 'Лысково', 'Лысьва', 'Льгов', 'М. Лопатка', 'Магадан', 'Магдагачи', 'Магнитогорск', 'Мадаун', 'Мазаново', 'Майкоп', 'Майск', 'Максатиха', 'Макушино', 'Малая кема', 'Малиново', 'Малоярославец', 'Малые Дербеты', 'Малые Кармакулы', 'Мама', 'Мангут', 'Маргаритово', 'Мариинск', 'Марково', 'Марресаля', 'Маслянино', 'Матвеев Курган', 'Махачкала', 'Мача', 'Маячный', 'Медвежьегорск', 'Междуреченск', 'Мезень', 'Мелеуз', 'Мельничное', 'Менза', 'Миасс', 'Миллерово', 'Мильково', 'Минеральные воды', 'Минусинск', 'Мирный', 'Михайловск', 'Мичуринск', 'Могзон', 'Могоча', 'Можайск', 'Можга', 'Моздок', 'Молодежная', 'Молчаново', 'Монды', 'Монерон', 'Мончегорск', 'Мопау', 'Моржовая', 'Моржовец', 'Морки', 'Морозовск', 'Моршанск', 'Мосальск', 'Мосеево', 'Москва', 'Мотыгино', 'Мошково', 'Мугур-Аксы', 'Мудьюг', 'Мужи', 'Мурманск', 'Мурмаши', 'Муслюмово', 'Мутный Материк', 'Мухоршибирь', 'Мценск', 'Мыс Алевина', 'Мыс Африка', 'Мыс Белый Нос', 'Мыс Биллингса', 'Мыс Братьев', 'Мыс Кигилях', 'Мыс Костантиновский', 'Мыс Микулкин', 'Мыс Озерный', 'Мыс Салаурова', 'Мыс Стерлигова', 'Мыс Терпения', 'Мыс Уэлен', 'Мыс Шмидта', 'Нагорный', 'Нагорское', 'Надым', 'Назарово', 'Назимово', 'Называевск', 'Нальчик', 'Намцы', 'Напас', 'Наро-Фоминск', 'Нарьян-Мар', 'Находка', 'Начики', 'Невельск', 'Невинномыск', 'Невьянск', 'Нелькан', 'Немчиновка', 'Ненастная', 'Неожиданный', 'Нера', 'Нерой', 'Нерчинск', 'Нерчинский Завод', 'Несь', 'Нефтеюганск', 'Ниванкуль', 'Нижне-Тамбовское', 'Нижне-Усинское', 'Нижнеангарск', 'Нижневартовск', 'Нижнесортымск', 'Нижнеудинск', 'Нижнеянск', 'Нижний Новгород', 'Нижний Тагил', 'Нижний Цасучей', 'Нижний Чир', 'Нижняя Пеша', 'Никель', 'Николаевск-на-Амуре', 'Николаевская', 'Николо-Полома', 'Никольск', 'Никольское', 'Ничатка', 'Новая Ладога', 'Новиково', 'Ново-Александровск', 'Ново-Иерусалим', 'Ново-Касторное', 'Новобирилюссы', 'Новокузнецк', 'Новолазаревская', 'Новороссийск', 'Новоселенгинск', 'Новосибирск', 'Новочунка', 'Новый Васюган', 'Новый Оскол', 'Новый Порт', 'Новый Торьял', 'Новый Уренгой', 'Ноглики', 'Ножовка', 'Нолинск', 'Нора', 'Норильск', 'Норск', 'Ноябрьск', 'Ныврово', 'Ныда', 'Нюрба', 'Нюя', 'Нязепетровск', 'Няксимволь', 'Няндома', 'Обловка', 'Облучье', 'Обоянь', 'Обская ГМО', 'Обьячево', 'Огурцово', 'Одесское', 'Озерки', 'Озерная', 'Озеро Таймыр', 'Озинки', 'Оймякон', 'Октябрьская', 'Октябрьское', 'Окунев Нос', 'Ола', 'Олекминск', 'Оленек', 'Оленья Речка', 'Оловянная', 'Олонец', 'Ольга', 'Омолон', 'Омск', 'Омсукчан', 'Онгудай', 'Онега', 'Опарино', 'Опочка', 'Орджоникидзевская', 'Ордынское', 'Орел', 'Оренбург', 'Орлик', 'Орлинга', 'Оса', 'Оссора', 'Осташков', 'Остров  Айон', 'Остров  Валаам', 'Остров  Вилькицкого', 'Остров  Голомянный', 'Остров  Русский', 'Остров  Спафарьева', 'Остров  Харлов', 'Остров Большой Ушканий', 'Остров Большой Шантар', 'Остров Визе', 'Остров Врангеля', 'Остров Диксон', 'Остров Котельный', 'Остров Преображения', 'Остров Тюлений', 'Острова Дунай', 'Острова Известий', 'Острова Челно-Вершины', 'Оха', 'Оханск', 'Охотничий', 'Охотск', 'Охотский Перевоз', 'Павелец', 'Павлово', 'Павловск', 'Павловский Посад', 'Павловское', 'Павлоградка', 'Паданы', 'Падун', 'Палана', 'Палатка', 'Памятная', 'Пангоды', 'Парабель', 'Партизанск', 'Пачелма', 'Певек', 'Пенза', 'Первомайское', 'Первомайское', 'Перелюб', 'Переславль-Залесский', 'Пермь', 'Петровск', 'Петровский Завод', 'Петрозаводск', 'Петрокрепость', 'Петропавловка', 'Петропавловск-Камчатский', 'Петропавловский Маяк', 'Петрунь', 'Петухово', 'Петушки', 'Печора', 'Пильво', 'Пинега', 'Пионерский', 'Пировское', 'Питляр', 'Погиби', 'Пограничное', 'Пограничный', 'Подгорное', 'Покровка', 'Покровская', 'Полигус', 'Половинное', 'Полтавка', 'Полтавка', 'Полуй', 'Полярный', 'Полярный', 'Помоздино', 'Понил', 'Поныри', 'Поронайск', 'Посевная', 'Поспелиха', 'Посьет', 'Пошехонье-Володарск', 'Поярково', 'Преображение', 'Приаргунск', 'Приволжск', 'Приморско-Ахтарск', 'Пролив Санникова', 'Промышленная', 'Прохладная', 'Прохоркино', 'Псков', 'Пугачев', 'Пудино', 'Пудож', 'Пустошь', 'Пушкинские Горы', 'Пущино', 'Пыщуг', 'Пялица', 'Пятигорск', 'Ра-Из', 'Радужный', 'Разнаволок', 'Реболы', 'Ребриха', 'Ревда', 'Ремонтное', 'Ржев', 'Родино', 'Родниковая', 'Романовка', 'Рославль', 'Ростов', 'Ростов-на-Дону', 'Рощино', 'Рощиной', 'Ртищево', 'Рубцовск', 'Рудная Пристань', 'Русская Поляна', 'Рыбинск', 'Рыльск', 'Ряжск', 'Рязань', 'Салемал', 'Салехард', 'Самара', 'Самарка', 'Санага', 'Сангары', 'Санкт-Петербург', 'Саныяхтат', 'Саранпауль', 'Саранск', 'Сарапул', 'Саратов', 'Саргатское', 'Саров', 'Сарыг-Сеп', 'Саскылах', 'Сасово', 'Светлоград', 'Светлолобово', 'Светлый', 'Свиягино', 'Свободный', 'Святой Нос', 'Северное', 'Северо-Енисейск', 'Северо-Курильск', 'Северодвинск', 'Североуральск', 'Сегежа', 'Сеген-Кюель', 'Сегжема', 'Сеймчан', 'Сектагли', 'Селты', 'Семячик', 'Сенгейский Шар', 'Сергач', 'Сергеевка', 'Сергокала', 'Серов', 'Серов', 'Серпухов', 'Сеяха', 'Сидоровск', 'Симушир', 'Сковородино', 'Славгород', 'Славянск-на-Кубани', 'Сладково', 'Слаутное', 'Смидович', 'Смоленск', 'Советск', 'Советская Гавань', 'Советская Речка', 'Совхоз Эльген', 'Совхоз им.Ленина', 'Сого-Хая', 'Солекуль', 'Солнечная', 'Соловьевск', 'Солонешное', 'Сопочная карга', 'Сортавала', 'Сосновка', 'Сосновка', 'Сосново', 'Сосново-Озерское', 'Сосуново', 'Сосьва', 'Софийский Прииск', 'Сочи (Адлер)', 'Спас-Деменск', 'Среднеколымск', 'Средний Васюган', 'Средний Калар', 'Средникан', 'Средняя Олекма', 'Сретенск', 'Ставрополь', 'Старица', 'Старица', 'Старый Оскол', 'Степановка', 'Стерлитамак', 'Столб', 'Стрелка', 'Сузун', 'Сукпай', 'Сунтар', 'Суон-Тит', 'Суоярви', 'Сура', 'Сургут', 'Сусуман', 'Сухана', 'Сухиничи', 'Сухобузимское', 'Сызрань', 'Сыктывкар', 'Сым', 'Сысерть', 'Сытомино', 'Таборы', 'Тавда', 'Таганрог', 'Таежная', 'Тазовский', 'Тайга', 'Тайгонос', 'Таймылыр', 'Тайшет', 'Таксимо', 'Талая', 'Талон', 'Тальменка', 'Тамбей', 'Тамбов', 'Тангуй', 'Танхой', 'Танюрер', 'Тара', 'Тарко-Сале', 'Тасеево', 'Тасса', 'Татарск', 'Таурово', 'Таштып', 'Тверь', 'Теви', 'Тевриз', 'Тегульдет', 'Тегультя', 'Телемба', 'Темников', 'Теплый Ключ', 'Тереховка', 'Териберка', 'Терней', 'Тетюши', 'Тивяку', 'Тигиль', 'Тикси', 'Тилишма', 'Тим', 'Тимирязевский', 'Тисуль', 'Тихвин', 'Тихорецк', 'Тобольск', 'Тогул', 'Тогучин', 'Токо', 'Толмачево', 'Толька', 'Тольятти', 'Томмот', 'Томпа', 'Томпо', 'Томск', 'Тонгулах', 'Тоора-Хем', 'Топки', 'Торбеево', 'Торжок', 'Торопец', 'Тотьма', 'Третьяково', 'Троицк', 'Троицко-Печорское', 'Троицкое', 'Троицкое', 'Трубчевск', 'Туапсе', 'Тугулым', 'Тула', 'Тулун', 'Тума', 'Туманная', 'Тумнин', 'Тунгокочен', 'Тунка', 'Туой-Хая', 'Тупик', 'Тура', 'Турий Рог', 'Туринск', 'Турочак', 'Туруханск', 'Турчасово', 'Тутончаны', 'Тында', 'Тырка', 'Тюкалинск', 'Тюмень', 'Тюмети', 'Тюхтет', 'Тяжин', 'Тяня', 'Уакит', 'Убинское', 'Угино', 'Углегорск', 'Угловское', 'Угут', 'Удское', 'Уега', 'Ужаниха', 'Ужур', 'Улан-Удэ', 'Улеты', 'Улья', 'Ульяновск', 'Умба', 'Унеча', 'Уни', 'Ура-Губа', 'Урми', 'Уруп', 'Урюпинск', 'Усолье-Сибирское', 'Усть-Антосе', 'Усть-Баргузин', 'Усть-Воямполка', 'Усть-Заза', 'Усть-Илимск', 'Усть-Ишим', 'Усть-Кабырза', 'Усть-Камо', 'Усть-Камчатск', 'Усть-Кан', 'Усть-Кара', 'Усть-Кара', 'Усть-Каренга', 'Усть-Кокса', 'Усть-Кулом', 'Усть-Кут', 'Усть-Лабинск', 'Усть-Мая', 'Усть-Миль', 'Усть-Мома', 'Усть-Нюкжа', 'Усть-Озерное', 'Усть-Олой', 'Усть-Омчуг', 'Усть-Ордынский', 'Усть-Тарка', 'Усть-Уда', 'Усть-Умальта', 'Усть-Уса', 'Усть-Уса', 'Усть-Хайрюзово', 'Усть-Цильма', 'Усть-Чаркы', 'Усть-Юдома', 'Усугли', 'Уфа', 'Ухта', 'Учами', 'Учур', 'Ушки', 'Уяр', 'Фролово', 'Хабардино', 'Хабаровск', 'Хабары', 'Хакасская', 'Хамар-Дабан', 'Ханты-Мансийск', 'Харабали', 'Хасавюрт', 'Хатанга', 'Хатырык-Хомо', 'Хвалынск', 'Хейджан', 'Хилок', 'Хову-Аксы', 'Ходовариха', 'Холмогоры', 'Холмск', 'Хорей-Вер', 'Хоринск', 'Хороль', 'Хоседа-Хард', 'Хуларин', 'Хулугли', 'Цакир', 'Целина', 'Целинное', 'Целинное', 'Центральный рудник', 'Цимлянск', 'Циммермановка', 'Цып-Наволок', 'Чаваньга', 'Чадан', 'Чаингда', 'Чайковский', 'Чаны', 'Чара', 'Чарышское', 'Чаун', 'Чебоксары', 'Чекунда', 'Челябинск', 'Чемал', 'Чемдальск', 'Чемурнаут', 'Червянка', 'Чердынь', 'Черемушки', 'Черемхово', 'Черемхово', 'Череповец', 'Черкесск', 'Черлак', 'Чермоз', 'Чернушка', 'Чернышевский', 'Черняево', 'Черняховск', 'Черский', 'Чертково', 'Черусти', 'Чистоозерное', 'Чистополь', 'Чита', 'Чокурдах', 'Чугуевка', 'Чулпаново', 'Чулым', 'Чульман', 'Чумикан', 'Чумпурук', 'Чурапча', 'Чюльбю', 'Шабалино', 'Шадринск', 'Шаим', 'Шалинское', 'Шамары', 'Шангалы', 'Шарыпово', 'Шарья', 'Шатрово', 'Шахты', 'Шахунья', 'Шебалино', 'Шевли', 'Шелаболиха', 'Шелагонцы', 'Шелехова', 'Шелопугино', 'Шенкурск', 'Шербакуль', 'Шереметьево', 'Шилка', 'Шимановск', 'Шира', 'Шойна', 'Шумиха', 'Шумиха', 'Щетинкино', 'Ыныкчан', 'Ытык-Кель', 'Эгвекинот', 'Эйк', 'Экимчан', 'Элиста', 'Эльтон', 'Энгозеро', 'Энкан', 'Эньмувеем', 'Эрзин', 'Эссо', 'Югоренок', 'Южно-Курильск', 'Южно-Сахалинск', 'Южно-Сухокумск', 'Южноуральск', 'Юильск', 'Юмурчен', 'Юрга', 'Юрты', 'Юрьев-Польский', 'Юрьевец', 'Юста', 'Юшкозеро', 'Ягодное', 'Яйлю', 'Яковлевка', 'Якутск', 'Якша', 'Ялуторовск', 'Ямкун', 'Янаул', 'Янискоски', 'Янов Стан', 'Янск', 'Яранск', 'Яренск', 'Ярольин', 'Ярославль', 'Ярцево', 'Яшкуль', 'Яя'];


var peoples = [{
    "fio": "Иноземцева Надежда",
    "image": "http://static.best-gooods.ru/img/women/women1.jpg",
    "sex": 0
}, {
    "fio": "Тотенкова Регина",
    "image": "http://static.best-gooods.ru/img/women/women2.jpg",
    "sex": 0
}, {
    "fio": "Курдина Эмилия",
    "image": "http://static.best-gooods.ru/img/women/women3.jpg",
    "sex": 0
}, {
    "fio": "Стаина Анна",
    "image": "http://static.best-gooods.ru/img/women/women4.jpg",
    "sex": 0
}, {
    "fio": "Чуличкова Анастасия",
    "image": "http://static.best-gooods.ru/img/women/women5.jpg",
    "sex": 0
}, {
    "fio": "Шеркова Евгения",
    "image": "http://static.best-gooods.ru/img/women/women6.jpg",
    "sex": 0
}, {
    "fio": "Андрюхина Нина",
    "image": "http://static.best-gooods.ru/img/women/women7.jpg",
    "sex": 0
}, {
    "fio": "Катериночкина Анфиса",
    "image": "http://static.best-gooods.ru/img/women/women8.jpg",
    "sex": 0
}, {
    "fio": "Головина Анна",
    "image": "http://static.best-gooods.ru/img/women/women9.jpg",
    "sex": 0
}, {
    "fio": "Чупрова Екатерина",
    "image": "http://static.best-gooods.ru/img/women/women10.jpg",
    "sex": 0
}, {
    "fio": "Холопова Виктория",
    "image": "http://static.best-gooods.ru/img/women/women11.jpg",
    "sex": 0
}, {
    "fio": "Крупина Мария",
    "image": "http://static.best-gooods.ru/img/women/women12.jpg",
    "sex": 0
}, {
    "fio": "Полевщикова Кристина",
    "image": "http://static.best-gooods.ru/img/women/women13.jpg",
    "sex": 0
}, {
    "fio": "Пьянкова Диана",
    "image": "http://static.best-gooods.ru/img/women/women14.jpg",
    "sex": 0
}, {
    "fio": "Буланова Яна",
    "image": "http://static.best-gooods.ru/img/women/women15.jpg",
    "sex": 0
}, {
    "fio": "Цейдлерина Мария",
    "image": "http://static.best-gooods.ru/img/women/women16.jpg",
    "sex": 0
}, {
    "fio": "Щеголева Светлана",
    "image": "http://static.best-gooods.ru/img/women/women17.jpg",
    "sex": 0
}, {
    "fio": "Янкелевич Алина",
    "image": "http://static.best-gooods.ru/img/women/women18.jpg",
    "sex": 0
}, {
    "fio": "Якушевич Наталья",
    "image": "http://static.best-gooods.ru/img/women/women19.jpg",
    "sex": 0
}, {
    "fio": "Фомичева Диана",
    "image": "http://static.best-gooods.ru/img/women/women20.jpg",
    "sex": 0
}, {
    "fio": "Пережогина Виктория",
    "image": "http://static.best-gooods.ru/img/women/women21.jpg",
    "sex": 0
}, {
    "fio": "Ячменькова Василиса",
    "image": "http://static.best-gooods.ru/img/women/women22.jpg",
    "sex": 0
}, {
    "fio": "Рябова Дарья",
    "image": "http://static.best-gooods.ru/img/women/women23.jpg",
    "sex": 0
}, {
    "fio": "Домышева Юлия",
    "image": "http://static.best-gooods.ru/img/women/women24.jpg",
    "sex": 0
}, {
    "fio": "Милова Татьяна",
    "image": "http://static.best-gooods.ru/img/women/women25.jpg",
    "sex": 0
}, {
    "fio": "Шипицына Анна",
    "image": "http://static.best-gooods.ru/img/women/women26.jpg",
    "sex": 0
}, {
    "fio": "Протасова Евгения",
    "image": "http://static.best-gooods.ru/img/women/women27.jpg",
    "sex": 0
}, {
    "fio": "Молодыха Алиса",
    "image": "http://static.best-gooods.ru/img/women/women28.jpg",
    "sex": 0
}, {
    "fio": "Коржева Ксения",
    "image": "http://static.best-gooods.ru/img/women/women29.jpg",
    "sex": 0
}, {
    "fio": "Кузнецова Вероника",
    "image": "http://static.best-gooods.ru/img/women/women30.jpg",
    "sex": 0
}, {
    "fio": "Сукина Алиса",
    "image": "http://static.best-gooods.ru/img/women/women31.jpg",
    "sex": 0
}, {
    "fio": "Перова ?Агата",
    "image": "http://static.best-gooods.ru/img/women/women32.jpg",
    "sex": 0
}, {
    "fio": "Коржакова Ольга",
    "image": "http://static.best-gooods.ru/img/women/women33.jpg",
    "sex": 0
}, {
    "fio": "Ёжина Вероника",
    "image": "http://static.best-gooods.ru/img/women/women34.jpg",
    "sex": 0
}, {
    "fio": "Абрамович Валентина",
    "image": "http://static.best-gooods.ru/img/women/women35.jpg",
    "sex": 0
}, {
    "fio": "Крылова Наталья",
    "image": "http://static.best-gooods.ru/img/women/women36.jpg",
    "sex": 0
}, {
    "fio": "Проскуркина Александра",
    "image": "http://static.best-gooods.ru/img/women/women37.jpg",
    "sex": 0
}, {
    "fio": "Терехова Юлия",
    "image": "http://static.best-gooods.ru/img/women/women38.jpg",
    "sex": 0
}, {
    "fio": "Труфанова Варвара",
    "image": "http://static.best-gooods.ru/img/women/women39.jpg",
    "sex": 0
}, {
    "fio": "Батурина Марина",
    "image": "http://static.best-gooods.ru/img/women/women40.jpg",
    "sex": 0
}, {
    "fio": "Васнецова Нина",
    "image": "http://static.best-gooods.ru/img/women/women41.jpg",
    "sex": 0
}, {
    "fio": "Перевалова Надежда",
    "image": "http://static.best-gooods.ru/img/women/women42.jpg",
    "sex": 0
}, {
    "fio": "Рошета Любовь",
    "image": "http://static.best-gooods.ru/img/women/women43.jpg",
    "sex": 0
}, {
    "fio": "Мосякова Татьяна",
    "image": "http://static.best-gooods.ru/img/women/women44.jpg",
    "sex": 0
}, {
    "fio": "Носова Анастасия",
    "image": "http://static.best-gooods.ru/img/women/women45.jpg",
    "sex": 0
}, {
    "fio": "Типалова Юнона",
    "image": "http://static.best-gooods.ru/img/women/women46.jpg",
    "sex": 0
}, {
    "fio": "Колесникова Инесса",
    "image": "http://static.best-gooods.ru/img/women/women47.jpg",
    "sex": 0
}, {
    "fio": "Якуничева Анна",
    "image": "http://static.best-gooods.ru/img/women/women48.jpg",
    "sex": 0
}, {
    "fio": "Левина Евгения",
    "image": "http://static.best-gooods.ru/img/women/women49.jpg",
    "sex": 0
}, {
    "fio": "Агафонова Виктория",
    "image": "http://static.best-gooods.ru/img/women/women50.jpg",
    "sex": 0
}, {
    "fio": "Дуркина Антонина",
    "image": "http://static.best-gooods.ru/img/women/women51.jpg",
    "sex": 0
}, {
    "fio": "Игошина Мария",
    "image": "http://static.best-gooods.ru/img/women/women52.jpg",
    "sex": 0
}, {
    "fio": "Званцова Светлана",
    "image": "http://static.best-gooods.ru/img/women/women53.jpg",
    "sex": 0
}, {
    "fio": "Хлопонина Елена",
    "image": "http://static.best-gooods.ru/img/women/women54.jpg",
    "sex": 0
}, {
    "fio": "Суботина Изабелла",
    "image": "http://static.best-gooods.ru/img/women/women55.jpg",
    "sex": 0
}, {
    "fio": "Дроздова Марфа",
    "image": "http://static.best-gooods.ru/img/women/women56.jpg",
    "sex": 0
}, {
    "fio": "Милютина Изабелла",
    "image": "http://static.best-gooods.ru/img/women/women57.jpg",
    "sex": 0
}, {
    "fio": "Гнусарева Ангелина",
    "image": "http://static.best-gooods.ru/img/women/women58.jpg",
    "sex": 0
}, {
    "fio": "Домаш Вячеслав",
    "image": "http://static.best-gooods.ru/img/men/men1.jpg",
    "sex": 1
}, {
    "fio": "Лагутов Руслан",
    "image": "http://static.best-gooods.ru/img/men/men2.jpg",
    "sex": 1
}, {
    "fio": "Степанков Радислав",
    "image": "http://static.best-gooods.ru/img/men/men3.jpg",
    "sex": 1
}, {
    "fio": "Перешивкин Ростислав",
    "image": "http://static.best-gooods.ru/img/men/men4.jpg",
    "sex": 1
}, {
    "fio": "Кобзев Платон",
    "image": "http://static.best-gooods.ru/img/men/men5.jpg",
    "sex": 1
}, {
    "fio": "Кабанов Игнатий",
    "image": "http://static.best-gooods.ru/img/men/men6.jpg",
    "sex": 1
}, {
    "fio": "Чепурин Николай",
    "image": "http://static.best-gooods.ru/img/men/men7.jpg",
    "sex": 1
}, {
    "fio": "Крымов Изяслав",
    "image": "http://static.best-gooods.ru/img/men/men8.jpg",
    "sex": 1
}, {
    "fio": "Собчак Евгений",
    "image": "http://static.best-gooods.ru/img/men/men9.jpg",
    "sex": 1
}, {
    "fio": "Былинкин Максим",
    "image": "http://static.best-gooods.ru/img/men/men10.jpg",
    "sex": 1
}, {
    "fio": "Архипов Сергей",
    "image": "http://static.best-gooods.ru/img/men/men11.jpg",
    "sex": 1
}, {
    "fio": "Донцов Самсон",
    "image": "http://static.best-gooods.ru/img/men/men12.jpg",
    "sex": 1
}, {
    "fio": "Стаин Владилен",
    "image": "http://static.best-gooods.ru/img/men/men13.jpg",
    "sex": 1
}, {
    "fio": "Лызлов Владислав",
    "image": "http://static.best-gooods.ru/img/men/men14.jpg",
    "sex": 1
}, {
    "fio": "Ягужинский Аристарх",
    "image": "http://static.best-gooods.ru/img/men/men15.jpg",
    "sex": 1
}, {
    "fio": "Фризов Владимир",
    "image": "http://static.best-gooods.ru/img/men/men16.jpg",
    "sex": 1
}, {
    "fio": "Крупнов Дмитрий",
    "image": "http://static.best-gooods.ru/img/men/men17.jpg",
    "sex": 1
}, {
    "fio": "Ябловский Вадим",
    "image": "http://static.best-gooods.ru/img/men/men18.jpg",
    "sex": 1
}, {
    "fio": "Гусенков Самсон",
    "image": "http://static.best-gooods.ru/img/men/men19.jpg",
    "sex": 1
}, {
    "fio": "Панфёров Семён",
    "image": "http://static.best-gooods.ru/img/men/men20.jpg",
    "sex": 1
}, {
    "fio": "Ясинский Павел",
    "image": "http://static.best-gooods.ru/img/men/men21.jpg",
    "sex": 1
}, {
    "fio": "Тетерев Глеб",
    "image": "http://static.best-gooods.ru/img/men/men22.jpg",
    "sex": 1
}, {
    "fio": "Шлыков Николай",
    "image": "http://static.best-gooods.ru/img/men/men23.jpg",
    "sex": 1
}, {
    "fio": "Козлов Илья",
    "image": "http://static.best-gooods.ru/img/men/men24.jpg",
    "sex": 1
}, {
    "fio": "Амалиев Максим",
    "image": "http://static.best-gooods.ru/img/men/men25.jpg",
    "sex": 1
}, {
    "fio": "Паулкин Ефим",
    "image": "http://static.best-gooods.ru/img/men/men26.jpg",
    "sex": 1
}, {
    "fio": "Колганов Герман",
    "image": "http://static.best-gooods.ru/img/men/men27.jpg",
    "sex": 1
}, {
    "fio": "Саламатов Николай",
    "image": "http://static.best-gooods.ru/img/men/men28.jpg",
    "sex": 1
}, {
    "fio": "Сподарев Степан",
    "image": "http://static.best-gooods.ru/img/men/men29.jpg",
    "sex": 1
}, {
    "fio": "Бочкарёв Владимир",
    "image": "http://static.best-gooods.ru/img/men/men30.jpg",
    "sex": 1
}, {
    "fio": "Опекунов Вячеслав",
    "image": "http://static.best-gooods.ru/img/men/men31.jpg",
    "sex": 1
}, {
    "fio": "Телицын Тимофей",
    "image": "http://static.best-gooods.ru/img/men/men32.jpg",
    "sex": 1
}, {
    "fio": "Ямлиханов Андрей",
    "image": "http://static.best-gooods.ru/img/men/men33.jpg",
    "sex": 1
}, {
    "fio": "Малиновский Владислав",
    "image": "http://static.best-gooods.ru/img/men/men34.jpg",
    "sex": 1
}, {
    "fio": "Гребнев Ростислав",
    "image": "http://static.best-gooods.ru/img/men/men35.jpg",
    "sex": 1
}, {
    "fio": "Кузанов Леонид",
    "image": "http://static.best-gooods.ru/img/men/men36.jpg",
    "sex": 1
}, {
    "fio": "Ягфаров Серафим",
    "image": "http://static.best-gooods.ru/img/men/men37.jpg",
    "sex": 1
}, {
    "fio": "Цитников Всеволод",
    "image": "http://static.best-gooods.ru/img/men/men38.jpg",
    "sex": 1
}, {
    "fio": "Владимиров Артём",
    "image": "http://static.best-gooods.ru/img/men/men39.jpg",
    "sex": 1
}, {
    "fio": "Банин Александр",
    "image": "http://static.best-gooods.ru/img/men/men40.jpg",
    "sex": 1
}, {
    "fio": "Капица Кирилл",
    "image": "http://static.best-gooods.ru/img/men/men41.jpg",
    "sex": 1
}, {
    "fio": "Колбин Клавдий",
    "image": "http://static.best-gooods.ru/img/men/men42.jpg",
    "sex": 1
}, {
    "fio": "Володин Зиновий",
    "image": "http://static.best-gooods.ru/img/men/men43.jpg",
    "sex": 1
}, {
    "fio": "Уланов Иван",
    "image": "http://static.best-gooods.ru/img/men/men44.jpg",
    "sex": 1
}, {
    "fio": "Седых Кирилл",
    "image": "http://static.best-gooods.ru/img/men/men45.jpg",
    "sex": 1
}, {
    "fio": "Туровский Лев",
    "image": "http://static.best-gooods.ru/img/men/men46.jpg",
    "sex": 1
}, {
    "fio": "Яснов Ефим",
    "image": "http://static.best-gooods.ru/img/men/men47.jpg",
    "sex": 1
}, {
    "fio": "Москвин ?Артем",
    "image": "http://static.best-gooods.ru/img/men/men48.jpg",
    "sex": 1
}, {
    "fio": "Измайлов Герман",
    "image": "http://static.best-gooods.ru/img/men/men49.jpg",
    "sex": 1
}, {
    "fio": "Цыганов Егор",
    "image": "http://static.best-gooods.ru/img/men/men50.jpg",
    "sex": 1
}, {
    "fio": "Голумбовский Дмитрий",
    "image": "http://static.best-gooods.ru/img/men/men51.jpg",
    "sex": 1
}, {
    "fio": "Аничков Кирилл",
    "image": "http://static.best-gooods.ru/img/men/men52.jpg",
    "sex": 1
}, {
    "fio": "Канаш Степан",
    "image": "http://static.best-gooods.ru/img/men/men53.jpg",
    "sex": 1
}, {
    "fio": "Клепахов Дмитрий",
    "image": "http://static.best-gooods.ru/img/men/men54.jpg",
    "sex": 1
}, {
    "fio": "Колесников Анатолий",
    "image": "http://static.best-gooods.ru/img/men/men55.jpg",
    "sex": 1
}, {
    "fio": "Цветков Леонид",
    "image": "http://static.best-gooods.ru/img/men/men56.jpg",
    "sex": 1
}, {
    "fio": "Мишин Ефим",
    "image": "http://static.best-gooods.ru/img/men/men57.jpg",
    "sex": 1
}, {
    "fio": "Борисов Митрофан",
    "image": "http://static.best-gooods.ru/img/men/men58.jpg",
    "sex": 1
}];

function shuffleArray(array) {
    var currentIndex = array.length,
        temporaryValue, randomIndex;

    while (0 !== currentIndex) {
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}


	var pluginLang = {
		"RU": {
			"Visitors_Today": "Посетителей сегодня",
			"Visitors_Online": "Посетителей на сайте",
			"Visitors_Buy": "Покупок сегодня",
			"Dostavka": "[fio], г. "+_user.city_ru+", сделал(а) заказ на сумму [amount], кол-во 1шт",
			"FastDeliveryTo": "Действует быстрая доставка в г. "+_user.city_ru,
			"CurrentView": "Сейчас  [count] пользователей просматривают эту страницу вместе с вами."
		},
		"ID": {
			"Visitors_Today": "Pengunjung hari ini",
			"Visitors_Online": "Sedang online",
			"Visitors_Buy": "Pembelian hari ini",
			"Dostavka": "[fio], "+_user.city_en+", buat pesanan [amount], jumlah 1",
			"FastDeliveryTo": "Pengiriman cepat, di kota "+_user.city_en,
			"CurrentView": "[count] orang sedang melihat halaman ini sekarang",
			"names_0": ["Putri", "Irene", "Intan", "Sarah", "Syifa", "jessica", "Farah", "Cindy"],
			"names_1": ["Kevin", "ahmad", "farel", "Angga", "Henry", "stanley", "David"]
		},
		"PL": {
			"Visitors_Today": "Najwięcej dzisiaj",
			"Visitors_Online": "użytkownicy online",
			"Visitors_Buy": "zamów już dziś",
			"Dostavka": "[fio], m. "+_user.city_en+", zamówił(a) na [amount], ilość - 1szt",
			"FastDeliveryTo": "Działa szybka dostawa do m. "+_user.city_en,
			"CurrentView": "Teraz [count] osób przeglądają stronę razem z Państwem",
			"names_0": ["Iwona Bielecka", "Stanisława Pietrzak", "Liliana", "Kornelia Wierzbicka", "Helena Bukowska", "Małgorzata Osińska", "Kornelia Pietrzak", "Elżbieta Piasecka"],
			"names_1": ["Szymon Chrzanowski", "Damian Kaźmierczak", "Artur Mazur", "Jakub Rybak", "Bogusław Kozak", "Edward Kozłowski", "Adam Szydłowski", "Sławomir Bednarczyk", "Jacek Bednarczyk"]

		},

		"GB": {
			"Visitors_Today": "Today visitors",
			"Visitors_Online": "Visitors online",
			"Visitors_Buy": "orders today",
			"Dostavka": "[fio], "+_user.city_en+", just ordered 1 item",
			"FastDeliveryTo": "Fast delivery to "+_user.city_en+" available",
			"CurrentView": "[count] visitors online just now",
			"names_0": (new String("Ann Lamb,Grace Booker,Ella Johnston,Elizabeth Walton,Cora Hubbard,Mary Daniel, Ashlie Octavia")).split(','),
			"names_1": ["Joseph", "Edward", "Michael", "Oliver", "Garey","James","John"]


		},
		"DE": {
			"Visitors_Today": "Besucher heute",
			"Visitors_Online": "Besucher online",
			"Visitors_Buy": "gekauft heute",
			"Dostavka": "[fio], "+_user.city_en+", kaufte eine für [amount], 1 item",
			"FastDeliveryTo": "schnelle Lieferung "+_user.city_en,
			"CurrentView": "Jetzt [count] Menschen betrachten diese Seite mit Ihnen",
			"names_0": (new String("Ursula,Karin,Helga,Sabin,Ingrid,Gisela,Anna,Maria,Heike,Erica")).split(','),
			"names_1": (new String("Peter,Jürgen,Wolfgang,Hans,Werner,Tomas,Frank")).split(',')
		},
		"EE": {
			"Visitors_Today": "Külastusi täna",
			"Visitors_Online": "Saidi külastajad",
			"Visitors_Buy": "ostis täna",
			"Dostavka": "[fio], "+_user.city_en+", võtnud määruse",
			"FastDeliveryTo": "toimib kiire tarne "+_user.city_en,
			"CurrentView": "Nüüd [count] inimest vaatad seda lehte.",
			"names_0": (new String("Aleksandra,Kaia,Jelena,Loviise,Liis,Lagle,Leena,Anna,Kati,Kadri")).split(','),
			"names_1": (new String("Hendrik,Tiitus,Tarmo,Jaakob,Toomas,Johannes,Artur,Rain")).split(',')

		},

		"TH": {
			"Visitors_Today": "ผู้ที่เข้าชมวันนี้",
			"Visitors_Online": "ผู้ที่ออนไลน์ขณะนี้",
			"Visitors_Buy": "จำนวนสินค้าที่",
			"Dostavka": "ชื่อจริง , "+_user.city_en+", ที่อยู่  [amount]",
			"FastDeliveryTo": "จัดส่งสินค้าไปยัง "+_user.city_en,
			"CurrentView": "ตอนนี้มี [count] คนกำลังดูหน้านี้ในเวลาเดียวกับคุณ",
			"names_0": (new String("Aleksandra,Kaia,Jelena,Loviise,Liis,Lagle,Leena,Anna,Kati,Kadri")).split(','),
			"names_1": (new String("Hendrik,Tiitus,Tarmo,Jaakob,Toomas,Johannes,Artur,Rain")).split(',')

		},










		"DEF": []
	}
	var _lng = pluginLang.RU;
	if( typeof pluginLang[_user.country] !== 'undefined'){
		_lng = pluginLang[_user.country];
		if( typeof _lng.names_0 !== 'undefined'){
			for(var j=0;j<peoples.length;j++){
				_lng.names_0 = shuffleArray(_lng.names_0);
				_lng.names_1 = shuffleArray(_lng.names_1);
				if( peoples[j].sex == 1){
					peoples[j].fio = _lng.names_1[0];
				}else{
					peoples[j].fio = _lng.names_0[0];

				}
			}
		}

	}




function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function shuffleArray(array) {
    var currentIndex = array.length,
        temporaryValue, randomIndex;

    while (0 !== currentIndex) {
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}
peoples = shuffleArray(peoples);
var mainNow = 0;
var cityName = '';
var countryName = '';

function detectCity() {
    var geolocation = ymaps.geolocation;
    cityName = geolocation.city || '';
}

function detectCountry() {
    var geolocation = ymaps.geolocation;
    countryName = geolocation.country;
}
$(function() {
    try {
        ymaps.ready(detectCity);
        ymaps.ready(detectCountry);
    } catch (e) {}
});

function addTopLine(isMobile) {
    isMobile = isMobile ? isMobile : false;
    var allToday = new Date().getHours() * 100 + Math.floor(Math.random() * 1000);
    var now = mainNow != 0 ? mainNow : getRandomInt(45, 150);
    mainNow = now;
    var todayBuy = getRandomInt(50, 100) + new Date().getHours();
    if (allToday <= todayBuy) {
        todayBuy = Math.floor(allToday / 2) + 2;
    }
    var allHeight = isMobile ? 34 : 36;
    var html = '<style>.top-line span.mobile{height: 35px !important;padding-top: 10px !important;font-size: 12px !important;box-sizing: border-box !important;}' +
        'body{padding-top:34px !important;}' +
        '.top-line span{font-family: Arial !important;font-size:21px !important;}' +
        '.top-line span *{font-family: Arial !important;font-size:21px !important;}' +
        '.top-line .all-today.mobile{display:none!important;}' +
        '.tm-block-navbar{top: 36px !important;}' +
        '.all-today{background-image: url(https://funcpa.ru/offers/assets/images/in_landing/all.png) !important;height: 28px !important;padding-left: 43px !important;background-repeat: no-repeat !important;background-position: 5px !important;margin-left: 10px !important;display: inline-block !important;padding-top: 8px !important;margin-top: 0 !important;}' +
        '.now{background-image: url(https://funcpa.ru/offers/assets/images/in_landing/now.png) !important;height: 28px !important;padding-left: 45px !important;background-repeat: no-repeat !important;background-position: 5px !important;margin-left: 10px !important;display: inline-block !important;padding-top: 8px !important;margin-top: 0 !important;border-left: 3px solid #E4E4E4 !important;}' +
        '.today-buy{background-image: url(https://funcpa.ru/offers/assets/images/in_landing/buy.png) !important;height: 28px !important;padding-left: 45px !important;background-repeat: no-repeat !important;background-position: 5px !important;margin-left: 10px !important;display: inline-block !important;padding-top: 8px !important;margin-top: 0 !important;border-left: 3px solid #E4E4E4 !important;}' +
        '.top-line .now.mobile{border-left:0 !important;}</style>' +
        '<div class="top-line" style="overflow: hidden !important;box-sizing: border-box !important; z-index: 99999 !important;height:' + allHeight + 'px !important; text-align:center !important;background: #F1EDEE !important; position: fixed !important; width:100% !important;top:0!important; left:0 !important;">' +
        '<div style="font-size: 21px !important;color: #000 !important;display:inline-block !important;">' +
        '<span class="all-today ' + (isMobile ? 'mobile' : '') + '">'+_lng.Visitors_Today+': <strong>' + allToday + '</strong></span>' +
        '<span class="now ' + (isMobile ? 'mobile' : '') + '">'+_lng.Visitors_Online+': <strong>' + now + '</strong></span>' +
        '<span class="today-buy ' + (isMobile ? 'mobile' : '') + '">'+_lng.Visitors_Buy+': <strong>' + todayBuy + '</strong></span>' +
        '</div></div>';
    $(html).appendTo($(document.body));
}

function showTips(bill, bill2) {
    this.bill = bill;
    this.bill2 = bill2;
    this.showItem = 0;
    this.generateHTML = function(image, fio, city, bill, bill2, sex) {
        var top = 50;
        if ($('.freezing-info').length) {
            top = 229;
        }
        var nowMoney = bill;
        if (getRandomInt(0, 1)) {
            nowMoney = bill2;
        }
	nowMoney = nowMoney.replace('сумму','');
	
        return (
            '<div class="notify" style="font-family: \'Roboto\', sans-serif !important; z-index:991000 !important;display: none !important;opacity:0.1 !important;background: #363636 !important;border-radius:10px !important;padding:30px !important;width:330px !important;height:110px !important;position:fixed !important;top:' + top + 'px !important;right:20px !important;box-sizing: border-box !important;color: white !important;">' +
            '<img src="' + image + '" width="50" height="50" style="width:50px !important;box-sizing:content-box !important; height: 50px !important; padding-right:20px !important; float: left !important;">' +
            '<div class="notify-text" style="color:#fff;font-size: 14px !important;line-height:normal !important;">'+(_lng.Dostavka.replace('[fio]', fio).replace('[city]',city).replace('[amount]', nowMoney))+' </div>' +
            '</div>'
        );
    };
    this.addItem = function(html) {
        $(html).appendTo($(document.body));
        $('.notify').css('display', 'block');
        $('.notify').animate({
            opacity: 1.0
        }, 'slow');
    };
    this.bindEvent = function() {
        setTimeout(function() {
            $('.notify').animate({
                opacity: 0.1
            }, 'slow', function() {
                $('.notify').css('display', 'none');
                $('.notify').remove();
            });
        }, 6000);
    };
    this.getIntervalAction = function() {
        var self = this;
        return function() {
            var item = peoples[self.showItem];
            if (!item) {
                self.showItem = -1;
                var item = peoples[0];
            }
            self.showItem++;
            var city = cityName;


            if (getRandomInt(0, 1)) {
                city = cityList[getRandomInt(0, 1306)];
            }
	if(city=='') city = _user.city_ru;
            var html = self.generateHTML('https://funcpa.ru/offers/assets/images/in_landing/yico.png', item.fio, city, self.bill, self.bill2, item.sex);
            self.addItem(html);
            self.bindEvent();
        }
    };
    setInterval(this.getIntervalAction(), 25000);
}

function addDeliveryPopup() {
    this.generateHTML = function(city) {
        return (
            '<div class="delivery-notify" style="font-family: Arial !important; z-index: 991000 !important;background: #363636 !important;border: 1px solid white !important;padding:30px !important;padding-top: 17px !important;width:270px !important;height:80px !important;position:fixed !important;bottom:0px !important;left:0px !important;box-sizing: border-box !important;color: white !important;">' +
            '<div class="close-delivery-notify" style="color:#fff;width:15px !important;height:15px !important;cursor: pointer !important;position:absolute !important;right:0 !important;top:0 !important;border:1px solid #fff !important; font-size: 22px !important;line-height: 0.6 !important;text-align: center !important;">&times;</div>' +
            '<div class="notify-text" style="color:#fff;">'+(_lng.FastDeliveryTo.replace('city',city))+'</div>' +
            '</div>'
        );
    };
    this.bindEvents = function() {
        $('.close-delivery-notify').on('click', function() {
            $('.delivery-notify').remove();
        });
        $(document).on('wheel', function() {
            if ($(document).scrollTop() + $(window).height() == $(document).height()) {
                if ($('.delivery-notify').length) {
                    $('.delivery-notify').remove();
                }
            }
        });
    };
    this.getShowAction = function() {
        var self = this;
        return function() {
            var html = self.generateHTML(cityName);
            $(html).appendTo($(document.body));
            self.bindEvents();
        };
    };

    setTimeout(this.getShowAction(), 15000);
}

function showSwimmer() {
    var count = mainNow != 0 ? mainNow : getRandomInt(45, 150);
    var bottom = 6;
    if ($('.delivery-notify').length) {
        bottom = 88;
    }
    mainNow = count;
    var html = '<div class="swimmer" style="line-height:18px !important; font-family: Arial !important; font-size: 12px !important;z-index:991001 !important;position: fixed !important; bottom:' + bottom + 'px !important; left: 6px !important; width:265px !important;height: 73px !important;background: #FFFFEA !important; border-radius: 5px !important; color:black; border:1px solid #000 !important; padding: 10px !important;box-sizing: border-box !important;">' +
        '<div class="close-swimmer" style="color:black; line-height:11px !important; cursor:pointer !important;width: 13px !important;height: 13px !important;font-size: 22px !important;position: absolute !important;top: 10px !important;right:10px !important; background: white !important;color:#9C8B74 !important;border: 1px solid #9C8B74 !important; border-radius: 3px !important;">&times;</div>' +
        '<img src="https://funcpa.ru/offers/assets/images/in_landing/swimmer.png" style="width:50px !important; height: 50px !important; float: left !important;padding-right: 10px !important;border:0 !important;">' +
        '<span style="color:black">'+(_lng.CurrentView.replace('[count]',count) )+' ' + 
        '</div>';
    $(html).appendTo($(document.body));
    $('.close-swimmer').on('click', function() {
        $('.swimmer').remove();
    });
    setInterval(function() {
        if ($('.delivery-notify').length) {
            $('.swimmer').css('bottom', 88);
        } else {
            $('.swimmer').css('bottom', 6);
        }
    }, 1000);
}

function freezeMoney(country) {

    var dollar = '';
    if (country == 'UA') {
        dollar = '14 гривен';
    } else if (country == 'RU') {
        dollar = '45 рублей';
    } else if (country == 'KZ') {
        dollar = '180 тенге';
    } else if (country == 'BY') {
        dollar = '10730 бел.руб.';
    } else {
	return; 
        dollar = '45 рублей';
    }
    var html = '<style>' +
        '.freezing-info-packages {font-size: 20px !important;color: #000000 !important;padding-top: 12px !important;z-index: 2 !important;position: relative !important;line-height: 1 !important;}' +
        '.freezing-info-packages span{font-size: 20px !important;color: #000000 !important;padding-top: 12px !important;z-index: 2 !important;position: relative !important;line-height: 1 !important;}' +
        '.freezing-close {position: absolute !important;top: -14px !important;right: 4px !important;width: 20px !important;height: 20px !important;display: block !important;}' +
        '.freezing-info:before {content: "";position: absolute !important;height: 198px !important;width: 280px !important;top: 0 !important;right: 0 !important;margin-top: -26px !important;background: url("https://funcpa.ru/offers/assets/images/in_landing/buyer-ice.png") no-repeat !important;}' +
        '.freezing-info{font-family: Arial !important; z-index: 991000 !important;color: black !important;width: 329px !important;height: 125px !important;position: fixed !important;background: url("https://funcpa.ru/offers/assets/images/in_landing/buyer-bg.png") no-repeat !important;box-sizing: border-box !important;padding: 10px 30px !important;top:56px !important;right:0 !important;border: 0 !important;font-size: 100% !important;font: inherit !important;vertical-align: baseline !important;}' +
        '.freezing-info-price {font-size: 22px !important;color: #02aced !important;z-index: 2 !important;position: relative !important;margin-left: 3px !important;}' +
        '.freezing-info-price span{font-size: 22px !important;color: #02aced !important;z-index: 2 !important;position: relative !important;margin-left: 3px !important;}' +
        '.freezing-info-title {font-size: 21px !important;color: #000000 !important;z-index: 2 !important;position: relative !important;text-transform: uppercase !important;line-height: 1.3 !important;}' +
        '.freezing-close:before {-webkit-transform: rotate(45deg) !important;-ms-transform: rotate(45deg) !important;transform: rotate(45deg) !important;}' +
        '.freezing-close:after {-webkit-transform: rotate(-45deg) !important;-ms-transform: rotate(-45deg) !important;transform: rotate(-45deg) !important;}' +
        '.freezing-close:before, ' +
        '.freezing-close:after {content: "";position: absolute !important;width: 100% !important;height: 2px !important;background: #ffffff !important;}' +
        '</style>' +
        '<div class="freezing-info">' +
        '<div class="freezing-info-title">Мы заморозили цену!</div>' +
        '<div class="freezing-info-price">1$ = <span class="dynamic-freezing-info--price">' + dollar + '</span></div>' +
        '<div class="freezing-info-packages">Осталось <span class="packages-count">' + 120 + '</span> штук <br>по старому курсу' +
        '</div>' +
        '<a href="#close" class="freezing-close"></a>' +
        '</div>';
    $(html).appendTo($(document.body));
    $('.freezing-close').on('click', function(e) {
        $('.freezing-info').remove();
        e.preventDefault();
        e.stopPropagation();
    });
}

function addCityToComment() {
    var names = $('.vk-comment-name');
    for (var i = 0; i < names.length; i++) {
        var item = $(names[i]);
        if (getRandomInt(0, 1)) {
            var newText = item.text() + ' г.' + cityName;
            item.text(newText);
        } else {
            var newText = item.text() + ' г.' + cityList[getRandomInt(0, 1306)];
            item.text(newText);
        }
    }
}