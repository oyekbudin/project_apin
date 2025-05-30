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

INSERT INTO siswa (name, nis, phonenumber, gender, kelas) VALUES 
    ('ALIYA QURROTUNNADA','701','087234567701','P','7'),
    ('ARSHILLA NATASYA RIFKY','702','087234567702','P','7'),
    ('BEKTI FIRMAN HAKIM','703','087234567703','L','7'),
    ('DEA EINJELLIA','704','087234567704','P','7'),
    ('ESA GALIH SATRIADI','705','087234567705','L','7'),
    ('KEYZHA FITRI MAHARRANI','706','087234567706','P','7'),
    ('KHOLIYAH NUR AISYAH','707','087234567707','P','7'),
    ('LINDA WIDYANA ARUM','708','087234567708','P','7'),
    ('LUKMAN HERYANA','709','087234567709','L','7'),
    ('MULYANA','710','087234567710','L','7'),
    ('MUTIARA NUR AZIZAH','711','087234567711','P','7'),
    ('NUR AZIZAH','712','087234567712','P','7'),
    ('NURCAHAYA SETIAWATI','713','087234567713','P','7'),
    ('NURUL AZIZAH PRIHATIN','714','087234567714','P','7'),
    ('RAFFI AHMAD FIRMANSYAH','715','087234567715','L','7'),
    ('RAISA DEA ANGGRAENI','716','087234567716','P','7'),
    ('RIFQI SIDIK MAULANA','717','087234567717','L','7'),
    ('RIVDA MUKARROMAH','719','087234567719','P','7'),
    ('RIZKI','718','087234567718','L','7'),
    ('SAFIRA LAILATUL JANNAH','720','087234567720','P','7'),
    ('SITI MAYSAROH','721','087234567721','P','7'),
    ('SYARIF HIDAYAT','722','087234567722','L','7'),
    ('WYLDAN ARIF PRAMONO','723','087234567723','L','7'),
    ('ARINA FEBRIANA SULASTRI','801','088234567801','P','8'),
    ('ARYA FENDI ANDIKA','802','088234567802','L','8'),
    ('AZKA ZAENU RIFKI','803','088234567803','L','8'),
    ('BILI BARA SAPUTRA','804','088234567804','L','8'),
    ('CITRA AMELIA','805','088234567805','P','8'),
    ('FAJAR ASHIDIK','806','088234567806','L','8'),
    ('FAJRIATUS SOLEHAH','807','088234567807','P','8'),
    ('FANREZA ANDIKA PUTRA','808','088234567808','L','8'),
    ('FEBRI MAULANA','809','088234567809','L','8'),
    ('FELLA MILKHATUN NAILA','810','088234567810','P','8'),
    ('FITRI NUR AINI','811','088234567811','P','8'),
    ('GISELL PUTRI SETIAWAN','812','088234567812','P','8'),
    ('IRMA RIZQI FATMALA','813','088234567813','P','8'),
    ('MELFI SYAHRIN AULIA','814','088234567814','P','8'),
    ('MUHAMAD FADIL AL FAQIH','815','088234567815','L','8'),
    ('MUTHI KHOIRIN NADA','816','088234567816','P','8'),
    ('NUROHMAN','817','088234567817','L','8'),
    ('RAFAEL SETIAWAN','826','088234567826','L','8'),
    ('RASTY NUR AISYAH','818','088234567818','P','8'),
    ('RESTY NUR AINI','819','088234567819','P','8'),
    ('REVI AGUSTINA','820','088234567820','P','8'),
    ('RIZKI RAMADHAN','821','088234567821','L','8'),
    ('SILFI DWI AFIFAH','822','088234567822','P','8'),
    ('WAHYU DIKA PRATAMA','827','088234567827','L','8'),
    ('WAHYUNI ALVI KANIYA','823','088234567823','P','8'),
    ('WULAN SRI HARYATI','824','088234567824','P','8'),
    ('YENI OKTAVIA','825','088234567825','P','8'),
    ('ABDUL AZIZ PRATAMA','901','089234567901','L','9'),
    ('AIDA ROHMAWATI','902','089234567902','P','9'),
    ('ALIF FADHIL MUZAKI','903','089234567903','L','9'),
    ('ANDINI CAHYANINGSIH','904','089234567904','P','9'),
    ('ANGGITA PUTRI AMELIA','905','089234567905','P','9'),
    ('FALDI JUNIAR','906','089234567906','L','9'),
    ('IBNU HAIZUL FADLI','907','089234567907','L','9'),
    ('LUNA FATYA SABRINA','908','089234567908','P','9'),
    ('MADIH ASSOFARI','909','089234567909','L','9'),
    ('MUHAMAD SAUQIL HUDA','910','089234567910','L','9'),
    ('MUHAMMAD DARSIMAN','911','089234567911','L','9'),
    ('MUHAMMAD RENDRA H','912','089234567912','L','9'),
    ('NUR DIANA','913','089234567913','P','9'),
    ('QIYAN ARDIANSYAH','914','089234567914','L','9'),
    ('WARID NUR HAMZAH','915','089234567915','L','9'),
    ('WITA FITRIYANI','916','089234567916','P','9');

