drop database if exists sb;
create database sb;

drop table if exists sb.consumables;
create table sb.consumables (
consID char (5) primary key,
consName varchar (20) not null
);

insert into sb.consumables values ('1', 'Beverages');
insert into sb.consumables values ('2', 'Food');


drop table if exists sb.subconsumables;
create table sb.subconsumables(
subconsID char (5) primary key,
consID char (5),
foreign key (consID) references sb.consumables (consID) on delete set null on update cascade,
subconsName varchar (10) not null,
imagePath varchar (15)
);

insert into sb.subconsumables values ('1', '1', 'Tea', 'tea.jpg');
insert into sb.subconsumables values ('2', '1', 'Frappe', 'frappe.jpeg');
insert into sb.subconsumables values ('3', '1', 'Coffee', 'coffee.jpg');
insert into sb.subconsumables values ('4', '2', 'Sandwich', 'sandwich.jpg');
insert into sb.subconsumables values ('5', '2', 'Wrap', 'wrap.jpg');
insert into sb.subconsumables values ('6', '2', 'Cake', 'cake.jfif');

drop table if exists sb.beverageSizes;
create table sb.beverageSizes (
sizeID char (5) primary key,
sizeName varchar (10) not null,
sizeAddPrice integer (5) not null
);

insert into sb.beverageSizes values ('1', 'Tall', 0);
insert into sb.beverageSizes values ('2', 'Grande', 15);
insert into sb.beverageSizes values ('3', 'Venti', 30);

drop table if exists sb.products;
create table sb.products (
prodID char (5) primary key,
consID char (5),
subconsID char (5),
foreign key (consID) references sb.consumables (consID) on delete set null on update cascade,
foreign key (subconsID) references sb.subconsumables (subconsID) on delete set null on update cascade,
prodName varchar (50) not null,
prodPrice integer (5) not null,
imagePath varchar (15)
);

insert into sb.products values ('100', '1', '1', 'Chai Tea Latte', '155', '100.jpg');
insert into sb.products values ('101', '1', '1', 'Earl Grey Latte', '140', '101.jpg');
insert into sb.products values ('102', '1', '1', 'Jade Citrus Mint Brewed Tea','155', '102.jpg');
insert into sb.products values ('103', '1', '1', 'Matcha Tea Latte', '155', '103.jpg');
insert into sb.products values ('104', '1', '1', 'Honey Citrus Mint Tea', '155', '104.jpg');
insert into sb.products values ('105', '1', '1', 'Comfort Brewed Wellness Tea', '120', '105.jpg');
insert into sb.products values ('106', '1', '1', 'London Fog Tea Latte', '140', '106.jpg');

insert into sb.products values ('107', '1', '2', 'Strawberry Creme Frappuccino', '150', '107.png');
insert into sb.products values ('108', '1', '2', 'Mocha Frappuccino', '155', '108.jpg');
insert into sb.products values ('109', '1', '2', 'Caramel Frappuccino', '155', '109.jpg');
insert into sb.products values ('110', '1', '2', 'Double Chocolaty Chip Creme Frappuccino', '170', '110.jpg');
insert into sb.products values ('111', '1', '2', 'Java Chip Frappuccino', '170', '111.jpg');
insert into sb.products values ('112', '1', '2', 'Cookies and Cream Frappuccino', '170', '112.jpg');
insert into sb.products values ('113', '1', '2', 'Toasted White Chocolate Mocha Frappuccino', '150', '113.jpg');	

insert into sb.products values ('114', '1', '3', 'Caffe Americano', '130', '114.jpg');
insert into sb.products values ('115', '1', '3', 'Cappuccino', '140', '115.jpg');
insert into sb.products values ('116', '1', '3', 'Caffe Latte', '140', '116.jpg');
insert into sb.products values ('117', '1', '3', 'Caramel Macchiato', '165', '117.jpg');
insert into sb.products values ('118', '1', '3', 'Caffe Mocha', '155', '118.jpg');
insert into sb.products values ('119', '1', '3', 'Flat White', '165', '119.jpg');
insert into sb.products values ('120', '1', '3', 'Cold Foam Iced Espresso', '170', '120.png');

insert into sb.products values ('200', '2', '4', 'Crispy Grilled Cheese on Sourdough', '160', '200.jpg');
insert into sb.products values ('201', '2', '4', 'Roasted Ham, Swiss and Egg', '205', '201.jpg');
insert into sb.products values ('202', '2', '4', 'Chicken & Bacon on Brioche', '165', '202.jpg');
insert into sb.products values ('203', '2', '4', 'Ham & Swiss on Baguette', '165', '203.jpg');

insert into sb.products values ('204', '2', '5', 'Bacon, Sausage & Egg Wrap', '175', '204.jpg');
insert into sb.products values ('205', '2', '5', 'Spinach, Feta & Egg White Wrap', '180', '205.jpg');

insert into sb.products values ('206', '2', '6', 'Basque Cheesecake', '215', '206.png');
insert into sb.products values ('207', '2', '6', 'Classic Chocolate Cake', '225', '207.png');
insert into sb.products values ('208', '2', '6', 'Cinnamon Coffee Cake', '215', '208.jpg');
insert into sb.products values ('209', '2', '6', 'Blueberry Cheesecake', '200', '209.png');
insert into sb.products values ('210', '2', '6', 'New York Cheesecake', '250', '210.jpg');

drop table if exists sb.transactions;
create table sb.transactions (
itemNo integer primary key,
transactionID integer,
itemName varchar (50),
itemPrice integer,
itemQty integer,
itemTotal integer,
custName varchar (50),
transactionStatus varchar (10)
);

select * from sb.consumables;
select * from sb.subconsumables;		
select * from sb.beverageSizes;
select * from sb.products;
select * from sb.transactions;					

