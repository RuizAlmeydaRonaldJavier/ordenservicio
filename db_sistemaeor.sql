-- Eliminamos la base de datos si esta creada
DROP DATABASE IF EXISTS db_sistemaeor;
-- Creamos la base de datos
CREATE DATABASE db_sistemaeor;
-- Usamos la base de datos
USE db_sistemaeor;


-- ******** TABLAS
-- Creamos la tabla usuarios
CREATE TABLE usuarios
(
  id_usuario              INT(11) NOT NULL AUTO_INCREMENT,
  usuario                 VARCHAR(45) NOT NULL,
  contrasenia             VARCHAR(45) NOT NULL,
  fecha_registro          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                  VARCHAR(1) NOT NULL DEFAULT '1',
  id_perfil               INT(11) NOT NULL,
  PRIMARY KEY (id_usuario)
);

-- Creamos la tabla perfiles
CREATE TABLE perfiles
(
  id_perfil             INT(11) NOT NULL AUTO_INCREMENT,
  descripcion           VARCHAR(45) NOT NULL,
  fecha_registro        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                VARCHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id_perfil)
);

-- Creamos la tabla usuario sesion
CREATE TABLE sessiones_usuarios
(
  id_sessionUsuario       INT(11) NOT NULL AUTO_INCREMENT,
  fecha_registro          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                  VARCHAR(1) NOT NULL DEFAULT '1',
  id_usuario              INT(11) NOT NULL,
  PRIMARY KEY (id_sessionUsuario)
);

-- Creamos la tabla proveedores
CREATE TABLE proveedores
(
  id_proveedor          INT(11) NOT NULL AUTO_INCREMENT,
  razon_social          VARCHAR(60) NOT NULL,
  ruc                   VARCHAR(11) NOT NULL,
  direccion             VARCHAR(80) NOT NULL,
  correo_electronico    VARCHAR(60) NOT NULL,
  telefono              VARCHAR(9) NOT NULL,
  fecha_registro        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                VARCHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id_proveedor)
);

-- Creamos la tabla ordenes de servicio
CREATE TABLE ordenes_servicios
(
  id_ordenServicio            INT(11) NOT NULL AUTO_INCREMENT,
  numero_ordenServicio           VARCHAR(10) NOT NULL,
  fecha                       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  requerimiento_referencia      VARCHAR(80) NOT NULL,
  informe_referencia            VARCHAR(80) NOT NULL,
  descripcion                 VARCHAR(200) NOT NULL,
  importe                   VARCHAR(20) NOT NULL,
  sub_total                   VARCHAR(20) NOT NULL,
  igv                   VARCHAR(20) NOT NULL,
  importe_neto01                   VARCHAR(20) NOT NULL,
  retencion             VARCHAR(20) NOT NULL,
  importe_neto02            VARCHAR(20) NOT NULL,
  observacion                 VARCHAR(100) NOT NULL,
  fecha_registro        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                    VARCHAR(1) NOT NULL DEFAULT '1',
  id_proveedor              INT(11) NOT NULL,
  id_meta                   INT(11) NOT NULL,
  id_tipoFactura                   INT(11) NOT NULL,
  PRIMARY KEY (id_ordenServicio)
);

-- Creamos la tabla ordenes de compras
CREATE TABLE ordenes_compras
(
  id_ordenCompra              INT(11) NOT NULL AUTO_INCREMENT,
  numero_ordenCompra            VARCHAR(10) NOT NULL,
  fecha                       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  requerimiento_referencia      VARCHAR(80) NOT NULL,
  informe_referencia            VARCHAR(80) NOT NULL,
  sub_total                 VARCHAR(20) NOT NULL,
  igv               VARCHAR(20) NOT NULL,
  total               VARCHAR(20) NOT NULL,
  observacion                 VARCHAR(100) NOT NULL,
  fecha_registro            TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                    VARCHAR(1) NOT NULL DEFAULT '1',
  id_proveedor              INT(11) NOT NULL,
  id_meta                   INT(11) NOT NULL,
  PRIMARY KEY (id_ordenCompra)
);

