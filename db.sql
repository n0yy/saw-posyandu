CREATE DATABASE IF NOT EXISTS spk_posyandu;
USE spk_posyandu;

CREATE TABLE makanan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  kalori FLOAT,
  protein FLOAT,
  lemak FLOAT,
  zat_besi FLOAT,
  zinc FLOAT,
  biaya INT
);

CREATE TABLE kriteria (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(50),
  atribut ENUM('benefit','cost'),
  bobot FLOAT
);

CREATE TABLE penilaian (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_makanan INT,
  id_kriteria INT,
  nilai FLOAT,
  FOREIGN KEY (id_makanan) REFERENCES makanan(id),
  FOREIGN KEY (id_kriteria) REFERENCES kriteria(id)
);

-- nilai default untuk penilaian
INSERT INTO kriteria (nama, atribut, bobot) VALUES
  ('kalori', 'benefit', 0.2),
  ('protein', 'benefit', 0.2),
  ('lemak', 'benefit', 0.1),
  ('zat_besi', 'benefit', 0.15),
  ('zinc', 'benefit', 0.15),
  ('biaya', 'cost', 0.2);

-- Contoh data makanan
INSERT INTO makanan (nama, kalori, protein, lemak, zat_besi, zinc, biaya) VALUES
('Bubur Ayam Wortel',       120, 4.2, 2.5, 1.2, 0.6, 3500),
('Nasi Tim Daging Cincang', 160, 6.8, 4.0, 1.8, 1.1, 5000),
('Puree Kentang Keju',      110, 3.5, 3.2, 0.9, 0.5, 4000),
('Bubur Kacang Hijau',      150, 5.0, 2.0, 2.5, 1.3, 3000),
('Sup Sayur Tahu Ayam',     130, 5.6, 3.0, 1.0, 0.9, 4500);
