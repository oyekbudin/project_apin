DROP TABLE IF EXISTS "administrator";
DROP SEQUENCE IF EXISTS userx_id_seq;
CREATE SEQUENCE userx_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."administrator" (
    "id" integer DEFAULT nextval('userx_id_seq') NOT NULL,
    "name" character varying(100) NOT NULL,
    "registerdate" timestamp DEFAULT now(),
    "loginstatus" boolean DEFAULT false,
    "adminname" character varying(100) NOT NULL,
    "role" character varying(50),
    "password" text NOT NULL
) WITH (oids = false);

INSERT INTO "administrator" ("id", "name", "registerdate", "loginstatus", "adminname", "role", "password") VALUES
(1,	'Erika Aura',	'2025-02-18 14:02:31.510714',	'f',	'erikaaura',	'Bendahara',	'$2y$10$qBOxkvlMk23Y6mN7xtUKRecHgHLdLykGm/mOGnyVtxX8YQuZrXUDS'),
(2,	'Ibnu Sadun Isngadi',	'2025-02-18 14:47:51.351131',	'f',	'ibnusadun',	'KepalaSekolah',	'$2y$10$021srvXiRrYPrLoMeweNsulDZ7ZYfjiGW.4m6HVESvYKTAOsB73mq'),
(3,	'Arvin Noer Hakim',	'2025-02-18 14:48:42.902256',	'f',	'hakimarvinnoer',	'SistemAdmin',	'$2y$10$lQJrDb9WcSdWaGOkjIMQxOxLxt.QGKO2z2gJ5kowbxLlE2QGvyBfW'),
(4,	'Retno Kinasih',	'2025-02-25 16:58:56.996955',	'f',	'retnoasih',	'Bendahara',	'$2y$10$bfUf6DrpPc63GTujNHSIHOO0JMDXnJSKGcd2ewwcZ7.QVU4fxjjO2');

DROP TABLE IF EXISTS "userx";
DROP SEQUENCE IF EXISTS userx_id_seq;
CREATE SEQUENCE userx_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."userx" (
    "id" integer DEFAULT nextval('userx_id_seq') NOT NULL,
    "name" character varying(100) NOT NULL,
    "registerdate" timestamp DEFAULT now(),
    "loginstatus" boolean DEFAULT false,
    CONSTRAINT "userx_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "userx" ("id", "name", "registerdate", "loginstatus") VALUES
(1,	'Erika Aura',	'2025-02-18 14:02:31.510714',	'f'),
(2,	'Ibnu Sadun Isngadi',	'2025-02-18 14:47:51.351131',	'f'),
(3,	'Arvin Noer Hakim',	'2025-02-18 14:48:42.902256',	'f'),
(4,	'Retno Kinasih',	'2025-02-25 16:58:56.996955',	'f');

CREATE TABLE siswa (
    nis int NOT NULL,
    phonenumber VARCHAR(50) NOT NULL,
    gender VARCHAR(1) NOT NULL,
    kelas int NOT NULL
) INHERITS (Userx);