-- Creamos la tabla detalle de ordenes de compras
CREATE TABLE ordenesCompras_detalle
(
  id_ordenCompraDetalle           INT(11) NOT NULL AUTO_INCREMENT,
  cantidad                VARCHAR(10) NOT NULL,
  precio_unitario           VARCHAR(10) NOT NULL,
  precio_total              VARCHAR(10) NOT NULL,
  estado                      VARCHAR(1) NOT NULL DEFAULT '1',
  id_ordenCompra                INT(11) NOT NULL,
  id_producto                 INT(11) NOT NULL,
  PRIMARY KEY (id_ordenCompraDetalle)
);

-- Creamos la tabla productos
CREATE TABLE productos
(
  id_producto               INT(11) NOT NULL AUTO_INCREMENT,
  codigo              VARCHAR(10) NOT NULL,
  descripcion           VARCHAR(10) NOT NULL,
  fecha_registro            TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                    VARCHAR(1) NOT NULL DEFAULT '1',
  id_unidadMedida             INT(11) NOT NULL,
  PRIMARY KEY (id_producto)
);

-- Creamos la tabla productos
CREATE TABLE unidades_medidas
(
  id_unidadMedida             INT(11) NOT NULL AUTO_INCREMENT,
  descripcion           VARCHAR(20) NOT NULL,
  fecha_registro            TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                    VARCHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id_unidadMedida)
);

-- Creamos la tabla metas
CREATE TABLE metas
(
  id_meta             INT(11) NOT NULL AUTO_INCREMENT,
  c1                VARCHAR(4) NOT NULL,
  c2                    VARCHAR(4) NOT NULL,
  c3                VARCHAR(7) NOT NULL,
  c4            VARCHAR(7) NOT NULL,
  c5                  VARCHAR(2) NOT NULL,
  c6              VARCHAR(3) NOT NULL,
  c7                  VARCHAR(4) NOT NULL,
  c8            VARCHAR(5) NOT NULL,
  c9            VARCHAR(7) NOT NULL,
  c10           VARCHAR(100) NOT NULL,
  dpto          VARCHAR(25) NOT NULL,
  prov          VARCHAR(25) NOT NULL,
  dist          VARCHAR(25) NOT NULL,
  und_medida    VARCHAR(10) NOT NULL,
  fecha_registro        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                VARCHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id_meta)
);


CREATE TABLE tipos_facturas
(
  id_tipoFactura             INT(11) NOT NULL AUTO_INCREMENT,
  descripcion           VARCHAR(20) NOT NULL,
  porcentaje              INT(11) NOT NULL,
  fecha_registro            TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado                    VARCHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id_tipoFactura)
);


-- ******** RELACIONES
-- Relacion de la tabla usuarios con pefiles
ALTER TABLE usuarios ADD CONSTRAINT fk_usuario_perfil FOREIGN KEY (id_perfil) REFERENCES 
perfiles (id_perfil);

-- Relacion de la tabla usuarios con pefiles
ALTER TABLE sessiones_usuarios ADD CONSTRAINT fk_sessionUsuario_usuario FOREIGN KEY (id_usuario) 
REFERENCES usuarios (id_usuario);

-- Relacion de la tabla ordenes de servicios con proveedores
ALTER TABLE ordenes_servicios ADD CONSTRAINT fk_ordenServicio_proveedor FOREIGN KEY (id_proveedor) 
REFERENCES proveedores (id_proveedor);

-- Relacion de la tabla ordenes de servicios con metas
ALTER TABLE ordenes_servicios ADD CONSTRAINT fk_ordenServicio_meta FOREIGN KEY (id_meta) 
REFERENCES metas (id_meta);

-- Relacion de la tabla ordenes de servicios con tipos facturas
ALTER TABLE ordenes_servicios ADD CONSTRAINT fk_ordenServicio_tipoFactura FOREIGN KEY (id_tipoFactura) 
REFERENCES tipos_facturas (id_tipoFactura);

