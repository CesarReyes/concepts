-- 2. Lista de alumnos del curso “programación”
SELECT a.*
FROM curso c, alumno_curso ac ,alumno a
WHERE
	c.nombre like '%programacion%'
    AND c.id=ac.curso_id
    AND ac.alumno_id=a.id
ORDER BY a.nombre

-- 3. Calcula el promedio de un alumno en un cruso Ej: Curso 1 alumno 1
SELECT
	(SELECT sum(n.valor)
FROM prueba p, nota n
WHERE
	p.curso_id=1
    AND n.prueba_id=p.id
    AND n.alumno_id=1) / 
    (SELECT count(n.valor)
FROM prueba p, nota n
WHERE
	p.curso_id=1
    AND n.prueba_id=p.id
    AND n.alumno_id=1)
AS promedio


-- 4.Entregua a los alumnos y el promedio que tiene en cada ramo.
SELECT 
	c.nombre,
    a.nombre,
    ( (SELECT sum(n.valor)
		FROM prueba p, nota n
		WHERE
			p.curso_id=c.id
			AND n.prueba_id=p.id
			AND n.alumno_id=a.id)
            / 
			(SELECT count(n.valor)
		FROM prueba p, nota n
		WHERE
			p.curso_id=c.id
			AND n.prueba_id=p.id
			AND n.alumno_id=a.id)    
    ) AS promedio
FROM curso c, alumno_curso ac ,alumno a
WHERE
	c.id=ac.curso_id
    AND ac.alumno_id=a.id
ORDER BY c.nombre,a.nombre


-- 5. Lista a todos los alumnos con más de un ramo con
promedio rojo.
SELECT 
	d.nombre,
	d.rojo
FROM (SELECT 
    a.nombre,
    count(a.nombre) AS rojo
FROM curso c, alumno_curso ac ,alumno a
WHERE
	c.id=ac.curso_id
    AND ac.alumno_id=a.id
    AND
    ( (SELECT sum(n.valor)
		FROM prueba p, nota n
		WHERE
			p.curso_id=c.id
			AND n.prueba_id=p.id
			AND n.alumno_id=a.id)
            / 
			(SELECT count(n.valor)
		FROM prueba p, nota n
		WHERE
			p.curso_id=c.id
			AND n.prueba_id=p.id
			AND n.alumno_id=a.id)    
    ) <= 3.9
GROUP BY a.nombre
ORDER BY a.nombre) d
WHERE d.rojo >= 2

-- 6. jugadores de tenis: Respuesta -> d) imposible saberlo 
