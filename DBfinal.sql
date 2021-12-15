--*****************************************************************************************************************************************************************
--                                                                    CREATE TABLES 
--*****************************************************************************************************************************************************************
CREATE TABLE restaurantes(
    ID        NUMBER(8) PRIMARY KEY ,
    DUENO     VARCHAR2(20) NOT NULL ,
    TELEFONO  VARCHAR2(20) NOT NULL 
);
CREATE SEQUENCE res_incre START WITH 1 INCREMENT BY 1;
CREATE TRIGGER res_tri BEFORE INSERT ON restaurantes FOR EACH ROW BEGIN SELECT res_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;

CREATE TABLE direcciones(
    ID         NUMBER(8)     PRIMARY KEY ,  
    DISTRITO   VARCHAR2(25)  NOT NULL ,
    CIUDAD     VARCHAR2(20)  NOT NULL ,
    CALLE      VARCHAR2(9)   NOT NULL 
);
CREATE SEQUENCE direc_incre START WITH 10000001 INCREMENT BY 1;
CREATE TRIGGER direc_tri BEFORE INSERT ON direcciones FOR EACH ROW BEGIN SELECT direc_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;

CREATE TABLE sedes(
    ID            NUMBER(8) PRIMARY KEY ,   
    COD_RSTRANTE  NUMBER(8)    NOT NULL ,
    COD_DIRECC    NUMBER(8)    NOT NULL ,
    NOMBRE        VARCHAR2(20) NOT NULL ,
    AFORO         NUMBER(5)    NOT NULL ,
    TELEFONO      VARCHAR2(20) NOT NULL
);
CREATE SEQUENCE sed_incre START WITH 11000001 INCREMENT BY 1;
CREATE TRIGGER sed_tri BEFORE INSERT ON sedes FOR EACH ROW BEGIN SELECT sed_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;

CREATE TABLE comments(
    ID           NUMBER(8) PRIMARY KEY , 
    COD_SEDE     NUMBER(8) NOT NULL,    
    CALIFICACION NUMBER(2) NOT NULL, 
    RESENA       VARCHAR2(30) NOT NULL
);
CREATE SEQUENCE comm_incre START WITH 10100001 INCREMENT BY 1;
CREATE TRIGGER comm_tri BEFORE INSERT ON comments FOR EACH ROW BEGIN SELECT comm_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;


CREATE TABLE implementos(
    ID              NUMBER(8)     PRIMARY KEY ,   
    COD_SEDE        NUMBER(8)     NOT NULL ,
    COSTO           NUMBER(6,2)   NOT NULL ,
    CANTIDAD        NUMBER(8)     NOT NULL ,
    NOMBRE          VARCHAR2(20)  NOT NULL ,
    FCHA_MNTNIENTO  DATE          NOT NULL 
);
CREATE SEQUENCE imp_incre START WITH 10010001 INCREMENT BY 1;
CREATE TRIGGER imp_tri BEFORE INSERT ON implementos FOR EACH ROW BEGIN SELECT imp_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;

CREATE TABLE menus(
    ID           NUMBER(8)  PRIMARY KEY , 
    COD_SEDE   NUMBER(8)    NOT NULL ,    
    DIA        VARCHAR2(20) NOT NULL 
);
CREATE SEQUENCE menu_incre START WITH 12000001 INCREMENT BY 1;
CREATE TRIGGER menu_tri BEFORE INSERT ON menus FOR EACH ROW BEGIN SELECT menu_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;

CREATE TABLE platillos(
    ID_NOMBRE       VARCHAR2(20)  PRIMARY KEY ,
    COD_MENU        NUMBER(8)     NOT NULL , 
    COD_CUERPO      NUMBER(8)      ,
    DESCRIPCION     VARCHAR2(50)  NOT NULL ,
    PRMEDIO_CMPRA   NUMBER(3)     NOT NULL ,
    COSTO           NUMBER(5,2)   NOT NULL ,
    PROMOCION       VARCHAR2(30)
);

CREATE TABLE ingredientes(
    ID             NUMBER(8)    PRIMARY KEY ,  
    COD_PLATILLO   VARCHAR2(20) NOT NULL ,
    NOMBRE         VARCHAR2(20) NOT NULL ,
    PRECIO         NUMBER(6,2)  NOT NULL ,
    FCHA_VENCE     DATE         NOT NULL ,
    DESCRIPCION    VARCHAR2(50) NOT NULL 
);
CREATE SEQUENCE ingre_incre START WITH 13000001 INCREMENT BY 1;
CREATE TRIGGER ingre_tri BEFORE INSERT ON ingredientes FOR EACH ROW BEGIN SELECT ingre_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;

CREATE TABLE stocks(
    COD_INGREDIENTE   NUMBER(8) NOT NULL ,
    COD_PROVEEDOR     NUMBER(8) NOT NULL ,
    TOTAL             NUMBER(6) NOT NULL 
);

CREATE TABLE proveedores(
    ID          NUMBER(8)     PRIMARY KEY ,  
    COD_DIREC   NUMBER(8)     NOT NULL ,
    NOMBRE      VARCHAR2(20)  NOT NULL ,
    TELEFONO    VARCHAR2(20)  NOT NULL 
);
CREATE SEQUENCE porv_incre START WITH 14000001 INCREMENT BY 1;
CREATE TRIGGER porv_tri BEFORE INSERT ON proveedores FOR EACH ROW BEGIN SELECT porv_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;


CREATE TABLE comensales(  
    DNI       NUMBER(8)      PRIMARY KEY , 
    COD_DIREC   NUMBER(8)    NOT NULL ,  
    NOMBRE      VARCHAR2(20) NOT NULL ,
    APELLIDO    VARCHAR2(20) NOT NULL 
);

