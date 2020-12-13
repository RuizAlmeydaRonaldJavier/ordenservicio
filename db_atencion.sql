-- Eliminamos la base de datos si esta creada
DROP DATABASE IF EXISTS db_atencion;
-- Creamos la base de datos
CREATE DATABASE db_atencion;
-- Usamos la base de datos
USE db_atencion;
 
-- Creamos la tabla persona
CREATE TABLE personas (
	id_persona 			INT(11) NOT NULL AUTO_INCREMENT,
    documento           VARCHAR(20) NOT NULL,
	nombre 				VARCHAR(45) NOT NULL,
	apellido_paterno	VARCHAR(45) NOT NULL,
	apellido_materno	VARCHAR(45) NOT NULL,
	fecha_nacimiento	DATE NOT NULL,
	correo	 			VARCHAR(45),
	sexo	 			VARCHAR(10) NOT NULL,
  PRIMARY KEY (id_persona),
  UNIQUE INDEX documento_unique (documento)
);

-- Creamos la tabla tipo de atencion
CREATE TABLE tipo_atenciones (
	id_tip_atencion INT(11) NOT NULL AUTO_INCREMENT,
	descripcion		 VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_tip_atencion)
);

-- Creamos la tabla usuario
CREATE TABLE usuarios (
	id_usuario		INT(11) NOT NULL AUTO_INCREMENT,
	id_persona 		INT(11) NOT NULL,
  tipo_usuario	VARCHAR(45) NOT NULL,
	nom_usuario     VARCHAR(45) NOT NULL,
	contrasenia		VARCHAR(45) NOT NULL,
	estado 			VARCHAR(10) NOT NULL,
  PRIMARY KEY (id_usuario)
);

-- Creamos la tabla ambiente
CREATE TABLE ambientes (
	id_ambiente        INT(11) NOT NULL AUTO_INCREMENT,
	id_tip_atencion   INT(11) NOT NULL,
	descripcion		  VARCHAR(45) NOT NULL,
    estado			  VARCHAR(1) NOT NULL,   
  PRIMARY KEY (id_ambiente)
);

-- Creamos la tabla atencion
CREATE TABLE atenciones (
	id_atencion 	  INT(11) NOT NULL AUTO_INCREMENT,
    id_persona        INT(11) NOT NULL,
	id_ambiente       INT(11) NOT NULL,
    preferencial      VARCHAR(20) NOT NULL,
	fecha timestamp default current_timestamp,
	num_orden		  VARCHAR(45) NOT NULL,
    estado_ate        INT(1) default 0,
  PRIMARY KEY (id_atencion)
);

-- Creamos la tabla usuario sesion
CREATE TABLE sesion_usuarios (
	id_sesion_usu 	     INT(11) NOT NULL AUTO_INCREMENT,
	id_usuario_ambiente  INT(11) NOT NULL,
	estado               VARCHAR(1) NOT NULL,
  fecha_sesion               timestamp default current_timestamp,
  PRIMARY KEY (id_sesion_usu)
);

-- Creamos la tabla usuario ambiente
CREATE TABLE usuario_ambiente (
  id_usuario_ambiente  INT(11) NOT NULL AUTO_INCREMENT,
  id_usuario           INT(11) NOT NULL,
  id_ambiente          INT(11) NOT NULL,
  estado               VARCHAR(1) NOT NULL,
  PRIMARY KEY (id_usuario_ambiente)
);

CREATE TABLE videos (
	id_video int(11) NOT NULL AUTO_INCREMENT,
    nombre 	 VARCHAR(20) NOT NULL,
    descripcion		VARCHAR(50) NOT NULL,
    fecha			timestamp default current_timestamp,
    url				VARCHAR(80) NOT NULL,
    estado    INT(1) default 0,
  PRIMARY KEY (id_video)
);

-- Relacion de la tabla usuario con persona
ALTER TABLE usuarios ADD CONSTRAINT fk_usuario_persona FOREIGN KEY (id_persona) REFERENCES personas (id_persona);

-- Relacion de la tabla atencion con persona
ALTER TABLE atenciones ADD CONSTRAINT fk_atencion_persona FOREIGN KEY (id_persona) REFERENCES personas (id_persona);

-- Relacion de tabla ambiente con tipo de atencion
ALTER TABLE ambientes ADD CONSTRAINT fk_ambiente_tip_atencion FOREIGN KEY (id_tip_atencion) REFERENCES tipo_atenciones (id_tip_atencion);

-- Relacion de tabla atencion con ambiente
ALTER TABLE atenciones ADD CONSTRAINT fk_atencion_ambiente FOREIGN KEY (id_ambiente) REFERENCES ambientes (id_ambiente);

-- Relacion de tabla usuario sesion con ambiente
-- ALTER TABLE sesion_usuarios ADD CONSTRAINT fk_usu_sesion_ambiente FOREIGN KEY (id_ambiente) REFERENCES ambientes (id_ambiente);

