CREATE DATABASE sge_coworking character set utf8mb4 collate utf8mb4_unicode_ci;
Use sge_coworking;

Create Table perfis(
  id unsigned auto_increment primary key,
  nome varchar(50) no null unique
);

Create table utilizadores (
	id int unsigned auto_increment primary key,
    nome varchar(100) not null,
    email varchar(150) not null unique,
    password_hash varchar(255) not null,
    perfil_id int unsigned not null,
    ativo tinyint(1) not null default 1,
    criado_em timestamp not null default current_timestamp,
	
    foreign key(perfil_id) references perfis(id)
);

Create table clientes(
	id int unsigned auto_increment primary key,
    utilizador_id int unsigned not null unique,
    tipo_cliente enum('individual', 'empresa') not null default 'individual',
    nif varchar(20) null,
    contacto varchar(20) null,
    
    foreign key (utilizador_id) references utilizadores(id)
);

Create table gestores(
	id int unsigned auto_increment primary key,
    utilizador_id int unsigned not null unique,
    numero_funcionario varchar(20) not null unique,
    turno enum('manha', 'tarde', 'noite') not null,
    data_admissao date not null,
    
    foreign key (utilizador_id) references utilizadores(id)
);

Create table salas(
	id int unsigned auto_increment primary key,
    nome varchar(100) not null,
    tipo enum ('sala_reuniao', 'mesa_individual', 'open_space') not null,
    capacidade int unsigned not null,
    preco_hora decimal(10,2) not null,
    descricao text null,
    disponivel tinyint(1) not null default 1
);

Create table planos(
	id int unsigned auto_increment primary key,
    nome varchar(50) not null unique, 
    descricao text null, 
    preco decimal(10,2) not null default 0.00,
    duracao_dias int unsigned null,
    limite_reservas int unsigned null,
    beneficios text null
);

Create table assinaturas_planos(
	id int unsigned auto_increment primary key,
    cliente_id int unsigned not null,
    plano_id int unsigned not null,
    data_inicio date not null,
    data_fim date null,
    estado enum('ativo', 'expirado', 'cancelado', 'esgotado') not null default 'ativo',
    
    foreign key (cliente_id) references clientes(id),
    foreign key (plano_id) references planos(id)
);

Create table reservas (
	id int unsigned auto_increment primary key,
    cliente_id int unsigned not null,
    sala_id int unsigned not null,
    assinatura_id int unsigned null,
    data Date not null,
    hora_inicio Time Not null,
    hora_fim time not null,
    estado Enum('pendente', 'confirmada', 'cancelada') not null default 'pendente',
    
    foreign key (cliente_id) references clientes(id),
    foreign key (sala_id) references salas(id),
    foreign key (assinatura_id) references assinaturas_planos(id)
);

Create table checkins(
	id int unsigned auto_increment primary key,
    reserva_id int unsigned not null unique,
    hora_entrada datetime null,
    hora_saida datetime null,

	foreign key (reserva_id) references reservas(id)
);

Create table pagamentos (
	id int unsigned auto_increment primary key,
    cliente_id int unsigned not null,
    reserva_id int unsigned null,
    assinatura_id int unsigned null,
    valor decimal(10,2) not null,
    metodo_pagamento enum('dinheiro', 'transferencia', 'cartao', 'multicaixa_express') not null,
    data_pagamento datetime not null default current_timestamp,
    estado enum('pago', 'pendente', 'reembolsado') not null default 'pendente',
    
    foreign key (cliente_id) references clientes(id),
    foreign key (reserva_id) references reservas(id),
    foreign key (assinatura_id) references assinaturas_planos(id)
);


Create table logs_auditoria(
	id int unsigned auto_increment primary key,
    utilizador_id int unsigned not null,
    acao varchar(255) not null, 
    tabela_afetada varchar(50) not null,
    registo_id int unsigned null,
    data_hora datetime not null default current_timestamp,
    
    foreign key (utilizador_id) references utilizadores(id)
);