-- Relacion de la tabla ordenes de compras con proveedores
ALTER TABLE ordenes_compras ADD CONSTRAINT fk_ordenCompra_proveedor FOREIGN KEY (id_proveedor) 
REFERENCES proveedores (id_proveedor);

-- Relacion de la tabla ordenes de compras con metas
ALTER TABLE ordenes_compras ADD CONSTRAINT fk_ordenCompra_meta FOREIGN KEY (id_meta) 
REFERENCES metas (id_meta);

-- Relacion de la tabla detalle de ordenes de compras con ordenes de compras
ALTER TABLE ordenesCompras_detalle ADD CONSTRAINT fk_ordenCompraDetalle_ordenCompra FOREIGN KEY (id_ordenCompra) 
REFERENCES ordenes_compras (id_ordenCompra);

-- Relacion de la tabla detalle de ordenes de compras con productos
ALTER TABLE ordenesCompras_detalle ADD CONSTRAINT fk_ordenCompraDetalle_producto FOREIGN KEY (id_producto) 
REFERENCES productos (id_producto);

-- Relacion de la tabla productos con unidades de medidas
ALTER TABLE productos ADD CONSTRAINT fk_producto_unidadMedida FOREIGN KEY (id_unidadMedida) 
REFERENCES unidades_medidas (id_unidadMedida);


-- ******** DATOS POR DEFECTO
-- Insertar perfiles
INSERT INTO perfiles (descripcion) VALUES ('ADMINISTRADOR'), ('LOGISTICA'), ('ALMACEN');

-- Insertar usuarios
INSERT INTO usuarios (usuario, contrasenia, id_perfil) VALUES ('ADMINISTRADOR', '123', '1'), ('LOGISTICA', '123', '2'), 
('ALMACEN', '123', '3');

-- Insertar proveedores
INSERT INTO proveedores (razon_social, ruc, direccion, correo_electronico, telefono) VALUES 
('RUIZ ALMEYDA RONALD JAVIER', '1212121212', 'JIRON NICOLAS DE PIEROLA # 174', 'ronaldj.ruiz@upsjb.edu.pe', '121212121'), 
('GUTIERREZ GONZALES JORGE', '6767676767', 'SAN MARTIN 2DA CUADRA', 'ruizalmeyda@upsjb.edu.pe', '676767676');

-- Insertar unidades de medidas
INSERT INTO unidades_medidas (descripcion) VALUES ('UNIDAD'), ('GALON');

-- Insertar productos
INSERT INTO productos (codigo, descripcion, id_unidadMedida) VALUES ('P0010', 'TONER', '1'), 
('P0011', 'ACEITE', '2');

-- Insertar metas
INSERT INTO metas (c1, c2, c3, c4, c5, c6, c7, c8, c9, c10) VALUES ('0001', '0016', '3000669', '5005159', 
'23', '051', '0115', '00001', '0136043', 'BRINDAR APOYO NUTRICIONAL A LAS PERSONAS AFECTADAS POR TUBERCULOSIS'), 
('0002', '0030', '3000355', '5004156', '05', '014', '0031', '00001', '0106645', 
'PATRULLAJE MUNICIPAL POR SECTOR - SERENAZGO');

-- Insertar ordenes de servicios
/*INSERT INTO ordenes_servicios (numero_ordenServicio, requerimiento_referencia, informe_referencia, 
descripcion, importe, retencion, importe_neto, observacion, id_proveedor, id_meta) VALUES 
('2020000001', 'REQ. N 201-MPCH/GSP', 'INF. N 100-MPCH/GSP', 'SERVICIO A LA MUNICIPALIDAD PROVINCIAL DE CHINCHA 
  COMO APOYO EN LE GERENCIA DE SECRETARIA GENERAL CORRESPONDIENTE AL MES DE FEBRERO','1,500.00', '0.00', '1,500.00', 
  'CONFORMIDAD DE SERVICIO', '1', '1'), 
('2020000002', 'REQ. N 159-MPCH/ALC', 'INF. N 200-MPCH/ALC', 'SERVICIO A LA MUNICIPALIDAD PROVINCIAL DE CHINCHA 
  COMO APOYO EN EL DESPACHO DE ALCALDIA CORRESPONDIENTE AL MES DE MARZO','1,500.00', '0.00', '1,500.00', 
  'CONFORMIDAD DE SERVICIO', '2', '2');*/

  INSERT INTO tipos_facturas (descripcion, porcentaje) VALUES ('Sin retencion', '0'), ('Con retencion', '8'), 
  ('IGV disgregado', '18'), ('IGV incluido', '18'), ('Sin IGV', '0'); 


