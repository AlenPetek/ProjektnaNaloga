
-- POIZVEDBE:

USE projekt;
 SET SQL_SAFE_UPDATES = 0;

DELETE FROM priča;
DELETE FROM krožišče;
DELETE FROM cesta;
DELETE FROM žival;
DELETE FROM zgradba;
DELETE FROM lokacija;


INSERT INTO lokacija (idLokacija, ime, koordinati_od, koordinati_do)
VALUES (0789, 'Koroška cesta', '46.557585, 15.641716','46.557717, 15.644435'),
 (0790, 'Trg Generala Maistra', '46.561255, 15.648162','46.562008, 15.648312'),
 (0791, 'Betnavski gozd', '46.530371, 15.644835','46.537892, 15.638455');

INSERT INTO zgradba (idZgradba, Lokacija_idLokacija,koordinati_od, koordinati_do,odprto_od, odprto_do, ime, 
funkcionalnost, višina, št_nadstropij)
VALUES (2219,0789, '46.557780, 15.643622','46.557925, 15.643829','00:00:00','24:59:59', 'Koroška 15',
'Navadno bivališče', NULL,NULL),
 (2220,0791, '46.53720801332717, 15.637643209722697','46.53747766785112, 15.63749451736218','7:00:00','19:30:00', 'Dogoska 29',
'Bar', NULL,NULL),
 (2221,0791, '46.51905665229316, 15.675654283808024','46.519521757529546, 15.676593056924226','8:00:00','12:00:00', 'Zavetišče za živali Maribor',
'Zavetišče za živali',NULL,NULL);


INSERT INTO žival (idŽival, ime, starost, tel, opis, vrsta_živali,pasma, Zgradba_idZgradba)

VALUES (0001, 'Loki',NULL, 040298377,'Beli pudelj z rdečim ovratnikom','pes', 'pudelj',2219),
(0002, 'Mika',12, 040336121,'Rjava mačka z črnim  repom','mačka', 'evropska kratkodlaka',2219),
(0003, 'Taco',10, 040008341,'Rottweiler z modrim ovratnikom','pes', 'rottweiler',2221);


INSERT INTO priča (idPriča, Žival_idŽival,  Lokacija_idLokacija, datum, zap_št, koordinati)
VALUES (9000, 0001, 0790, '2019-12-05 13:45:00', 1, '46.561723, 15.648232'),
(9001, 0001, 0791, '2019-12-21 18:30:00', 2, '46.557823, 15.643024'),
(9003, 0002, 0791, '2020-1-14 20:21:00', 1, '46.534211, 15.640577'),
(9004, 0003, 0791, '2020-1-15 09:00:00', 1, '46.534576, 15.643624'),
(9002, 0001, 0789, '2019-12-25 19:21:00', 3, '46.557823, 15.643024'),
(9005, 0003, 0791, '2020-1-15 09:00:00', 2, '46.534074, 15.644600');

-- SELECT * FROM  lokacija;
-- SELECT * FROM  priča;
-- SELECT * FROM  zgradba;
-- SELECT * FROM  žival;

------------------------------------------------------------------------------------------------------
-- V katerem zavetišču se nahaja pes z imenom 'Taco'?
------------------------------------------------------------------------------------------------------

  SELECT  zgradba.ime FROM zgradba INNER JOIN žival  ON žival.Zgradba_idZgradba = zgradba.idZgradba 
  WHERE žival.ime='Taco' AND (funkcionalnost  LIKE '%Zavetišče%' OR  funkcionalnost LIKE  '%zavetišče%');

------------------------------------------------------------------------------------------------------
-- Kje je pes 'Loki' bil nazadnje viden ?
------------------------------------------------------------------------------------------------------

 SELECT lokacija.ime FROM priča  INNER JOIN  lokacija ON priča.Lokacija_idLokacija=lokacija.idLokacija
 INNER JOIN (SELECT   MAX(zap_št) as max ,Žival_idŽival as sub_idŽival FROM priča GROUP BY Žival_idŽival) as
 sub ON sub.sub_idŽival=priča.Žival_idŽival INNER JOIN žival ON žival.idŽival=priča.Žival_idŽival
 WHERE  (zap_št = max AND žival.ime= 'Loki');

------------------------------------------------------------------------------------------------------
-- Izpiši podatke psov, ki so pasme Rottweiler in imajo modri ovratnik 
------------------------------------------------------------------------------------------------------

SELECT * FROM žival WHERE pasma ='rottweiler' AND (opis LIKE '%modri%'AND opis LIKE '%ovratnik%' );


------------------------------------------------------------------------------------------------------
-- pes 'Taco' je bil najden, odstrani ga iz baze
------------------------------------------------------------------------------------------------------

DELETE FROM žival WHERE ime='Taco';

------------------------------------------------------------------------------------------------------
-- Izpiši zaporedje prič za pesa 'Loki' 
------------------------------------------------------------------------------------------------------

SELECT zap_št, lokacija.ime FROM žival INNER JOIN priča ON žival.idŽival=priča.Žival_idŽival 
INNER JOIN lokacija ON lokacija.idLokacija=priča.Lokacija_idLokacija
WHERE žival.ime='Loki' ORDER BY zap_št ASC;

