--------------------------------------------------------
--  File created - Friday-November-15-2024   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Sequence STORE_INFO_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."STORE_INFO_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence USERS_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."USERS_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence INVENTORY_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."INVENTORY_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence RECEIPT_ITEM_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."RECEIPT_ITEM_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence RECEIPT_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."RECEIPT_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence DAMAGED_ITEM_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "C##INVENSYNC"."DAMAGED_ITEM_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 101 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Table I_DAMAGED_ITEM
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_DAMAGED_ITEM" 
   (	"DAMAGED_ID" NUMBER, 
	"DATE_DAMAGED" DATE DEFAULT SYSDATE, 
	"DAMAGED_DESC" VARCHAR2(255 BYTE), 
	"QTY_DAMAGED" NUMBER, 
	"ACTION" VARCHAR2(100 BYTE), 
	"COST" NUMBER(10,2), 
	"ITEM_ID" NUMBER
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_USERS
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_USERS" 
   (	"USER_ID" NUMBER, 
	"NAME" VARCHAR2(100 BYTE), 
	"ROLE" VARCHAR2(50 BYTE), 
	"ADDRESS" VARCHAR2(150 BYTE), 
	"PHONE_NUMBER" NUMBER(15,0), 
	"EMAIL" VARCHAR2(100 BYTE), 
	"PASSWORD" VARCHAR2(100 BYTE), 
	"STORE_ID" NUMBER
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_RECEIPT_ITEM
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" 
   (	"RECEIPT_ITEM_ID" NUMBER, 
	"QUANTITY" NUMBER, 
	"TOTAL_PER_ITEM" NUMBER(10,2), 
	"RECEIPT_ID" NUMBER, 
	"ITEM_ID" NUMBER
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_STORE_INFO
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_STORE_INFO" 
   (	"STORE_ID" NUMBER, 
	"STORE_NAME" VARCHAR2(100 BYTE), 
	"STORE_TYPE" VARCHAR2(50 BYTE), 
	"LOCATION" VARCHAR2(100 BYTE), 
	"PHONE_NUMBER" NUMBER(15,0), 
	"EMAIL" VARCHAR2(100 BYTE), 
	"DATE_CREATED" DATE DEFAULT SYSDATE, 
	"YEAR_FOUNDED" NUMBER
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_INVENTORY
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_INVENTORY" 
   (	"ITEM_ID" NUMBER, 
	"ITEM_NAME" VARCHAR2(100 BYTE), 
	"QUANTITY" NUMBER DEFAULT 0, 
	"DATE_ADDED" DATE DEFAULT SYSDATE, 
	"HARGA_BELI" NUMBER(10,2), 
	"HARGA_JUAL" NUMBER(10,2), 
	"STATUS" VARCHAR2(50 BYTE), 
	"DATE_EXPIRED" DATE, 
	"USER_ID" NUMBER
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table I_RECEIPT
--------------------------------------------------------

  CREATE TABLE "C##INVENSYNC"."I_RECEIPT" 
   (	"RECEIPT_ID" NUMBER, 
	"DATE_ADDED" DATE DEFAULT SYSDATE, 
	"TOTAL_PRICE" NUMBER(10,2), 
	"USER_ID" NUMBER
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
REM INSERTING into C##INVENSYNC.I_DAMAGED_ITEM
SET DEFINE OFF;
REM INSERTING into C##INVENSYNC.I_USERS
SET DEFINE OFF;
REM INSERTING into C##INVENSYNC.I_RECEIPT_ITEM
SET DEFINE OFF;
REM INSERTING into C##INVENSYNC.I_STORE_INFO
SET DEFINE OFF;
REM INSERTING into C##INVENSYNC.I_INVENTORY
SET DEFINE OFF;
REM INSERTING into C##INVENSYNC.I_RECEIPT
SET DEFINE OFF;
--------------------------------------------------------
--  DDL for Index SYS_C009402
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009402" ON "C##INVENSYNC"."I_DAMAGED_ITEM" ("DAMAGED_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009390
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009390" ON "C##INVENSYNC"."I_USERS" ("USER_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009399
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009399" ON "C##INVENSYNC"."I_RECEIPT_ITEM" ("RECEIPT_ITEM_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009387
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009387" ON "C##INVENSYNC"."I_STORE_INFO" ("STORE_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009393
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009393" ON "C##INVENSYNC"."I_INVENTORY" ("ITEM_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Index SYS_C009395
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##INVENSYNC"."SYS_C009395" ON "C##INVENSYNC"."I_RECEIPT" ("RECEIPT_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS" ;
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
--  Constraints for Table I_DAMAGED_ITEM
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_DAMAGED_ITEM" ADD PRIMARY KEY ("DAMAGED_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table I_USERS
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_USERS" MODIFY ("NAME" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_USERS" MODIFY ("PASSWORD" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_USERS" ADD PRIMARY KEY ("USER_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table I_RECEIPT_ITEM
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" MODIFY ("QUANTITY" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" MODIFY ("TOTAL_PER_ITEM" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" ADD PRIMARY KEY ("RECEIPT_ITEM_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table I_STORE_INFO
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_STORE_INFO" MODIFY ("STORE_NAME" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_STORE_INFO" ADD PRIMARY KEY ("STORE_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table I_INVENTORY
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_INVENTORY" MODIFY ("ITEM_NAME" NOT NULL ENABLE);
  ALTER TABLE "C##INVENSYNC"."I_INVENTORY" ADD PRIMARY KEY ("ITEM_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table I_RECEIPT
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_RECEIPT" ADD PRIMARY KEY ("RECEIPT_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_DAMAGED_ITEM
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_DAMAGED_ITEM" ADD FOREIGN KEY ("ITEM_ID")
	  REFERENCES "C##INVENSYNC"."I_INVENTORY" ("ITEM_ID") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_USERS
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_USERS" ADD FOREIGN KEY ("STORE_ID")
	  REFERENCES "C##INVENSYNC"."I_STORE_INFO" ("STORE_ID") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_RECEIPT_ITEM
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" ADD FOREIGN KEY ("RECEIPT_ID")
	  REFERENCES "C##INVENSYNC"."I_RECEIPT" ("RECEIPT_ID") ENABLE;
  ALTER TABLE "C##INVENSYNC"."I_RECEIPT_ITEM" ADD FOREIGN KEY ("ITEM_ID")
	  REFERENCES "C##INVENSYNC"."I_INVENTORY" ("ITEM_ID") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_INVENTORY
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_INVENTORY" ADD FOREIGN KEY ("USER_ID")
	  REFERENCES "C##INVENSYNC"."I_USERS" ("USER_ID") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table I_RECEIPT
--------------------------------------------------------

  ALTER TABLE "C##INVENSYNC"."I_RECEIPT" ADD FOREIGN KEY ("USER_ID")
	  REFERENCES "C##INVENSYNC"."I_USERS" ("USER_ID") ENABLE;
