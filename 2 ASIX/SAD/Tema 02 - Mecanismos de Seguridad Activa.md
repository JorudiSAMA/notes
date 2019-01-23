# Tema 2 - Mecanismos de Seguridad Activa

### PARTE I

### 1. Sistemas Personales. Ataques y contramedidas

La protección de la información es el **resultado de la aplicación de un conjunto de mecanismos o estrategias de seguridad**. 

**Principios básicos de las estrategias de seguridad**:

- La seguridad es el **objetivo global**.
- La seguridad **forma parte de la organización**, teniendo en cuenta todos los aspectos que la puedan formar.
- El **marco legal** se debe de considerar como **parte del diseño** de las políticas de seguridad.

> La **gestión y la planificación** de la seguridad es **imprescindible** para marcar un objetivo final, implementar de una manera correcta la seguridad y para el mantenimiento/control.

**Tipos de seguridad**:

- **Seguridad activa**: mecanismo y **medidas físicas y lógicas** que permiten **prevenir y detectar posibles intentos de comprometer los componentes de un sistema informático**.

  > Ejemplo: **Cortafuegos** -> filtra el acceso a ciertos servicios en determinadas conexiones y puede 		bloquear un intento de ataque al sistema.
  >
  > Ejemplo: **Uso de contraseñas**.

- **Seguridad pasiva**: **medidas** para **minimizar los efectos** en caso de una incidencia y **mantener informados** a los administradores sobre la existencia de incidentes que puedan comprometer la seguridad.

  > Ejemplo: **Copias de seguridad**.

> Recordamos la importancia del papel de la seguridad, sobre todo en los **datos** de una empresa por ejemplo, porque el **hardware o software siempre se puede sustituir**, pero **los datos no tienen sustituto**; si se pierden no hay vuelta atrás.

#### 1.1 Clasificación de los ataques a un sistema

##### Según el objetivo del ataque:

- **Interrupmir**:

  - Ataque contra la **disponibilidad**.

  - Se **destruye** o queda **no disponible** un recurso del sistema.

    > Ejemplo: **Cortar** la línea de comunicación de una empresa o **deshabilitar** el sistema de ficheros de un servidor.

- **Interceptar**:

  - Ataque contra la **confidencialidad**.

  - Un usuario no autorizado consigue acceder a un recurso.

    > Ejemplo: **Virus** o **keyloggers** que se dedican a interceptar datos de los usuarios introducidos por teclado o algún **'sniffer'** también.

- **Modificar**:

  - Ataque contra la **integridad**.

  - Un usuario no autorizado consigue acceder a un recurso y también consigue modificarlo, borrarlo o alterarlo.

    > Ejemplo: **Borrar** o **cambiar** una base datos, **alterar** páginas web, etc.

- **Fabricar**:

  - Ataque contra la **integridad**.

  - Un elemento consigue crear o insertar objetos falsificados dentro del sistema.

    > Ejemplo: **Añadir sin autorización** un nuevo usuario y contraseña en el fichero de usuarios.

![1](C:\Users\vesprada\Desktop\1.png)

##### Según la forma del ataque:

- **Ataque pasivo**:
  - **Finalidad**: **Obtener** información **confidencial**.
  - El atacante no modifica ni destruye ningún recurso del sistema informático, **solo observa**.
  - La mayoría de estos se produce sobre la información que **circula en la red**, **sin alterar** la información.
  - **Prevención**: usar **técnicas criptográficas** para cifrar la información que circula por la red.
- **Ataque activo**:
  - **Finalidad**: **Obtener** información **confidencial** y **alterar** o destruir un **recurso** del sistema.
  - El espía mientras **monitoriza** la red puede causar **problemas más grandes que en un ataque pasivo**, mediante:
    - **Suplantación de identidad**.
    - **Re-actuación**, es decir, interceptar mensajes y reenviarlos muchas veces.
    - **Degradar el servicio**, para evitar el funcionamiento normal de los recursos.
    - **Modificar** paquetes o mensajes, así reenviarlos a una persona o a otra zona, para causar algún efecto deseado.

##### Según el tipo de atacante:

Un ataque puede venir del interior de la red, hablaríamos de **'insider'**, o de fuera de la red, **'outsider'**. **Los ataques externos son más numerosos que los internos, pero los internos son por estadística más dañinos y causan más daño que los externos**.

Los principales posibles atacantes de un sistema son:

- **Personal de la misma organización o empresa**:
  - Pueden ser **no intencionados**, pero si son intencionados pueden ser muy devastadores.
  - **Prevención**: 
    - Dar los **permisos** **correctos** a cada trabajador.
    - Limitar la cantidad de **permisos** que dispone una **única** **persona**.
    - Buscar **fallos de seguridad en los permisos**.
    - Definir una buena **política de formación**.
    - **Deshabilitar** puertos USB.
- **Antiguos trabajadores**:
  - **Prevención**:
    - Dar de baja todas las cuentas del ex trabajador.
    - Cambiar la contraseña de acceso lo mas pronto posible.
- **Intrusos o Hackers**:
  - **Finalidad**: **destructiva**.
  - Suelen aprovechan las vulnerabilidades conocidas del SO y programas para conseguir el control.
  - También suelen utilizar ingeniería social.
- **Intrusos remunerados**:
  - Estos ataques suelen ser **distribuidos o organizados**, es decir, se suelen realizar desde distintos equipos o organizaciones de manera coordinada. En este caso se suele llamar **CaaS** (Crime as a Service) o crimen como servicio.
  - Al ser entre varias organizaciones, **disponen de muchos más recursos que un ataque realizado por una única persona**.
  - **Finalidad**: Como todos los ataques, suele ser acceder a la información confidencial.