CREATE TABLE encbzdo_pedidos(  
    ID             NUMBER(8) PRIMARY KEY , 
    COD_DNI        NUMBER(8) NOT NULL ,
    FECHA          DATE      NOT NULL ,
    COD_DELIVERY   NUMBER(8) 
);
CREATE SEQUENCE encb_incre START WITH 10000501 INCREMENT BY 1;
CREATE TRIGGER encb_tri BEFORE INSERT ON encbzdo_pedidos FOR EACH ROW BEGIN SELECT encb_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;

CREATE TABLE deliveris(  
    ID              NUMBER(8)    PRIMARY KEY , 
    COSTO_ADCNAL    NUMBER(5,2)  NOT NULL ,
    TELEFONO        VARCHAR2(20) NOT NULL ,
    PLAZO_ENTREGA   VARCHAR2(20) NOT NULL 
);
CREATE SEQUENCE deli_incre START WITH 10055501 INCREMENT BY 1;
CREATE TRIGGER deli_tri BEFORE INSERT ON deliveris FOR EACH ROW BEGIN SELECT deli_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;



CREATE TABLE crpo_pedidos(  
    ID             NUMBER(8)    PRIMARY KEY , 
    COD_ENCBZADO   NUMBER(8)    NOT NULL ,
    DESCRIPCION    VARCHAR2(20) NOT NULL ,
    COSTO_TOTAL    NUMBER(6,2)  NOT NULL ,
    CANITDAD       NUMBER(3)    NOT NULL     
);
CREATE SEQUENCE crpo_incre START WITH 10005501 INCREMENT BY 1;
CREATE TRIGGER crpo_tri BEFORE INSERT ON crpo_pedidos FOR EACH ROW BEGIN SELECT crpo_incre.NEXTVAL INTO :NEW.ID FROM DUAL;
END;

-----------------------------------------------------------------------

CREATE TABLE trabajadores(  
    DNI           NUMBER(8)    PRIMARY KEY ,
    COD_SEDE      NUMBER(8)    NOT NULL ,
    NOMBRE        VARCHAR2(20) NOT NULL ,
    TELEFONO      VARCHAR2(20) NOT NULL ,
    ASISTENCIAS   NUMBER(1)    NOT NULL ,
    FCHA_INICIO   DATE         NOT NULL 
);

CREATE TABLE chefs(
    DNI           NUMBER(8)     PRIMARY KEY ,
    COD_SEDE      NUMBER(8)     NOT NULL ,
    NOMBRE        VARCHAR2(20)  NOT NULL ,
    TELEFONO      VARCHAR2(20)  NOT NULL ,
    FCHA_INICIO   DATE          NOT NULL , 
    ASISTENCIAS   NUMBER(1)     NOT NULL ,
    ESPECIALIDAD  VARCHAR2(30)  NOT NULL
);

CREATE TABLE managers(
    DNI           NUMBER(8)    PRIMARY KEY ,
    COD_SEDE      NUMBER(8)    NOT NULL ,
    NOMBRE        VARCHAR2(20) NOT NULL ,
    TELEFONO      VARCHAR2(20) NOT NULL ,
    UNIVERSIDAD   VARCHAR2(20) NOT NULL ,
    ASISTENCIAS   NUMBER(1)    NOT NULL ,
    FCHA_INICIO   DATE         NOT NULL 
);

--+ restaurantes     00000001
--+ direcciones      1000000#
--+ sedes            1100000#
--+ comments         1010000#
--+ implementos      1001000#
--+ menus            1200000#
--+ ingredientes     1300000#
--+ proveedores      1400000#
--+ encbzdo_pedidos  1000050#
--+ crpo_pedidos     1000550#
--+ deliveris        1005550#
--+ platillos        char
--+ comensales       DNI
-- trabajadores      DNI
-- chefs             DNI
-- managers          DNI

--*****************************************************************************************************************************************************************
--                                                                     FOREIGN KEY 
--*****************************************************************************************************************************************************************

ALTER TABLE sedes ADD CONSTRAINT FK_sed_COD_RSTRANTE
FOREIGN KEY (COD_RSTRANTE) REFERENCES restaurantes (ID);
ALTER TABLE sedes ADD CONSTRAINT FK_sed_COD_DIRECC
FOREIGN KEY (COD_DIRECC) REFERENCES direcciones (ID);

ALTER TABLE comments ADD CONSTRAINT FK_com_COD_SEDE
FOREIGN KEY (COD_SEDE) REFERENCES sedes (ID);

ALTER TABLE implementos ADD CONSTRAINT FK_imp_COD_SEDE
FOREIGN KEY (COD_SEDE) REFERENCES sedes (ID);

ALTER TABLE menus ADD CONSTRAINT FK_men_COD_SEDE
FOREIGN KEY (COD_SEDE) REFERENCES sedes (ID);

ALTER TABLE trabajadores ADD CONSTRAINT FK_tra_COD_SEDE
FOREIGN KEY (COD_SEDE) REFERENCES sedes (ID);
ALTER TABLE chefs ADD CONSTRAINT FK_chef_COD_SEDE
FOREIGN KEY (COD_SEDE) REFERENCES sedes (ID);
ALTER TABLE managers ADD CONSTRAINT FK_mana_COD_SEDE
FOREIGN KEY (COD_SEDE) REFERENCES sedes (ID);

ALTER TABLE comensales ADD CONSTRAINT FK_com_COD_DIREC
FOREIGN KEY (COD_DIREC) REFERENCES direcciones (ID);