INSERT INTO infaq (name, kelas, harga) VALUES
    ('SOT Juli','789','45000'),
    ('SOT Agustus','789','45000'),
    ('SOT September','789','45000'),
    ('SOT Oktober','789','45000'),
    ('SOT November','789','45000'),
    ('SOT Desember','789','45000'),
    ('SOT Januari','789','45000'),
    ('SOT Februari','789','45000'),
    ('SOT Maret','789','45000'),
    ('SOT April','789','45000'),
    ('SOT Mei','789','45000'),
    ('SOT Juni','789','45000'),
    ('ASTS 1','789','50000'),
    ('ASAS 1','789','50000'),
    ('ASTS 2','780','50000'),
    ('ASAT Genap','789','50000'),
    ('Sarpras 1','789','100000'),
    ('Sarpras 2','789','100000'),
    ('Kegiatan 1','789','50000'),
    ('Kegiatan 2','789','50000'),
    ('Atribut','700','80000'),
    ('Raport','700','40000'),
    ('ANBK','800','200000'),
    ('ASAJ','900','553000');

INSERT INTO pembayaran (idsiswa, idinfaq, nominal) VALUES
('901','1','45000'),
('901','2','45000'),
('901','3','45000'),
('901','13','50000'),
('902','1','45000'),
('902','2','45000'),
('902','3','45000'),
('902','4','45000'),
('902','5','45000'),
('902','6','45000'),
('902','7','45000'),
('902','8','45000'),
('902','9','45000'),
('902','10','45000'),
('902','11','45000'),
('902','12','45000'),
('903','1','45000'),
('903','2','45000'),
('903','3','45000'),
('903','4','45000'),
('903','5','45000'),
('903','6','45000'),
('903','13','50000'),
('906','13','50000'),
('906','14','50000'),
('906','16','50000'),
('906','17','100000'),
('906','19','5000'),
('909','1','45000'),
('909','2','45000'),
('909','3','45000'),
('909','4','45000'),
('909','13','50000'),
('909','14','50000'),
('909','17','100000'),
('910','13','50000'),
('911','1','45000'),
('911','2','45000'),
('911','3','45000'),
('911','4','45000'),
('911','5','45000'),
('911','6','45000'),
('911','7','45000'),
('911','8','45000'),
('911','9','45000'),
('911','10','45000'),
('911','11','45000'),
('911','12','45000'),
('914','1','45000'),
('914','13','50000'),
('914','14','5000'),
('916','13','50000'),
('801','13','50000'),
('801','14','50000'),
('801','17','5000'),
('801','23','200000'),
('803','13','50000'),
('805','13','50000'),
('806','1','45000'),
('806','2','45000'),
('806','3','45000'),
('806','4','45000'),
('806','5','45000'),
('806','6','45000'),
('806','7','45000'),
('806','8','45000'),
('806','9','45000'),
('806','10','45000'),
('806','11','45000'),
('806','12','45000'),
('806','13','50000'),
('806','14','50000'),
('806','17','100000'),
('806','19','50000'),
('807','13','50000'),
('807','14','50000'),
('807','17','100000'),
('807','19','50000'),
('809','1','45000'),
('809','2','45000'),
('809','3','45000'),
('809','4','45000'),
('809','13','50000'),
('809','14','50000'),
('809','23','20000'),
('810','1','45000'),
('810','2','45000'),
('810','3','45000'),
('810','4','45000'),
('810','5','45000'),
('810','6','45000'),
('810','7','45000'),
('810','8','45000'),
('810','9','45000'),
('810','10','45000'),
('810','11','45000'),
('810','12','45000'),
('810','13','50000'),
('810','14','50000'),
('810','15','50000'),
('810','16','50000'),
('810','17','100000'),
('810','18','100000'),
('810','19','50000'),
('810','20','50000'),
('810','23','200000'),
('811','13','50000'),
('813','13','50000'),
('814','13','50000'),
('815','13','50000'),
('815','14','20000'),
('816','1','45000'),
('816','2','45000'),
('816','3','45000'),
('816','4','45000'),
('816','5','45000'),
('816','6','45000'),
('816','7','45000'),
('816','8','45000'),
('816','9','45000'),
('816','10','45000'),
('816','11','45000'),
('816','12','45000'),
('816','13','50000'),
('816','14','50000'),
('816','15','50000'),
('816','17','100000'),
('816','23','200000'),
('818','1','45000'),
('818','2','45000'),
('818','3','45000'),
('818','4','45000'),
('818','5','45000'),
('818','6','45000'),
('819','7','45000'),
('819','8','45000'),
('819','9','45000'),
('819','10','45000'),
('819','11','45000'),
('819','12','45000'),
('819','13','50000'),
('819','14','50000'),
('819','17','100000'),
('819','23','120000'),
('821','13','50000'),
('822','13','50000'),
('823','1','45000'),
('823','2','45000'),
('823','13','50000'),
('823','14','10000'),
('824','1','45000'),
('824','2','45000'),
('824','3','45000'),
('824','4','45000'),
('824','5','45000'),
('824','6','45000'),
('824','7','45000'),
('824','8','45000'),
('824','9','45000'),
('824','10','45000'),
('824','11','45000'),
('824','12','45000'),
('825','1','45000'),
('825','2','45000'),
('825','3','45000'),
('825','4','45000'),
('825','5','45000'),
('825','6','45000'),
('825','13','50000'),
('825','14','50000'),
('825','17','100000'),
('825','19','50000'),
('825','23','20000'),
('701','13','50000'),
('702','13','50000'),
('703','13','50000'),
('704','13','50000'),
('705','1','45000'),
('705','2','45000'),
('705','3','45000'),
('705','4','45000'),
('705','5','45000'),
('705','6','45000'),
('705','7','45000'),
('705','8','45000'),
('705','9','45000'),
('705','10','45000'),
('705','11','45000'),
('705','12','45000'),
('705','13','50000'),
('705','14','50000'),
('705','15','50000'),
('705','16','50000'),
('705','17','100000'),
('705','18','100000'),
('705','19','50000'),
('705','20','50000'),
('705','21','80000'),
('705','22','40000'),
('706','13','50000'),
('707','13','50000'),
('708','13','50000'),
('709','13','50000'),
('709','1','45000'),
('709','2','45000'),
('709','3','45000'),
('709','4','45000'),
('709','5','45000'),
('709','6','45000'),
('709','7','45000'),
('709','8','45000'),
('709','9','45000'),
('709','10','45000'),
('709','11','45000'),
('709','12','45000'),
('710','13','50000'),
('711','13','50000'),
('712','13','50000'),
('713','13','50000'),
('714','13','50000'),
('715','13','50000'),
('716','13','50000'),
('717','13','50000'),
('718','13','50000'),
('719','13','50000'),
('719','14','50000'),
('719','17','100000'),
('720','13','50000'),
('720','1','45000'),
('720','2','45000'),
('720','3','45000'),
('720','4','45000'),
('720','5','45000'),
('720','6','45000'),
('720','7','45000'),
('720','8','45000'),
('720','9','45000'),
('720','10','45000'),
('720','11','45000'),
('720','12','45000'),
('721','13','50000'),
('722','13','50000'),
('719','19','50000'),
('719','21','80000'),
('719','22','40000'),
('719','15','30000'),
('701','1','45000'),
('701','2','45000'),
('701','3','45000'),
('701','4','45000'),
('701','5','45000'),
('701','6','45000'),
('701','14','50000'),
('701','19','50000'),
('701','17','100000'),
('701','21','80000'),
('702','14','50000'),
('702','15','50000'),
('702','17','100000'),
('702','18','100000'),
('702','19','50000'),
('702','20','50000'),
('702','16','50000'),
('702','21','80000'),
('702','22','20000'),
('810','1','45000'),
('810','2','45000'),
('810','3','45000'),
('810','13','35000'),
('811','14','50000'),
('811','1','45000'),
('811','2','45000'),
('811','3','45000'),
('811','4','45000'),
('811','5','45000'),
('811','6','45000'),
('811','17','30000'),
('811','23','200000'),
('818','13','50000'),
('818','14','50000'),
('818','15','50000'),
('818','17','100000'),
('818','18','10000'),
('818','19','50000'),
('824','13','50000'),
('824','14','50000'),
('824','15','50000'),
('824','17','100000'),
('824','18','10000'),
('824','19','50000'),
('823','14','40000'),
('823','19','50000'),
('823','17','10000'),
('721','1','45000'),
('721','14','50000'),
('721','17','5000'),
('916','14','50000'),
('714','1','45000'),
('714','2','45000'),
('714','3','45000'),
('714','14','50000'),
('714','17','15000'),
('718','14','50000'),
('817','1','45000'),
('817','2','45000'),
('817','13','50000'),
('817','14','50000'),
('817','17','98000'),
('713','14','50000'),
('702','22','20000'),
('717','1','45000'),
('717','2','45000'),
('717','3','45000'),
('717','4','45000'),
('722','14','50000'),
('709','14','50000'),
('709','17','100000'),
('709','19','50000'),
('709','21','80000'),
('709','22','40000'),
('803','1','45000'),
('803','2','45000'),
('803','3','45000'),
('803','4','45000'),
('803','5','45000'),
('803','6','45000'),
('803','14','50000'),
('803','17','100000'),
('803','19','50000'),
('803','23','200000'),
('715','14','50000'),
('715','19','50000'),
('704','1','45000'),
('704','2','45000'),
('704','3','45000'),
('704','14','50000'),
('704','19','50000'),
('704','17','15000'),
('904','1','45000'),
('904','13','50000'),
('904','14','50000'),
('904','17','17000'),
('822','1','45000'),
('822','2','45000'),
('822','3','45000'),
('822','4','45000'),
('822','5','45000'),
('822','6','45000'),
('822','14','50000'),
('822','17','100000'),
('822','19','50000'),
('822','23','200000'),
('710','14','50000'),
('710','1','45000'),
('710','2','45000'),
('710','3','45000'),
('710','19','50000'),
('710','17','3000'),
('722','1','45000'),
('722','2','45000'),
('722','3','45000'),
('722','4','45000'),
('722','5','45000'),
('722','6','45000'),
('722','21','80000'),
('722','22','40000'),
('721','2','45000'),
('909','5','45000'),
('909','6','45000'),
('909','19','50000'),
('909','16','50000'),
('719','15','20000'),
('719','16','50000'),
('719','18','30000'),
('807','1','45000'),
('807','2','45000'),
('807','3','45000'),
('807','23','5000'),
('713','1','45000'),
('713','2','45000'),
('903','14','50000'),
('903','17','100000'),
('903','19','50000'),
('913','13','50000'),
('913','14','50000'),
('913','17','100000'),
('913','19','50000'),
('913','1','45000'),
('913','2','45000'),
('913','3','45000'),
('913','4','45000'),
('720','14','26000'),
('714','17','85000'),
('714','19','50000'),
('714','22','40000'),
('714','21','3000'),
('711','14','50000'),
('711','22','40000'),
('711','17','14500'),
('805','23','200000'),
('805','1','45000'),
('805','2','45000'),
('805','3','45000'),
('805','4','45000'),
('805','5','45000'),
('805','6','45000'),
('805','14','50000'),
('805','19','50000'),
('805','17','30000'),
('701','7','45000'),
('701','8','45000'),
('701','9','45000'),
('701','22','40000'),
('701','18','25000'),
('812','23','172000'),
('808','23','156000'),
('714','21','77000'),
('714','4','45000'),
('714','5','45000'),
('714','18','33000'),
('710','4','45000'),
('710','5','45000'),
('710','6','45000'),
('710','21','80000'),
('710','22','40000'),
('710','17','45000'),
('715','22','40000'),
('715','18','100000'),
('908','13','50000'),
('908','17','44000'),
('716','1','45000'),
('716','2','45000'),
('716','3','45000'),
('716','14','50000'),
('716','17','25000'),
('719','18','70000'),
('719','20','50000'),
('719','13','50000'),
('719','14','50000'),
('719','19','50000'),
('719','17','40000'),
('707','1','45000'),
('707','2','45000'),
('707','3','45000'),
('707','17','100000'),
('707','21','25000'),
('707','14','50000'),
('817','3','45000'),
('817','4','45000'),
('817','15','8000'),
('817','17','2000'),
('817','23','200000'),
('817','19','50000'),
('712','1','45000'),
('712','2','45000'),
('712','3','45000'),
('712','14','25000'),
('708','1','45000'),
('708','2','45000'),
('708','3','45000'),
('708','14','50000'),
('708','17','15000'),
('713','3','45000'),
('713','4','45000'),
('713','5','45000'),
('713','6','45000'),
('713','17','80000'),
('713','19','50000'),
('722','17','100000'),
('722','19','50000'),
('722','7','45000'),
('722','18','15000'),
('818','18','90000'),
('818','20','50000'),
('818','23','200000'),
('818','16','20000'),
('818','7','45000'),
('818','8','45000'),
('704','4','45000'),
('704','5','45000'),
('704','6','45000'),
('704','17','35000'),
('704','22','40000'),
('711','1','45000'),
('711','2','45000'),
('711','3','45000'),
('711','17','85500'),
('711','21','80000'),
('711','19','14500'),
('720','14','24000'),
('720','17','100000'),
('720','19','50000'),
('720','21','80000'),
('720','22','40000'),
('720','18','21000'),
('903','16','50000'),
('719','1','45000'),
('719','2','45000'),
('719','3','45000'),
('719','4','45000'),
('719','5','45000'),
('719','6','45000'),
('813','1','45000'),
('813','2','45000'),
('813','3','45000'),
('813','4','45000'),
('813','5','45000'),
('813','6','45000'),
('903','7','45000'),
('903','8','45000'),
('903','9','45000'),
('903','10','45000'),
('903','11','45000'),
('903','12','45000'),
('803','15','50000'),
('819','23','80000'),
('819','19','20000'),
('818','9','45000'),
('818','10','45000'),
('818','16','10000'),
('914','14','45000'),
('914','2','45000'),
('914','3','45000'),
('914','4','45000'),
('914','17','20000'),
('916','1','45000'),
('916','2','45000'),
('916','17','10000'),
('909','18','100000'),
('909','7','45000'),
('909','20','5000'),
('703','1','45000'),
('703','2','45000'),
('703','14','10000'),
('916','3','45000'),
('916','4','45000'),
('916','17','90000'),
('916','16','20000'),
('826','1','45000'),
('826','2','45000'),
('826','3','45000'),
('826','4','45000'),
('826','5','45000'),
('826','6','45000'),
('826','13','50000'),
('826','14','50000'),
('826','17','100000'),
('826','19','50000'),
('826','23','200000'),
('827','1','45000'),
('827','2','45000'),
('827','3','45000'),
('827','4','45000'),
('827','5','45000'),
('827','6','45000'),
('827','13','50000'),
('827','14','50000'),
('827','17','100000'),
('827','19','50000'),
('827','23','200000'),
('826','7','45000'),
('826','8','45000'),
('826','9','45000'),
('826','10','45000'),
('826','11','45000'),
('826','12','45000'),
('713','7','45000'),
('713','8','45000'),
('713','15','45000'),
('916','5','45000'),
('916','6','45000'),
('916','7','45000'),
('916','19','35000'),
('916','16','30000'),
('714','15','50000'),
('714','6','45000'),
('714','7','45000'),
('714','18','10000'),
('722','8','45000'),
('809','17','100000'),
('809','19','50000'),
('809','23','180000'),
('809','6','45000'),
('809','5','45000');


