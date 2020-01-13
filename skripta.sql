create database aboras_19 default character set utf8;
use aboras_19;
create table utakmica(
    sifra int not null primary key auto_increment,
    datum date not null,
    opis varchar(255) not null,
    rezultat varchar(255) not null
);
insert into utakmica(datum, opis, rezultat)
values ('2020-01-13', 'Barca-Real', '2:1');

select * from utakmica;