ALTER TABLE encbzdo_pedidos ADD CONSTRAINT FK_enc_COD_DELIVERY
FOREIGN KEY (COD_DELIVERY) REFERENCES deliveris (ID);
ALTER TABLE encbzdo_pedidos ADD CONSTRAINT FK_enc_COD_DNI
FOREIGN KEY (COD_DNI) REFERENCES comensales (DNI);

ALTER TABLE crpo_pedidos ADD CONSTRAINT FK_crpo_COD_ENCBZADO
FOREIGN KEY (COD_ENCBZADO) REFERENCES encbzdo_pedidos (ID);

ALTER TABLE proveedores ADD CONSTRAINT FK_pro_COD_DIREC
FOREIGN KEY (COD_DIREC) REFERENCES direcciones (ID);

ALTER TABLE platillos ADD CONSTRAINT FK_pla_COD_MENU
FOREIGN KEY (COD_MENU) REFERENCES menus (ID);
ALTER TABLE platillos ADD CONSTRAINT FK_pla_COD_CUERPO
FOREIGN KEY (COD_CUERPO) REFERENCES crpo_pedidos (ID);

ALTER TABLE ingredientes ADD CONSTRAINT FK_ing_COD_PLATILLO
FOREIGN KEY (COD_PLATILLO) REFERENCES platillos (ID_NOMBRE);

ALTER TABLE stocks ADD CONSTRAINT FK_sto_COD_PROVEEDOR
FOREIGN KEY (COD_PROVEEDOR) REFERENCES proveedores (ID);
ALTER TABLE stocks ADD CONSTRAINT FK_sto_COD_INGREDIENTE
FOREIGN KEY (COD_INGREDIENTE) REFERENCES ingredientes (ID);


DESCRIBE restaurantes;
DESCRIBE direcciones;
DESCRIBE sedes;
DESCRIBE comments;
DESCRIBE implementos;
DESCRIBE menus;

DESCRIBE trabajadores;
DESCRIBE chefs;
DESCRIBE managers;

DESCRIBE comensales;
DESCRIBE encbzdo_pedidos;
DESCRIBE crpo_pedidos;
DESCRIBE deliveris; 

DESCRIBE proveedores;
DESCRIBE platillos;
DESCRIBE ingredientes;
DESCRIBE stocks;

--*****************************************************************************************************************************************************************
--                                                                     INSERT 
--*****************************************************************************************************************************************************************

INSERT INTO restaurantes ( DUENO, TELEFONO) VALUES ('&DUENO','&TELEFONO');
DELETE FROM restaurantes WHERE ID = &ID;
DESCRIBE restaurantes;
SELECT* FROM restaurantes;

INSERT INTO direcciones ( DISTRITO,CIUDAD,CALLE ) VALUES ( '&DISTRITO', '&CIUDAD', '&CALLE');
DELETE FROM direcciones WHERE ID = &ID;
DESCRIBE direcciones;
SELECT* FROM direcciones;

INSERT INTO sedes ( COD_RSTRANTE,COD_DIRECC,NOMBRE,AFORO,TELEFONO ) VALUES ( &COD_RSTRANTE,&COD_DIRECC,'&NOMBRE',&AFORO,'&TELEFONO' );
DELETE FROM sedes WHERE ID = &ID;
DESCRIBE sedes;
SELECT* FROM sedes;

INSERT INTO comments ( COD_SEDE,CALIFICACION,RESENA) VALUES ( &COD_SEDE,&CALIFICACION,'&RESEÑA');
DELETE FROM comments WHERE ID = &ID;
DESCRIBE comments;
SELECT* FROM comments;

INSERT INTO implementos ( COD_SEDE,COSTO,CANTIDAD,NOMBRE,FCHA_MNTNIENTO) VALUES (&COD_SEDE,&COSTO,&CANTIDAD,'&NOMBRE','&FCHA_MNTNIENTO');
DELETE FROM implementos WHERE ID = &ID;
DESCRIBE implementos;
SELECT* FROM implementos;

INSERT INTO menus ( COD_SEDE, DIA) VALUES (&COD_SEDE, '&DIA');
DELETE FROM menus WHERE ID = &ID;
DESCRIBE menus;
SELECT* FROM menus;

INSERT INTO platillos (ID_NOMBRE,COD_MENU,DESCRIPCION,PRMEDIO_CMPRA,COSTO,PROMOCION) VALUES ('&ID_NOMBRE',&COD_MENU,'&DESCRIPCION',&PRMEDIO_CMPRA,&COSTO,'&PROMOCION');
DELETE FROM platillos WHERE ID_NOMBRE = '&ID_NOMBRE';
DESCRIBE platillos;
SELECT* FROM platillos;

INSERT INTO ingredientes ( COD_PLATILLO,NOMBRE,PRECIO,FCHA_VENCE,DESCRIPCION ) VALUES ('&COD_PLATILLO','&NOMBRE',&PRECIO,'&FCHA_VENCE','&DESCRIPCION');
DELETE FROM ingredientes WHERE ID = &ID;
DESCRIBE ingredientes;
SELECT* FROM ingredientes;

INSERT INTO stocks ( COD_INGREDIENTE, COD_PROVEEDOR, TOTAL ) VALUES (&COD_INGREDIENTE, &COD_PROVEEDOR, &TOTAL);
DELETE FROM stocks WHERE COD_INGREDIENTE = &COD_INGREDIENTE;
DELETE FROM stocks WHERE COD_PROVEEDOR   = &COD_PROVEEDOR;
DESCRIBE stocks;
SELECT* FROM stocks;

