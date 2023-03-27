SELECT IFNULL(MAX(numeroParte), 0) + 1 AS siguiente_numero
FROM parteTrabajo
WHERE anio = YEAR(NOW());
