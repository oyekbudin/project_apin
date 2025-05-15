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
CREATE TABLE infaq_kelas (
    id_infaq integer not null,
    id_kelas integer not null,
    PRIMARY KEY (id_infaq, id_kelas),
    FOREIGN KEY (id_infaq) REFERENCES infaq(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_kelas) REFERENCES kelas(id)
);
INSERT INTO kelas (id, nama) VALUES
(7, 'Kelas 7'),
(8, 'Kelas 8'),
(9, 'Kelas 9');

DROP TABLE IF EXISTS "siswa" CASCADE;
CREATE TABLE siswa (
    nis int UNIQUE NOT NULL PRIMARY KEY,
    phonenumber VARCHAR(15) NOT NULL,
    gender VARCHAR(1) NOT NULL,
    kelas integer NOT NULL
) INHERITS (Users);

DROP TABLE IF EXISTS "infaq" CASCADE;
CREATE TABLE infaq (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,
    harga int NOT NULL
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
    payment_type VARCHAR(50) NULL, 
    status VARCHAR(15) NULL DEFAULT 'pending' CHECK (status IN ('success','pending', 'settlement', 'expire', 'cancel', 'deny', 'refund')),
    transaction_time TIMESTAMP NULL,
    fraud_status VARCHAR(20) NULL,
    snap_token TEXT NULL,

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


INSERT INTO administrator (name, adminname, role, password) VALUES (
    'Arvin Noer Hakim', 'hakimarvinnoer', 'SistemAdmin', '$2y$10$lQJrDb9WcSdWaGOkjIMQxOxLxt.QGKO2z2gJ5kowbxLlE2QGvyBfW'
);

INSERT INTO "siswa" ( "nis", "name", "kelas","phonenumber", "gender") VALUES
( 701, 'ALIYA QURROTUNNADA',  7, '081111111701', 'P'),
( 702, 'ARSHILLA NATASYA RIFKY',  7, '081111111702', 'P'),
( 703, 'BEKTI FIRMAN HAKIM',  7, '081111111703', 'L'),
( 704, 'DEA EINJELLIA',  7, '081111111704', 'P'),
( 705, 'ESA GALIH SATRIADI',  7, '081111111705', 'L'),
( 706, 'KEYZHA FITRI MAHARRANI',  7, '081111111706', 'P'),
( 707, 'KHOLIYAH NUR AISYAH',  7, '081111111707', 'P'),
( 708, 'LINDA WIDYANA ARUM',  7, '081111111708', 'P'),
( 709, 'LUKMAN HERYANA',  7, '081111111709', 'L'),
( 710, 'MULYANA',  7, '081111111710', 'L'),
( 711, 'MUTIARA NUR AZIZAH',  7, '081111111711', 'P'),
( 712, 'NUR AZIZAH',  7, '081111111712', 'P'),
( 713, 'NURCAHAYA SETIAWATI',  7, '081111111713', 'P'),
( 714, 'NURUL AZIZAH PRIHATIN',  7, '081111111714', 'P'),
( 715, 'RAFFI AHMAD FIRMANSYAH',  7, '081111111715', 'L'),
( 716, 'RAISA DEA ANGGRAENI',  7, '081111111716', 'P'),
( 717, 'RIFQI SIDIK MAULANA',  7, '081111111717', 'L'),
( 718, 'RIZKI',  7, '081111111718', 'L'),
( 719, 'RIVDA MUKARROMAH',  7, '081111111719', 'P'),
( 720, 'SAFIRA LAILATUL JANNAH',  7, '081111111720', 'P'),
( 721, 'SITI MAYSAROH',  7, '081111111721', 'P'),
( 722, 'SYARIF HIDAYAT',  7, '081111111722', 'L'),
( 723, 'WYLDAN ARIF PRAMONO',  7, '081111111723', 'L'),
( 801, 'ARINA FEBRIANA SULASTRI',  8, '081111111801', 'P'),
( 802, 'ARYA FENDI ANDIKA',  8, '081111111802', 'L'),
( 803, 'AZKA ZAENU RIFKI',  8, '081111111803', 'L'),
( 804, 'BILI BARA SAPUTRA',  8, '081111111804', 'L'),
( 805, 'CITRA AMELIA',  8, '081111111805', 'P'),
( 806, 'FAJAR ASHIDIK',  8, '081111111806', 'L'),
( 807, 'FAJRIATUS SOLEHAH',  8, '081111111807', 'P'),
( 808, 'FANREZA ANDIKA PUTRA',  8, '081111111808', 'L'),
( 809, 'FEBRI MAULANA',  8, '081111111809', 'L'),
( 810, 'FELLA MILKHATUN NAILA',  8, '081111111810', 'P'),
( 811, 'FITRI NUR AINI',  8, '081111111811', 'P'),
( 812, 'GISELL PUTRI SETIAWAN',  8, '081111111812', 'P'),
( 813, 'IRMA RIZQI FATMALA',  8, '081111111813', 'P'),
( 814, 'MELFI SYAHRIN AULIA',  8, '081111111814', 'P'),
( 815, 'MUHAMAD FADIL AL FAQIH',  8, '081111111815', 'L'),
( 816, 'MUTHI KHOIRIN NADA',  8, '081111111816', 'P'),
( 817, 'NUROHMAN',  8, '081111111817', 'L'),
( 818, 'RASTY NUR AISYAH',  8, '081111111818', 'P'),
( 819, 'RESTY NUR AINI',  8, '081111111819', 'P'),
( 820, 'REVI AGUSTINA',  8, '081111111820', 'P'),
( 821, 'RIZKI RAMADHAN',  8, '081111111821', 'L'),
( 822, 'SILFI DWI AFIFAH',  8, '081111111822', 'P'),
( 823, 'WAHYUNI ALVI KANIYA',  8, '081111111823', 'P'),
( 824, 'WULAN SRI HARYATI',  8, '081111111824', 'P'),
( 825, 'YENI OKTAVIA',  8, '081111111825', 'P'),
( 901, 'ABDUL AZIZ PRATAMA',  9, '081111111901', 'L'),
( 902, 'AIDA ROHMAWATI',  9, '081111111902', 'P'),
( 903, 'ALIF FADHIL MUZAKI',  9, '081111111903', 'L'),
( 904, 'ANDINI CAHYANINGSIH',  9, '081111111904', 'P'),
( 905, 'ANGGITA PUTRI AMELIA',  9, '081111111905', 'P'),
( 906, 'FALDI JUNIAR',  9, '081111111906', 'L'),
( 907, 'IBNU HAIZUL FADLI',  9, '081111111907', 'L'),
( 908, 'LUNA FATYA SABRINA',  9, '081111111908', 'P'),
( 909, 'MADIH ASSOFARI',  9, '081111111909', 'L'),
( 910, 'MUHAMAD SAUQIL HUDA',  9, '081111111910', 'L'),
( 911, 'MUHAMMAD DARSIMAN',  9, '081111111911', 'L'),
( 912, 'MUHAMMAD RENDRA H',  9, '081111111912', 'L'),
( 913, 'NUR DIANA',  9, '081111111913', 'P'),
( 914, 'QIYAN ARDIANSYAH',  9, '081111111914', 'L'),
( 915, 'WARID NUR HAMZAH',  9, '081111111915', 'L'),
( 916, 'WITA FITRIYANI',  9, '081111111916', 'P'),
( 826, 'RAFAEL SETIAWAN',  8, '081111111826', 'L'),
( 827, 'WAHYU DIKA PRATAMA',  8, '081111111827', 'L');
;

INSERT INTO "rekening" ( "nama_sekolah" ) VALUES
( 'SMP MAARIF NU 01 WANAREJA');