-- relacion de la tabal sesion con sesion_usuarios
-- ALTER TABLE sesion ADD CONSTRAINT fk_ses_sesion_usuario FOREIGN KEY (id_sesion_usu) REFERENCES sesion_usuarios (id_sesion_usu);

-- Relacion de tabla usuario sesion con usuario
-- ALTER TABLE sesion_usuarios ADD CONSTRAINT fk_usu_sesion_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario);

-- Relacion de tabla usuario ambiente con ambiente
ALTER TABLE usuario_ambiente ADD CONSTRAINT fk_usu_amb_ambiente FOREIGN KEY (id_ambiente) REFERENCES ambientes (id_ambiente);

-- Relacion de tabla usuario ambiente con ambiente
ALTER TABLE usuario_ambiente ADD CONSTRAINT fk_usu_amb_usuarios FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario);

ALTER TABLE sesion_usuarios ADD CONSTRAINT fk_sess_usu_usuarios FOREIGN KEY (id_usuario_ambiente) REFERENCES usuario_ambiente (id_usuario_ambiente);

-- REGISTRO DE LA TABLA PERSONA 
INSERT INTO personas (id_persona, documento, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, correo, sexo) 
VALUES (1, '12345678', 'JOSE', 'MESIAS', 'LOAYSA', '1998-04-08', '', 'HOMBRE');
INSERT INTO personas (id_persona, documento, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, correo, sexo) 
VALUES (2, '87654321', 'MARIA', 'GUIDO', 'LOPEZ', '1997-02-04', '', 'MUJER');
INSERT INTO personas (id_persona, documento, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, correo, sexo) 
VALUES (3, '21543666', 'ANGEL', 'AVALOS', 'QUISPE', '1990-03-18', '', 'HOMBRE');
INSERT INTO personas (id_persona, documento, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, correo, sexo) 
VALUES (4, '78573424', 'LUCIA', 'PEREZ', 'TASAYCO', '1993-07-12', '', 'MUJER');
INSERT INTO personas (id_persona, documento, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, correo, sexo) 
VALUES (5, '79874352', 'ANDREA', 'MORENO', 'ALMEYDA', '1990-02-19', '', 'MUJER');

-- REGISTRO DE LA TABLA TIPO DE ATENCION 
INSERT INTO tipo_atenciones (id_tip_atencion, descripcion) VALUES (1, 'MODULO');
INSERT INTO tipo_atenciones (id_tip_atencion, descripcion) VALUES (2, 'VENTANILLA');

-- REGISTRO DE LA TABLA USUARIO
INSERT INTO usuarios (id_usuario, id_persona, tipo_usuario, nom_usuario, contrasenia, estado) VALUES (1, 1, 'ADMINISTRADOR', 'ADM', '123456789', 'ACTIVO');
INSERT INTO usuarios (id_usuario, id_persona, tipo_usuario, nom_usuario, contrasenia, estado) VALUES (2, 2, 'ADMINISTRADO', 'ADMO', '123456789', 'ACTIVO');
-- REGISTRO DE LA TABLA USUARIO
INSERT INTO usuarios (id_usuario, id_persona, tipo_usuario, nom_usuario, contrasenia, estado) VALUES (3, 3, 'MODULO', 'MOD', '123456789', 'ACTIVO');
INSERT INTO usuarios (id_usuario, id_persona, tipo_usuario, nom_usuario, contrasenia, estado) VALUES (4, 4, 'VENTANILLA', 'VEN', '123456789', 'ACTIVO');

INSERT INTO usuarios (id_usuario, id_persona, tipo_usuario, nom_usuario, contrasenia, estado) VALUES (5, 5, 'MODULO', 'MAN', '123456789', 'ACTIVO');

-- REGISTRO DE LA TABLA AMBIENTE
INSERT INTO ambientes (id_ambiente, id_tip_atencion, descripcion, estado) VALUES (1, 1, 'MANTENIMIENTO', '1');
INSERT INTO ambientes (id_ambiente, id_tip_atencion, descripcion, estado) VALUES (2, 1, 'BIENESTAR SOCIAL', '1');
INSERT INTO ambientes (id_ambiente, id_tip_atencion, descripcion, estado) VALUES (3, 1, 'FEDATARIO', '1');

INSERT INTO ambientes (id_ambiente, id_tip_atencion, descripcion, estado) VALUES (4, 2, 'MESA DE PARTE', '1');
INSERT INTO ambientes (id_ambiente, id_tip_atencion, descripcion, estado) VALUES (5, 2, 'CAJERO', '1');
INSERT INTO ambientes (id_ambiente, id_tip_atencion, descripcion, estado) VALUES (6, 2, 'BOLETAS', '1');
INSERT INTO ambientes (id_ambiente, id_tip_atencion, descripcion, estado) VALUES (7, 2, 'ADMINISTRADOR', '1');
INSERT INTO ambientes (id_ambiente, id_tip_atencion, descripcion, estado) VALUES (8, 2, 'ADMINISTRADO', '1');

