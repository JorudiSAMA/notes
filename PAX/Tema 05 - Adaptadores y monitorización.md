# Tema 05 - Adaptadores y monitorización



## Índice

1. [Configuración de adaptadores](#configuracion-de-adaptadores)
2. [Administración de la red](#administracion-de-la-red)



##1. Configuración de adaptadores

Un **adaptador de red** es la pieza que permite a los dispositivos acceder a la red. Ejemplos:

- Tarjeta de red cableada (NIC)
- Tarjeta de red inalámbrica

Estos adaptadores tienen que ser **configurados** para ser utilizados por un equipo. Se configuran **según los sistemas operativos** y se tiene en cuenta qué herramientas aportan los S.O.

Debido a que **las redes cada vez son más grandes y más complejas**, en el mercado existen diversos protocolos y herramientas para gestión de la red. Las funciones de estas herraminetas son:

1. Detectar y solucionar errores
2. Configurar la red
3. Analizar el rendimiento
4. Examinar la seguridad de la red

Los S.O permiten extender estas utilidades mediante las funciones propias de red con el adaptador de red del equipo.

El **protocolo de red que se usa es el TCP/IP** y para configurar estos adaptadores de red se tienen que asignar valores a los siguientes **parámetros**:

- Dirección IP
- Máscara de red
- Puerta de enlace (gateway)
- Direcciones IP de los DNS (domain name server)

## 1.1 Adaptadores con cable

Los adaptadores de red con cable permiten acceder a la red mediante el cableado que haya en el edificio donde se situa el equipo. En la mayoría de estos casos utilizamos tarjetas de red tipo **Ethernet** mediante la interfaz **RJ-45**. Este adaptador de red (suele) ir incorporado en las blacas base de los equipos.

Para **ver todos los adaptadores** (reconocidos) por vuestro ordenador en GNU/Linux:

```shell
ifconfig -a
```

En GNU/Linux a cada adaptador se le asigna un **identificador**, y en el caso del **Ethernet** suele ser `ethn` , donde la **n** corresponde al número de adaptador empezando desde el 0. Cada identificador junto con el adaptador forma una **interfaz** o **interface**.

Para deshabilitar la interfaz `eth0` utilizamos `ifdown` :

```bash
sudo ifdown eth0
```

Y para habilitarla `ifup`:

```bash
sudo ifup eth0
```

Por tanto, la sintaxis es:

```bash
sudo ifdown [interfaz]
sudo ifup [interfaz]
```

El superusuario es **requerido** para realizar estos comandos.

#### Configuración del protoclo TCP/IP

Se puede hacer de varias maneras:

1. ####Por órdenes:

   Sintaxis:

   ```bash
   sudo ifconfig [interfaz] [inet up nueva_dirrecion_ip] [netmask nueva_mascara] [network dirige_red] [broadcast dirige_difusion]
   ```

   Ejemplo:

   ```bash
   sudo ifconfig eth0 inet up 192.168.0.3 netmask 255.255.255.0 broadcast 192.168.0.255
   ```

   Y para hacer ''**routing**'' o **tablas de encaminamiento**, utilizamos `route`. 

   Sintaxis:

   ```bash
   sudo route add [-net direccion_red] [netmask mascara_red] [gw ip_puerta_enlace] [dev interfaz]
   ```

   Ejemplo:

   ```bash
   sudo route add -net 192.168.0.0 netmask 255.255.255.0 gw 192.168.0.1 dev eth0
   ```

   El término `gw` viene de **gateway** (**puerta de enlace**).

   Por tanto, para **realizar una configuración de TCP/IP correctamente** haríamos lo siguiente:

   ```bash
   # Paso1 - Desactivamos la interfaz
   sudo ifdown eth0
   # Paso 2 - Asignamos direcciones a nuestro host
   sudo ifconfig eth0 inet up 192.168.0.3 netmask 255.255.255.0 broadcast 192.168.0.255
   # Paso 3 - Asignamos encaminamiento o routing a la red
   sudo route add -net 192.168.0.0 netmask 255.255.255.0 gw 192.168.0.1 dev eth0
   # Paso 4 - Activamos la interfaz ya lista para su uso
   sudo ifup eth0
   # Paso 5 - Comprobamos los valores asignados
   sudo ifconfig eth0
   ```

   Una vez realizada la configuración **TCP/IP**, también podemos ver la **tabla ARP**:

   ```bash
   sudo ip neigh show
   ```

   Podemos añadir o eliminar entradas de la **tabla** **ARP**, o borrar la tabla entera:

   ```bash
   # Sintaxis adición de entrada
   sudo ip neigh add [ip_host] lladr [mac_host] dev [interfaz_host] nud perm
   # Ejemplo adición de entrada
   sudo ip neigh add 192.168.0.5 lladr 00:1a:30:38:a8:00 dev eth0 nud perm

   # Sintaxis eliminación de entrada
   sudo ip neigh del [ip_host] dev [interfaz_host]
   # Ejemplo eliminación de entrada
   sudo ip neigh del 192.168.0.5 dev eth0

   # Sintaxis eliminación de la tabla ARP
   sudo ip -s -s n f [ip_host]
   # Ejemplo eliminación de la tabla ARP
   sudo ip -s -s n f 192.168.0.3
   ```

   **IMPORTANTE**: **Estos canvios no se mantienen al reiniciar el equipo**. Para configurar interfaces de manera permanente, se tiene que hacer a través del fichero `/etc/network/interfaces`.

2. #### Escribiendo archivos del sistema:

   En este caso haremos lo mismo que el punto anterior pero escribiendo los ficheros del sistema, concretamente los ficheros son los siguientes:

   - `/etc/network/interfaces` : **Configuración TCP/IP** refiriéndose a la dirección IP, la máscara de red, la dirección de red, la dirección de la puerta de enlace y la dirección de broadcast.

     Ejemplo:

     ```bash
     # Muestra el contenido del fichero
     cat /etc/network/interfaces
     # Ejemplo de fichero
     auto eth0
     iface eth0 inet static
     address 192.168.0.3
     netmask 255.255.255.0
     network 192.168.0.0
     broadcast 192.168.0.255
     gateway 192.168.0.1
     dns-nameservers 8.8.8.8 8.8.4.4
     ```

   - `/etc/resolv.conf`: Configuración de los servidores **DNS**.

     Ejemplo:

     ```bash
     # Muestra el contenido del fichero
     cat /etc/resolv.conf
     # Ejemplo de fichero
     nameserver 8.8.8.8
     nameserver 8.8.4.4
     ```

3. #### Entorno de ventanas:

   Cada **distribución** de **GNU/Linux** tiene su **entorno de ventanas y gestor de ficheros**. Desde este entorno podemos configurar el **adaptador de red**. Para hacerlo accederíamos a las propiedades de red:

   `Sistema > Preferencias > Conexiones de red` 

   En este caso, en la ventana "**Con cable**" podemos configurar todos los adaptadores con cable. Seleccionaríamos el adaptador con cable, por ejemplo `eth0` y pulsamos el botón **editar**. Esta manera es mucho más hacible para más tipos de usuario.

## 1.2 Adaptadores sin cable

Los adaptadores de red sin cable son reconocidos por el sistema operativo y **se configuran de manera muy similar a los de con cable**. A diferencia de los de cable, **no podemos saber todos los hosts que se conectan y desde donde**, por tanto, el acceso solo se permite a hosts conocidos. Por tanto, el acceso a la red se tiene que realizar de manera segura, mediante la **introducción de un `SSID` y `password`**.

Maneras de configurar estos adaptadores:

1. #### Con órdenes:

   Utilizamos `iwconfig` que requiere tener el paquete `wireless-tools`:

   ```bash
   # Sintaxis básica
   sudo iwconfig [interfaz] essid [X] key [k] commit
   # Ejemplo
   sudo iwconfig wlan0 essid Aula key s:12345678 commit
   ```

   - `interfaz`: identificador del adaptador sin cable.
   - `essid`: para asignar el nombre de la red.
   - `key`: para indicar la clave de la red
   - `commit`: para indicar que los canvios se efectúan inmediatamente

2. #### Con ficheros:

   Se realiza de la misma manera que el caso de las redes con cable, modificando el fichero `/etc/network/interfaces` pero en este caso **hay que especificar el acceso a la red** mediante los parámetros `wireless-essid` y `wireless-key` :

   ```bash
   # Muestra el fichero
   cat /etc/network/interfaces
   # Ejemplo de fichero
   auto wlan0
   iface wlan0 inet static
   address 192.168.0.3
   netmask 255.255.255.0
   network 192.168.0.0
   broadcast 192.168.0.255
   gateway 192.168.0.1
   dns-nameservers 8.8.8.8 8.8.4.4
   wireless-essid Aula
   wireless-key 12345678
   ```

   Guardamos el fichero y activamos la interfaz:

   ```bash
   sudo ifup wlan0
   ```

3. #### Con ventanas:

   Este caso es muy similar al de los adaptadores con cable,

   `Sistema > Preferencias > Conexiones de red` 

   En este caso, en la ventana "**Sin cable**" podemos configurar todos los adaptadores sin cable. Seleccionamos la red a editar y en una nueva ventana que se abrirá configuraremos la red.

## 1.3 Comprobación de conexión

Una vez configurado el adaptador de red correctamente, es hora de comprobar el trabajo que hemos hecho. Tenemos que ser capaces de detectar posibles errores.

### Ping

Sirve para comprobar la conectividad de la red enviando paquetes ICMP a otra estación. Si estos paquetes son devueltos, podemos decir que tenemos conexión de red y el adaptador está configurado.

```bash
# Sintaxis
ping [ip_estación]

# Paso 1: Conexión a la red
ping [ip_router]
# Paso 2: Conexión a un servidor DNS público
ping [x.x.x.x]
# Paso 3: Conexión a un servidor público por nombre lógico 
ping [www.unaweb.com]
```

Primero comprobamos la conexión a la red, apuntando al router. En este caso, el router es `192.168.0.1`.

```bash
ping 192.168.0.1
```

Si todo va bien, el output sería así:

```bash
64 bytes from 192.168.0.1: icmp_seq=1 ttl=64 time=59.6 ms
64 bytes from 192.168.0.1: icmp_seq=2 ttl=64 time=3.07 ms
64 bytes from 192.168.0.1: icmp_seq=3 ttl=64 time=2.12 ms
64 bytes from 192.168.0.1: icmp_seq=4 ttl=64 time=2.05 ms
```

Luego comprobamos si obtenemos respuesta de conexión y obtener la rapidez de la respuesta. Optamos por los DNS públicos de google `8.8.8.8`:

```bash
ping 8.8.8.8
```

Si todo va bien, el output sería así:

```bash
PING 8.8.8.8 (8.8.8.8) 56(84) bytes of data.
64 bytes from 8.8.8.8: icmp_seq=1 ttl=54 time=51.9 ms
64 bytes from 8.8.8.8: icmp_seq=2 ttl=54 time=38.8 ms
64 bytes from 8.8.8.8: icmp_seq=3 ttl=54 time=39.5 ms
```

Para terminar, solo queda comprobar si podemos navegar por nombres lógicos. Optamos por la web de google `www.google.com`:

```bash
ping www.google.com
```

Si todo va bien, el output sería así:

```bash
PING google.com (213.176.161.13) 56(84) bytes of data.
64 bytes from www.google.com (213.176.161.13): icmp_seq=1 ttl=241
time=68.8 ms
64 bytes from www.google.com (213.176.161.13): icmp_seq=2 ttl=241
time=52.5 ms
64 bytes from www.google.com (213.176.161.13): icmp_seq=3 ttl=241
time=53.3 ms
```

### traceroute

A veces con la comprobación `ping` no es suficiente. **Se podría dar el caso que no podemos acceder a una maquina concreta del exterior**. En este caso, es necesario conocer que caminos siguen los paquetes que hemos enviado y hasta donde llegan.

La orden `traceroute ` nos dice la sequencia de direccionamiento que sigue un paquete hasta llegar a su destino. Funciona de la siguiente forma:

Se envian **datagramas IP** empezando por **TTL**(time to live) igual a 1, y en este caso el primer encaminado devuelve el origen respondiendo que se ha excedido el tiempo de vida. De esta manera ya se puede conocer el primer encaminador, entonces, **el TTL va aumentando en 1 hasta conocer todo el camino que recorre el paquete**. Ejemplo:

```bash
root@aula:$ traceroute www.google.com
traceroute to www.google.com (213.176.161.13), 30 hops max, 60 byte packets
 1 10.224.32.1 (10.224.32.1) 27.633 ms * *
 2 * * *
 3 * * *
 4 * * *
 5 * * *
 6 * ae0-1702-xcr1.par.cw.net (195.2.22.137) 33.885 ms xe-11-0-0-xcr1.bap.cw.net (195.2.25.65) 60.166 ms
 7 * * *
 8 * * *
 9 * * *
10 * * *
11 * * *
12 83.247.145.10 (83.247.145.10) 59.048 ms 62.008 ms 58.009 ms
13 garbi-rt.google.com (213.176.160.18) 56.224 ms 54.013 ms 54.349 ms
14 www.google.com (213.176.161.13) 54.558 ms 53.166 ms 55.672 ms
```

Entonces, si no tenemos una conexión hasta una cierta máquina, con esta orden **podemos conocer hasta donde llega el paquete y localizar el problema**. Además, permite **conocer el rendimiento de la red**.

### netstat

Algunas veces necesitamos consultar el rendimiento de la red y el estado de los protocolos. Esto lo podemos obtener con la herramienta `netstat` ; información de protocolos como `Ethernet`, `UDP`, `ICMP`,`TCP` y `IP` . Esta orden tiene estos posibles parámetros:

- `-a` : muestra todas las conexiones y los puertos abiertos.
- `-n` : muestra la información de los puertos y direcciones de manera numérica.
- `-p` : protocolo: muestra la información asociada al protocolo especificado.
- `-r` : muestra el contenido de la mesa de rutas.
- `-s` : muestra estadísticas por protocolos.

Ejemplo:

```bash
# Sintaxis
netstat [argumentos]

# Ejemplo
professor@aula:$ netstat -s
Ip:
 338986 total packets received
 4 with invalid addresses
 0 forwarded
 0 incoming packets discarded
 338979 incoming packets delivered
 247741 requests siendo out
 212 dropped because of missing route
Icmp:
 48 ICMP messages received
 0 input ICMP message failed.
 ICMP input histogram:
 timeout in transit: 9
 echo replies: 39
 163 ICMP messages siendo
 0 ICMP messages failed
 ICMP output histogram:
 destination unreachable: 13
 echo request: 150
IcmpMsg:
 InType0: 39
 InType11: 9
 OutType3: 13
 OutType8: 150
Tcp:
 4909 activo connections openings
 1 passive connection openings
 7 failed connection attempts
 161 connection resets received
 12 connections established
 333834 segmentos received
 238189 segmentos send out
 4518 segmentos retransmited
 0 bad segmentos received.
 1209 resets siendo
Udp:
 5031 packets received
 13 packets tono unknown puerto received.
 0 packet receive errores
 5052 packets sended
```

### nslookup

Con el ping podiamos conocer si funcionaba correctamente el servidor DNS o no, pero para conocer solo eso tenemos la herramienta `nslookup`. Se puede hacer de dos formas: pasando como parámetro el nombre de una máquina o su IP. Ejemplo:

```bash
# Sintaxis
nslookup [nombre/ip] [ip_dns]

# Ejemplo
professor@laptop:~$ nslookup www.google.com
Server: 10.20.0.1
Address: 10.20.0.1#53
Non-authoritative answer:
www.google.com canonical name = forcesafesearch.google.com.
Name: forcesafesearch.google.com
Address: 216.239.38.120
```

Ahora vamos a descubrir cuál es el DNS de una máquina solicitada. En este caso `216.239.38.120` y que nos devuelve su servidor `10.20.0.1` y su DNS correctamente:

```bash
professor@laptop:~$ nslookup 216.239.38.120
Server: 10.20.0.1
Address: 10.20.0.1#53
Non-authoritative answer:
120.38.239.216.in-addr.arpa name = any-in-2678.1e100.net.
Authoritative answers can cordero found from:
216.in-addr.arpanameserver = r.arin.net.
216.in-addr.arpanameserver = z.arin.net.
216.in-addr.arpanameserver = y.arin.net.
216.in-addr.arpanameserver = arin.authdns.ripe.net.
216.in-addr.arpanameserver = x.arin.net.
216.in-addr.arpanameserver = u.arin.net.
r.arin.net internet address = 199.180.180.63
u.arin.net internet address = 204.61.216.50
u.arin.net has AAAA address 2001:500:14:6050:ad::1
y.arin.net internet address = 192.82.134.30
```

También podemos especificar que servidor DNS queremos usar, pasando la IP del DNS como segundo parámetro:

```bash
professor@laptop:~$nslookup www.google.com 8.8.8.8
Server: 8.8.8.8
Address: 8.8.8.8#53
Non-authoritative answer:
www.google.com canonical name = forcesafesearch.google.com.
Name: forcesafesearch.google.com
Address: 216.239.38.120
```

------

## 2. Administración de la red

Administrar la red es importante y es tarea de los administradores de la red.

## 2.1 Representación de la red

Para diagnosticar y corregir eficientemente los problemas de la red, se tiene que
tener información sobre cómo se ha diseñado la red y el rendimiento que se espera en
condiciones normales. La documentación de red tiene que incluir:

- Mesa de configuración de la red.
- Mesa de configuración de los sistemas terminales (servidores, estaciones de
  trabajo, etc.).
- Diagrama de la topología de la red.

#### Mesa de configuración de la red

Contiene información detallada del hardware y software que se utiliza en la red. Los datos que la mesa tendría que incluir para todos los componentes son las siguientes:

- Tipo de dispositivo y modelo
- Fichero de la imagen de la IOS, incluyendo la versión.
- Nombre del dispositivo a la red.
- Localización del dispositivo (edificio, planta, sala, bastidor o rack, panel).
- Dirección de la capa de enlace (MAC).
- Dirección de la capa de red (IP).
- Cualquier información importante sobre los aspectos físicos del dispositivo.

#### Mesa de configuración de los sistemas terminales

Contiene información básica del hardware y software que se utilizan en los
dispositivos o sistemas finales, como servidores, consolas de administración de red,
estaciones de trabajo, etc. Un sistema terminal mal configurado puede tener un impacto
muy negativo sobre el rendimiento del conjunto de la red. Debe incluir:

- Nombre del dispositivo (propósito).
- Sistema operativo y versión.
- Dirección IP.
- Máscara de subred.
- Puerta de enlace por defecto, servidor DNS y wins, entre otros.
- Cualquier aplicación de anchura de banda grande que tenga el sistema.

#### Diagrama de la topología de la red

Es la representación gráfica de la red, que tiene que mostrar como están
conectados los diferentes dispositivos. Este diagrama comparte mucha información de la
mesa de configuración. Se tiene que ver representado cada dispositivo de manera clara o
con un símbolo gráfico, todas las conexiones tanto físicas como lógicas y, si se cree
conveniente, también los protocolos de encaminamiento. Debe incluir:

- Simbología para todos los dispositivos y cómo están conectados.
- Tipo de interfaces y cantidad.
- Direcciones IP.
- Máscara de subred.

## 2.2 Herramientas para la monitorización de la red y resolución de problemas

Una vez documentada la red y todos sus componentes, hay que disponer de
herramientas que ayuden a monitorear el rendimiento y faciliten la resolución de los
posibles problemas que vayan saliendo. Para facilitar esto, hay una gran variedad de
**programas** disponibles, tanto propietarios como libres.

#### Herramientas NMS

Las herramientas NMS (**network management system**) permiten a los admins de la red **monitorear en remoto y de manera gráfica los dispositivos de la red**. Proporcionan información general del estado del dispositivo, estadísticas e información de la configuración. Un ejemplo de estas aplicaciones son Pandora FMS y Nagios.

#### Analizadores de red

Los analizadores de paquetes, también llamados sniffers, permiten ver la información que viaja por la red y la representan en un formato relativamente sencillo de entender. Presentan información de la capa física, de enlace, de protocolos y de las tramas. Ejemplo: Wireshark.

## 2.3 Protocolo de administración de redes (SNMP)

**SNMP** (**simple network management protocol**) es un **protocolo** definido en la **capa de aplicación de la arquitectura TCP/IP**. Este **protocolo** define los mensajes que se intercambian el ordenador administrador y un dispositivo concreto de la red, y permite al ordenador administrador obtener o asignar valores a variables (parámetros) de los dispositivos que componen la red de ordenadores que se administra.

La arquitectura de administración de la red gestionada bajo este protocolo distingue entre los dispositivos de una red entre el sistema de administración, el agente y los dispositivos:

- El **sistema de administración de red** (NMS, network-management system) es el ordenador el cual se utiliza para la monitorización de la red.
- El **agente** es el software situado en el dispositivo administrado, y es el encargado de recibir órdenes del sistema de administración y enviar la información del ordenador gestionado al ordenador de la administración.
- Un **dispositivo** gestionado es un nodo que tiene un agente SNMP y reside en una red gestionada.

Cuando obtenemos información de esos dispositivos, necesitamos almacenarla en algún sitio, y ese sitio es lógicamente una base de datos. SNMP tiene una estructura de datos específica para crear esta base datos.

**MIB** **(management information base**) es la estructura de datos que usa el protocolo **SNMP** para **almacenar y clasificar la información de administración de la red**; podríamos decir que es similar a una base de datos. Es una **estructura** jerárquica, en forma de **árbol**, que **tiene como entradas objetos en que se guarda información de cada dispositivo**.

Las operaciones que hace el administrador de red sobre los dispositivos administrados son:

- **Consulta información de los parámetros de un dispositivo**: por ejemplo, en el caso de un router, tablas de encaminamiento o ''routing tables'' etc.
- **Cambiar la configuración**.

**Problemas** del SNMP:

- **Inutiliza** la red cuando la gestionamos.
- No podemos gestionar la red cuando está **congestionada**.

**Ventajas** del SNMP:

- **Universalidad** del protocolo
- **Extensibilidad** del protocolo
- **Flexibilidad** del protocolo