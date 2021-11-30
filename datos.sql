START TRANSACTION;
INSERT INTO categoria (id, nombre, descripcion) VALUES
(1, 'Ruta', 'Ciclismo de carretera'),
(2, 'MTB', 'Ciclismo de montaña, XC, XCO, XCM y DH'),
(3, 'Ciclocross', NULL),
(4, 'Team', 'Relacionado con todas las novedades y actividades del equipo NONINÁ TEAM');

INSERT INTO usuario (id, nombre, email, nick, password, roles) VALUES
(1, 'Juan José Guerra', 'japgrguez@gmail.com', 'jjguerra', '$2y$13$XqTPTX50SblaIx6UAiXMb.el/HuLB8elbOrWbrNMnkF7QY7cpjCZ2', '[\"ROLE_USER\"]'),
(2, 'José Miguel González Lozada', 'josgonloz@gmail.com', 'z3myY', '$2y$13$BxVBkaaHzC4Qjan3Nn7i5uiwuSL1nFgU4S63eSBQ.u7rI1mfdkrue', '[\"ROLE_ADMIN\"]');

INSERT INTO noticia (id, usuario_id, categoria_id, titular, entradilla, cuerpo, imagen, fecha) VALUES
(6, 2, 4, 'SIERRA DE HORNACHUELOS-SIERRA NORTE', 'Difícil, pero no imposible, prácticamente todo el equipo disfrutando por la sierra de hornachuelos', '<p>Gran quedada del equipo. Es complicado pero fuimos capaces de juntarnos prácticamente todos los integrantes del equipo para disfrutar por la sierra de Hornachuelos.</p>\n\n        <p>Combinación perfecta para que nuestros chavales disfruten al máximo. El Noniná resucita de nuevo ✊🏻✊🏻 🌳☀️🏞️🚴</p>', 'noticia6.jpg', '2021-11-30 13:20:20'),
(7, 2, 4, 'Andalucía Bike Race', 'Participación de Mario y Álvaro en la prueba de 6 etapas Andaluza', '<p>Nuestros amigos Mario y Álvaro participaron en la gran prueba por etapas de nuestra tierra.</p>\n\n        <p>Donde Álvaro desgraciadamente sufrió una caída el penúltimo día en la etapa reina que no le permitió acaba esa etapa y por lo tanto la carrera completa. Pero seguro que volverá a ella para ser finisher.</p>\n        \n        <p>Etapas muy duras pero que no pararon de disfrutar en todo momento, Una experiencia maravillosa por lo que nos contaron. </p>', 'noticia7.jpg', '2021-11-30 13:20:20');

COMMIT;