-- NOTA: PUEDEN INGRESAR CON ESTE ADMINISTRADOR
INSERT INTO `usuario_ambiente` (`id_usuario_ambiente`, `id_usuario`, `id_ambiente`, `estado`) VALUES (NULL, '1', '7', '1');
-- NOTA: PUEDEN INGRESAR CON ESTE ADMINISTRADO 
INSERT INTO `usuario_ambiente` (`id_usuario_ambiente`, `id_usuario`, `id_ambiente`, `estado`) VALUES (NULL, '2', '8', '1');

INSERT INTO `usuario_ambiente` (`id_usuario_ambiente`, `id_usuario`, `id_ambiente`, `estado`) VALUES (NULL, '5', '1', '1');

-- REGISTRO DE LA TABLA USUARIO SESION
-- INSERT INTO sesion_usuarios (id_sesion_usu, id_ambiente, id_usuario, fecha) VALUES (1, 1, 3, CURDATE());
-- INSERT INTO sesion_usuarios (id_sesion_usu, id_ambiente, id_usuario, fecha) VALUES (2, 4, 4, CURDATE());

-- REGISTRO DE LA TABLA ATENCION (visualiza el usuario interno)
-- INSERT INTO atenciones (id_atencion, id_persona, id_ambiente, preferencial, num_orden) VALUES (1, 5, 1, 'SI', 'MM00001');
-- INSERT INTO atenciones (id_atencion, id_persona, id_ambiente, preferencial, num_orden) VALUES (2, 5, 4, 'NO', 'VM00001');

-- PROCEDIMIENTOS ALMACENADOS

-- REGISTRAR PERSONA
DELIMITER $$
CREATE PROCEDURE up_registrar_persona(
    IN _documento       VARCHAR(20),
	IN _nombre 				VARCHAR(45) ,
	IN _apellido_paterno	VARCHAR(45) ,
	IN _apellido_materno	VARCHAR(45), 
	IN _fecha_nacimiento	DATE,
	IN _correo	 			VARCHAR(45),
	IN _sexo	 			VARCHAR(11) 
)BEGIN
	INSERT INTO personas (documento, nombre,apellido_paterno,apellido_materno,fecha_nacimiento,correo,sexo) VALUES (_documento,_nombre,_apellido_paterno,_apellido_materno,_fecha_nacimiento,_correo,_sexo);
END$$

-- LISTAR PERSONA 11-06-2019
DELIMITER $$
CREATE PROCEDURE up_listar_persona(

)BEGIN
	SELECT id_persona, documento, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, correo, sexo FROM personas;
END$$
-- REGISTRAR_TIPO_ATENCION

DELIMITER $$
CREATE PROCEDURE up_registrar_usuario(
  IN _id_persona      INT(11),
  IN _tipo_usuario    VARCHAR(45),
  IN _nom_usuario     VARCHAR(45),
  IN _contrasenia   VARCHAR(45),
  IN _estado      VARCHAR(10)
)
BEGIN
  INSERT INTO usuarios (id_persona, tipo_usuario, nom_usuario, contrasenia, estado) VALUES (_id_persona, _tipo_usuario, _nom_usuario, _contrasenia,_estado);
END $$

DELIMITER $$
CREATE PROCEDURE up_registrar_tipo_atencion (
	IN _descripcion		 VARCHAR(45)
)
BEGIN
INSERT INTO tipo_atenciones (descripcion) VALUES (_descripcion);
END $$

-- REGISTRAR AMBIENTE
DELIMITER $$
CREATE PROCEDURE up_registrar_ambiente(
	IN _id_tip_atencion   INT(11),
	IN _descripcion		  VARCHAR(45),
    IN _estado			  VARCHAR(1)
)
BEGIN
INSERT INTO ambientes (id_tip_atencion,descripcion,estado ) VALUES (_id_tip_atencion,_descripcion,_estado); 
END $$

-- registrar atencion
DELIMITER $$
CREATE PROCEDURE up_registrar_atencion (
    IN _id_persona        INT(11),
	IN _id_ambiente       INT(11),
    IN _preferencial      VARCHAR(20),
	IN _num_orden		  VARCHAR(45)
)
BEGIN
	INSERT INTO atenciones (id_persona,id_ambiente,preferencial,num_orden) 
	VALUES (_id_persona,_id_ambiente,_preferencial,_num_orden);
END $$

-- Este procedimiento lista todas las atenciones
DELIMITER $$
CREATE PROCEDURE up_listar_atencion(

)BEGIN
    SELECT ate.id_atencion, 
      per.id_persona, per.documento, CONCAT(per.nombre,', ',per.apellido_paterno,' ',per.apellido_materno) AS nom_ape, 
      tip.id_tip_atencion, (tip.descripcion) AS tipo_atencion_des, amb.id_ambiente, amb.descripcion, 
            ate.preferencial, ate.fecha, ate.num_orden, ate.estado_ate FROM atenciones ate 
            
  INNER JOIN personas per ON ate.id_persona = per.id_persona
  INNER JOIN ambientes amb ON ate.id_ambiente = amb.id_ambiente
  INNER JOIN tipo_atenciones tip ON amb.id_tip_atencion = tip.id_tip_atencion
  where amb.id_ambiente IN (SELECT DISTINCT id_ambiente from ambientes) and ate.estado_ate <> 3
   GROUP BY amb.id_ambiente 
  ORDER BY ate.preferencial DESC, ate.num_orden ASC LIMIT 6;
