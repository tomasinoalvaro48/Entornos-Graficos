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
	VALUES ('Dueño Rechazado', 'dueR@d', md5('123456'), 'dueno', 'rechazado', 'confirmado');

#Cargas de locales - TEST
INSERT INTO tp_entornos_graficos.local (nombre_local, ubicacion_local, rubro_local, id_usuario, estado_elim_local, imagen_local)
	VALUES ('Pizzería Don Mario', 'Av. Siempre Viva 742', 'gastronomia', 5, 'activo', 'default_local.svg');

INSERT INTO tp_entornos_graficos.local (nombre_local, ubicacion_local, rubro_local, id_usuario, estado_elim_local, imagen_local)
	VALUES ('Heladería Fría', 'Calle Falsa 123', 'gastronomia', 5, 'activo', 'default_local.svg');

INSERT INTO tp_entornos_graficos.local (nombre_local, ubicacion_local, rubro_local, id_usuario, estado_elim_local, imagen_local)
	VALUES ('Óptica Visión', 'Belgrano 456', 'salud', 5, 'activo', 'default_local.svg');

INSERT INTO tp_entornos_graficos.local (nombre_local, ubicacion_local, rubro_local, id_usuario, estado_elim_local, imagen_local)
	VALUES ('Librería Central', 'San Martín 789', 'comercio', 5, 'activo', 'default_local.svg');

INSERT INTO tp_entornos_graficos.local (nombre_local, ubicacion_local, rubro_local, id_usuario, estado_elim_local, imagen_local)
	VALUES ('Gym Power', 'Mitre 321', 'deporte', 5, 'eliminado', 'default_local.svg');

#Cargas de promociones - TEST
INSERT INTO tp_entornos_graficos.promocion (texto_promo, fecha_desde_promo, fecha_hasta_promo, categoria_cliente_promo, estado_promo, id_local, estado_elim_promo, imagen_promo)
	VALUES ('2x1 en pizzas grandes', '2026-09-01', '2026-09-30', 'inicial', 'aprobada', 1, 'activa', 'default_promo.svg');

INSERT INTO tp_entornos_graficos.promocion (texto_promo, fecha_desde_promo, fecha_hasta_promo, categoria_cliente_promo, estado_promo, id_local, estado_elim_promo, imagen_promo)
	VALUES ('20% OFF en helados', '2026-09-01', '2026-09-15', 'medium', 'aprobada', 2, 'activa', 'default_promo.svg');

INSERT INTO tp_entornos_graficos.promocion (texto_promo, fecha_desde_promo, fecha_hasta_promo, categoria_cliente_promo, estado_promo, id_local, estado_elim_promo, imagen_promo)
	VALUES ('Lentes de sol 3 cuotas sin interés', '2026-08-15', '2026-10-15', 'premium', 'aprobada', 3, 'activa', 'default_promo.svg');

INSERT INTO tp_entornos_graficos.promocion (texto_promo, fecha_desde_promo, fecha_hasta_promo, categoria_cliente_promo, estado_promo, id_local, estado_elim_promo, imagen_promo)
	VALUES ('15% en útiles escolares', '2026-08-01', '2026-08-31', 'inicial', 'pendiente', 4, 'activa', 'default_promo.svg');

INSERT INTO tp_entornos_graficos.promocion (texto_promo, fecha_desde_promo, fecha_hasta_promo, categoria_cliente_promo, estado_promo, id_local, estado_elim_promo, imagen_promo)
	VALUES ('Clase de prueba gratis', '2026-07-01', '2026-07-31', 'medium', 'denegada', 5, 'eliminada', 'default_promo.svg');

INSERT INTO tp_entornos_graficos.promocion (texto_promo, fecha_desde_promo, fecha_hasta_promo, categoria_cliente_promo, estado_promo, id_local, estado_elim_promo, imagen_promo)
	VALUES ('Combo familiar pizza + bebida', '2026-09-10', '2026-12-31', 'premium', 'aprobada', 1, 'activa', 'default_promo.svg');

