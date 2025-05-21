DROP TABLE IF EXISTS "pesanwa";
CREATE TABLE pesanwa (
    id SERIAL PRIMARY KEY,
    nomor_penerima VARCHAR(20) NOT NULL,
    nama_penerima VARCHAR(100),
    pesan TEXT NOT NULL,
    status VARCHAR(20),
    response_json JSONB,
    waktu_kirim TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);