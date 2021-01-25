-- The table is added to the MYSQL_DATABASE db
CREATE TABLE IF NOT EXISTS music(
    id INT AUTO_INCREMENT PRIMARY KEY,
    ipadress VARCHAR(255) NOT NULL,
    counter INT NOT NULL
);
