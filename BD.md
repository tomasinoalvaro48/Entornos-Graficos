drop DATABASE IF EXISTS `tp_entornos_graficos`;
CREATE DATABASE IF NOT EXISTS `tp_entornos_graficos`;

CREATE TABLE IF NOT EXISTS `tp_entornos_graficos`.`usuario` (
	`id_usuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre_usuario` VARCHAR(100) NULL,
	`email_usuario` VARCHAR(100) NULL,
	`clave_usuario` VARCHAR(50) NULL,
	`tipo_usuario` VARCHAR(15) NULL,
	`categoria_cliente` VARCHAR(10) NULL,
    `estado_dueno` VARCHAR(10) NULL,
    `estado_mail` VARCHAR(15) NULL,
    `token_verificacion` VARCHAR(255) NULL,
	PRIMARY KEY (`id_usuario`),
	UNIQUE INDEX `id_usuario_UNIQUE` (`id_usuario` ASC) VISIBLE);
                        
CREATE TABLE IF NOT EXISTS `tp_entornos_graficos`.`dias_semana` (
	`id_dia` INT UNSIGNED NOT NULL,
	`nombre_dia` VARCHAR(15) NOT NULL,
	PRIMARY KEY (`id_dia`),
	UNIQUE INDEX `id_dia_UNIQUE` (`id_dia` ASC) VISIBLE);
                        
CREATE TABLE IF NOT EXISTS `tp_entornos_graficos`.`local` (
	`id_local` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ubicacion_local` VARCHAR(50) NULL,
	`nombre_local` VARCHAR(100) NULL,
	`rubro_local` VARCHAR(20) NULL,
	`id_usuario` INT UNSIGNED NULL,
    `estado_elim_local` VARCHAR(15) NULL,
    `imagen_local` VARCHAR(255) NULL,
	PRIMARY KEY (`id_local`),
	UNIQUE INDEX `id_local_UNIQUE` (`id_local` ASC) VISIBLE,
	INDEX `fk_id_usuario_idx` (`ubicacion_local` ASC) VISIBLE,
		CONSTRAINT `fk_id_usuario`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `tp_entornos_graficos`.`usuario` (`id_usuario`)
		ON DELETE RESTRICT
		ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS `tp_entornos_graficos`.`promocion` (
	`id_promo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`texto_promo` VARCHAR(200) NULL,
	`fecha_desde_promo` DATE NULL,
	`fecha_hasta_promo` DATE NULL,
	`categoria_cliente_promo` VARCHAR(10) NULL,
	`estado_promo` VARCHAR(10) NULL,
	`id_local` INT UNSIGNED NULL,
    `estado_elim_promo` VARCHAR(15) NULL,
    `imagen_promo` VARCHAR(255) NULL,
	PRIMARY KEY (`id_promo`),
	UNIQUE INDEX `id_promo_UNIQUE` (`id_promo` ASC) VISIBLE,
	INDEX `fk_id_local_idx` (`id_local` ASC) VISIBLE,
		CONSTRAINT `fk_id_local`
		FOREIGN KEY (`id_local`)
		REFERENCES `tp_entornos_graficos`.`local` (`id_local`)
		ON DELETE RESTRICT
		ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS `tp_entornos_graficos`.`dias_promo` (
	`id_dia` INT UNSIGNED NOT NULL,
	`id_promo` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`id_dia`, `id_promo`),
	INDEX `fk_id_promo_idx` (`id_promo` ASC) VISIBLE,
	CONSTRAINT `fk_id_dia`
		FOREIGN KEY (`id_dia`)
		REFERENCES `tp_entornos_graficos`.`dias_semana` (`id_dia`)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	CONSTRAINT `fk_id_promo`
		FOREIGN KEY (`id_promo`)
		REFERENCES `tp_entornos_graficos`.`promocion` (`id_promo`)
		ON DELETE RESTRICT
		ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS `tp_entornos_graficos`.`uso_promocion` (
	`id_cli` INT UNSIGNED NOT NULL,
	`id_promo` INT UNSIGNED NOT NULL,
	`fecha_uso_promo` DATE NULL,
	`estado_uso_promo` VARCHAR(10) NULL,
	PRIMARY KEY (`id_cli`, `id_promo`),
	INDEX `fk_id_promo_idx` (`id_promo` ASC) VISIBLE,
	CONSTRAINT `fk_id_cli`
		FOREIGN KEY (`id_cli`)
		REFERENCES `tp_entornos_graficos`.`usuario` (`id_usuario`)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	CONSTRAINT `fk_uso_promocion_id_promo`
		FOREIGN KEY (`id_promo`)
		REFERENCES `tp_entornos_graficos`.`promocion` (`id_promo`)
		ON DELETE RESTRICT
		ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS `tp_entornos_graficos`.`novedad` (
	`id_novedad` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`texto_nov` VARCHAR(200) NULL,
	`fecha_desde_nov` DATE NULL,
	`fecha_hasta_nov` DATE NULL,
	`categoria_cliente_nov` VARCHAR(15) NULL,
    `estado_elim_novedad` VARCHAR(15) NULL,
    `imagen_novedad` VARCHAR(255) NULL,
	PRIMARY KEY (`id_novedad`),
	UNIQUE INDEX `id_novedad_UNIQUE` (`id_novedad` ASC) VISIBLE);

INSERT INTO tp_entornos_graficos.dias_semana (id_dia, nombre_dia)
	VALUES (1, 'Lunes'), (2, 'Martes'), (3, 'Miércoles'),
	(4, 'Jueves'), (5, 'Viernes'), (6, 'Sábado'), (7, 'Domingo');
    
INSERT INTO tp_entornos_graficos.usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, estado_mail)
	VALUES ('Administrador', 'adm@a', md5('123456'), 'admin', 'confirmado');

#Cargas de clientes - TEST
INSERT INTO tp_entornos_graficos.usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, categoria_cliente, estado_mail) 
	VALUES ('Cliente Inicial', 'cliIni@cli', md5('123456'),'cliente', 'inicial', 'confirmado');
    
INSERT INTO tp_entornos_graficos.usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, categoria_cliente, estado_mail) 
	VALUES ('Cliente Medium', 'cliMed@cli', md5('123456'),'cliente', 'medium', 'confirmado');
    
INSERT INTO tp_entornos_graficos.usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, categoria_cliente, estado_mail) 
	VALUES ('Cliente Premium', 'cliPre@cli', md5('123456'),'cliente', 'premium', 'confirmado');

#Cargas de dueños - TEST
INSERT INTO tp_entornos_graficos.usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, estado_dueno, estado_mail) 
	VALUES ('Dueño Aceptado', 'dueA@d', md5('123456'), 'dueno', 'aceptado', 'confirmado');

INSERT INTO tp_entornos_graficos.usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, estado_dueno, estado_mail) 
	VALUES ('Dueño Rechazado', 'dueR@d', md5('123456'), 'dueno', 'aceptado', 'confirmado');
    
