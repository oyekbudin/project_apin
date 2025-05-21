CREATE TABLE log_error_pembayaran (
    id SERIAL PRIMARY KEY,
    order_id VARCHAR(100),
    status_message TEXT,
    status_code VARCHAR(10),
    transaction_status VARCHAR(50),
    payment_type VARCHAR(50),
    raw_response TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);