INSERT INTO proveedores ( COD_DIREC, NOMBRE, TELEFONO ) VALUES (&COD_DIREC, '&NOMBRE', '&TELEFONO');
DELETE FROM proveedores WHERE ID = &ID;
DESCRIBE proveedores;
SELECT* FROM proveedores;

INSERT INTO comensales ( DNI,COD_DIREC, NOMBRE, APELLIDO ) VALUES ( &DNI,&COD_DIREC, '&NOMBRE', '&APELLIDO' );
DELETE FROM comensales WHERE DNI = &DNI;
DESCRIBE comensales;
SELECT* FROM comensales;

INSERT INTO encbzdo_pedidos ( COD_DNI, FECHA, COD_DELIVERY ) VALUES (&COD_DNI, '&FECHA', &COD_DELIVERY);
DELETE FROM encbzdo_pedidos WHERE ID = &ID;
DESCRIBE encbzdo_pedidos;
SELECT* FROM encbzdo_pedidos;

INSERT INTO deliveris ( COSTO_ADCNAL, TELEFONO, PLAZO_ENTREGA) VALUES (&COSTO_ADCNAL, '&TELEFONO', '&PLAZO_ENTREGA');
DELETE FROM deliveris WHERE ID = &ID;
DESCRIBE deliveris;
SELECT* FROM deliveris;

INSERT INTO crpo_pedidos ( COD_ENCBZADO, DESCRIPCION, COSTO_TOTAL, CANITDAD ) VALUES (&COD_ENCBZADO, '&DESCRIPCION', &COSTO_TOTAL, &CANITDAD);
DELETE FROM crpo_pedidos WHERE ID = &ID;
DESCRIBE crpo_pedidos;
SELECT* FROM crpo_pedidos;

INSERT INTO trabajadores ( DNI, COD_SEDE, NOMBRE,  TELEFONO, ASISTENCIAS, FCHA_INICIO ) VALUES (&DNI, &COD_SEDE, '&NOMBRE',  '&TELEFONO', &ASISTENCIAS, '&FCHA_INICIO');
DELETE FROM trabajadores WHERE DNI = &DNI;
DESCRIBE trabajadores;
SELECT* FROM trabajadores;

TO_DATE('02/12/2019', 'DD/MM/YYYY')

INSERT INTO chefs ( DNI, COD_SEDE, NOMBRE,  TELEFONO, ASISTENCIAS, FCHA_INICIO, ESPECIALIDAD ) VALUES (&DNI, &COD_SEDE, '&NOMBRE',  '&TELEFONO', &ASISTENCIAS, '&FCHA_INICIO', '&ESPECIALIDAD');
DELETE FROM chefs WHERE DNI = &DNI;
DESCRIBE chefs;
SELECT* FROM chefs;

INSERT INTO managers (DNI, COD_SEDE, NOMBRE,  TELEFONO, ASISTENCIAS, FCHA_INICIO, UNIVERSIDAD ) VALUES (&DNI, &COD_SEDE, '&NOMBRE',  '&TELEFONO', &ASISTENCIAS, '&FCHA_INICIO', &UNIVERSIDAD);
DELETE FROM managers WHERE DNI = &DNI;
DESCRIBE managers;
SELECT* FROM managers;

--*****************************************************************************************************************************************************************
--                                                                 DESCRIBE TABLES 
--*****************************************************************************************************************************************************************
DESCRIBE restaurantes;
DESCRIBE comments;
DESCRIBE sedes;
DESCRIBE implementos;
DESCRIBE menus;
DESCRIBE platillos;
DESCRIBE ingredientes;
DESCRIBE stocks;
DESCRIBE proveedores;
DESCRIBE direcciones;
DESCRIBE comensales;
DESCRIBE encbzdo_pedidos;
DESCRIBE deliveris; 
DESCRIBE crpo_pedidos;
DESCRIBE trabajadores;
DESCRIBE asistencias; 
DESCRIBE chefs;
DESCRIBE managers;

--*****************************************************************************************************************************************************************
--                                                                 INSERT VALUES 
--*****************************************************************************************************************************************************************

SELECT* FROM restaurantes;
SELECT* FROM comments;
SELECT* FROM sedes;
SELECT* FROM implementos;
SELECT* FROM trabajadores;
SELECT* FROM chefs;
SELECT* FROM managers;
SELECT* FROM asistencias; 
SELECT* FROM menus;
SELECT* FROM platillos;
SELECT* FROM ingredientes;
SELECT* FROM stocks;
SELECT* FROM proveedores;
SELECT* FROM direcciones;
SELECT* FROM comensales;
SELECT* FROM encbzdo_pedidos;
SELECT* FROM deliveris; 
SELECT* FROM crpo_pedidos;







--*****************************************************************************************************************************************************************
--*****************************************************************************************************************************************************************
--******************************************************* NO sé si esta bien esta parte *************************************************************************
--*****************************************************************************************************************************************************************
--*****************************************************************************************************************************************************************
--*****************************************************************************************************************************************************************

INSERT INTO restaurantes ( DUENO, TELEFONO) VALUES ('&DUEÑO','&TELEFONO');

INSERT INTO direcciones VALUES (10000001,'Paucarpata','Arequipa','E-7');
INSERT INTO sedes VALUES (11000001,00000001,10000001,'Solaris',550,'757575');

INSERT INTO direcciones VALUES (10000002,'Cerro Colorado','Arequipa','H-10');
INSERT INTO sedes VALUES (21000002,00000001,10000002,'Venus',1000,'808080');

INSERT INTO direcciones VALUES (10000003,'Barranco','Lima','G-101');
INSERT INTO sedes VALUES (31000003,00000001,10000003,'Chocco Chips',335,'262626');

