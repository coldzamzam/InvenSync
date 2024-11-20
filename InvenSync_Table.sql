--------------------------------------------------------
--  File created - Wednesday-November-20-2024   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Sequence USERS_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."USERS_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 113 NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence RECEIPT_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."RECEIPT_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence STORE_INFO_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."STORE_INFO_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence RECEIPT_ITEM_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."RECEIPT_ITEM_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence INVENTORY_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."INVENTORY_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence DAMAGED_ITEM_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."DAMAGED_ITEM_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Table I_RECEIPT
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_RECEIPT" 
   (	"RECEIPT_ID" VARCHAR2(50 BYTE), 
	"DATE_ADDED" DATE DEFAULT SYSDATE, 
	"TOTAL_PRICE" NUMBER(10,2), 
	"USER_ID" VARCHAR2(50 BYTE)
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_INVENTORY
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_INVENTORY" 
   (	"ITEM_ID" VARCHAR2(50 BYTE), 
	"ITEM_NAME" VARCHAR2(100 BYTE), 
	"QUANTITY" NUMBER DEFAULT 0, 
	"DATE_ADDED" DATE DEFAULT SYSDATE, 
	"HARGA_BELI" NUMBER(10,2), 
	"HARGA_JUAL" NUMBER(10,2), 
	"STATUS" VARCHAR2(50 BYTE), 
	"DATE_EXPIRED" DATE, 
	"USER_ID" VARCHAR2(50 BYTE), 
	"IS_DELETED" NUMBER(1,0) DEFAULT 0
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_USERS
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_USERS" 
   (	"USER_ID" VARCHAR2(50 BYTE), 
	"NAME" VARCHAR2(100 BYTE), 
	"ROLE" VARCHAR2(50 BYTE), 
	"ADDRESS" VARCHAR2(150 BYTE), 
	"PHONE_NUMBER" NUMBER(15,0), 
	"EMAIL" VARCHAR2(100 BYTE), 
	"PASSWORD" VARCHAR2(100 BYTE), 
	"OWNER_ID" VARCHAR2(255 BYTE), 
	"IS_DELETED" NUMBER(1,0) DEFAULT 0
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_STORE_INFO
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_STORE_INFO" 
   (	"STORE_NAME" VARCHAR2(100 BYTE), 
	"STORE_TYPE" VARCHAR2(50 BYTE), 
	"LOCATION" VARCHAR2(100 BYTE), 
	"PHONE_NUMBER" NUMBER(15,0), 
	"EMAIL" VARCHAR2(100 BYTE), 
	"DATE_CREATED" DATE DEFAULT SYSDATE, 
	"YEAR_FOUNDED" NUMBER, 
	"STORE_ID" VARCHAR2(255 BYTE), 
	"OWNER_ID" VARCHAR2(255 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_RECEIPT_ITEM
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" 
   (	"RECEIPT_ITEM_ID" VARCHAR2(50 BYTE), 
	"QUANTITY" NUMBER, 
	"TOTAL_PER_ITEM" NUMBER(10,2), 
	"RECEIPT_ID" VARCHAR2(50 BYTE), 
	"ITEM_ID" VARCHAR2(50 BYTE), 
	"IS_DELETED" NUMBER(1,0) DEFAULT 0
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_DAMAGED_ITEM
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_DAMAGED_ITEM" 
   (	"DAMAGED_ID" VARCHAR2(50 BYTE), 
	"DATE_DAMAGED" DATE DEFAULT SYSDATE, 
	"DAMAGED_DESC" VARCHAR2(255 BYTE), 
	"QTY_DAMAGED" NUMBER, 
	"ACTION" VARCHAR2(100 BYTE), 
	"COST" NUMBER(10,2), 
	"ITEM_ID" VARCHAR2(50 BYTE), 
	"IS_DELETED" NUMBER(1,0) DEFAULT 0
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
REM INSERTING into C##INVENSYNC.I_RECEIPT
SET DEFINE OFF;
REM INSERTING into C##INVENSYNC.I_INVENTORY
SET DEFINE OFF;
REM INSERTING into C##INVENSYNC.I_USERS
SET DEFINE OFF;
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID103','AQSA ZAMZAMI','Admin Kasir','Komplek Kejaksaan Agung Blok F No. 11','82122050408','aqsazamzami@gmail.com','$2y$10$bvfj88ht1pxM9Znv/8Ruf.4bXwb/q0U2D4CNHf6phqyYK4bLqepPO',null,'0');
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID101','aqsa','Owner','jawa','8312534654','sazam@gmail.com','$2y$10$Nvel/M.4ug29lkI2nk3FauTLVRp/Fetd/xyYB7jJ8ezaWg/Jxyfj.',null,'0');
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID102','Aqsa Zamzami','Admin Gudang','Depok, Jawa Barat','82124793703','aqsazamzami@gmail.com','$2y$10$vjVaCYQ2sldDh/CTCbdG9.McBmTkwSq3ETpVAo61CTTDqIhm/BVUa',null,'0');
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID111','invensync2','Owner','ui','8212892323','invensync2@gmail.com','$2y$10$fw0mg/XmIpyppaFGIrHI4eCha2Pn/TLvkDB.pXeiVRVeDRk4X6D9.',null,'0');
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID112','InvenSync','Owner','pnj','81234567898','invensync@gmail.com','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f',null,'0');
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID108','jema','Admin Kasir','depok lama','82189674523','jemujema@gmail.com','$2y$10$Go2F63IYK72FGmtqIcKn9ukULJorSy2Ut2Klmx4/QZlwSvGczv.Bm',null,'0');
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID104','zam','Owner','jaksel','812345654','zamzam@gmail.com','$2y$10$pGipudrQ0V4uEQhWI91zTemqupTk2kz3UruW08zcEda4v3LEjuLD.',null,'0');
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID105','zaki','Admin Gudang','debar','88726261821','zakzak@gmail.com','$2y$10$KYFjkD4avI/s1rAMdynaKO4524aTrtsrzMuow0Gi2oY5UTSL/yjJi',null,'0');
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID110','invensync','Admin Gudang','pnj','85184554669','invensync@gmail.com','c7183967b833141ef647c582a91d2cca37571a43f3e095a1b43ba8f1d02980f2',null,'0');
Insert into C##INVENSYNC.I_USERS (USER_ID,NAME,ROLE,ADDRESS,PHONE_NUMBER,EMAIL,PASSWORD,OWNER_ID,IS_DELETED) values ('UID109','njel','Admin Gudang','kukusan teknik','8156826893','njel123@gmail.com','cf424122c9869aa36558453fe7a20581d3fa13172ba9b3b82e09fa03ba925ed2',null,'0');
REM INSERTING into C##INVENSYNC.I_STORE_INFO
SET DEFINE OFF;
REM INSERTING into C##INVENSYNC.I_RECEIPT_ITEM
SET DEFINE OFF;
REM INSERTING into C##INVENSYNC.I_DAMAGED_ITEM
SET DEFINE OFF;
--------------------------------------------------------
--  DDL for Index SYS_C009418
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009418" ON "C##INVENSYNC"."I_RECEIPT" ("RECEIPT_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009414
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009414" ON "C##INVENSYNC"."I_INVENTORY" ("ITEM_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009411
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009411" ON "C##INVENSYNC"."I_USERS" ("USER_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009426
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009426" ON "C##INVENSYNC"."I_STORE_INFO" ("STORE_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009422
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009422" ON "C##INVENSYNC"."I_RECEIPT_ITEM" ("RECEIPT_ITEM_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009416
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009416" ON "C##INVENSYNC"."I_DAMAGED_ITEM" ("DAMAGED_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Trigger TRG_USERS_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_USERS_ID" 
BEFORE INSERT ON I_USERS
FOR EACH ROW
BEGIN
    :NEW.USER_ID := 'UID' || USERS_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_USERS_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_STORE_INFO_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_STORE_INFO_ID" 
BEFORE INSERT ON I_STORE_INFO
FOR EACH ROW
BEGIN
    :NEW.STORE_ID := 'STR' || STORE_INFO_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_STORE_INFO_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_RECEIPT_ITEM_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_RECEIPT_ITEM_ID" 
BEFORE INSERT ON I_RECEIPT_ITEM
FOR EACH ROW
BEGIN
    :NEW.RECEIPT_ITEM_ID := 'RIT' || RECEIPT_ITEM_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_RECEIPT_ITEM_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_RECEIPT_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_RECEIPT_ID" 
BEFORE INSERT ON I_RECEIPT
FOR EACH ROW
BEGIN
    :NEW.RECEIPT_ID := 'RCP' || RECEIPT_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_RECEIPT_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_INVENTORY_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_INVENTORY_ID" 
BEFORE INSERT ON I_INVENTORY
FOR EACH ROW
BEGIN
    :NEW.ITEM_ID := 'ITM' || INVENTORY_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_INVENTORY_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_DAMAGED_ITEM_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_DAMAGED_ITEM_ID" 
BEFORE INSERT ON I_DAMAGED_ITEM
FOR EACH ROW
BEGIN
    :NEW.DAMAGED_ID := 'DMG' || DAMAGED_ITEM_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_DAMAGED_ITEM_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_RECEIPT_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_RECEIPT_ID" 
BEFORE INSERT ON I_RECEIPT
FOR EACH ROW
BEGIN
    :NEW.RECEIPT_ID := 'RCP' || RECEIPT_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_RECEIPT_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_INVENTORY_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_INVENTORY_ID" 
BEFORE INSERT ON I_INVENTORY
FOR EACH ROW
BEGIN
    :NEW.ITEM_ID := 'ITM' || INVENTORY_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_INVENTORY_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_USERS_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_USERS_ID" 
BEFORE INSERT ON I_USERS
FOR EACH ROW
BEGIN
    :NEW.USER_ID := 'UID' || USERS_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_USERS_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_STORE_INFO_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_STORE_INFO_ID" 
BEFORE INSERT ON I_STORE_INFO
FOR EACH ROW
BEGIN
    :NEW.STORE_ID := 'STR' || STORE_INFO_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_STORE_INFO_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_RECEIPT_ITEM_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_RECEIPT_ITEM_ID" 
BEFORE INSERT ON I_RECEIPT_ITEM
FOR EACH ROW
BEGIN
    :NEW.RECEIPT_ITEM_ID := 'RIT' || RECEIPT_ITEM_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_RECEIPT_ITEM_ID" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_DAMAGED_ITEM_ID
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "C##INVENSYNC"."TRG_DAMAGED_ITEM_ID" 
BEFORE INSERT ON I_DAMAGED_ITEM
FOR EACH ROW
BEGIN
    :NEW.DAMAGED_ID := 'DMG' || DAMAGED_ITEM_SEQ.NEXTVAL;
END;

/
ALTER TRIGGER "C##INVENSYNC"."TRG_DAMAGED_ITEM_ID" ENABLE;
--------------------------------------------------------
--  Constraints for Table I_RECEIPT
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_RECEIPT" ADD PRIMARY KEY ("RECEIPT_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table I_INVENTORY
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_INVENTORY" MODIFY ("ITEM_NAME" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_INVENTORY" ADD PRIMARY KEY ("ITEM_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS"  ENABLE;
  ALTER TABLE "C##INVENSYNC"."I_INVENTORY" MODIFY ("IS_DELETED" NOT NULL ENABLE);
--------------------------------------------------------
--  Constraints for Table I_USERS
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_USERS" MODIFY ("NAME" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_USERS" MODIFY ("PASSWORD" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_USERS" ADD PRIMARY KEY ("USER_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
  ALTER TABLE "C##INVENSYNC"."I_USERS" MODIFY ("IS_DELETED" NOT NULL ENABLE);
--------------------------------------------------------
--  Constraints for Table I_STORE_INFO
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_STORE_INFO" MODIFY ("STORE_NAME" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_STORE_INFO" ADD PRIMARY KEY ("STORE_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table I_RECEIPT_ITEM
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" MODIFY ("QUANTITY" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" MODIFY ("TOTAL_PER_ITEM" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" ADD PRIMARY KEY ("RECEIPT_ITEM_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS"  ENABLE;
  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" MODIFY ("IS_DELETED" NOT NULL ENABLE);
--------------------------------------------------------
--  Constraints for Table I_DAMAGED_ITEM
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_DAMAGED_ITEM" ADD PRIMARY KEY ("DAMAGED_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS"  ENABLE;
  ALTER TABLE "C##INVENSYNC"."I_DAMAGED_ITEM" MODIFY ("IS_DELETED" NOT NULL ENABLE);
--------------------------------------------------------
--  Ref Constraints for Table I_RECEIPT
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_RECEIPT" ADD FOREIGN KEY ("USER_ID")
	  REFERENCES "C##INVENSYNC"."I_USERS" ("USER_ID") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_INVENTORY
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_INVENTORY" ADD FOREIGN KEY ("USER_ID")
	  REFERENCES "C##INVENSYNC"."I_USERS" ("USER_ID") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_USERS
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_USERS" ADD CONSTRAINT "FK_OWNERID" FOREIGN KEY ("OWNER_ID")
	  REFERENCES "C##INVENSYNC"."I_USERS" ("USER_ID") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_STORE_INFO
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_STORE_INFO" ADD CONSTRAINT "FK_OWNERSTORE" FOREIGN KEY ("OWNER_ID")
	  REFERENCES "C##INVENSYNC"."I_USERS" ("USER_ID") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_RECEIPT_ITEM
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" ADD FOREIGN KEY ("RECEIPT_ID")
	  REFERENCES "C##INVENSYNC"."I_RECEIPT" ("RECEIPT_ID") ENABLE;
  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" ADD FOREIGN KEY ("ITEM_ID")
	  REFERENCES "C##INVENSYNC"."I_INVENTORY" ("ITEM_ID") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_DAMAGED_ITEM
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_DAMAGED_ITEM" ADD FOREIGN KEY ("ITEM_ID")
	  REFERENCES "C##INVENSYNC"."I_INVENTORY" ("ITEM_ID") ENABLE;
