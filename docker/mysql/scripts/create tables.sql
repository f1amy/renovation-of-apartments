use renovation_of_apartments;

create table if not exists task (
    id integer not null auto_increment,
    text varchar(64) not null,
    cost decimal(10, 2) not null,
    primary key (id),
    unique key (text)
);

create table if not exists warehouse (
    id integer not null auto_increment,
    name varchar(32) not null,
    address varchar(64) not null,
    primary key (id),
    unique key (name),
    unique key (address)
);

create table if not exists item (
    id integer not null auto_increment,
    warehouse_id integer not null,
    name varchar(32) not null,
    quantity integer not null,
    purchase_price decimal(10, 2) not null,
    type enum ('Инструмент', 'Материал') not null,
    primary key (id),
    foreign key (warehouse_id)
        references warehouse (id),
    unique key (warehouse_id, name)
);

create table if not exists contract (
    id integer not null auto_increment,
    number integer not null,
    date date not null,
    primary key (id),
    unique key (number)
);

create table if not exists customer (
    id integer not null auto_increment,
    full_name varchar(64) not null,
    phone_number varchar(32) not null,
    email_address varchar(64) null,
    primary key (id),
    unique key (phone_number),
    unique key (email_address)
);

create table if not exists work_object (
    id integer not null auto_increment,
    house_address varchar(64) not null,
    apartment_number integer not null,
    entrance_number integer null,
    floor_number integer null,
    primary key (id),
    unique key (house_address, apartment_number)
);

create table if not exists `order` (
    id integer not null auto_increment,
    contract_id integer not null,
    customer_id integer not null,
    work_object_id integer not null,
    primary key (id),
    foreign key (contract_id)
        references contract (id),
    foreign key (customer_id)
        references customer (id),
    foreign key (work_object_id)
        references work_object (id),
    unique key (contract_id)
);

create table if not exists employee (
    id integer not null auto_increment,
    full_name varchar(64) not null,
    phone_number varchar(32) not null,
    email_address varchar(64) null,
    position varchar(64) not null,
    primary key (id),
    unique key (phone_number),
    unique key (email_address)
);

create table if not exists exit_to_object (
    id integer not null auto_increment,
    order_id integer not null,
    brigade_gathering_datetime datetime not null,
    primary key (id),
    foreign key (order_id)
        references `order` (id),
    unique key (order_id, brigade_gathering_datetime)
);

create table if not exists work_task (
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

create table if not exists equipment (
    id integer not null auto_increment,
    item_id integer not null,
    exit_to_object_id integer not null,
    item_quantity integer not null,
    primary key (id),
    foreign key (item_id)
        references item (id),
    foreign key (exit_to_object_id)
        references exit_to_object (id),
    unique key (item_id, exit_to_object_id)
);

create table if not exists renovating_brigade (
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

create table if not exists user (
    id integer not null auto_increment,
    username varchar(64) not null,
    password_hash char(60) not null,
    primary key (id),
    unique key (username)
);
