UPDATE partetrabajo 
SET 
    cliente = 'cliente2', 
    tipo = 'tipo1', 
    fechaEntrada = NOW(), 
    tecnico = 'tecnico1', 
    intervencion = 'intervencion1', 
    marca = 'marca1', 
    modelo = 'modelo1', 
    numeroSerie = 123214, 
    horas = 2, 
    estado = 'ENT'
WHERE 
    idParteTrabajo = 6;
