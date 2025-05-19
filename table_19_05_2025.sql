DROP TABLE IF EXISTS "users" CASCADE;
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    registerdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    loginstatus BOOLEAN DEFAULT FALSE
);

DROP TABLE IF EXISTS "administrator";
CREATE TABLE administrator (
    idadmin SERIAL PRIMARY KEY,
    adminname VARCHAR(100) UNIQUE NOT NULL,
    role VARCHAR(50),
    password TEXT NOT NULL
) INHERITS (Users);

DROP TABLE IF EXISTS "infaq_kelas";
DROP TABLE IF EXISTS "kelas";
CREATE TABLE kelas (
    id integer not null PRIMARY KEY,
    nama varchar(20) not null
);

DROP TABLE IF EXISTS "infaq" CASCADE;
CREATE TABLE infaq (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,
    harga int NOT NULL
);

CREATE TABLE infaq_kelas (
    id_infaq integer not null,
    id_kelas integer not null,
    PRIMARY KEY (id_infaq, id_kelas),
    FOREIGN KEY (id_infaq) REFERENCES infaq(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_kelas) REFERENCES kelas(id)
);

DROP TABLE IF EXISTS "siswa" CASCADE;
CREATE TABLE siswa (
    nis int UNIQUE NOT NULL PRIMARY KEY,
    phonenumber VARCHAR(15) NOT NULL,
    gender VARCHAR(1) NOT NULL,
    kelas integer NOT NULL,
    FOREIGN KEY (kelas) REFERENCES kelas(id)
) INHERITS (Users);

DROP TABLE IF EXISTS "notification";
CREATE TABLE notification (
    id SERIAL PRIMARY KEY,
    gross_amount numeric,
    payment_type varchar(50),
    transaction_status varchar(50),
    transaction_time TIMESTAMP,
    status_code int,
    fraud_status varchar(50),
    /*created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, */
    order_id int,
    id_siswa int,
    id_infaq int,
    nominal numeric,
    payment_method varchar(10) NOT NULL DEFAULT 'midtrans'
);

DROP TABLE IF EXISTS "pembayaran";
CREATE TABLE pembayaran (
    id SERIAL PRIMARY KEY,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_siswa int not null,
    id_infaq int not null,
    nominal numeric CHECK (nominal >= 0),
    payment_method VARCHAR(10) NOT NULL DEFAULT 'manual' CHECK (payment_method IN ('manual', 'midtrans')),
    order_id int not NULL, 
    /*payment_type VARCHAR(50) NULL, */
    status VARCHAR(15) NULL DEFAULT 'pending' CHECK (status IN ('success','pending', 'settlement', 'expire', 'cancel', 'deny', 'refund')),
    /*transaction_time TIMESTAMP NULL,
    fraud_status VARCHAR(20) NULL,
    snap_token TEXT NULL,*/

    FOREIGN KEY (id_siswa) REFERENCES siswa(nis) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_infaq) REFERENCES infaq(id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS "tagihan" CASCADE;
CREATE TABLE tagihan (
    id SERIAL,
    id_siswa integer not null,
    id_infaq INTEGER NOT NULL,
    PRIMARY KEY (id, id_siswa, id_infaq),
    FOREIGN KEY (id_siswa) REFERENCES siswa(nis) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_infaq) REFERENCES infaq(id) ON DELETE CASCADE ON UPDATE CASCADE
);
DROP TABLE IF EXISTS "request_tagihan" CASCADE;
CREATE TABLE request_tagihan (
    id SERIAL,
    title VARCHAR(50),
    id_admin integer not null,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(15) NULL DEFAULT 'pending' CHECK (status IN ('accepted','pending', 'rejected')),
    PRIMARY KEY (id),
    FOREIGN KEY (id_admin) REFERENCES administrator(idadmin) ON DELETE CASCADE ON UPDATE CASCADE
);
DROP TABLE IF EXISTS "tagihan_infaq" CASCADE;
CREATE TABLE tagihan_infaq (
    id_tagihan integer not null,
    id_infaq integer not null,
    PRIMARY KEY (id_tagihan, id_infaq),
    FOREIGN KEY (id_tagihan) REFERENCES request_tagihan(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_infaq) REFERENCES infaq(id) ON DELETE CASCADE ON UPDATE CASCADE
);


DROP TABLE IF EXISTS "pesanwa";
CREATE TABLE pesanwa (
    id SERIAL PRIMARY KEY,
    jenis VARCHAR(50) UNIQUE NOT NULL,
    pesan TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS "rekening";
CREATE TABLE rekening (
    id SERIAL PRIMARY KEY,
    nama_sekolah VARCHAR(100),
    nama_pemilik_rekening VARCHAR(100),
    nama_bank VARCHAR(50),
    nomor_rekening VARCHAR(20),
    nama_kepsek VARCHAR(50),
    nim_kepsek VARCHAR(20),
    nama_bendahara VARCHAR(50),
    phonenumber VARCHAR(15)
);

DROP TABLE IF EXISTS "tagihan_aktif";
CREATE TABLE tagihan_aktif (
    id SERIAL PRIMARY KEY,
    id_tagihan int,
    FOREIGN KEY (id_tagihan) REFERENCES request_tagihan(id) ON DELETE CASCADE ON UPDATE CASCADE
);