END$$

-- Este procedimiento lista las atenciones de modulos
DELIMITER $$
CREATE PROCEDURE up_listar_atencion_modulo(

)BEGIN
    SELECT ate.id_atencion, per.id_persona, per.documento, per.nombre, 
    	   tip.id_tip_atencion, tip.descripcion, 
    	   amb.id_ambiente, amb.descripcion, 
    	   ate.preferencial, ate.fecha FROM atenciones ate 
	
    INNER JOIN personas per ON ate.id_persona = per.id_persona
	INNER JOIN ambientes amb ON ate.id_ambiente = amb.id_ambiente
	INNER JOIN tipo_atenciones tip ON amb.id_tip_atencion = tip.id_tip_atencion
    where amb.id_tip_atencion = 1;
END$$

-- Este procedimiento lista las atenciones de ventanillas
DELIMITER $$
CREATE PROCEDURE up_listar_atencion_ventanilla(

)BEGIN
    SELECT ate.id_atencion, per.id_persona, per.documento, per.nombre, 
    	   tip.id_tip_atencion, tip.descripcion, 
    	   amb.id_ambiente, amb.descripcion, 
    	   ate.preferencial, ate.fecha FROM atenciones ate 
	
    INNER JOIN personas per ON ate.id_persona = per.id_persona
	INNER JOIN ambientes amb ON ate.id_ambiente = amb.id_ambiente
	INNER JOIN tipo_atenciones tip ON amb.id_tip_atencion = tip.id_tip_atencion
    where amb.id_tip_atencion = 2;
END$$

-- registrar sesion_usuario
DELIMITER $$
CREATE PROCEDURE up_registrar_sesion_usuario (
	IN _id_ambiente          INT(11),
	IN _id_usuario			 INT(11),
	IN _fecha                DATE
)
BEGIN
INSERT INTO sesion_usuarios (id_ambiente,id_usuario,fecha ) VALUES (_id_ambiente,_id_usuario,_fecha);
END $$

-- Procedimiento para realizar el logeo de usuario
DELIMITER $$
CREATE PROCEDURE up_login_usuario(
  IN IN_usuario VARCHAR(45),
  IN IN_contrasenia VARCHAR(45),
  IN IN_id_ambiente int
)
BEGIN
    DECLARE dec_id_ambiente int; 

    IF IN_usuario IS NOT NULL AND IN_contrasenia != '' THEN 
       IF (SELECT 1 FROM usuarios u INNER JOIN personas p on u.id_persona = p.id_persona 
          INNER JOIN usuario_ambiente usas on u.id_usuario = usas.id_usuario 
          WHERE nom_usuario = IN_usuario  AND contrasenia = IN_contrasenia and usas.estado = 1 and usas.id_ambiente = IN_id_ambiente  LIMIT 1)  THEN

           SELECT * FROM usuarios u INNER JOIN personas p on u.id_persona = p.id_persona 
          INNER JOIN usuario_ambiente usas on u.id_usuario = usas.id_usuario
          INNER JOIN ambientes amb ON amb.id_ambiente = usas.id_ambiente
          WHERE nom_usuario = IN_usuario  AND contrasenia = IN_contrasenia and usas.estado = 1  and usas.id_ambiente = IN_id_ambiente LIMIT 1; 

          SELECT usas.id_usuario_ambiente INTO dec_id_ambiente FROM usuarios u INNER JOIN personas p on u.id_persona = p.id_persona 
          INNER JOIN usuario_ambiente usas on u.id_usuario = usas.id_usuario 
          WHERE nom_usuario = IN_usuario  AND contrasenia = IN_contrasenia and usas.estado = 1  and usas.id_ambiente = IN_id_ambiente LIMIT 1; 

           CALL up_registrar_session_usuario(dec_id_ambiente);
        ELSE
            signal sqlstate '45000' set message_text = 'El usuario no existe en el sistema';

        END IF;
    
    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos correctos!!';
    END IF;

END $$


DELIMITER $$
CREATE PROCEDURE up_registrar_session_usuario(
  IN IN_id_usuario_ambiente INT
)
BEGIN
INSERT INTO sesion_usuarios(id_usuario_ambiente,estado) 
VALUES (IN_id_usuario_ambiente,1);

END$$

