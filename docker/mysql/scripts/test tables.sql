use renovation_of_apartments;

insert into task (
    text,
    cost
) values (
    'Покраска одной стены',
    500
);

insert into task (
    text,
    cost
) values (
    'Установка одного пластикового окна',
    5000
);

insert into task (
    text,
    cost
) values (
    'Наклеивание обоев на одну стену',
    2500
);

insert into task (
    text,
    cost
) values (
    'Установка натяжного потолка в одной комнате',
    10000
);

insert into warehouse (
    name,
    address
) values (
    'Основной',
    'ул. Первая, д. 23'
);

insert into warehouse (
    name,
    address
) values (
    'Дополнительный',
    'ул. Вторая, д. 17'
);

insert into item (
    warehouse_id,
    name,
    quantity,
    type,
    purchase_price
) values (
    1,
    'Отвертка',
    4,
    'Инструмент',
    200
);

insert into item (
    warehouse_id,
    name,
    quantity,
    type,
    purchase_price
) values (
    1,
    'Коробка гвоздей',
    6,
    'Инструмент',
    100
);

insert into item (
    warehouse_id,
    name,
    quantity,
    type,
    purchase_price
) values (
    2,
    'Шуруповерт',
    3,
    'Инструмент',
    2500
);

insert into item (
    warehouse_id,
    name,
    quantity,
    type,
    purchase_price
) values (
    2,
    'Рулон обоев дизайн №1',
    10,
    'Материал',
    2000
);

insert into item (
    warehouse_id,
    name,
    quantity,
    type,
    purchase_price
) values (
    2,
    'Рулон обоев дизайн №2',
    8,
    'Материал',
    2300
);

insert into item (
    warehouse_id,
    name,
    quantity,
    type,
    purchase_price
) values (
    2,
    'Рулон линолиума дизайн №1',
    12,
    'Материал',
    3200
);

insert into contract (
    number,
    date
) values (
    1,
    '2018-11-28'
);

insert into contract (
    number,
    date
) values (
    2,
    '2018-11-27'
);

insert into contract (
    number,
    date
) values (
    3,
    '2018-11-29'
);

insert into contract (
    number,
    date
) values (
    4,
    '2018-11-25'
);

insert into customer (
    full_name,
    phone_number
) values (
    'Константинов Альберт Улебович',
    '+79504662378'
);

insert into customer (
    full_name,
    phone_number,
    email_address
) values (
    'Титов Лука Львович',
    '+79503889256',
    'titov.lion@gmail.com'
);

insert into customer (
    full_name,
    phone_number,
    email_address
) values (
    'Терентьева Силика Рубеновна',
    '+79509642844',
    'terentyeva.silika@gmail.com'
);

insert into customer (
    full_name,
    phone_number,
    email_address
) values (
    'Григорьева Залина Семеновна',
    '+795056378253',
    'grigorieva.zalina@gmail.com'
);

insert into work_object (
    house_address,
    apartment_number,
    entrance_number,
    floor_number
) values (
    'ул. Первых, 43',
    32,
    2,
    3
);

insert into work_object (
    house_address,
    apartment_number,
    floor_number
) values (
    'ул. Вторых, 185',
    11,
    2
);

insert into work_object (
    house_address,
    apartment_number,
    entrance_number
) values (
    'ул. Третьих, 36',
    25,
    3
);

insert into work_object (
    house_address,
    apartment_number
) values (
    'ул. Четвертых, 64',
    67
);

insert into `order` (
    contract_id,
    customer_id,
    work_object_id
) values (
    1,
    1,
    1
);

insert into `order` (
    contract_id,
    customer_id,
    work_object_id
) values (
    2,
    2,
    2
);

insert into `order` (
    contract_id,
    customer_id,
    work_object_id
) values (
    3,
    3,
    3
);

insert into `order` (
    contract_id,
    customer_id,
    work_object_id
) values (
    4,
    4,
    4
);

insert into employee (
    full_name,
    phone_number,
    email_address,
    position
) values (
    'Лазарева Эрида Ростиславовна',
    '+79508672857',
    'lazareva.erida@gmail.com',
    'Начальница учета'
);

insert into employee (
    full_name,
    phone_number,
    email_address,
    position
) values (
    'Волков Олег Альбертович',
    '+79502562759',
    'volkov.oleg@gmail.com',
    'Бригадир'
);

insert into employee (
    full_name,
    phone_number,
    email_address,
    position
) values (
    'Костин Борис Андреевич',
    '+79509487275',
    'kostin.boris@gmail.com',
    'Рабочий'
);

insert into employee (
    full_name,
    phone_number,
    email_address,
    position
) values (
    'Архипов Мечеслав Христофорович',
    '+79508764692',
    'arhipov.mecheslav@gmail.com',
    'Рабочий'
);

