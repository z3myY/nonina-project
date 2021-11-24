<?php

namespace App\DataFixtures;

use App\Entity\Noticia;
use App\Entity\Usuario;
use App\Entity\Categoria;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * Con el siguiente método lo que haremos es introducir 3 noticias y 2 usuarios, uno con el 
     * roll de administrador [ROLE_ADMIN] y otro con usuario normal [ROLE_USER]
     */
    public function load(ObjectManager $manager)
    {

        // Usuarios
        $usuario = new Usuario();
        $usuario->setNombre("Juan José Guerra");
        $usuario->setNick("jjguerra");
        $usuario->setEmail("japgrguez@gmail.com");
        $usuario->setPassword($this->passwordEncoder->encodePassword(
            $usuario,
            'jjGC1_'
        ));
        $usuario->setRoles(array("ROLE_USER"));
        $manager->persist($usuario);



        $usuario = new Usuario();
        $usuario->setNombre("José Miguel González Lozada");
        $usuario->setNick("z3myY");
        $usuario->setEmail("josgonloz@gmail.com");
        $usuario->setPassword($this->passwordEncoder->encodePassword(
            $usuario,
            'Nonina6_'
        ));
        // Damos el rol de administrador (ROLE_ADMIN) para este usuario
        $usuario->setRoles(array("ROLE_ADMIN"));
        $manager->persist($usuario);

        /**
         * Introducimos en la tabla Categoria, todas las categorias que tendremos para este proyecto,
         * no añadiremos por ahora nada para modificar o añadir categorías, será algo que quizas se haga
         * en un futuro para la gestión de estas.
         */

        // Categorias
        $categoria1 = new Categoria();
        $categoria1->setNombre("Ruta");
        $categoria1->setDescripcion("Ciclismo de carretera");
        $manager->persist($categoria1);

        $categoria2 = new Categoria();
        $categoria2->setNombre("MTB");
        $categoria2->setDescripcion("Ciclismo de montaña, XC, XCO, XCM y DH");
        $manager->persist($categoria2);

        $categoria = new Categoria();
        $categoria->setNombre("Ciclocross");
        $manager->persist($categoria);

        $categoria = new Categoria();
        $categoria->setNombre("Team");
        $categoria->setDescripcion("Relacionado con todas las novedades y actividades del equipo NONINÁ TEAM");
        $manager->persist($categoria);



        // Noticias 
        $noticia = new Noticia();
        $noticia->setUsuario($usuario);
        $noticia->setTitular("Un Giro de Italia como lo de siempre");
        $noticia->setEntradilla("Así será la 'Corsa Rosa' de 2022: Mortirolo, Pordio y Marmolada serán los platos fuertes de una ronda que finalizará en Verona con crono individual.");
        $noticia->setCuerpo("<p>La 105º edición del Giro de Italia terminó de dar a conocer su recorrido al desvelar que la última etapa será una contrarreloj individual de 17 km que tendrá la meta en el anfiteatro romano de Verona, con un trazado idéntico al de la edición de 2019 que ganó Richard Carapaz.</p><p>Este Giro 2022, que se ha ido desvelando por partes, tendrá seis etapas de montaña, cuatro de ellas con final en alto, seis de media montaña, siete propicias para los velocistas y dos cronos individuales.</p><p>La montaña será clave en la disputa por la maglia rosa. El Mortirolo, Blochkaus y las cimas del Passo Pordoi y Fedaia marcarán las diferencias en la general. En la cuarta jornada el pelotón deberá afrontar la llegada a la cima del Etna, en Sicilia, al final de una etapa de 166 km y 3.590 metros de desnivel.</p><p>Luego en la novena etapa volverá la lucha entre escaladores, ya que el Blockhaus decidirá entre los corredores tras haber cruzado Roccaraso y el Passo Lanciano. El tríptico de las etapas 15, 16 y 17 definirá la general con llegadas a Cogne, Aprica (tras el Mortirolo ) y Lavarone.</p><p>En la penúltima estación puede haber sorpresas con las subidas del Passo San Pellegrino, Passo Pordoi (2.239 metros sobre el nivel del mar, el punto más alto de esta edición) antes de llegar al Passo Fedaia. Todo debería decidirse en la montaña pero, si aún quedan dudas, la crono final de Verona encumbrará al nuevo ganador.</p><p>'Será un Giro durísimo', dice un Egan Bernal que, como confirmó a MARCA, no descarta presentearse en la Grande Partenza para intentar revalidar su reinado. López, Viviani, Nibali, Carapaz, Valter, Almeida, Ulissi y Colbrelli sí han confirmado su presencia. Será un Giro como los de siempre.</p>");
        $noticia->setCategoria($categoria1);
        $noticia->setFecha(new \DateTime());
        $noticia->setImagen("noticia1.jpg");
        $manager->persist($noticia);

        $noticia = new Noticia();
        $noticia->setUsuario($usuario);
        $noticia->setTitular("Chris Froome sufrió un brote de bilharzia en el pasado Tour de Francia");
        $noticia->setEntradilla("El ciclista argumentó sentirse muy cansado en plena ronda gala");
        $noticia->setCuerpo("<p>El británico Chris Froome (Israel Start Up Nation), cuatro veces ganador del Tour de Francia, sufrió un el pasado verano un brote de bilharzia, infección parasitaria producida por un gusano que ya padeció hace 10 años.</p><p>
        Froome, también ganador del Giro de Italia y doble vencedor de la Vuelta, se sintió especialmente cansado durante
        todo el Tour de Francia 2021, por lo que se sometió a una serie de pruebas para ver las causas.
        </p>
        
        <p>El equipo israelí confirmó a Velonews que Froome sufrió un nuevo episodio de la bilharzia, el mismo gusano parásito
            con el que se infectó hace 10 años.
        </p>
        
        <p>'Chris Froome tuvo algunos problemas médicos esta temporada, y estuvo completamente bloqueado durante el Tour de
            Francia, Para él fue el más difícil de todos los que ha hecho. Gastó enormes cantidades de energía, comentó Sylvan
            Adams, propietario del Israel Start-Up Nation.
        </p>
        
        <p>Froome admitió que fue diagnosticado y posteriormente tratado por el parásito, pero no quiso dar más detalles,
            sugiriendo que no quería parecer que estaba 'poniendo excusas' y dijo que fue tratado con éxito por los médicos del
            equipo.
        </p>
        
        <p>'Voy a competir durante algunos años. Me encanta correr y estoy motivado para seguir trabajando y seguir compitiendo.
            Tuve algunos problemas relacionados con mi recuperación, y creo que ya hemos resuelto la mayoría de ellos. Estoy
            emocionado para afrontar la temporada 2022', dijo.
        </p>
        
        <p>La bilharzia, una enfermedad parasitaria también llamada esquistosomiasis, que afectó a Froome hace una década cuando
            fichó por el Team Sky en 2010. La enfermedad, que afecta a más de 200 millones de personas en todo el mundo y causa
            hasta 200.000 muertes por año, es frecuente en África, América del Sur y Asia.
        </p>
    
        <p>Froome fue tratado por el brote de este verano y reanudó las carreras en la Vuelta a Alemania del mes de agosto.
        </p>
        
        <p>'Dio positivo en la prueba de bilharzia, tomó la medicación y tuvo un buen final de temporada. Inmediatamente comenzó
            a mostrar una mejora en sus números, y somos optimistasrespecto a volver a ver al viejo Chris Froome. Él puede estar
            allí y competir por las grandes giras', concluyó el dirigente de la formación. </p>");

        $noticia->setCategoria($categoria1);
        $noticia->setFecha(new \DateTime());
        $noticia->setImagen("noticia2.jpg");
        $manager->persist($noticia);

        $noticia = new Noticia();
        $noticia->setUsuario($usuario);
        $noticia->setTitular("Morcillo hace historia en el aniversario más emotivo de la Vuelta Ibiza Scott");
        $noticia->setEntradilla("Guerrero - Sintsov y Burato - Peretti se hacen con la tercera etapa de la Vuelta a Ibiza");
        $noticia->setCuerpo("<p>Fue hace veinte años cuando Bartolo Planells inició la aventura de la Vuelta a Ibiza Scott con el objetivo de enseñar
        a sus amigos los encantos de la isla de Ibiza de una forma muy especial: rodando en bici, en mountain bike. Su
        hermano, Juanjo Planells cogió el testigo para continuar con el legado que dejó Bartolo y, a día de hoy, por su
        empeño y dedicación, el XX aniversario de la prueba ha resultado ser un éxito absoluto que ha cerrado estas dos
        décadas con un ibicienco de Santa Eulalia como ganador de la cita: Enrique Morcillo. Junto a José Mari Sánchez ambos
        han subido a lo más alto del podio de esta prueba cuya esencia es la practica del MTB por parejas.</p>
    
        <p>Las veinte ediciones vienen avaladas por el elenco de deportistas que participan en ella, por su forma de engranar a
            los élite con los amateurs, por la fidelidad de sus participantes -que año tras año agotan las inscripciones en
            menos de dos horas- y por el máximo compromiso de
        
            instituciones y patrocinadores que se han volcado para hacer realidad esta cita a pesar de las adversidades de la
            pandemia.</p>
        
        <p>Pablo Guerrero y Anton Sintsov junto a Chiara Burato y Claudia Peretti se han hecho con la tercera etapa en un
            recorrido que no ha hecho más que enamorar a los bikers tras el aumento de kilómetros que ha previsto la
            organización para esta edición. El trazado para hoy se aventuraba exigente para los participantes, sobre todo tras
            las dos jornadas anteriores, donde los ciclistas han completado un total de 203 kilómetros con un desnivel acumulado
            de 5.200 metros en tres días. Un escenario paradisiaco para la práctica de este deporte.</p>
        
        <p>'Llevábamos varios años pegándole al palo, entonces este año ganar la vuelta aquí, en casa, junto a José María
            Sánchez que ha sido mi último compañero en los cuatro últimos años, es una alegría. Que se hayan endurecido más
            etapas es de mi agrado, ya que cuanto más dura, más se selecciona el grupo de cabeza, y nosotros aprovechando el
            pico de forma de la Cape, hemos venido a rematar', ha declarado Enrique Morcillo.</p>
        
        <p>'Esta tercera etapa ha sido muy bonita, los que conocíamos la carrera de otros años, hemos visto que tenía esencia de
            la primera etapa y de la última de siempre, ha sido bastante rápida y completa pasando siempre por sitios muy
            icónicos de la isla como Cala Comte o Cala Bassa y con un tiempo que finalmente ha acompañado. Desde mi punto de
            vista ha sido un total acierto endurecer con unos kilómetros más la carrera. En cuanto a la competición en sí, hemos
            intentado mantener la primera plaza controlada por los rivales más directos, no tener ningún problema ni físico ni
            mecánico y hemos llegado muy cerca de ellos a la línea de meta para mantener el liderato', explicaba el ganador de
            la prueba, Jose Mari Sánchez sus sensaciones al entrar en meta. Aunque la emoción de la victoria se ha multiplicado
            inmediatamente porque ha pedido matrimonio a su pareja con la medalla de finisher en la mano, y ella ha dicho: sí.
        </p>
        
        <p>La pareja de las italianas ha demostrado su altísimo nivel donde a pesar de haber sufrido una caída en recorrido, se
            han vuelto a proclamar ganadoras de la etapa vistiendo el maillot amarillo durante tres días de forma consecutiva.
        
        </p>
        
        <p>La edición 2022 ya tiene fecha: 15, 16 y 17 de abril. Pronto se anunciará la apertura de inscripciones, y esperamos
            volver a vernos aquí, en Ibiza, la isla del MTB.
        
        </p>");
        $noticia->setCategoria($categoria2);
        $noticia->setFecha(new \DateTime());
        $noticia->setImagen("noticia3.jpg");
        $manager->persist($noticia);

        $noticia = new Noticia();
        $noticia->setUsuario($usuario);
        $noticia->setTitular("Primera aventura");
        $noticia->setEntradilla("Nuestra primera participación en una carrera por etapas, y para algunos la primera de su vida en bici");
        $noticia->setCuerpo("<p>Simplemente eramos un grupo de amigos al que les gustaba la bicicleta, pero todo
        esto empezó de la siguiente manera, quedaros a leer esta pequeña historia sobre el origen del
        Noniná Team:
</p>

<p>Todo comenzó en un pequeño pueblo de la campiña sevillana, en la mesa de una terraza de un pub. Fue fácil
        y simple. Solo hicieron falta unos refrescos (porque somos sanos🙄) y la tan mala suerte de
        tener alguna tarjeta de crédito a mano...</p>

<p>
- ¿Ei nos apuntamos a un carrera de estas gordas por etapas? - Soltó uno como el que no
        quiere la cosa y sin pensar lo que iba a pasar.

</p>
<p>
-No hay huevos. - Soltó el otro aún más motivado.
</p>
<p>
- Noniná - Soltó el tercero, que seguro que era el que menos pasta tenia, menos habia
        entrenado y mas le habia afectado el azúcar de la Coca-Cola 😂. Pues si, esa ultima frase
        fue la que decidió el antes y el después en un grupo de amigos. Meses más
        tarde estábamos gozándolo en los montes de la sierra de la @lariojabikerace, carrera de 4 etapas
        con muchos km y desnivel.

</p>
<p>
Pues desde ese dia, hasta ahora, ha habido infinidad de quedadas, viajes, algunas carreras (cada vez más), vivencias y mucho
        disfrute que iremos contando poco a poco. Sin más, un grupo de amigos sevillanos-cordobeses con el unico fin de pasárnoslo bien y disfrutar del deporte que más nos gusta, el ciclismo.
</p>");
        $noticia->setCategoria($categoria);
        $noticia->setFecha(new \DateTime());
        $noticia->setImagen("noticia4.jpg");
        $manager->persist($noticia);

        $noticia = new Noticia();
        $noticia->setUsuario($usuario);
        $noticia->setTitular("Cañada Rosal-Sanlúcar de Barrameda. 170 km, 446+, 7h");
        $noticia->setEntradilla("Reto post-cuarentena. Muchas ganas de estar juntos pero pocos entrenos.");
        $noticia->setCuerpo("<p>Objetivo conseguido, primer reto de muchos que quedan por hacer juntos, reto que nació durante el confinamiento y que hemos podido tachar de la lista durante el día de hoy. </p>
        <p>Ruta de 170 km que comenzábamos a las 3 AM en Cañada Rosal, pasando por pueblos vecinos como La Luisiana y Fuentes de Andalucía, y siguiendo hasta Marchena, con el objetivo de llegar antes de las 7 AM a Utrera donde realizamos la primera parada (Nos pusimos finos desayunando) jejeje salimos de nuevo hacia Marismillas con las pilas cargadas dirección Lebrija y Trebujena que la rodeamos siguiendo el canal del bajo Guadalquivir hasta llegar al pinar de la Algaida para encarar la recta final de nuestra ruta llegando a Sanlúcar de Barrameda en 7 horas y cumpliendo un reto grupal que hemos disfrutado y sufrido juntos, pero siempre con ganas de avanzar y de seguir haciendo retos juntos. Y recuerda si alguien te dice que no puedes hacerlo... tú dile NONINÁ.</p>
        
        <p>VAMOOOOOOOOOOOOOOS!</p>");
        $noticia->setCategoria($categoria);
        $noticia->setFecha(new \DateTime());
        $noticia->setImagen("noticia5.jpg");
        $manager->persist($noticia);

        $noticia = new Noticia();
        $noticia->setUsuario($usuario);
        $noticia->setTitular("SIERRA DE HORNACHUELOS-SIERRA NORTE");
        $noticia->setEntradilla("Difícil, pero no imposible, prácticamente todo el equipo disfrutando por la sierra de hornachuelos");
        $noticia->setCuerpo("<p>Gran quedada del equipo. Es complicado pero fuimos capaces de juntarnos prácticamente todos los integrantes del equipo para disfrutar por la sierra de Hornachuelos.</p>

        <p>Combinación perfecta para que nuestros chavales disfruten al máximo. El Noniná resucita de nuevo ✊🏻✊🏻 🌳☀️🏞️🚴</p>");
        $noticia->setCategoria($categoria);
        $noticia->setFecha(new \DateTime());
        $noticia->setImagen("noticia6.jpg");
        $manager->persist($noticia);

        $noticia = new Noticia();
        $noticia->setUsuario($usuario);
        $noticia->setTitular("Andalucía Bike Race");
        $noticia->setEntradilla("Participación de Mario y Álvaro en la prueba de 6 etapas Andaluza");
        $noticia->setCuerpo("<p>Nuestros amigos Mario y Álvaro participaron en la gran prueba por etapas de nuestra tierra.</p>

        <p>Donde Álvaro desgraciadamente sufrió una caída el penúltimo día en la etapa reina que no le permitió acaba esa etapa y por lo tanto la carrera completa. Pero seguro que volverá a ella para ser finisher.</p>
        
        <p>Etapas muy duras pero que no pararon de disfrutar en todo momento, Una experiencia maravillosa por lo que nos contaron. </p>");
        $noticia->setCategoria($categoria);
        $noticia->setFecha(new \DateTime());
        $noticia->setImagen("noticia7.jpg");
        $manager->persist($noticia);

        $manager->flush();
    }
}
