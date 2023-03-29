INSERT INTO partetrabajo (
    anio, 
    numeroParte, 
    cliente, 
    tipo, 
    fechaEntrada, 
    tecnico, 
    intervencion, 
    marca, 
    modelo, 
    numeroSerie, 
    horas, 
    estado
) 
SELECT 
    YEAR(NOW()), 
    IFNULL(MAX(numeroParte), 0) + 1, 
    'cliente1', 
    'tipo1', 
    NOW(), 
    'tecnico1', 
    'intervencion1', 
    'marca1', 
    'modelo1', 
    123214, 
    2, 
    'ENT'
FROM partetrabajo 
WHERE anio = YEAR(NOW());
