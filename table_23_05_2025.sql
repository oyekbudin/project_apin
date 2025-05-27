DROP TABLE IF EXISTS "users" CASCADE;
CREATE TABLE users (
    id UUID PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    registerdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    loginstatus BOOLEAN DEFAULT FALSE
);

DROP TABLE IF EXISTS "administrator" CASCADE;
CREATE TABLE administrator (
    idadmin UUID PRIMARY KEY,
    adminname VARCHAR(100) UNIQUE NOT NULL,
    role VARCHAR(50),
    password TEXT NOT NULL,
    name VARCHAR(100) UNIQUE NOT NULL,
    registerdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    loginstatus BOOLEAN DEFAULT FALSE
);

DROP TABLE IF EXISTS "infaq_kelas";
DROP TABLE IF EXISTS "kelas" CASCADE;
CREATE TABLE kelas (
    id integer not null PRIMARY KEY,
    nama varchar(20) not null
);

DROP TABLE IF EXISTS "infaq" CASCADE;
CREATE TABLE infaq (
    id UUID PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,
    harga int NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE infaq_kelas (
    id UUID PRIMARY KEY,
    id_infaq UUID not null,
    id_kelas integer not null,
    /*PRIMARY KEY (id_infaq, id_kelas),*/
    FOREIGN KEY (id_infaq) REFERENCES infaq(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_kelas) REFERENCES kelas(id)
);

DROP TABLE IF EXISTS "siswa" CASCADE;
CREATE TABLE siswa (
    nis int UNIQUE NOT NULL PRIMARY KEY,
    phonenumber VARCHAR(15) NOT NULL,
    gender VARCHAR(1) NOT NULL,
    kelas integer NOT NULL,
    name VARCHAR(100) UNIQUE NOT NULL,
    registerdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    loginstatus BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (kelas) REFERENCES kelas(id)    
);

DROP TABLE IF EXISTS "notification";
CREATE TABLE notification (
    id UUID PRIMARY KEY,
    gross_amount numeric,
    payment_type varchar(50),
    transaction_status varchar(50),
    transaction_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status_code int,
    fraud_status varchar(50),
    /*created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, */
    order_id text,
    id_siswa int,
    id_infaq UUID,
    nominal numeric,
    payment_method varchar(10) NOT NULL DEFAULT 'midtrans',
    snaptoken text
);

DROP TABLE IF EXISTS "pembayaran";
CREATE TABLE pembayaran (
    id UUID PRIMARY KEY,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_siswa int not null,
    id_infaq UUID not null,
    nominal numeric CHECK (nominal >= 0),
    payment_method VARCHAR(10) NOT NULL DEFAULT 'manual' CHECK (payment_method IN ('manual', 'midtrans')),
    order_id text not NULL, 
    /*payment_type VARCHAR(50) NULL, */
    status VARCHAR(15) NULL DEFAULT 'pending' /*CHECK (status IN ('success','pending', 'settlement', 'expire', 'cancel', 'deny', 'refund'))*/,
    /*transaction_time TIMESTAMP NULL,
    fraud_status VARCHAR(20) NULL,
    snap_token TEXT NULL,*/

    FOREIGN KEY (id_siswa) REFERENCES siswa(nis) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_infaq) REFERENCES infaq(id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS "tagihan" CASCADE;
CREATE TABLE tagihan (
    id UUID,
    id_siswa integer not null,
    id_infaq UUID NOT NULL,
    PRIMARY KEY (id, id_siswa, id_infaq),
    FOREIGN KEY (id_siswa) REFERENCES siswa(nis) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_infaq) REFERENCES infaq(id) ON DELETE CASCADE ON UPDATE CASCADE
);
DROP TABLE IF EXISTS "request_tagihan" CASCADE;
CREATE TABLE request_tagihan (
    id UUID,
    title VARCHAR(50),
    id_admin UUID not null,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(15) NULL DEFAULT 'pending' CHECK (status IN ('accepted','pending', 'rejected')),
    PRIMARY KEY (id),
    FOREIGN KEY (id_admin) REFERENCES administrator(idadmin) ON DELETE CASCADE ON UPDATE CASCADE
);
DROP TABLE IF EXISTS "tagihan_infaq" CASCADE;
CREATE TABLE tagihan_infaq (
    id UUID PRIMARY KEY,
    id_tagihan UUID not null,
    id_infaq UUID not null,
    /*PRIMARY KEY (id_tagihan, id_infaq),*/
    FOREIGN KEY (id_tagihan) REFERENCES request_tagihan(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_infaq) REFERENCES infaq(id) ON DELETE CASCADE ON UPDATE CASCADE
);


DROP TABLE IF EXISTS "pesanwa";
CREATE TABLE pesanwa (
    id UUID PRIMARY KEY,
    nomor_penerima VARCHAR(20) NOT NULL,
    nama_penerima VARCHAR(100),
    pesan TEXT NOT NULL,
    status VARCHAR(20),
    response_json JSONB,
    waktu_kirim TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DROP TABLE IF EXISTS "rekening";
CREATE TABLE rekening (
    id int PRIMARY KEY,
    nama_sekolah VARCHAR(100),
    nama_pemilik_rekening TEXT,
    nama_bank TEXT,
    nomor_rekening TEXT,
    nama_kepsek TEXT,
    nim_kepsek TEXT,
    nama_bendahara TEXT,
    phonenumber TEXT
);

DROP TABLE IF EXISTS "tagihan_aktif";
CREATE TABLE tagihan_aktif (
    id UUID PRIMARY KEY,
    id_tagihan UUID,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tagihan) REFERENCES request_tagihan(id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "log_error_pembayaran";
CREATE TABLE log_error_pembayaran (
    id UUID PRIMARY KEY,
    order_id VARCHAR(100),
    status_message TEXT,
    status_code VARCHAR(10),
    transaction_status VARCHAR(50),
    payment_type VARCHAR(50),
    raw_response TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