#Cargas de dias_promo - TEST
INSERT INTO tp_entornos_graficos.dias_promo (id_dia, id_promo)
	VALUES (1, 1), (3, 1), (5, 1);

INSERT INTO tp_entornos_graficos.dias_promo (id_dia, id_promo)
	VALUES (6, 2), (7, 2);

INSERT INTO tp_entornos_graficos.dias_promo (id_dia, id_promo)
	VALUES (1, 3), (2, 3), (3, 3), (4, 3), (5, 3);

INSERT INTO tp_entornos_graficos.dias_promo (id_dia, id_promo)
	VALUES (1, 4), (2, 4), (3, 4), (4, 4), (5, 4), (6, 4);

INSERT INTO tp_entornos_graficos.dias_promo (id_dia, id_promo)
	VALUES (1, 5), (3, 5), (5, 5);

INSERT INTO tp_entornos_graficos.dias_promo (id_dia, id_promo)
	VALUES (5, 6), (6, 6), (7, 6);

#Cargas de uso_promocion - TEST
INSERT INTO tp_entornos_graficos.uso_promocion (id_cli, id_promo, fecha_uso_promo, estado_uso_promo)
	VALUES (2, 1, '2026-09-05', 'aceptada');

INSERT INTO tp_entornos_graficos.uso_promocion (id_cli, id_promo, fecha_uso_promo, estado_uso_promo)
	VALUES (3, 2, '2026-09-03', 'aceptada');

INSERT INTO tp_entornos_graficos.uso_promocion (id_cli, id_promo, fecha_uso_promo, estado_uso_promo)
	VALUES (4, 3, NULL, 'enviada');

INSERT INTO tp_entornos_graficos.uso_promocion (id_cli, id_promo, fecha_uso_promo, estado_uso_promo)
	VALUES (4, 6, NULL, 'enviada');

INSERT INTO tp_entornos_graficos.uso_promocion (id_cli, id_promo, fecha_uso_promo, estado_uso_promo)
	VALUES (3, 1, '2026-09-10', 'rechazada');

INSERT INTO tp_entornos_graficos.uso_promocion (id_cli, id_promo, fecha_uso_promo, estado_uso_promo)
	VALUES (4, 2, '2026-09-08', 'aceptada');

#Cargas de novedades - TEST
INSERT INTO tp_entornos_graficos.novedad (texto_nov, fecha_desde_nov, fecha_hasta_nov, categoria_cliente_nov, estado_elim_novedad, imagen_novedad)
	VALUES ('¡Nueva sucursal de Pizzería Don Mario en zona norte!', '2026-09-01', '2026-09-30', 'inicial', 'activa', 'default_novedad.svg');

INSERT INTO tp_entornos_graficos.novedad (texto_nov, fecha_desde_nov, fecha_hasta_nov, categoria_cliente_nov, estado_elim_novedad, imagen_novedad)
	VALUES ('Semana del helado artesanal - Nuevos sabores disponibles', '2026-09-01', '2026-09-07', 'medium', 'activa', 'default_novedad.svg');

INSERT INTO tp_entornos_graficos.novedad (texto_nov, fecha_desde_nov, fecha_hasta_nov, categoria_cliente_nov, estado_elim_novedad, imagen_novedad)
	VALUES ('Óptica Visión: Llegaron los nuevos modelos Ray-Ban 2026', '2026-08-20', '2026-10-20', 'premium', 'activa', 'default_novedad.svg');

INSERT INTO tp_entornos_graficos.novedad (texto_nov, fecha_desde_nov, fecha_hasta_nov, categoria_cliente_nov, estado_elim_novedad, imagen_novedad)
	VALUES ('Feria del libro en Librería Central - Descuentos especiales', '2026-08-01', '2026-08-31', 'inicial', 'eliminada', 'default_novedad.svg');

INSERT INTO tp_entornos_graficos.novedad (texto_nov, fecha_desde_nov, fecha_hasta_nov, categoria_cliente_nov, estado_elim_novedad, imagen_novedad)
	VALUES ('Gym Power reabre con equipamiento renovado', '2026-09-15', '2026-10-15', 'medium', 'activa', 'default_novedad.svg');
