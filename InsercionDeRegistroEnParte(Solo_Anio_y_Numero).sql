INSERT INTO partetrabajo (anio, numeroParte) 
VALUES (YEAR(NOW()), 
        (SELECT IFNULL(MAX(numeroParte), 0) + 1 
         FROM partetrabajo 
         WHERE anio = YEAR(NOW())));