-- ******** PROCEDIMIENTOS ALMACENADOS
-- Procedimiento para listar los perfiles
DELIMITER $$
CREATE PROCEDURE up_listar_perfil
(
) BEGIN
  SELECT * FROM perfiles WHERE estado = '1'; 
END $$

-- Procedimiento para validar inicio de sesión del usuario
DELIMITER $$
CREATE PROCEDURE up_validar_usuario(
  IN _usuario VARCHAR(45),
  IN _contrasenia VARCHAR(45),
  IN _id_perfil INT(11)
) BEGIN
  DECLARE _id_usuario INT(11); 

  IF _usuario IS NOT NULL AND _contrasenia != '' THEN
    IF (SELECT 1 FROM usuarios us WHERE us.usuario = _usuario  AND us.contrasenia = _contrasenia 
    AND us.estado = "1" AND us.id_perfil = _id_perfil LIMIT 1) THEN
        
      SELECT us.id_usuario INTO _id_usuario FROM usuarios us WHERE us.usuario = _usuario  
      AND us.contrasenia = _contrasenia AND us.estado = "1" AND us.id_perfil = _id_perfil LIMIT 1;

      SELECT * FROM usuarios us INNER JOIN perfiles pe WHERE us.usuario = _usuario  
      AND us.contrasenia = _contrasenia AND us.estado = "1" AND us.id_perfil = _id_perfil LIMIT 1;

      CALL up_registrar_session_usuario(_id_usuario);
    ELSE
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El usuario no existe en el sistema.';
    END IF;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error al ingresar los datos.';
  END IF;
END $$

-- Procedimiento para registrar la session de los usuarios
DELIMITER $$
CREATE PROCEDURE up_registrar_session_usuario
(
  IN _id_usuario INT(11)
) BEGIN
  INSERT INTO sessiones_usuarios (id_usuario) VALUES (_id_usuario);
END $$

-- Procedimiento para listar los proveedores
DELIMITER $$
CREATE PROCEDURE up_listar_proveedor
(
) BEGIN
  SELECT * FROM proveedores WHERE estado = '1'; 
END $$

-- Procedimiento para listar los productos
DELIMITER $$
CREATE PROCEDURE up_listar_producto
(
) BEGIN
  SELECT pro.id_producto, pro.codigo, pro.descripcion, pro.fecha_registro, pro.estado, uni.descripcion 
  AS 'unidad_medida' FROM productos pro INNER JOIN unidades_medidas uni ON 
  pro.id_unidadMedida = uni.id_unidadMedida WHERE pro.estado = '1'; 
END $$

-- Procedimiento para listar las metas
DELIMITER $$
CREATE PROCEDURE up_listar_meta
(
) BEGIN
  SELECT * FROM metas WHERE estado = '1'; 
END $$

-- Procedimiento para listar los usuarios
DELIMITER $$
CREATE PROCEDURE up_listar_usuario
(
) BEGIN
  SELECT * FROM usuarios WHERE estado = '1'; 
END $$

-- Procedimiento para listar las ordenes de servicios
DELIMITER $$
CREATE PROCEDURE up_listar_orden_servicio
(
) BEGIN
  SELECT *, ord.estado as 'estado_orden' FROM ordenes_servicios ord INNER JOIN proveedores pro ON ord.id_proveedor = pro.id_proveedor ORDER BY id_ordenServicio DESC;
END $$

-- Procedimiento para listar las ordenes de compras
CREATE PROCEDURE up_listar_orden_compra
(
) BEGIN
  SELECT * FROM ordenes_compras WHERE estado = '1'; 