INSERT INTO direcciones VALUES (10000004,'Cercado','Lima','T-202');
INSERT INTO sedes VALUES (41000004,00000001,10000004,'Imperium',290,'818181');

INSERT INTO direcciones VALUES (10000005,'Ate Vitarte','Lima','A-218');
INSERT INTO sedes VALUES (51000005,00000001,10000005,'Carpis',560,'414141');


INSERT INTO comments VALUES (10100001,11000001,5,'La comida muy rica');
INSERT INTO comments VALUES (20100001,11000001,4,'No me gusto la comida');
INSERT INTO comments VALUES (30100001,11000001,10,'La comida estaba muy rica');
INSERT INTO comments VALUES (40100001,11000001,7,'Me gusto mucho');
INSERT INTO comments VALUES (50100001,11000001,8,'La mejor atencion');

INSERT INTO comments VALUES (10100002,11000002,4,'Horrible lugar');
INSERT INTO comments VALUES (20100002,11000002,9,'Buena atencion');
INSERT INTO comments VALUES (30100002,11000002,10,'Recomendado');
INSERT INTO comments VALUES (40100002,11000002,10,'Buenaso');
INSERT INTO comments VALUES (50100002,11000002,7,'Me gusto la comida');

INSERT INTO comments VALUES (10100003,11000003,1,'No lo recomiendo');
INSERT INTO comments VALUES (20100003,11000003,5,'Buena su comida');
INSERT INTO comments VALUES (30100003,11000003,6,'Me gusto mucho');
INSERT INTO comments VALUES (40100003,11000003,8,'Uff la mejor comida');
INSERT INTO comments VALUES (50100003,11000003,10,'Me encanto su comida');

INSERT INTO comments VALUES (10100004,11000004,4,'Le faltaba sabor a la comida');
INSERT INTO comments VALUES (20100004,11000004,7,'La comida muy rica');
INSERT INTO comments VALUES (30100004,11000004,9,'Me encantaron sus platos');
INSERT INTO comments VALUES (40100004,11000004,10,'La mejor comida');
INSERT INTO comments VALUES (50100004,11000004,10,'Uff sin comentarios');