DELIMITER $$
CREATE PROCEDURE up_actualizar_session_usuario(
  IN IN_id_usuario_ambiente INT
)
BEGIN

  DECLARE dec_id_sesion_usu int; 

  SELECT id_sesion_usu INTO dec_id_sesion_usu FROM  sesion_usuarios 
  WHERE id_usuario_ambiente = IN_id_usuario_ambiente and estado = 1 
  and date_format(NOW(),'%Y-%m-%d') = date_format(fecha_sesion,'%Y-%m-%d') 
  ORDER BY  id_sesion_usu DESC LIMIT 1;

  UPDATE sesion_usuarios SET estado= 0 WHERE id_sesion_usu = dec_id_sesion_usu;

END$$

/*
DELIMITER $$
CREATE PROCEDURE up_registrar_session(
  IN IN_id_sesion_usu INT
)
BEGIN

INSERT INTO sesion(id_sesion_usu, inicio, termino, estado) VALUES (id_sesion_usu,'','',0);

END $$
*/

DELIMITER $$
CREATE PROCEDURE up_buscar_persona_documento(
	IN IN_documento VARCHAR(20)
)
BEGIN
SELECT * FROM personas WHERE documento = IN_documento;
END $$


DELIMITER $$
CREATE  PROCEDURE up_buscar_persona_id(
	IN IN_id_persona INT
	)  
BEGIN

    SELECT * FROM personas WHERE  id_persona = IN_id_persona;

     IF IN_id_persona IS NOT NULL AND IN_id_persona != '' THEN 
       IF (SELECT 1 FROM personas WHERE IN_id_persona = IN_id_persona LIMIT 1)  THEN
            SELECT * FROM personas WHERE  idPersona = IN_id_persona;
        ELSE
             signal sqlstate '45000' set message_text = 'Lo siento la persona que busca no existe en el sistema';
        END IF;
    
    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;

END$$


-- EL SIGUIENTE PROCEDIMIENTO NOS VA A PERMITIR ACTUALIZAR EL REGISTRO DE LAS PERSONAS ASIGNANDOLE LOS SIGUIENTES CAMPOS
DELIMITER $$
CREATE  PROCEDURE up_actualizar_persona(
  IN IN_id_persona       INT,
  IN IN_documento        VARCHAR(20),
  IN IN_nombre           VARCHAR(45),
  IN IN_apellido_paterno VARCHAR(45), 
  IN IN_apellido_materno VARCHAR(45),
  IN IN_fecha_nacimiento DATE,
  IN IN_correo           VARCHAR(45),
  IN IN_sexo             VARCHAR(11)
)  BEGIN

    IF IN_id_persona IS NOT NULL AND IN_id_persona != '' THEN 
       IF (SELECT 1 FROM personas WHERE id_persona = IN_id_persona LIMIT 1)  THEN
            UPDATE personas SET
               documento         = IN_documento,
               nombre            = IN_nombre,
               apellido_paterno  = IN_apellido_paterno,
               apellido_materno  = IN_apellido_materno,
               fecha_nacimiento  = IN_fecha_nacimiento,
               correo            = IN_correo,
               sexo              = IN_sexo
               WHERE 
               id_persona        = IN_id_persona;
        ELSE
            signal sqlstate '45000' set message_text = 'La persona que desea actualizar no existe en el sistema!!!';
        END IF;

    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;
END$$

-- LISTA LOS AMBIENTES DE MODULO CON EL ESTADO ACTIVO
DELIMITER $$
CREATE PROCEDURE up_listar_ambiente_modulo (
) BEGIN 
	SELECT amb.id_ambiente, tip.id_tip_atencion, amb.descripcion, amb.estado  FROM ambientes amb
	INNER JOIN tipo_atenciones tip ON amb.id_tip_atencion = tip.id_tip_atencion
	WHERE tip.descripcion = 'MODULO' AND amb.estado = 1;
END $$

-- LISTA LOS AMBIENTES DE MODULO CON EL ESTADO ACTIVO
DELIMITER $$
CREATE PROCEDURE up_listar_ambiente_ventanilla (
) BEGIN 
	SELECT amb.id_ambiente, tip.id_tip_atencion, amb.descripcion, amb.estado  FROM ambientes amb
	INNER JOIN tipo_atenciones tip ON amb.id_tip_atencion = tip.id_tip_atencion
	WHERE tip.descripcion = 'VENTANILLA' AND amb.estado = 1;
END $$

-- LISTA LOS AMBIENTES DE MODULO CON EL ESTADO ACTIVO
DELIMITER $$
CREATE PROCEDURE up_listar_ambiente_moduloV2 (
) BEGIN 
  SELECT DISTINCT ua.id_usuario,am.id_ambiente, am.descripcion,su.estado FROM sesion_usuarios su 
  INNER JOIN usuario_ambiente ua on su.id_usuario_ambiente = ua.id_usuario_ambiente 
  INNER JOIN ambientes am on am.id_ambiente = ua.id_ambiente 
  inner join tipo_atenciones tp on am.id_tip_atencion = am.id_tip_atencion 
  WHERE su.estado = 1 and am.id_tip_atencion = 1 and am.id_ambiente <> 7 and am.id_ambiente <> 8 and date_format(NOW(),'%Y-%m-%d') = date_format(su.fecha_sesion,'%Y-%m-%d');
