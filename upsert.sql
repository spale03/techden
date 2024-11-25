/* UPSERT */
INSERT into racunari (naziv,cena,slika,broj_pregleda,broj_kupovina)
VALUES (:naziv,:cena,:slika,:broj_pregleda,:broj_kupovina)
ON DUPLICATE KEY UPDATE cena = :cena, slika = :slika, broj_pregleda = :broj_pregleda, broj_kupovina = :broj_kupovina;