END $$

-- Procedimiento para registrar los proveedores
DELIMITER $$
CREATE PROCEDURE up_registrar_proveedor
(
  IN _razon_social          VARCHAR(60),
  IN _ruc                   VARCHAR(11),
  IN _direccion             VARCHAR(80),
  IN _correo_electronico    VARCHAR(60),
  IN _telefono              VARCHAR(9)
) BEGIN
  INSERT INTO proveedores (razon_social, ruc, direccion, correo_electronico, telefono) VALUES 
  (_razon_social, _ruc, _direccion, _correo_electronico, _telefono);
END $$

-- Procedimiento para registrar los productos
DELIMITER $$
CREATE PROCEDURE up_registrar_producto
(
  IN _codigo              VARCHAR(10),
  IN _descripcion         VARCHAR(10),
  IN _id_unidadMedida     INT(11)
) BEGIN
  INSERT INTO productos (codigo, descripcion, id_unidadMedida) VALUES 
  (_codigo, _descripcion, _id_unidadMedida);
END $$

DELIMITER $$
CREATE PROCEDURE up_registrar_meta
(
  IN _c1            VARCHAR(4), 
  IN _c2            VARCHAR(4), 
  IN _c3            VARCHAR(7),
  IN _c4            VARCHAR(7), 
  IN _c5            VARCHAR(2),
  IN _c6            VARCHAR(3),
  IN _c7            VARCHAR(4),
  IN _c8            VARCHAR(5), 
  IN _c9            VARCHAR(7),
  IN _c10           VARCHAR(100),
  IN _dpto          VARCHAR(25), 
  IN _prov          VARCHAR(25),  
  IN _dist          VARCHAR(25), 
  IN _und_medida    VARCHAR(10)

) BEGIN
  INSERT INTO metas (c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, dpto, prov, dist, und_medida) VALUES 
  (_c1, _c2, _c3, _c4, _c5 ,_c6, _c7, _c8, _c9, _c10, _dpto, _prov, _dist, _und_medida);
END $$

DELIMITER $$
CREATE PROCEDURE up_listar_unidad_medida(
)BEGIN
  SELECT id_unidadMedida, descripcion, fecha_registro, estado FROM unidades_medidas; 
END $$

DELIMITER $$
CREATE PROCEDURE up_buscar_ruc_ajax(
    IN IN_ruc VARCHAR(11)
)
BEGIN

    IF IN_ruc IS NOT NULL AND IN_ruc != '' THEN 
       
       SELECT * FROM proveedores WHERE ruc = IN_ruc;
    
    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;

END $$



DELIMITER $
CREATE PROCEDURE up_listar_tipo_factura(
)BEGIN
  SELECT * FROM tipos_facturas; 
END $$

INSERT INTO tipos_facturas (id_tipoFactura, descripcion, porcentaje) VALUES (null, 'Sin retención', '0'),
(null, 'Con retención', '8'), (null, 'IGV disgregado', '18'), (null, 'IGV incluido', '18'), (null, 'Sin IGV', '0');


------------
DELIMITER $$
CREATE PROCEDURE up_buscar_meta_ajax(
    IN IN_c1 VARCHAR(4)
)
BEGIN

    IF IN_c1 IS NOT NULL AND IN_c1 != '' THEN 
       
       SELECT * FROM metas WHERE c1 = IN_c1;
    
    ELSE
          signal sqlstate '45000' set message_text = 'Ingrese los datos de manera correcta!!!';
    END IF;

END $$