END $$

-- LISTA LOS AMBIENTES DE MODULO CON EL ESTADO ACTIVO
DELIMITER $$
CREATE PROCEDURE up_listar_ambiente_ventanillaV2 (
) BEGIN 
  SELECT DISTINCT ua.id_usuario,am.id_ambiente, am.descripcion,su.estado FROM sesion_usuarios su 
  INNER JOIN usuario_ambiente ua on su.id_usuario_ambiente = ua.id_usuario_ambiente 
  INNER JOIN ambientes am on am.id_ambiente = ua.id_ambiente 
  inner join tipo_atenciones tp on am.id_tip_atencion = am.id_tip_atencion 
  WHERE su.estado = 1 and am.id_tip_atencion = 2 and am.id_ambiente <> 7 and am.id_ambiente <> 8 and date_format(NOW(),'%Y-%m-%d') = date_format(su.fecha_sesion,'%Y-%m-%d');
END $$

    -- EL SIGUIENTE PROCEDIMIENTO NOS VA A PERMITIR BUSCAR LOS AMBIENTES MEDIANTE SU ID DE IDENTIFICACION
DELIMITER $$
CREATE  PROCEDURE up_buscar_ambiente_id (
	IN IN_id_ambiente INT
)  BEGIN

    SELECT amb.id_ambiente, tip.id_tip_atencion, (tip.descripcion) AS mov_ven, amb.descripcion, amb.estado  FROM ambientes amb
    INNER JOIN tipo_atenciones tip ON tip.id_tip_atencion = amb.id_tip_atencion
    WHERE  id_ambiente = IN_id_ambiente;

     IF IN_id_ambiente IS NOT NULL AND IN_id_ambiente != '' THEN 
       IF (SELECT 1 FROM ambientes WHERE IN_id_ambiente = IN_id_ambiente LIMIT 1)  THEN
    SELECT amb.id_ambiente, tip.id_tip_atencion, (tip.descripcion) AS mov_ven, amb.descripcion, amb.estado  FROM ambientes amb
    INNER JOIN tipo_atenciones tip ON tip.id_tip_atencion = amb.id_tip_atencion
    WHERE  id_ambiente = IN_id_ambiente;
        ELSE
             signal sqlstate '45000' set message_text = 'Lo siento la persona que busca no existe en el sistema';
        END IF;
    
    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;

END $$

-- Procedimiento para buscar a la persona mediante su documento
DELIMITER $$
CREATE PROCEDURE up_buscar_persona_dni_ajax(
    IN IN_documento INT
)
BEGIN

    IF IN_documento IS NOT NULL AND IN_documento != '' THEN 
       
       SELECT * FROM personas WHERE documento = IN_documento;
    
    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;

END $$

DELIMITER $$
CREATE PROCEDURE up_buscar_nombre_usuario_ajax(
    IN IN_nom_usuario VARCHAR(45)
)
BEGIN

    IF IN_nom_usuario IS NOT NULL AND IN_nom_usuario != '' THEN 
       
       SELECT * FROM usuarios WHERE nom_usuario = IN_nom_usuario;
    
    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;

END $$ 


DELIMITER $$
CREATE PROCEDURE up_buscar_usuario_nombre(
  IN IN_nom_usuario VARCHAR(45)
)
BEGIN
SELECT * FROM usuarios WHERE nom_usuario = IN_nom_usuario;
END $$


DELIMITER $$
CREATE  PROCEDURE up_buscar_usuario_id(
  IN IN_id_usuario INT
  )  
BEGIN

    SELECT * FROM usuarios WHERE  id_usuario = IN_id_usuario;

     IF IN_id_usuario IS NOT NULL AND IN_id_usuario != '' THEN 
       IF (SELECT 1 FROM usuarios WHERE IN_id_usuario = IN_id_usuario LIMIT 1)  THEN
            SELECT * FROM usuarios WHERE  idUsuario = IN_id_usuario;
        ELSE
             signal sqlstate '45000' set message_text = 'Lo siento la persona que busca no existe en el sistema';
        END IF;
    
    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;

END$$




DELIMITER $$
CREATE  PROCEDURE up_actualizar_usuario(
  IN IN_id_usuario       INT,
  IN IN_tipo_usuario     VARCHAR(20),
  IN IN_nom_usuario      VARCHAR(45),
  IN IN_contrasenia      VARCHAR(45), 
  IN IN_estado           VARCHAR(45)
)  BEGIN

    IF IN_id_usuario IS NOT NULL AND IN_id_usuario != '' THEN 
       IF (SELECT 1 FROM usuarios WHERE id_usuario = IN_id_usuario LIMIT 1)  THEN
            UPDATE usuarios SET
               tipo_usuario      = IN_tipo_usuario,
               nom_usuario       = IN_nom_usuario,
               contrasenia       = IN_contrasenia,
               estado            = IN_estado
               WHERE 
               id_usuario        = IN_id_usuario;
        ELSE
            signal sqlstate '45000' set message_text = 'La persona que desea actualizar no existe en el sistema!!!';
        END IF;

    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;
