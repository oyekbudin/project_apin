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

INSERT INTO administrator (name, adminname, role, password) VALUES (
    'Arvin Noer Hakim', 'hakimarvinnoer', 'SistemAdmin', '$2y$10$lQJrDb9WcSdWaGOkjIMQxOxLxt.QGKO2z2gJ5kowbxLlE2QGvyBfW'
);

DROP TABLE IF EXISTS "siswa" CASCADE;
CREATE TABLE siswa (
    nis int UNIQUE NOT NULL PRIMARY KEY,
    phonenumber VARCHAR(15) NOT NULL,
    gender VARCHAR(1) NOT NULL,
    kelas VARCHAR(1) NOT NULL
) INHERITS (Users);

DROP TABLE IF EXISTS "infaq" CASCADE;
CREATE TABLE infaq (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,
    kelas VARCHAR(3) NOT NULL,
    harga int NOT NULL
);

DROP TABLE IF EXISTS "pembayaran";
CREATE TABLE pembayaran (
    id SERIAL PRIMARY KEY,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idsiswa int not null,
    idinfaq int not null,
    nominal int CHECK (nominal >= 0),
    payment_method VARCHAR(10) NOT NULL DEFAULT 'manual' CHECK (payment_method IN ('manual', 'midtrans')),
    order_id VARCHAR(50) NULL, 
    payment_type VARCHAR(50) NULL, 
    status VARCHAR(15) NULL DEFAULT 'pending' CHECK (status IN ('pending', 'settlement', 'expire', 'cancel', 'deny', 'refund')),
    transaction_time TIMESTAMP NULL,
    fraud_status VARCHAR(20) NULL,
    snap_token TEXT NULL,

    FOREIGN KEY (idsiswa) REFERENCES siswa(nis) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idinfaq) REFERENCES infaq(id) ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "tagihan" CASCADE;
CREATE TABLE tagihan (
    id SERIAL PRIMARY KEY,
    idsiswa INT REFERENCES siswa(nis),
    tanggal DATE NOT NULL,
    total INTEGER DEFAULT 0
);

DROP TABLE IF EXISTS "tagihan_detail";
CREATE TABLE tagihan_detail (
    id SERIAL PRIMARY KEY,
    idtagihan INTEGER REFERENCES tagihan(id) ON DELETE CASCADE ON UPDATE CASCADE,
    idinfaq INTEGER REFERENCES infaq(id) ON DELETE CASCADE ON UPDATE CASCADE,
    nominal INTEGER NOT NULL,
    sudah_dibayar INTEGER DEFAULT 0
);


DROP TABLE IF EXISTS "pesanwa";
CREATE TABLE pesanwa (
    id SERIAL PRIMARY KEY,
    jenis VARCHAR(50) UNIQUE NOT NULL,
    pesan TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

