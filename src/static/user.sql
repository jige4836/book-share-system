#创建数据库
# create database book_share_system;

# 使用数据库
use book_share_system;

drop table if exists buy;
#积分商城
create table buy
(
    buy_id int auto_increment primary key ,
    uid      int,
    bid      int,
    credit   int,     #购买花费积分
    buy_time datetime #购买时间
);

# select * from user_message,book,book_time,booktype where book_time.uid=user_message.uid and book.bid=book_time.bid and book.bt_id=booktype.bt_id and username like '%{$username}%';

# insert into user_message (uid, username, phone, password, gender, birthday)values ('$uid','$username','$phone','$gender','$birthday');

# select book.bid,ISBN,bname,author,number,username,buy.credit,buy_time from buy,book,user_message where buy.uid=user_message.uid and book.bid=buy.bid and buy.uid='$uid';

# insert into buy (uid, bid, credit, buy_time) values ('$uid','$bid',1,now());

# update book set number=number-1 where bid='$bid';

# update user_message set credit=credit-1 where uid='$uid';

# select *
# from buy;

drop table if exists shopping;
#购物车
create table shopping
(
    shop_id int auto_increment primary key ,
    uid    int,
    bid    int,
#   bname varchar(30),
    number int
#     primary key (uid, bid)
);

# delete from shopping where bid='$bid'and uid='$uid';

# select book.bid,ISBN,bname,author,bt_name from shopping,book,booktype where book.bt_id=booktype.bt_id and shopping.bid=book.bid and shopping.uid='$uid' order by book.bt_id;

# select book.bid,ISBN,bname,author,bt_name from shopping,book,booktype where book.bt_id=booktype.bt_id and shopping.bid=book.bid and uid='$uid';

# insert into shopping(uid, bid, number)values ('$uid','$bid',1);

# select * from shopping where uid='$uid';

drop table if exists share;
#共享书籍
create table share
(
    sid    int auto_increment primary key,
    uid    int,
    bid    int,
    ISBN   varchar(30) unique,
    bname  varchar(20) not null,
    author varchar(20),
    number int,
    bt_id  int
);

# insert into share(uid, bid, ISBN, bname, author, number, bt_id)
# values ('$uid', '$bid', '$ISBN', '$bname', '$author', '$number', '$bt_id');

# update book
# set number=number - 1
# where ISBN = '$ISBN';

# delete
# from share
# where bid = '$bid'
#   and uid = '$uid';

# insert into share(uid, bid, ISBN, bname, author, number, bt_id)
# values ('$uid', '$bid', '$ISBN', '$bname', '$author', '$number', '$bt_id');

# select *
# from book;
# select *
# from share,
#      user_message
# where share.uid = user_message.uid
# order by sid;

# update user_message
# set credit=credit + 1
# where uid = '$uid';

# update book
# set number=number + '$number'
# where ISBN = '$ISBN';

# select *
# from book
# where ISBN = '$ISBN';

# insert into share(uid, ISBN, bname, author, number, bt_id)
# values ('$uid', '$ISBN', '$bname', '$author', '$number', '$bt_id');

# select *
# from book_time
# where uid = '$uid'
#   and bid = '$bid';

# update book_time
# set borrow_time=now();

drop table if exists book_time;
#借出与归还时间
create table book_time
(
    time_id     int primary key auto_increment,
    uid         int not null,
    bid         int not null,
    lend_time   datetime, #借出时间
    dateline    datetime, #归还截止日期
    borrow_time datetime,  #归还时间
    static int            #”1“已归还；”2“未归还
#     primary key (uid, bid) #设置联合主键，防止一个账号重复借阅一本书
);

# insert into book_time(uid, bid, lend_time,dateline) values ('$uid', '$bid', 'now()','$dateline');

# select ISBN,bname,username,lend_time,dateline,static from user_message as um,book_time as bt,book as b where bt.uid='$uid' and bt.bid=b.bid and bt.uid=um.uid and phone='$phone' and password='$password' order by time_id;

# update book_time set dateline='$dateline'where uid='$uid'and lend_time='$lend_time';

# select ISBN, bname, username, lend_time
# from user_message as um,
#      book_time as bt,
#      book as b
# where bt.uid = 1
#   and bt.bid = b.bid
#   and bt.uid = um.uid
#   and phone = '$phone'
#   and password = '$password'
# order by bt.lend_time;