END$$

DELIMITER $$
CREATE PROCEDURE up_listar_datos_personales( 
    IN_id_persona INT 
)
BEGIN
SELECT * FROM usuarios u INNER JOIN personas p ON u.id_persona = p.id_persona 
where p.id_persona = IN_id_persona;
END$$

DELIMITER $$
CREATE PROCEDURE up_listar_ambiente(
)BEGIN
  SELECT id_ambiente, id_tip_atencion, descripcion, estado FROM ambientes; 
END $$


DELIMITER $$
DROP PROCEDURE IF EXISTS sp_Generar_Codigo $$
CREATE PROCEDURE sp_Generar_Codigo(
    IN _id_ambiente int
)
BEGIN
    DECLARE contador INT;
    DECLARE p_codigo_secundario VARCHAR(12);
    BEGIN
        SET contador= (SELECT COUNT(*)+1 FROM atenciones where id_ambiente = _id_ambiente and date_format(NOW(),'%Y-%m-%d') = date_format(fecha,'%Y-%m-%d')); 
        IF(contador<12)THEN
            SET p_codigo_secundario= CONCAT(getNameAmbiente(_id_ambiente),'00',contador);
            ELSE IF(contador<100) THEN
                SET p_codigo_secundario= CONCAT(getNameAmbiente(_id_ambiente),'0',contador);
                ELSE IF(contador<1000)THEN
                    SET p_codigo_secundario= CONCAT(getNameAmbiente(_id_ambiente),contador);
                END IF;
            END IF;
        END IF; 
        SELECT p_codigo_secundario;
    END;
END $$


DELIMITER $$
CREATE FUNCTION getNameAmbiente (
  _id_ambiente int
) 
RETURNS VARCHAR(20)
DETERMINISTIC
BEGIN 
  DECLARE codigoPar VARCHAR(20);
  case  
    when _id_ambiente = 1 then      
      set codigoPar = 'MOD-MAN-';
    when _id_ambiente = 2 then      
      set codigoPar = 'MOD-BIE-'; 
    when _id_ambiente = 3 then      
      set codigoPar = 'MOD-FED-';
    when _id_ambiente = 4 then      
      set codigoPar = 'VEN-MES-'; 
    when _id_ambiente = 5 then      
      set codigoPar = 'VEN-CAJ-';
    when _id_ambiente = 6 then      
      set codigoPar = 'VEN-BOL-';  
  end case;

  RETURN codigoPar;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE listar_atenciones_ambientes_id(
    IN _id_ambiente int
)
BEGIN
  
  SELECT ate.id_atencion, per.id_persona, per.documento, CONCAT(per.nombre,', ',per.apellido_paterno,' ',per.apellido_materno) AS datos_persona,
  tip.id_tip_atencion, tip.descripcion, 
  amb.id_ambiente, (amb.descripcion) AS ambiente_des, 
  ate.preferencial, ate.fecha, ate.num_orden, ate.estado_ate FROM atenciones ate 
           
  INNER JOIN personas per ON ate.id_persona = per.id_persona
  INNER JOIN ambientes amb ON ate.id_ambiente = amb.id_ambiente
  INNER JOIN tipo_atenciones tip ON amb.id_tip_atencion = tip.id_tip_atencion
  WHERE amb.id_ambiente = _id_ambiente and ate.estado_ate <> 3 ORDER BY ate.preferencial DESC, ate.num_orden ASC; 	
    
END $$


DELIMITER $$
CREATE PROCEDURE up_listar_tipo_atencion(
)BEGIN
  SELECT id_tip_atencion, descripcion FROM tipo_atenciones; 
END $$

-- EL SIGUIENTE PROCEDIMIENTO NOS VA A PERMITIR ACTUALIZAR EL ESTADO DE LA LISTA DE LAS ATENCIONES
DELIMITER $$
CREATE  PROCEDURE up_actualizar_atencion_estado(
    IN IN_id_atencion      INT,
    IN IN_estado_ate       INT
)  BEGIN

    IF IN_id_atencion IS NOT NULL AND IN_id_atencion != '' THEN 
       IF (SELECT 1 FROM atenciones WHERE id_atencion = IN_id_atencion LIMIT 1)  THEN
            UPDATE atenciones SET
               estado_ate         = IN_estado_ate
               WHERE 
               id_atencion        = IN_id_atencion;
        ELSE
            signal sqlstate '45000' set message_text = 'La persona que desea actualizar no existe en el sistema!!!';
        END IF;

    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;
END $$

drop procedure up_buscar_ambiente
DELIMITER $$
CREATE PROCEDURE up_buscar_ambiente(
	IN IN_descripcion VARCHAR(45)
)
BEGIN
	SELECT amb.id_ambiente,
		   ate.descripcion AS ate_descripcion,
           amb.descripcion,
           amb.estado
           FROM ambientes amb
    INNER JOIN  tipo_atenciones ate ON ate.id_tip_atencion = amb.id_tip_atencion    
           
	WHERE amb.descripcion = IN_descripcion;
