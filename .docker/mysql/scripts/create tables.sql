use renovation_of_apartments;

create table task (
    id integer not null auto_increment,
    category enum ('Потолок', 'Стены', 'Пол', 'Коммуникации',
        'Демонтаж', 'Остальное') not null,
    text varchar(128) not null,
    unit enum ('Квадратный метр', 'Штука', 'Погонный метр',
        'Комплект', 'Не применимо') not null,
    cost_per_unit decimal(10, 2) not null,
    primary key (id),
    unique key (category, text)
);

create table warehouse (
    id integer not null auto_increment,
    name varchar(32) not null,
    address varchar(64) not null,
    primary key (id),
    unique key (name),
    unique key (address)
);

create table item (
    id integer not null auto_increment,
    warehouse_id integer not null,
    name varchar(128) not null,
    type enum ('Инструмент', 'Материал',
        'Расходуемое', 'Другое') not null,
    quantity integer not null,
    purchase_price decimal(10, 2) not null,
    primary key (id),
    foreign key (warehouse_id)
        references warehouse (id),
    unique key (warehouse_id, name)
);

create table customer (
    id integer not null auto_increment,
    full_name varchar(64) not null,
    phone_number varchar(32) not null,
    email_address varchar(64) null,
    primary key (id),
    unique key (phone_number),
    unique key (email_address)
);

create table work_object (
    id integer not null auto_increment,
    house_address varchar(64) not null,
    apartment_number integer not null,
    apartment_area integer not null,
    number_of_rooms integer not null,
    entrance_number integer null,
    floor_number integer null,
    primary key (id),
    unique key (house_address, apartment_number)
);

create table `order` (
    id integer not null auto_increment,
    contract_date date not null,
    period_of_execution date not null,
    customer_id integer not null,
    work_object_id integer not null,
    status enum ('В работе', 'Завершено',
        'Отменено') not null,
    primary key (id),
    foreign key (customer_id)
        references customer (id),
    foreign key (work_object_id)
        references work_object (id)
);

create table employee (
    id integer not null auto_increment,
    full_name varchar(64) not null,
    position varchar(64) not null,
    phone_number varchar(32) not null,
    email_address varchar(64) null,
    primary key (id),
    unique key (phone_number),
    unique key (email_address)
);

create table exit_to_object (
    id integer not null auto_increment,
    order_id integer not null,
    brigade_gathering_datetime datetime not null,
    primary key (id),
    foreign key (order_id)
        references `order` (id),
    unique key (order_id, brigade_gathering_datetime)
);

create table work_task (
    id integer not null auto_increment,
    task_id integer not null,
    exit_to_object_id integer not null,
    primary key (id),
    foreign key (task_id)
        references task (id),
    foreign key (exit_to_object_id)
        references exit_to_object (id),
    unique key (task_id, exit_to_object_id)
);

create table equipment (
    id integer not null auto_increment,
    item_id integer not null,
    item_quantity integer not null,
    exit_to_object_id integer not null,
    primary key (id),
    foreign key (item_id)
        references item (id),
    foreign key (exit_to_object_id)
        references exit_to_object (id),
    unique key (item_id, exit_to_object_id)
);

create table renovating_brigade (
    id integer not null auto_increment,
    employee_id integer not null,
    exit_to_object_id integer not null,
    primary key (id),
    foreign key (employee_id)
        references employee (id),
    foreign key (exit_to_object_id)
        references exit_to_object (id),
    unique key (employee_id, exit_to_object_id)
);

create table user (
    id integer not null auto_increment,
    username varchar(64) not null,
    password_hash char(60) not null,
    primary key (id),
    unique key (username)
);