# select uid
# from user_message
# where phone = '$phone'
#   and password = '$password';

# select * from user_message where uid=1 and phone=15816652214;

# select ISBN,bname,author,number,bt_name from book,booktype where book.bt_id=booktype.bt_id and bname like '一' or author like '一';

# insert into book_time(uid, bid, lend_time,dateline) values ('$uid', '$bid', now(), '$dateline');

# insert into book_time(uid, bid, borrow_time)
# values ('$uid', '$bid', 'now()');

drop table if exists user_message;
# 用户个人信息表
create table user_message
(
    uid      int auto_increment primary key,
    username varchar(20)        not null,
    phone    varchar(20) unique not null,#手机号，即账号
    password varchar(20)        not null,
    gender   int,#性别
    birthday date,#出生日期
    credit   int default 1               #积分
#     last_time datetime
);

# update user_message set password='$psw'where phone='$phone';

# update user set password='$psw' where phone='$phone';

# update user_message
# set username='$username',
#     gender='$gender',
#     birthday='$birthday'
# where phone = '$phone'
#   and password = '$password';

insert into user_message(username, phone, password, gender, birthday)
values ('张三', '15816652214', '123', 1, '2002-4-1');

insert into user_message(username, phone, password, gender, birthday)
values ('赵六', '13553387866', '123', 1, '1979-7-12');

# select *
# from user_message
# where password = '$password'
#   and phone = '$phone';

drop table if exists user;
# 用户表
create table user
(
    uid      int auto_increment primary key,
    phone    varchar(20) unique not null,#手机号，即账号
    password varchar(20)        not null
);

# select *
# from user;

insert into user(phone, password)
values ('15816652214', '123');

drop table if exists user_book;
#借书记录
create table user_book
(
    uid   int not null,
    bid   int not null,
    state int default 0
);

# select ISBN,bname,username,lend_time,borrow_time,static from user_message as um,book_time as bt,book as b where bt.uid='$uid' and bt.bid=b.bid and bt.uid=um.uid and phone='$phone' and password='$password' order by time_id;


# update book,user set number=1,password='121'where bid=bid ;

drop table if exists book;
# 书籍表
create table book
(
    bid    int auto_increment primary key,
    ISBN   varchar(30) unique,
    bname  varchar(20) not null,
    author varchar(20),
    number int,
    bt_id  int
#     time_id int auto_increment
#     last_time datetime
);

# select *
# from book;

insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('331241', '概率论', '赵一', 3, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('412439', '数字图像', '赵一', 3, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('512432', '大学英语', '赵一', 4, 2);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('543345', 'web程序设计', '赵一', 5, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('453523', '计算机网络原理', '赵一', 3, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('142142', '软件工程', '赵一', 3, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('543264', 'Linux基础教程', '张三', 2, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('543265', 'Linux基础教程', '赵一', 6, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('432434', '大学数学', '赵一', 3, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('413412', '大学物理', '赵一', 11, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('754362', '计算方法', '赵一', 3, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('436422', '军事理论', '赵一', 7, 2);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('412221', '白夜行', '赵一', 3, 1);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('432421', '挪威的森林', '赵一', 1, 1);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('414353', '十万个为什么', '赵一', 3, 1);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('521532', '小王子', '赵一', 0, 1);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('765744', 'Java从入门到入土', '赵一', 3, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('064543', 'C++从入门到入土', '赵一', 7, 4);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('542523', '三体', '赵一', 3, 1);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('222132', '盗墓笔记', '赵一', 0, 1);
insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID)
values ('325325', '母猪的产后护理', '赵一', 1, 3);


drop table if exists booktype;
#书籍类别
create table booktype
(
    bt_id   int         not null,
    bt_name varchar(30) not null
);

insert into booktype
values (1, '文学类'),
       (2, '人文社科类'),
       (3, '自然科学类'),
       (4, '技术科学类'),
       (5, '艺术类');

# select *
# from share,
#      user_message,
#      booktype
# where share.bt_id = booktype.bt_id
#   and share.uid = '1'
#   and share.uid = user_message.uid
# order by sid;

# select *
# from booktype;

# select *
# from book;


# select *
# from book
# where bname like '%数学%';

# select *
# from user;