END $$

-- DELIMITER $$
-- CREATE PROCEDURE up_buscar_usuario_dni(
--   IN IN_documento VARCHAR(45)
-- )
-- BEGIN
--   SELECT usu.nom_usuario
--            FROM usuarios usu
--     INNER JOIN  personas per ON per.id_persona = usu.id_persona  
           
--   WHERE per.documento = IN_documento;
-- END $$

drop procedure up_agregar_video

DELIMITER $$
CREATE PROCEDURE up_agregar_video(
	IN _nombre 				VARCHAR(20) ,
	IN _descripcion			VARCHAR(50) ,
	IN _fecha				DATE, 
	IN _url					VARCHAR(80)
)BEGIN
	INSERT INTO videos (nombre, descripcion, fecha, url) VALUES (_nombre, _descripcion, _fecha, _url);
END$$ 

call up_agregar_video ('sdvsv','ascsa','','cascas');

#SELECT ate.id_atencion, 
#      per.id_persona, per.documento, CONCAT(per.nombre,', ',per.apellido_paterno,' ',per.apellido_materno) AS nom_ape, 
#      tip.id_tip_atencion, (tip.descripcion) AS tipo_atencion_des, amb.id_ambiente, amb.descripcion, 
#            ate.preferencial, ate.fecha, ate.num_orden, ate.estado_ate FROM atenciones ate             
#  INNER JOIN personas per ON ate.id_persona = per.id_persona
#  INNER JOIN ambientes amb ON ate.id_ambiente = amb.id_ambiente
#  INNER JOIN tipo_atenciones tip ON amb.id_tip_atencion = tip.id_tip_atencion
#  where amb.id_ambiente IN (SELECT DISTINCT id_ambiente from ambientes) and ate.estado_ate <> 3 GROUP BY amb.id_ambiente ORDER BY ate.preferencial DESC, ate.num_orden ASC LIMIT 1;


-- LISTAR PERSONA 11-06-2019
DELIMITER $$
CREATE PROCEDURE up_listar_videos(

)BEGIN
  SELECT * from videos;
END$$


DELIMITER $$
CREATE PROCEDURE up_listar_videos_habilitados(

)BEGIN
    SELECT * FROM videos WHERE estado = 1;
END$$

DELIMITER $$
CREATE PROCEDURE up_listar_tipo_ambiente(
)BEGIN
  SELECT id_ambiente, descripcion FROM ambientes WHERE descripcion != 'ADMINISTRADOR';
END $$


-- ELIMINAR VIDEO
DELIMITER $$
CREATE PROCEDURE up_eliminar_videos(
	IN IN_id_video int
)
BEGIN
DELETE FROM videos where id_video = id_video;
END$$


DELIMITER $$
CREATE  PROCEDURE up_buscar_video_id(
  IN IN_id_video INT
  )  
BEGIN

    SELECT * FROM videos WHERE  id_video = IN_id_video;

     IF IN_id_video IS NOT NULL AND IN_id_video != '' THEN 
       IF (SELECT 1 FROM videos WHERE IN_id_video = IN_id_video LIMIT 1)  THEN
            SELECT * FROM videos WHERE  idVideo = IN_id_video;
        ELSE
             signal sqlstate '45000' set message_text = 'Lo siento la persona que busca no existe en el sistema';
        END IF;
    
    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;

END$$

DELIMITER $$
CREATE  PROCEDURE up_actualizar_video(
  IN IN_id_video       INT,
  IN IN_nombre         VARCHAR(20),
  IN IN_descripcion    VARCHAR(50),
  IN IN_fecha          DATE,
  IN IN_url            VARCHAR(80),
  IN IN_estado         INT(1)
)  BEGIN

    IF IN_id_video IS NOT NULL AND IN_id_video != '' THEN 
       IF (SELECT 1 FROM videos WHERE id_video = IN_id_video LIMIT 1)  THEN
            UPDATE videos SET
               nombre       = IN_nombre,
               descripcion  = IN_descripcion,
               fecha        = IN_fecha,
               url          = IN_url,
               estado       = IN_estado
               WHERE 
               id_video     = IN_id_video;
        ELSE
            signal sqlstate '45000' set message_text = 'La persona que desea actualizar no existe en el sistema!!!';
        END IF;

    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;
END$$

-- Registrar usuario a sus ambientes respectivos
DELIMITER $$
CREATE PROCEDURE up_registrar_usuario_ambiente2(
  IN _id_usuario      INT(11),
  IN _id_ambiente     INT(11),
  IN _estado          VARCHAR(1)
)
BEGIN
  INSERT INTO usuarios_ambiente (id_usuario, id_ambiente, estado) VALUES (_id_usuario, _id_ambiente, _estado);
END $$