#### 1.2 Fases de un ataque

1. **Reconocimiento**: El atacante obtiene información del sistema que pretende atacar mediante técnicas como **ingeniería social**, **'trashing'**. La finalidad en esta fase es **obtener la información necesaria para acceder al sistema**.

2. **Escaneo**: El atacante ahora quiere saber como es el sistema, que tan profundo es, y descubrir las **vulnerabilidades** del sistema o **puntos débiles**. Aquí es donde la seguridad de la empresa víctima entra en juego. El atacante al **descubrir los puntos débiles de la empresa**, ahora tiene que crear un **exploit**.

   Un **exploit** es un programa malicioso que se aprovecha de una **vulnerabilidad** del sistema, normalmente por un **error de programación**, para violar la seguridad de estas aplicaciones o sistemas.

3. **Obtener acceso**: Una vez se saben las vulnerabilidades, el hacker se dispone a aprovecharse de estas y  **acceder al sistema**. Gracias a internet, no se requiere siempre un alto conocimiento de informática para  acceder al sistema. Aquí la seguridad también juega un papel importante.

4. **Mantenimiento del acceso**: Ahora que el hacker está dentro, intentará preservar la posibilidad de volver a acceder mediante código malicioso, como caballos de troya o rootkits.

   Luego, podrá instalará un malware para capturar todo el tráfico de la red (**sniffing**), para saber que se introduce por los teclados (**keylogger**), **FTP** de contenido ilícito, etc.

   > Una **botnet** es un grupo de ordenadores (hasta miles de ellos) conectados a la red, infectados por código malicioso que va infectando al resto, como una red de zombies, que permiten el control remoto de estas por los hackers y se usan para realizar acciones sin autorización contra las empresas.

   > Un **rootkit** es una herramienta informática usada normalmente con finalidades maliciosas que permiten el acceso ilícito al sistema por parte de un hacker de forma remota. Se suelen utilizar técnicas para **preservar la presencia** de este mismo rootkit, y su nombre viene de '**root**' porque pueden ceder el control del sistema como 'root' al hacker remoto.

5. **Eliminar las huellas**: Es **muy importante** para el hacker borrar las huellas que haya podido dejar en el sistema atacado. Estas acciones quedan realizadas en los ficheros '.log'. El hacker intentará eliminar todos los logs y registros de alarmas de las herramientas contra hackers que puedan tener instaladas la empresa.

####  1.3 Análisis de código malicioso

##### Detección del código malicioso

Nos tenemos que fijar en:

- **Fecha** anterior de **modificación** de los ficheros.
- **Fecha de creación** de los ficheros.
- **Tamaño** de los ficheros.
- **Función hash** del fichero.

Mediante las funciones hash podemos calcular si el fichero se altero. La herramienta más conocida que hace esto se llama **Tripwire** y funciona de la siguiente forma:

- Obtiene un **hash** de cada uno de los ficheros relevantes y los guarda en una **base de datos** 	protegida.
- Cuando se ejecuta tripwire y esta todo igual no pasa nada pero si hay algo diferente genera una **señal de aviso**.
- **No analiza en línea**, a diferencia de los antivirus.
- **Función**: comprobar la **integridad** de los archivos.

##### Análisis de código malicioso

A la hora de analizar el código malicioso, hay que tener en cuenta una serie de **reglas**:

- **Aislar** la máquina con la que vamos a trabajar para que no afecte al resto de equipos; se pueden utilizar máquinas virtuales para ello.

- Antes de iniciar el análisis hay que **recoger** información sobre los puertos abiertos, usuarios y
  grupos, procesos en ejecución, recursos compartidos.

- Una vez ejecutado el malware, se dispone a recoger la información para estudiar el código malicioso.

  ##### Recogida de la información

Tipos de recogida:

- Recogida **estática**: relacionada directamente en el código malicioso,nombre del fichero, versión etc.
- Recogida **dinámica**:  efectos que produce el código malicioso: documentar las pruebas efectuadas y cambios en el sistema y esos resultados sirvan para prevenir ataques futuros.

##### Análisis y documentación de la información

Todas las pruebas efectuadas se tienen que **analizar y documentar** una vez recogida toda la información con la finalidad de **prevenir nuevos ataques**, es decir, para que no vuelva a ocurrir.

### PARTE II

#### 2. Herramientas preventivas

Las herramientas preventivas son todas aquellas **herramientas** y **mecanismos** que nos ayudan a **reforzar** la **seguridad** y **detectar debilidades** en nuestro sistema.

##### Políticas de seguridad de contraseñas

- **Memorizarla y no escribirla.**
- **Cambiarla periódicamente.**
- **No repetir la misma en varias cuentas.**
- **Evitar palabras de diccionario.**
- **Evitar datos personales.**
- **Añadir caracteres especiales.**
- **Evitar secuencias de teclado del tipo "qwerty" o "1234".**
- **Usar reglas mnemotécnicas para recordar las contraseñas.**

##### Niveles de contraseñas

Diferentes niveles de contraseñas y sus principales características:

1. **BIOS**:
   1. El intruso puede cambiar la configuración de arranque e iniciar cualquier cd o usb malicioso. Las debilidades de la BIOS es que se reconfigura al quitar la pila o jumpers y hay que proteger de manera física el equipo.
2. **Sector de arranque del equipo**:
   1. Evita que los intrusos puedan cambiar las opciones del incio de los diferentes Sistemas operativos.
3. **Sistema operativo**:
   1. Definición de **permisos** de usuarios y grupos.
   2. La información de los usuarios esta en **/etc/passwd**  y las contraseñas en **/*etc*/shadow**.
4. **Programa específico**

