create database sbkk;
create role administrator with login password 'cisco';
\c sbkk administrator
cisco

create sequence seq_operatorid;
create sequence seq_serverid;
create sequence seq_serverstatusid;

create table operator (
	id_operator int primary key default nextval('seq_operatorid'),
	fullname text not null,
	email text,
	login text not null,
	password text not null
);

create table server (
	id_server int primary key default nextval('seq_serverid'),
	id_operator int references operator (id_operator) on delete set null,
	invent_num int2,
	name text,
	description text,
	model text
);

create table server_state (
	id_serverstate int primary key default nextval('seq_serverstatusid'),
	id_server int references server (id_server) on delete cascade,
	status int,
	smoke boolean,
	temperature int,
	cpu_load int,
	date date
);