-- Procedimiento para registrar los orden de servicio
DELIMITER $$
CREATE PROCEDURE up_registrar_orden_servicio
(
  IN _requerimiento_referencia      VARCHAR(80),
  IN _informe_referencia            VARCHAR(80),
  IN _descripcion                 VARCHAR(200),
  IN _importe                   VARCHAR(20),
  IN _sub_total                   VARCHAR(20),
  IN _igv                   VARCHAR(20),
  IN _importe_neto01                   VARCHAR(20),
  IN _retencion             VARCHAR(20),
  IN _importe_neto02            VARCHAR(20),
  IN _observacion                 VARCHAR(100),
  IN _id_proveedor              INT(11),
  IN _id_meta                   INT(11),
  IN _id_tipoFactura                   INT(11)
) BEGIN
  DECLARE contador INT;
  DECLARE _numero_ordenServicio VARCHAR(10);
  DECLARE auxiliar INT;
  DECLARE anio VARCHAR(4);

  SET contador = (SELECT COUNT(*) FROM ordenes_servicios);

  IF (contador > 0 ) THEN
    SET auxiliar = (SELECT CAST(RIGHT(numero_ordenServicio, 4) AS INT) FROM ordenes_servicios ORDER BY id_ordenServicio DESC LIMIT 1);
    SET auxiliar = auxiliar + 1;
    SET anio = YEAR(NOW()); 

    IF(auxiliar < 10) THEN
      SET _numero_ordenServicio = CONCAT('OS', anio, '000', auxiliar);
      ELSE IF(contador<100) THEN
        SET _numero_ordenServicio = CONCAT('OS', anio, '00',auxiliar);
        ELSE IF(contador<1000)THEN
          SET _numero_ordenServicio = CONCAT('OS', anio, '0',auxiliar);
          ELSE
          SET _numero_ordenServicio = CONCAT('OS', anio, auxiliar);
        END IF;
      END IF;
    END IF; 

  ELSE
    SET anio = YEAR(NOW()); 
    SET _numero_ordenServicio = CONCAT('OS', anio, '0001');
  END IF;

  INSERT INTO ordenes_servicios VALUES (NULL, _numero_ordenServicio, now(), _requerimiento_referencia, _informe_referencia,
  _descripcion, _importe, _sub_total, _igv, _importe_neto01, _retencion, _importe_neto02, _observacion, now(), '1', 
  _id_proveedor, _id_meta, _id_tipoFactura);
END $$

-- Procedimiento para buscar las ordenes de servicios
DELIMITER $$
CREATE PROCEDURE up_buscar_orden_servicio
(
  IN _id_ordenServicio                   INT(11)
) BEGIN
  SELECT *, ord.descripcion AS 'descripcion_servicio', tfa.descripcion AS 'descripcion_factura' FROM ordenes_servicios ord INNER JOIN proveedores pro ON ord.id_proveedor = pro.id_proveedor INNER JOIN metas met ON ord.id_meta = met.id_meta INNER JOIN tipos_facturas tfa ON ord.id_tipoFactura = tfa.id_tipoFactura WHERE ord.id_ordenServicio = _id_ordenServicio;
END $$

DELIMITER $$
CREATE PROCEDURE up_modificar_orden_servicio
(
  IN _requerimiento_referencia      VARCHAR(80),
  IN _informe_referencia            VARCHAR(80),
  IN _descripcion                 VARCHAR(200),
  IN _importe                   VARCHAR(20),
  IN _sub_total                   VARCHAR(20),
  IN _igv                   VARCHAR(20),
  IN _importe_neto01                   VARCHAR(20),
  IN _retencion             VARCHAR(20),
  IN _importe_neto02            VARCHAR(20),
  IN _observacion                 VARCHAR(100),
  IN _id_proveedor              INT(11),
  IN _id_meta                   INT(11),
  IN _id_tipoFactura                   INT(11),
  IN _id_ordenServicio                   INT(11)
) BEGIN
  UPDATE ordenes_servicios SET 
  requerimiento_referencia = _requerimiento_referencia, 
  informe_referencia = _informe_referencia,
  descripcion = _descripcion,
  importe = _importe,
  sub_total = _sub_total,
  igv = _igv,
  importe_neto01 = _importe_neto01,
  retencion = _retencion,
  importe_neto02 = _importe_neto02,
  observacion = _observacion,
  id_proveedor = _id_proveedor,
  id_meta = _id_meta,
  id_tipoFactura = _id_tipoFactura WHERE id_ordenServicio = _id_ordenServicio;
  
END $$