INSERT INTO comments VALUES (10100005,11000005,10,'la mejor atencion');
INSERT INTO comments VALUES (20100005,11000005,10,'Comida 10/10);
INSERT INTO comments VALUES (30100005,11000005,10,'Me facina su comida');
INSERT INTO comments VALUES (40100005,11000005,8,'muy buena atencion');
INSERT INTO comments VALUES (50100005,11000005,7,'rica comida');

INSERT INTO implementos VALUES (10010001,11000001,25.8,7,'sillas','01/05/2025');
INSERT INTO implementos VALUES (20010001,11000001,80.5,20,'mesas','01/07/2029');
INSERT INTO implementos VALUES (30010001,11000001,10.5,100,'servilletas','07/02/2023');
INSERT INTO implementos VALUES (40010001,11000001,470.9,4,'masetas','03/03/2035');
INSERT INTO implementos VALUES (50010001,11000001,20.5,20,'manteles','10/05/2045');

INSERT INTO implementos VALUES (10010002,11000002,85.2,70,'sillas',TO_DATE('08/05/2053', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (20010002,11000002,90.5,40,'mesas',TO_DATE('07/02/2023', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (30010002,11000002,5.4,45,'poet',TO_DATE('25/07/2033', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (40010002,11000002,9.54,50,'alcohol en gel',TO_DATE('30/12/2053', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (50010002,11000002,45.8,4,'manteles',TO_DATE('15/11/2043', 'DD/MM/YYYY'));

INSERT INTO implementos VALUES (10010003,11000003,25.8,7,'sillas',TO_DATE('04/05/2025', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (20010003,11000003,254.6,7,'mesas',TO_DATE('11/05/2033', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (30010003,11000003,45.9,7,'platos',TO_DATE('20/08/2052', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (40010003,11000003,127.8,7,'cortinas',TO_DATE('01/10/2026', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (50010003,11000003,5.4,7,'escobas',TO_DATE('01/02/2029', 'DD/MM/YYYY'));

INSERT INTO implementos VALUES (10010004,11000004,154.8,7,'recojedor',TO_DATE('01/06/2054', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (20010004,11000004,25.2,45,'silla',TO_DATE('01/05/2029', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (30010004,11000004,25.6,70,'mesa',TO_DATE('25/07/2027', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (40010004,11000004,15.2,45,'escoba',TO_DATE('01/11/2024', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (50010004,11000004,95.6,73,'jabon',TO_DATE('14/12/2025', 'DD/MM/YYYY'));

INSERT INTO implementos VALUES (10010005,11000005,15.6,7,'poet',TO_DATE('01/05/2025', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (20010005,11000005,141.6,80,'mesas',TO_DATE('01/05/2025', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (30010005,11000005,27.6,45,'sillas',TO_DATE('01/05/2025', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (40010005,11000005,36.5,45,'manteles',TO_DATE('01/05/2025', 'DD/MM/YYYY'));
INSERT INTO implementos VALUES (50010005,11000005,16.4,37,'masetas',TO_DATE('01/05/2025', 'DD/MM/YYYY'));

INSERT INTO trabajadores VALUES (73333523,11000001,'Juan Peres','99217489',4,TO_DATE('01/05/2018', 'DD/MM/YYYY'));
INSERT INTO trabajadores VALUES (73337423,11000002,'Lupita Perez','99487489',3,TO_DATE('01/01/2018', 'DD/MM/YYYY'));
INSERT INTO trabajadores VALUES (73853523,11000003,'Oscar Palza','99217489',6,TO_DATE('01/05/2017', 'DD/MM/YYYY'));
INSERT INTO trabajadores VALUES (73378423,11000004,'Rosa Caripo','994487489',7,TO_DATE('01/04/2014', 'DD/MM/YYYY'));
INSERT INTO trabajadores VALUES (74592523,11000005,'Angel Caceres','92367489',3,TO_DATE('10/08/2017', 'DD/MM/YYYY'));

INSERT INTO managers VALUES (73333523,11000001,'Gonzalo Romeo','932454232','UCSP',4,TO_DATE('01/03/2017', 'DD/MM/YYYY'));
INSERT INTO managers VALUES (73334823,11000002,'Mauricio Cadenas','843423534','UPC',5,TO_DATE('01/06/2017', 'DD/MM/YYYY'));
INSERT INTO managers VALUES (73853523,11000003,'Gaston acuario','784537953','PUCP',5,TO_DATE('01/12/2017', 'DD/MM/YYYY'));
INSERT INTO managers VALUES (73378423,11000004,'Elon musc','96745664','Harvard',4,TO_DATE('04/02/2018', 'DD/MM/YYYY'));
INSERT INTO managers VALUES (74592523,11000005,'Jeff besos','910240100','Cambridge',3,TO_DATE('02/12/2019', 'DD/MM/YYYY'));

INSERT INTO trabajadoresVALUES (77777523,11000001,'Cian Peres','99217489',TO_DATE('01/05/2018', 'DD/MM/YYYY'));
INSERT INTO trabajadores VALUES (77858423,11000002,'Luz Perez','99487489',TO_DATE('01/01/2018', 'DD/MM/YYYY'));
INSERT INTO trabajadores VALUES (73489623,11000003,'Carmen Palza','99217489',TO_DATE('01/05/2017', 'DD/MM/YYYY'));
INSERT INTO trabajadores VALUES (73484823,11000004,'Pancha Caripo','994487489',TO_DATE('01/04/2014', 'DD/MM/YYYY'));
INSERT INTO trabajadores VALUES (74494923,11000005,'Ammy Caceres','92367489','TO_DATE(10/08/2017', 'DD/MM/YYYY'));

INSERT INTO chefs VALUES (77777523,11000001,'Adam Romeo','931451232',TO_DATE('01/03/2017', 'DD/MM/YYYY'),4,'desayuno');
INSERT INTO chefs VALUES (77858423,11000002,'Hugo Barreda','823424534',TO_DATE('01/06/2017', 'DD/MM/YYYY'),4,'almuerzo');
INSERT INTO chefs VALUES (73489623,11000003,'Gordon Ramsay','724637953',TO_DATE('01/12/2017', 'DD/MM/YYYY'),5,'cena');
INSERT INTO chefs VALUES (73484823,11000004,'Ana Carpio','91775664',TO_DATE('04/02/2018', 'DD/MM/YYYY'),3,'postre');
INSERT INTO chefs VALUES (74494923,11000005,'Andrea Perez','900243100',TO_DATE('02/12/2019', 'DD/MM/YYYY'),2,'sopa');

INSERT INTO chefs VALUES (10002101,77777523,'desayuno');
INSERT INTO chefs VALUES (20002102,77858423,'almuerzo');
INSERT INTO chefs VALUES (30002103,73489623,'cena');
INSERT INTO chefs VALUES (40002104,73484823,'postre');
INSERT INTO chefs VALUES (50002105,74494923,'sopa');

INSERT INTO asistencias VALUES (10001001,12345640,'10/08/2017','10/08/2017','Lunes');
INSERT INTO asistencias VALUES (10001002,12345641,'10/08/2017','10/08/2017','Lunes');
INSERT INTO asistencias VALUES (10001003,12345642,'10/08/2017','10/08/2017','Lunes');
INSERT INTO asistencias VALUES (10001004,12345643,'10/08/2017','10/08/2017','Lunes');
INSERT INTO asistencias VALUES (10001005,12345640,'10/08/2017','10/08/2017','Lunes');
INSERT INTO asistencias VALUES (10001006,12345644,'10/08/2017','10/08/2017','Lunes');


INSERT INTO asistencias VALUES (20001001,12345630,'10/08/2019','10/08/2019','Martes');
INSERT INTO asistencias VALUES (20001002,12345631,'10/08/2019','10/08/2019','Martes');
INSERT INTO asistencias VALUES (20001003,12345632,'10/08/2019','10/08/2019','Martes');
INSERT INTO asistencias VALUES (20001004,12345633,'10/08/2019','10/08/2019','Martes');
INSERT INTO asistencias VALUES (20001005,12345634,'10/08/2019','10/08/2019','Martes');
INSERT INTO asistencias VALUES (20001006,12345614,'10/08/2019','10/08/2019','Martes');

INSERT INTO menus VALUES (12000001,11000001,'Lunes');
INSERT INTO menus VALUES (12000002,11000001,'Martes');
INSERT INTO menus VALUES (12000003,11000001,'Miercoles');
INSERT INTO menus VALUES (12000004,11000001,'Jueves');
INSERT INTO menus VALUES (12000005,11000001,'Viernes');

INSERT INTO menus VALUES (22000001,11000002,'Lunes');
INSERT INTO menus VALUES (22000002,11000002,'Martes');
INSERT INTO menus VALUES (22000003,11000002,'Miercoles');
INSERT INTO menus VALUES (22000004,11000002,'Jueves');
INSERT INTO menus VALUES (22000005,11000002,'Viernes');

INSERT INTO menus VALUES (32000001,11000003,'Lunes');
INSERT INTO menus VALUES (32000002,11000003,'Martes');
INSERT INTO menus VALUES (32000003,11000003,'Miercoles');
INSERT INTO menus VALUES (32000004,11000003,'Jueves');
INSERT INTO menus VALUES (32000005,11000003,'Viernes');

INSERT INTO menus VALUES (42000001,11000004,'Lunes');
INSERT INTO menus VALUES (42000002,11000004,'Martes');
INSERT INTO menus VALUES (42000003,11000004,'Miercoles');
INSERT INTO menus VALUES (42000004,11000004,'Jueves');
INSERT INTO menus VALUES (42000005,11000004,'Viernes');

INSERT INTO menus VALUES (52000001,11000005,'Lunes');
INSERT INTO menus VALUES (52000002,11000005,'Martes');
INSERT INTO menus VALUES (52000003,11000005,'Miercoles');
INSERT INTO menus VALUES (52000004,11000005,'Jueves');
INSERT INTO menus VALUES (52000005,11000005,'Viernes');

INSERT INTO platillos VALUES ('papas fritas' ,12000022,10005501, 'papas', 70,  10.8,'no');
INSERT INTO platillos VALUES ('sopa' ,12000001,10005502, 'sopa', 80,  20.5,'no');
INSERT INTO platillos VALUES ('arroz chaufa' ,12000002,10005503, 'arroz', 100,  156.2,'no');
INSERT INTO platillos VALUES ('pescado' ,12000004,10005504, 'pescado', 20, 1587.2,'no');
INSERT INTO platillos VALUES ('ceviche' ,12000021,10005505, 'ceviche', 56,  157.3,'no');
INSERT INTO platillos VALUES ('popcorn' ,12000015,10005506, 'popcorn', 58,  489.4,'no');
INSERT INTO platillos VALUES ('torta' ,12000014,10005507, 'torta', 98,  456.8,'si');
INSERT INTO platillos VALUES ('cafe' ,12000002,10005508, 'cafe', 58,84.5,'no');
INSERT INTO platillos VALUES ('costillitas' ,12000002,10005509, 'costillitas', 48,  48.2,'no');
INSERT INTO platillos VALUES ('ensalada' ,12000005,10005510, 'ensalada', 36,  956.8,'no');
INSERT INTO platillos VALUES ('refresco' ,12000005,10005511, 'refresco', 10,  29.2,'si');

TO_DATE('01/05/2018', 'DD/MM/YYYY')

INSERT INTO ingredientes VALUES (13000001,'sopa' ,'a',29.2, TO_DATE('02/12/2020', 'DD/MM/YYYY'),'verdura');
INSERT INTO ingredientes VALUES (13000002,'pescado' ,'b',52.6, TO_DATE('02/12/2021', 'DD/MM/YYYY'),'verdura');
INSERT INTO ingredientes VALUES (13000003,'ceviche' ,'c',15.2, TO_DATE('02/12/2022', 'DD/MM/YYYY'),'verdura');
INSERT INTO ingredientes VALUES (13000004,'popcorn' ,'d',25.4, TO_DATE('02/12/2019', 'DD/MM/YYYY'),'verdura');
INSERT INTO ingredientes VALUES (13000005,'torta' ,'e',52.2, TO_DATE('29/11/2016', 'DD/MM/YYYY'),'verdura');
INSERT INTO ingredientes VALUES (13000006,'costillitas' ,'f',8.2, TO_DATE('02/12/2026', 'DD/MM/YYYY'),'verdura');
INSERT INTO ingredientes VALUES (13000007,'ensalada' ,'g',96.4, TO_DATE('02/12/2027', 'DD/MM/YYYY'),'verdura');
INSERT INTO ingredientes VALUES (13000008,'refresco' ,'h',75.8, TO_DATE('02/12/2015', 'DD/MM/YYYY'),'verdura');
INSERT INTO ingredientes VALUES (13000009,'cafe' ,'i',48.6, TO_DATE('02/12/2045', 'DD/MM/YYYY'),'verdura');

INSERT INTO direcciones VALUES (10000006,'Cerro Colorado','Arequipa','H-10');
INSERT INTO direcciones VALUES (10000007,'Paucarpata','Arequipa','H-10');
INSERT INTO direcciones VALUES (10000008,'Cercado','Arequipa','H-10');
INSERT INTO direcciones VALUES (10000009,'Mira flores','Arequipa','H-10');
INSERT INTO direcciones VALUES (10000010,'JLBYR','Lima','H-10');
INSERT INTO direcciones VALUES (10000011,'Cayma','Arequipa','H-10');
INSERT INTO direcciones VALUES (10000012,'Sachaca','Lima','H-10');
INSERT INTO direcciones VALUES (10000013,'Venezuela','Arequipa','H-10');
INSERT INTO direcciones VALUES (10000014,'Calalo','Arequipa','H-10');
INSERT INTO direcciones VALUES (10000015,'Cor','Arequipa','H-10');
INSERT INTO direcciones VALUES (10000016,'Callao','Lima','H-10');
INSERT INTO direcciones VALUES (10000017,'Carmen','Arequipa','H-10');
INSERT INTO direcciones VALUES (10000018,'P','Lima','H-10');
INSERT INTO direcciones VALUES (10000019,'C','Arequipa','H-10');

INSERT INTO proveedores VALUES (14000001,10000006,'Abc','454896');
INSERT INTO proveedores VALUES (14000002,10000007,'Ebc','454876');
INSERT INTO proveedores VALUES (14000003,10000008,'Ibc','454846');
INSERT INTO proveedores VALUES (14000004,10000009,'Obc','454846');
INSERT INTO proveedores VALUES (14000005,10000010,'Ubc','454856');
INSERT INTO proveedores VALUES (14000006,10000011,'Zbc','454486');

INSERT INTO stocks VALUES (13000002,14000007,2054);
INSERT INTO stocks VALUES (13000003,14000007,4892);
INSERT INTO stocks VALUES (13000004,14000008,96523);
INSERT INTO stocks VALUES (13000005,14000009,1203);
INSERT INTO stocks VALUES (13000006,14000010,2036);
INSERT INTO stocks VALUES (13000007,14000010,896);
INSERT INTO stocks VALUES (13000008,14000011,165);
INSERT INTO stocks VALUES (13000009,14000012,123);
INSERT INTO stocks VALUES (13000001,14000012,7544);

INSERT INTO comensales VALUES (12341234, 10000019,'Abelardo','Carpio');
INSERT INTO comensales VALUES (12344584, 10000018,'Anegl','Carpio');
INSERT INTO comensales VALUES (12315734, 10000017,'Carpio','Carpio');
INSERT INTO comensales VALUES (12344444, 10000016,'Carmen','Carpio');
INSERT INTO comensales VALUES (12377734, 10000015,'Cas','Carpio');
INSERT INTO comensales VALUES (12471114, 10000014,'Berlin','Carpio');
INSERT INTO comensales VALUES (12377034, 10000013,'Tokio','Carpio');
INSERT INTO comensales VALUES (12145234, 10000012,'Rio','Carpio');
INSERT INTO comensales VALUES (12756234, 10000019,'Estocolmo','Carpio');
INSERT INTO comensales VALUES (12348954, 10000018,'Cesar','Carpio');
INSERT INTO comensales VALUES (11542234, 10000017,'Carlos','Carpio');
INSERT INTO comensales VALUES (12120323, 10000016,'Abelardo','Carpio');
INSERT INTO comensales VALUES (12489253, 10000015,'Sefano','Carpio');
INSERT INTO comensales VALUES (12341145, 10000014,'Luis','Carpio');
INSERT INTO comensales VALUES (12341144, 10000013,'Ariel','Carpio');
INSERT INTO comensales VALUES (12344524, 10000012,'Ana','Carpio');

INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA) VALUES (10000501, 12341234,TO_DATE('01/02/2021', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000502, 12344584,TO_DATE('01/02/2022', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000503, 12315734,TO_DATE('01/02/2019', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000504, 12344444,TO_DATE('01/02/20215', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000505, 12377734,TO_DATE('01/02/2016', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000506, 12471114,TO_DATE('01/02/2015', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000507, 12377034,TO_DATE('01/02/2013', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000508, 12145234,TO_DATE('01/02/2016', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000509, 12756234,TO_DATE('01/02/2020', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000510, 12348954,TO_DATE('01/02/2021', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000511, 11542234,TO_DATE('01/02/2020', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000512, 12120323,TO_DATE('01/02/2020', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000513, 12489253,TO_DATE('01/02/2020', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000514, 12341145,TO_DATE('01/02/2015', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000515, 12341144,TO_DATE('01/02/2016', 'DD/MM/YYYY'));
INSERT INTO encbzdo_pedidos (ID,COD_DNI,FECHA)VALUES (10000516, 12344524,TO_DATE('01/02/2017', 'DD/MM/YYYY'));

INSERT INTO crpo_pedidos VALUES (10005501, 10000501,'plato1',503.2,2);
INSERT INTO crpo_pedidos VALUES (10005502, 10000502,'a',503.2,20);
INSERT INTO crpo_pedidos VALUES (10005503, 10000503,'b',15.2,4);
INSERT INTO crpo_pedidos VALUES (10005504, 10000505,'c',175.2,45);
INSERT INTO crpo_pedidos VALUES (10005505, 10000506,'d',45.2,4);
INSERT INTO crpo_pedidos VALUES (10005506, 10000507,'e',48.2,4);
INSERT INTO crpo_pedidos VALUES (10005507, 10000508,'e',1548.2,12);
INSERT INTO crpo_pedidos VALUES (10005508, 10000509,'g',4852.2,452);
INSERT INTO crpo_pedidos VALUES (10005509, 10000510,'h',154.2,45);
INSERT INTO crpo_pedidos VALUES (10005510, 10000511,'i',785.2,63);
INSERT INTO crpo_pedidos VALUES (10005511, 10000512,'s',154.2,69);
INSERT INTO crpo_pedidos VALUES (10005512, 10000513,'a',65.2,2);
INSERT INTO crpo_pedidos VALUES (10005513, 10000514,'k',487.2,3);
INSERT INTO crpo_pedidos VALUES (10005514, 10000515,'z',589.2,2);
INSERT INTO crpo_pedidos VALUES (10005515, 10000516,'z',1458.2,1);

DESCRIBE deliveris;
INSERT INTO deliveris VALUES (10055501, 20.2,'9921765900','15 min');
INSERT INTO deliveris VALUES (10055502, 15.2,'9921765900','15 min');
INSERT INTO deliveris VALUES (10055503, 5.2,'9921765900','25 min');
INSERT INTO deliveris VALUES (10055504, 7.2,'9921765900','15 min');
INSERT INTO deliveris VALUES (10055505, 32.2,'9921765900','40 min');
INSERT INTO deliveris VALUES (10055506, 29.2,'9921765900','60 min');
INSERT INTO deliveris VALUES (10055507, 9.2,'9921765900','45 min');
INSERT INTO deliveris VALUES (10055508, 5.2,'9921765900','35 min');


