/*This script will create all the tables for diamantsecret*/
use PROD_DIAMANTSECRET; 

SELECT 'CREATING TB_ACCOUNTS' AS ' ';
source table/TB_ACCOUNTS.sql;

SELECT 'CREATING TABLE TB_BRACELETS' AS ' ';
source table/TB_BRACELETS.sql;

SELECT 'CREATING TB_CATEGORIES' AS ' ';
source table/TB_CATEGORIES.sql;
 
SELECT 'CREATING TB_COMPANY_ID' AS ' ';
source table/TB_COMPANY_ID.sql;

SELECT 'CREATING TB_COUNTRY_VAT' AS ' ';
source table/TB_COUNTRY_VAT.sql;

SELECT 'CREATING TB_DIAMOND_SHAPE' AS ' ';
source table/TB_DIAMOND_SHAPE.sql;

SELECT 'CREATING TB_DIAMONDS' AS ' ';
source table/TB_DIAMONDS.sql;

SELECT 'CREATING TB_EARRINGS' AS ' ';
source table/TB_EARRINGS.sql;

SELECT 'CREATING TABLE TB_ITEMS' AS ' ';
source table/TB_ITEMS.sql;

SELECT 'CREATING TB_MATERIALS' AS ' ';
source table/TB_MATERIALS.sql;

SELECT 'CREATING TABLE TB_MODERATOR_LOGIN' AS ' ';
source table/TB_MODERATOR_LOGIN.sql;

SELECT 'CREATING TABLE TB_NECKLACES' AS ' ';
source table/TB_NECKLACES.sql;

SELECT 'CREATING TABLE TB_PENDANTS' AS ' ';
source table/TB_PENDANTS.sql;

SELECT 'CREATING TABLE TB_RING_SUBCATEGORY' AS ' ';
source table/TB_RING_SUBCATEGORY.sql;

SELECT 'CREATING TABLE TB_RINGS' AS ' ';
source table/TB_RINGS.sql;

SELECT 'CREATING TABLE TB_SUBSCRIBERS' AS ' ';
source table/TB_SUBSCRIBERS.sql;

SELECT 'CREATING TABLE TB_TMP_TABLE' AS ' ';
source table/TB_TMP_TABLE.sql;

SELECT 'CREATING TABLE TB_VERSION' AS ' ';
source table/TB_VERSION.sql;

/* Inserting Static Data */

SELECT 'INSERTING RECORDS IN TB_CATEGORIES' as '';
source staticData/TB_CATEGORIES.sql;

SELECT 'INSERTING RECORDS IN TB_COUNTRY_VAT' as '';
source staticData/TB_COUNTRY_VAT.sql;

SELECT 'INSERTING RECORDS IN TB_DIAMOND_SHAPE' as '';
source staticData/TB_DIAMOND_SHAPE.sql;

SELECT 'UPDATING RECORDS IN TB_MATERIALS' as '';
source staticData/TB_MATERIALS.sql;

SELECT 'INSERTING RECORDS IN TB_RING_SUBCATEGORY' as '';
source staticData/TB_RING_SUBCATEGORY.sql;

SELECT 'INSERTING RECORDS IN TB_ACCOUNTS' as '';
source staticData/TB_ACCOUNTS.sql;

SELECT 'UPDATING RECORDS IN TB_VERSION' as '';
source staticData/TB_VERSION.sql;