insert into employee (
    full_name,
    phone_number,
    email_address,
    position
) values (
    'Новиков Вениамин Ярославович',
    '+79506638792',
    'novikov.veniamin@gmail.com',
    'Рабочий'
);

insert into employee (
    full_name,
    phone_number,
    email_address,
    position
) values (
    'Самсонов Анатолий Кимович',
    '+79505793984',
    'samsonov.anatoly@gmail.com',
    'Рабочий'
);

insert into employee (
    full_name,
    phone_number,
    email_address,
    position
) values (
    'Королёв Федор Альбертович',
    '+79507854283',
    'korolev.fedor@gmail.com',
    'Рабочий'
);

insert into employee (
    full_name,
    phone_number,
    email_address,
    position
) values (
    'Тарасов Игорь Васильевич',
    '+79508649268',
    'tarasov.igor@gmail.com',
    'Директор'
);

insert into employee (
    full_name,
    phone_number,
    email_address,
    position
) values (
    'Владимирова Неолина Тимофеевна',
    '+79509873568',
    'vladimirovna.neolina@gmail.com',
    'Начальница кадров'
);

insert into exit_to_object (
    brigade_gathering_datetime,
    order_id
) values (
    '2018-11-29 9:00:00',
    1
);

insert into exit_to_object (
    brigade_gathering_datetime,
    order_id
) values (
    '2018-11-30 9:30:00',
    2
);

insert into work_task (
    task_id,
    exit_to_object_id
) values (
    1,
    1
);

insert into work_task (
    task_id,
    exit_to_object_id
) values (
    2,
    1
);

insert into work_task (
    task_id,
    exit_to_object_id
) values (
    3,
    2
);

insert into work_task (
    task_id,
    exit_to_object_id
) values (
    4,
    2
);

insert into equipment (
    item_id,
    exit_to_object_id,
    item_quantity
) values (
    1,
    1,
    3
);

insert into equipment (
    item_id,
    exit_to_object_id,
    item_quantity
) values (
    2,
    2,
    2
);

insert into equipment (
    item_id,
    exit_to_object_id,
    item_quantity
) values (
    3,
    1,
    3
);

insert into equipment (
    item_id,
    exit_to_object_id,
    item_quantity
) values (
    4,
    2,
    5
);

insert into renovating_brigade (
    employee_id,
    exit_to_object_id
) values (
    2,
    1
);

insert into renovating_brigade (
    employee_id,
    exit_to_object_id
) values (
    3,
    1
);

insert into renovating_brigade (
    employee_id,
    exit_to_object_id
) values (
    4,
    1
);

insert into renovating_brigade (
    employee_id,
    exit_to_object_id
) values (
    2,
    2
);

insert into renovating_brigade (
    employee_id,
    exit_to_object_id
) values (
    5,
    2
);

insert into renovating_brigade (
    employee_id,
    exit_to_object_id
) values (
    6,
    2
);

insert into user (
    id,
    username,
    password_hash
) values (
    1,
    'head-of-accounting',
    '$2a$10$i3iJNTqYZ9G5rlpQTnAnQ.toMM8jtkm1SrBfYWxPDR4oEjo4GweUm' -- acc0unt
);

insert into user (
    id,
    username,
    password_hash
) values (
    2,
    'brigadier',
    '$2a$10$HCLkPZ4XaE0OYfFlwrt8hO0S.yRsHJ0H2JDlshl0FUv2FPr6CAbn.' -- ch1ef
);

insert into user (
    id,
    username,
    password_hash
) values (
    3,
    'brigade-worker-1',
    '$2a$10$NOmn9H6iw.68zcfl3tshUOANWZ7GUKhcFTXE9BcepJy6LYGLUwNPS' -- work-1
);

insert into user (
    id,
    username,
    password_hash
) values (
    4,
    'brigade-worker-2',
    '$2a$10$qizCGTrbRG5HIvVH9UE.Q.AqHZXfXn7OcviEBH2vhug/BYUAaYSpa' -- work-2
);

insert into user (
    id,
    username,
    password_hash
) values (
    5,
    'brigade-worker-3',
    '$2a$10$GLjskYDlUm9nK4.CpTp.6.9K.EP5nVpJjfKHKjVmfsdiL5AcHliKK' -- work-3
);

insert into user (
    id,
    username,
    password_hash
) values (
    6,
    'brigade-worker-4',
    '$2a$10$xWZ80e4920En348TvAS/NORO0xNuUdTTOstQ4yNfOzKNzgLfsP/ZG' -- work-4
);

insert into user (
    id,
    username,
    password_hash
) values (
    7,
    'brigade-worker-5',
    '$2a$10$1uYCPlg2Aul4Tdlu5R4naeeBpnZClqzBaMkt2OWyJLhexL0KGPDtK' -- work-5
);
