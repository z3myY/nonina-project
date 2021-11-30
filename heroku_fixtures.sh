 php bin/console d:query:sql "INSERT INTO categoria (id, nombre, descripcion) VALUES \
(1, 'Ruta', 'Ciclismo de carretera'),\
(2, 'MTB', 'Ciclismo de montaña, XC, XCO, XCM y DH'),\
(3, 'Ciclocross', NULL),\
(4, 'Team', 'Relacionado con todas las novedades y actividades del equipo NONINÁ TEAM');"

#password Josgonloz1_
 php bin/console d:query:sql "INSERT INTO usuario (id, nombre, nick, email, password, roles) VALUES \
(nextval('usuario_id_seq'), 'admin', 'admin01', 'josgonloz@gmail.com', '\$2y\$13\$5te3clOSipWLW1PEBCQuv.GJxJIPBqUDQQmj5hET11TWbHSdI8Zqq', '[\"ROLE_ADMIN\"]');"
