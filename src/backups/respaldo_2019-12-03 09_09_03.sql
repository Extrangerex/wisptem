SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `daniel`
--




CREATE TABLE `clientesp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` text,
  `apellido` text,
  `mac` text,
  `cell` text,
  `cell2` varchar(20) DEFAULT NULL,
  `direcion` text,
  `comentario` text,
  `pago_total` int(11) DEFAULT NULL,
  `fecha_inicial` text,
  `fecha_final` text,
  `dias_p` int(11) DEFAULT NULL,
  `disable` text,
  `documento` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `plan` varchar(45) DEFAULT NULL,
  `poste` varchar(45) DEFAULT NULL,
  `sector` varchar(60) NOT NULL,
  `remoteaddress` varchar(15) DEFAULT NULL,
  `pago_instalacion` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `date_added` text,
  `mora` int(11) DEFAULT NULL,
  `id_mk` int(11) DEFAULT NULL,
  `id_router` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `id_pago` int(11) DEFAULT '1',
  `financiamiento` text,
  `corte_auto` varchar(3) DEFAULT 'yes',
  `anuncio` varchar(3) DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;


INSERT INTO clientesp VALUES
("1","Albania ","Fermin ","C0:25:67:43:B5:10","829-317-6274","","Calle  el carmen ","Por la agencia  de  motores  por  la cañada  ","800","2018-01-01","2019-10-25","","yes","","CC9B1@Albania Fermin.","1521 ","3M","02","BF","190.16.10.217","800","12","2019-09-3017:27:32","0","1","2","1","1","","yes","yes"),
("2","Wanda","Rosario ","C0:25:67:41:36:68","849-912-5743","","El cacao salón  Wanda cerca  de bam bam ","Salon Wanda  al lado de ban ban","800","2017-03-01","2019-11-25","","no","056-0165955-9","CCEP33Wanda Rosario","1521 ","3M","92","CC","190.16.10.218","3500","12","2019-09-3017:36:06","","1","2","1","1","","yes","yes"),
("3","Pedro ","Tineo ","D8:32:14:89:9D:F8","849-916-5000","","","","1200","2018-03-08","2019-11-25","","no","065-0015719-5","pedro tineo","1521 ","10M","","CC","190.16.10.219","3500","12","2019-09-3017:54:38","0","1","2","1","1","","yes","yes"),
("4","Yocelin","drullard estrella","C0:25:67:41:09:C8","829-542-6179","","Entrada por el hotel plus ","Entrada hotel plus","700","2018-02-25","2019-11-25","","no","08100118846","123","1521 ","2M","Cscs5b","CSC","190.16.10.220","3500","12","2019-09-3020:14:39","0","1","2","1","1","","yes","yes"),
("5","Yalianny","Castillo B","C0:25:67:41:0B:A0","8498807265","","El cacao al final frente al chet","Al final de la calle la que vende ropa cerca de ban  van ","1200","2018-09-01","2019-10-25","","yes","402-2136583-2","CEP9C3@Yalianny ","1521 ","5M","Cep9c3","CC","190.16.10.221","3500","12","2019-09-3020:42:20","0","1","2","1","1","","yes","yes"),
("6","Faira ","Penzo","C8:3A:35:BA:0A:50","829-704-9699","","Salón faira segundo nivel detrás de la peluquería André y banca loteka","Salón faira segundo nivel ","1000","2017-09-28","2019-11-25","","no","134-0002837-2","CNC32@Faira","1521 ","5M","Cnc32","CC","190.16.10.222","3500","12","2019-09-3021:09:33","0","1","2","1","1","","yes","yes"),
("7","María del Carmen ","Alcántara bruno ","C0:25:67:41:7A:AC","809-378-3640","","Por el callejón de la de los pastelitos ","La de los helados","1000","2019-08-28","2019-10-25","","yes","134-00019702-2","CEP102@Maria del Carme Alcantara Bruno","1521 ","3M","Cep102","CC","190.16.10.223","3500","11","2019-09-3021:44:09","0","1","2","1","1","","yes","yes"),
("8","Guillermo a","Reyes","C0:A5:DD:1B:EA:DD","829-915-6436","","Calle bulevar  próximo a luz y fuerza ","El bulevar frente a luz y fuerzas ","800","2018-03-03","2019-11-25","","no","065-0038342-4","MACB1A2@Guillermo Andres Reyes.","1521 ","3M","macb1a2","MDT","190.16.10.224","3500","12","2019-09-3021:55:32","0","1","2","1","1","","yes","yes"),
("9","Lucila","Taveras","C8:3A:35:A3:C6:80","809-852-8988","","Al lado de la policlínica ","El cacao ","500","2018-06-02","2019-10-25","","no","071-0031635-0","lucila taveras","1521 ","3M","","CC","190.16.10.225","3500","11","2019-09-3021:59:02","0","1","2","1","1","","yes","yes"),
("10","Wanda ","Rosario ","0C:80:63:0E:23:FD","849-912-5743","","Salón wanda segundo nivel","Casa al lado de ban ban ","1000","2018-10-04","2019-10-25","","no","056-0165955-9","CEP33@Wanda Rosario (Casa).","1521 ","3M","Cep33","CC","190.16.10.226","3500","11","2019-09-3022:05:20","0","1","2","1","1","","yes","yes"),
("11","Jeremía ","Gonzalez","C0:25:67:31:FB:D8","829-875-8769","","Barrio cacao  calle pepin #37","El cacao calle pepin #37","800","2018-12-20","2019-11-25","","no","066-0007265-3","jelemia","1521 ","2M","","CC","190.16.10.227","3500","11","2019-09-3022:09:15","0","1","2","1","1","","yes","yes"),
("12","Dallelin","Martínez ","C0:25:67:59:A5:CB","809-965-6412","","Calle el Carmen ","Calle el Carmen ","1500","2018-10-02","2019-12-25","","no","402-2373238-5","CSCS6B3@Dallelin Martinez","1521 ","5M","Cscs6b3","HP","190.16.10.228","3500","12","2019-09-3022:13:18","0","1","2","1","1","","yes","yes"),
("13","Francisco Alberto","Plasencia ","C0:25:67:43:B4:E8","809-967-7332","","Detrás de la peluquería Andry y banca loteka","Debajo del salón faira ","1300","2018-10-05","2019-12-25","","no","053-0027073-8","CNC34@Francisco Alberto Plasencia Garcia","1521 ","5M","Cnc34","CC","190.16.10.229","3500","12","2019-09-3022:18:24","0","1","2","1","1","","","yes"),
("14","Cofesora","De Ogracia ","C8:3A:35:9A:F7:08","849-751-8241","","Barrio come pan banca Antonio cruz","Barrio come pan  en la banca Antonio cruz ","1000","2018-08-29","2019-11-25","","no","134-0002897-6","CP3A2Confesora deogracia","1521 ","3M","Cp3a2","CP","190.16.10.230","3500","12","2019-09-3022:22:28","0","1","2","1","1","","yes","yes"),
("15","Randy","Andújar ","CC:2D:21:3A:76:D8","849-631-8127","","Come pan ","Come pan ","800","2018-06-28","2019-11-25","","no","402-3206992-8","CP2A3@Randi Anduja","1521 ","2M","Cp2a3","CP","190.16.10.231","3500","12","2019-09-3022:26:14","0","1","2","1","1","","yes","yes"),
("16","Guinston","Cordero","C8:3A:35:A3:67:08","809-657-1368","","Calle nuñez de Cáceres barrio el millón ","Calle 16 agosto ","1000","2018-06-01","2019-11-25","","no","033-0023320-6","CPE61@Juan camacho","1521 ","5M","Cpe61","CC","190.16.10.232","3500","12","2019-09-3022:30:53","0","1","2","1","1","","yes","yes"),
("17","Maria elbira","Concepción ","04:95:E6:19:AB:C0","849-873-1992","","El cacao ","El cacao casa 48","1000","2018-09-19","2019-10-25","","yes","066-0016928-5","CEPB2@Maria Erbira Concepcion","1521 ","3M","Cepb2","CC","190.16.10.233","3500","11","2019-09-3022:34:25","0","1","2","1","1","","yes","yes"),
("18","Yesenia1","Garcia1","C0:25:67:32:2C:CC","829-644-3047","","El cacao ","El cacao","1000","2018-10-06","2019-10-25","","yes","402-3624105-1","Yesenia Garsia01","1521 ","3M","","CC","190.16.10.234","3500","12","2019-09-3022:37:43","0","1","2","1","1","","yes","yes"),
("19","Hector","Rpm gimnasio ","C0:25:67:28:BE:64","809-402-2708","","Barrio el cacao ","Barrio el cacao al final en el gimnasio ","1000","2018-03-21","2019-09-25","","yes","121-0007946-1","cep131@Hector rpm gimnasio","1521 ","3M","Cep131","CC","190.16.10.235","3500","12","2019-09-3022:41:59","","1","2","1","1","","yes","yes"),
("20","Rufina","Burgos valle ","C0:25:67:28:DB:68","849-750_4817","","El cacao ","Barrio el cacao ","500","2018-06-20","2019-11-25","","no","047-0181150-9","Rufinina burgos","1521 ","2M","","CC","190.16.10.236","3500","12","2019-09-3022:49:15","0","1","2","1","1","","yes","yes"),
("21","Esmarlin ","Mosquea","C0:25:67:28:C4:14","809-268-8184","","Calle Sánchez el hospital ","Detrás del liceo santo Esteban Rivera calle Sánchez  donde  están las mata de mango","1000","2018-06-29","2019-11-25","","no","402-2612557-9","esmarlin mosquea taveraz","1521 ","3M","","HP","190.16.10.237","3500","12","2019-09-3022:55:21","0","1","2","1","1","","yes","yes"),
("22","Josefina ","Perez","B0:4E:26:DC:84:A9","849-256-3686","","Monte adentro ","Monte adentro ","800","2018-09-28","2019-12-25","","no","134-0004672-1","CBM1A1@Josefina Perez","1521 ","2M","Cbm1a1","MDT","190.16.10.238","3500","11","2019-09-3022:59:46","0","1","2","1","1","","","yes"),
("23","Pablo ","Beato","C0:25:67:22:15:18","829-343-2395","","El cacao al final  el chef ","El cacao el chef ultima casa al final ","700","2018-05-31","2019-11-25","","no","066-00056511-0","pablo beato","1521 ","2M","","CC","190.16.10.239","3500","11","2019-09-3023:06:39","0","1","2","1","1","","yes","yes"),
("24","Medí ","Ventura","","849-283-7428","","El Manantial Caños Seco.","","1000","2018-11-29","2019-12-25","","no","136-0013234-7","MT21Medi Ventura","1521 ","3M","MT21","EMT","190.16.10.240","0","12","2019-10-0820:31:19","0","1","1","1","1","","yes","yes"),
("25","Juan","Grend","","809","","El Hopital C/Gregodio Luperon Hotel al fondo.","","1200","2018-06-05","2019-11-25","","no","066-0005808-2","HPCL5B1@Juan Grend","1521 ","5M","HPCL5B1","HP","190.16.10.241","350","12","2019-10-0911:00:46","0","1","2","1","1","","yes","yes"),
("26","Dionicio","Coplin sosa ","04:95:E6:11:91:A0","829-660-5755","","Barrio  cachimbo por la  entrada de la escuela ","Cachimbo por la entrada de la escuela ","1000","2018-06-21","2019-11-25","","no","134-0004581-4","BC15@Dionicio Coplin Sosa","1521 ","3M","Bc15","ECHB","190.16.10.242","3000","12","2019-10-1217:16:01","","1","2","1","1","","yes","yes"),
("27","Rolando","Nuñe","C8:3A:35:B9:CE:88","809-727-3231","","Cachimbo Por la entrada de la escuela ","Por la  entrada  de  la  escuela ","1000","2018-03-12","2019-10-25","","yes","066-0014345-4","FRM1111","1521 ","3M","Bc14","ECHB","190.16.10.243","3000","11","2019-10-1217:33:33","","1","2","1","1","","yes","yes"),
("28","Sofi","Cruz","C0:25:67:39:FB:C8","809-234-4661","","Cachimbo por la entrada de la escuela ","Por  la  entradda de  la  escuela ","1000","2017-10-10","2019-12-25","","no","048--0025921--2","Sofy Cruz","1521 ","3M","Bc12","ECHB","190.16.10.244","3000","11","2019-10-1217:46:23","","1","2","1","1","","yes","yes"),
("29","Zofi ","Cruz ","CC:2D:21:3A:3A:D0","829-731-0980","","El cachimbo por  la  entrada  de  la  escuela ","Por la   entrada  de  la  escuela ","1000","2018-04-25","2019-12-25","","no","066-0018259-3","BC12@Zofi Cruz#2.","1521 ","3M","Bc13","ECHB","190.16.10.245","3000","11","2019-10-1217:52:35","","1","2","1","1","","yes","yes"),
("30","Midary","Sanchez duarte","C0:25:67:32:08:CC","829-577-8089","","Come pan ","Come pan por  el  colmado de  ronnny","800","2017-10-01","2020-01-25","","no","066-00041336-8","CPCP2A4@Midari sanchez duarte","1521 ","2M","Cp2a2","CP","190.16.10.246","3000","11","2019-10-1217:59:07","","1","2","1","1","","yes","yes"),
("31","Luz eneida","Mercedes ","C0:25:67:32:4E:80","829-757-0463","","Calle erciria pepin por  el  gimnasio hector","Por  el gimnasio  el cacao ","1000","2018-11-21","2019-11-25","","no","066-0018259-3","Lucenerds Mercedes","1521 ","3M","Cp141","CC","190.16.10.247","3000","11","2019-10-1218:11:16","","1","2","1","1","","yes","yes"),
("32","Enua árberto","Rubio green ","C0:25:67:59:7C:67","829-905-6303","","Calle Jon frente  a  plaza  canne","Frente  a  plaza   kanni","1000","2017-11-12","2019-12-25","","no","402-2162174-7","CC9A1@Enuar Alberto Rubio Green","1521 ","3M","Cc9a1","PBT","190.16.10.248","3000","11","2019-10-1218:19:19","","1","2","1","1","","yes","yes"),
("33","Estefania","Ribera ","D8:32:14:89:4A:70","8","","Intersección  calle  Sanchez y duerte ","Al lado  empanada  kandy","1000","2017-05-18","2019-10-25","","yes","066-0005513-8","CSCS11@Mari Rivera","1521 ","3M","Cscs11","CSC","190.16.10.249","3000","11","2019-10-1218:26:58","","1","2","1","1","","yes","yes"),
("34","Estefania","Rivera ","D8:32:14:89:4A:70","8","","Intersección  calle  duarte y  calle  Sanche ","Al lado de  las  empanada kanny","1000","2017-06-23","2019-10-25","","yes","066-0005513-8","CSCS11@Mari Rivera.","1521 ","5M","Cscs11","CSC","190.16.10.250","3000","12","2019-10-1218:53:32","0","1","2","1","1","","yes","yes"),
("35","Yefermia eneroliza ","Moya parez","C0:25:67:32:4E:B0","809-964-7270","","El cacao por  la  entrada  del  callejón de  la  que  vende comida ","El cacao  frente  al gimnasio ","1000","2018-01-21","2019-11-25","","no","134-0003265-5","CEP133@Yefermia Eneroliza Moya Perez","1521 ","3M","Cep133","CC","190.16.10.251","3000","12","2019-10-1219:24:11","","1","2","1","1","","yes","yes"),
("36","Enerto ","De  la  cruz","C0:25:67:3A:22:0C","809-974-6341","","Come pan  frente  al  furgon","Come pann frente al furgon cito","1000","2017-10-07","2019-10-25","","no","081-0006027-9","CP41@Enerto de la Cruz.2","1521 ","3M","Cp41","CP","190.16.10.252","3000","11","2019-10-1219:47:05","","1","2","1","1","","yes","yes"),
("37","Luis Miguel ","mesa","","809-863-8975","","Calle Sanchez entrada de la escuela  apartamento las 3 palmas ","Calle  Sanchez  por la  entrada  de  la  escuela  ","1000","2018-10-17","2019-10-25","","yes","010-0069354-7","Hpcs42@luismiguelmesa","1521 ","3M","Hpcs42","HP","190.16.10.253","3000","12","2019-10-1219:56:52","","1","2","1","1","","yes","yes"),
("38","Yuliana","De jesus","C0:25:67:20:FA:A4","829-649-8278","","El cacao  encima del colmado Rodriguez ","El cacao  encima del colmado Rodriguez","1000","2017-08-12","2019-11-25","","no","056-0130369-5","Yuliana De Jesu","1521 ","3M","Cnc21","CC","190.16.10.254","3000","11","2019-10-1220:05:04","","1","2","1","1","","yes","yes"),
("39","Altagracia","Amequita martinez ","C0:25:67:20:D3:5C","829-860-1927","","Com  pan frente al billar ","Frente al billar  por el callejón de la banca","1000","2018-05-21","2019-11-25","","no","134-0002800-0","CP2A3@Altagracia Merquiteque","1521 ","3M","Cp3a3","CP","190.16.10.255","3000","12","2019-10-1220:14:55","","1","2","1","1","","yes","yes"),
("40","Roberto ","De los santos ","04:95:E6:19:AC:88","829-296-7470","","El cacao  por  la  entrada   de  la  compra  venta ","Por  la  entrada  de  la  compra  venta ","1000","2018-03-06","2019-11-15","","no","134-0000967-9","CCEP41Roberto Rudo","1521 ","3M","Ccep41","CC","190.16.11.2","3000","12","2019-10-1220:19:51","0","1","2","1","1","","yes","yes"),
("41","Alejandro","Medina ","D8:32:14:89:9F:A0","829-376-7860","","El hospital  calle  gregorio  luperon","Por  la   entrega   del   colmado ","1000","2017-09-18","2019-12-25","","no","134-0000550-3","HPCS4A2Alexjandro Medina","1521 ","3M","Hpcl41","HP","190.16.11.3","3000","11","2019-10-1220:27:22","","1","2","1","1","","yes","yes"),
("42","Justina Maria ","Garcia","C0:25:67:32:2C:40","829-574-7977","","Entrada por  la ñeca ","Por el callejón  de  la  ñeca ","600","2017-12-05","2019-11-25","","no","134-0000126-2","Justina Maria Garsia","1521 ","2M","","ECHB","190.16.11.4","3000","11","2019-10-1220:32:58","","1","2","1","1","","yes","yes"),
("43","Randi","Agustín","","829-527-3595","","El hospital  barrio  fino cerca del jugado de  paz ","El hospital  barrio  fino cerca del jugado de  paz ","1000","2019-08-15","2019-10-25","","yes","402-2614164-2","Hpcr72@randi Agustín ","1521 ","3M","Hpcr72","BF","190.16.11.5","3000","11","2019-10-1220:41:00","","1","2","1","1","","yes","yes"),
("44","Yense ","Castro","","829-645-2946","","Detrás del  bar","Detrás del bar","1200","2019-09-25","2019-10-25","","yes","031-0353200-2","Pb12@","1521 ","5M","Pb12@yense castro","PBT","190.16.11.6","3000","12","2019-10-1220:52:00","","1","2","1","1","","yes","yes"),
("45","Josefina ","Garcia","C0:25:67:28:CC:50","829-571-6248","","El manantial  por la  entrada de  la  iglesia ","Por  la  entrada   de  la  iglesia  ","1000","2017-06-19","2019-12-15","","no","001-1012101-9","cp2a@ josefina garcia","1521 ","3M","Mt2a3","EMT","190.16.11.7","3000","12","2019-10-1220:59:05","","1","2","1","1","","yes","yes"),
("46","Eriberto ","Metirier","C0:25:67:32:01:F0","849-802-8633","","Peluquería  andry frente  a  salon amor ","Frente  a  salon amor  y  al lado  de  la  iglesia evangelica","1200","2017-03-06","2019-11-25","","no","134-00005302-4","CNC31@Andri Beato P.L.Q.L.","1521 ","5M","Cnc31","CC","190.16.11.8","3000","11","2019-10-1221:06:10","","1","2","1","1","","yes","yes"),
("47","Rosa Maria ","Paulino hernandez","14:4D:67:0F:C8:BD","829-924-9865","","El cacao  frente  a la mata de mango  casa #8 parte  atrás ","El cacao casa 8 por  la cancha ","500","2017-12-05","2019-11-25","","no","131-0001655-9","rosa","1521 ","2M","Cep122","CC","190.16.11.9","3000","12","2019-10-1221:34:27","","1","2","1","1","","yes","yes"),
("48","Jordi ","Lopez","C0:A5:DD:1B:EC:91","849-912-1694","","Frente al  pola","Frente   al   pola   segundo   piso ","1300","2018-08-02","2019-11-25","","no","402-3411392-2","JLIIRY@ jordy Lopez","1521 ","5M","Cscd31","CSC","190.16.11.10","3000","12","2019-10-1221:41:54","","1","2","1","1","","yes","yes"),
("49","Harmando","Hernande","C0:25:67:28:A5:FC","829-930-4707","","Come pan frente  a  los apartamento de  fari","Frente   a  los  apartamentos  de  fari","900","2017-10-30","2019-11-25","","no","066-0018855-8","cp8@Armanlo Hernadez","1521 ","3M","Cp31","CP","190.16.11.11","3000","12","2019-10-1221:48:53","","1","2","1","1","","yes","yes"),
("50","Yoka","Duran","AC:84:C6:8A:E6:77","829-542-1012","","Calle  bulevar ","Bulevar salón yoka ","1200","2017-12-27","2019-11-25","","no","071-0039667-5","CPB31@Yoka Duran.","1521 ","5M","Cpv31","CP","190.16.11.13","3000","11","2019-10-1311:21:19","0","1","2","1","1","","yes","yes"),
("51","sol leni","bonilla","C0:25:67:41:3D:2C","809-848-0019","","come pan calle boluvar entrada salon maranata","calle bulevar por la entrada del salon maranata","800","2018-02-17","2019-10-25","","yes","134-0003834-4","soldeni","1521 ","3M","cpv1a1","CP","190.16.11.14","3000","12","2019-10-1311:27:25","","1","2","1","1","","yes","yes"),
("52","teresa amequita","martinez","CC:2D:21:3A:38:D8","849-626-6938","829-860-9845","el cacao calle elcilia pepin frente ala iglesia catolica","elcilia pepin frente ala iglesia catolica","1200","2017-11-06","2019-11-25","","no","cep81","CEP81@Teresa asmiquita martinez.","1521 ","5M","","CC","190.16.11.15","3000","12","2019-10-1311:39:46","0","1","2","1","1","","yes","yes"),
("53","sofia","lora","14:91:82:F3:98:33","809-708-0087","","calle sanche frente al super casa parte atras","casa parte atras frente al super lupez","1000","2017-06-10","2019-12-25","","no","134-0001787-0","sofia lora","1521 ","5M","hpcs11","HP","190.16.11.16","3000","11","2019-10-1311:47:41","","1","2","1","1","","yes","yes"),
("54","Eligia","Rosso luciano","04:95:E6:54:71:F8","809-780-9476","","calle nuñez de caceres entrada por la iglesia frente al taller","por la entrada de la iglesia ebajenlica ","1500","2018-07-21","2019-10-25","","yes","097-0023739-0","CEP1A14@Eligia Rosso Luciano","1521 ","5M","","CC","190.16.11.17","3000","12","2019-10-1311:54:32","","1","2","1","1","","yes","yes"),
("55","juana","Varquiria Ovalles Martinet","04:95:E6:CA:DC:48","809-486-5007","","el cacao entrada al lado del colmado Rodriguez","al lado del colmado Rodriguez","1200","2018-05-18","2019-11-25","","no","001-1906916-9","MA51@Juana Valkiria Ovalles Martinez","1521 ","5M","","CC","190.16.11.18","3000","12","2019-10-1311:59:00","","1","2","1","1","","yes","yes"),
("56","Juan","Grend","C8:3A:35:A3:73:68","829-922-4714","","El Hospital hotel Sabana","Hotel Sabana El Hospital","1200","2018-06-05","2019-11-25","","no","066-0005808-2","HL4BJuan Grend ","1521 ","5M","hpl6b1","HP","190.16.11.19","3500","12","2019-10-1312:04:36","","1","2","1","1","","yes","yes"),
("57","Jose Simon","Flores ","C0:25:67:41:35:14","829-633-6805","849-865-6114","Come Pan Calle Bulevar Salon Maranata ","El Bulevar Salon MAratana","1300","2017-04-25","2019-11-25","","no","066-0014233-2","CPB12-Reina Elisa Mordan","1521 ","5M","","CP","190.16.11.20","3500","12","2019-10-1312:10:30","","1","2","1","1","","yes","yes"),
("58","Fauto","Javier Silven","50:0F:F5:81:6B:20","809-618-0833","","Come Pan Colmado Ronny","Colmado Ronny","1500","2017-06-08","2019-11-25","","no","402-2132628-9","cp7@Fauto javier","1521 ","5M","","CP","190.16.11.21","3000","12","2019-10-1312:16:23","","1","2","1","1","","yes","yes"),
("59","Juan Carlos ","Gomez","9C:D6:43:CF:0D:A1","809-229-4581","","Barrio fino","barrio fino","1200","2018-02-17","2019-11-25","","no","223-0045345-7","HPCS53@Juancarlo Gomez","1521 ","5M","","BF","190.16.11.22","3000","11","2019-10-1312:29:22","","1","2","1","1","","yes","yes"),
("60","Mayelin ","Alvarado","C0:A5:DD:1C:20:A7","809-857-3960","","El Hospital Hencima Colmado IMbe","Segunda Encima Colmado Embi","1000","2018-10-11","2019-10-25","","yes","","HPCS55@mayelin albarado","1521 ","3M","HPCS55","HP","190.16.11.23","3500","12","2019-10-1312:33:12","","1","2","1","1","","yes","yes"),
("61","Sunny Dominga","Florentino Mejia","C0:25:67:28:EB:00","809-836-0374","","El manantial","Salon Zuny al Final de la Calle","500","2017-06-09","2019-12-25","","no","060-016454-1","cp2a@dominga florentino mejia","1521 ","2M","","MDT","190.16.11.24","3000","11","2019-10-1312:36:29","0","1","2","1","1","","yes","yes"),
("62","Jose Osbaldo","Rodriguez","C0:25:67:32:C5:44","809-984-2229","","El Cacao Entrada Colmado Rodriguez","Entrada Colmado Rodruiguez","1500","2017-05-16","2019-11-25","","no","034-0001778-9","Jose Osbarlo Rodrigrez","1521 ","5M","","CC","190.16.11.25","3000","12","2019-10-1312:40:03","","1","2","1","1","","yes","yes"),
("63","Anabel","Marte","04:95:E6:54:33:E0","809-677-4925","","Come Pan SEgundo NIvel Al LAdo de LA Evanisteria","Encima de la Evanisteria","1000","2018-02-05","2019-11-25","","no","071-0063757-3","CP3A1Anabel Marte","1521 ","3M","CP3A1","CP","190.16.11.26","3500","12","2019-10-1312:43:21","","1","2","1","1","","yes","yes"),
("64","Olvis","Belen  Acosta","04:95:E6:54:42:98","829-716-7394","","","","1200","2019-01-16","2019-10-25","","no","402-1118914-3","MT52@Olbys Belen Acosta","1521 ","5M","","CP","190.16.11.27","3000","12","2019-10-1312:45:52","","1","2","1","1","","yes","yes"),
("65","Wanderly","Marte Feliz","C0:A5:DD:1C:11:4D","829-464-2912","","","El Cacao por los Apartamento Detras en los Apartamentos","1000","2019-04-04","2019-10-25","","yes","402-2488082-9","CEP112@Wanderly Marte.","1521 ","3M","CEP112","CC","190.16.11.28","3500","12","2019-10-1312:50:27","","1","2","1","1","","yes","yes"),
("66","Yesenia ","Garcia Herrera","C8:3A:35:A3:7A:B8","829-644-3047","","El Cacao Calle Elcilia Pepin Frente al Colmado Miguel","Calle Ercilia Pepin Frente al Colmado Miguel","1000","2017-12-08","2019-10-25","","no","402-3624105-1","CEP101@Yesenia Garcia Herrera.","1521 ","3M","","CC","190.16.11.29","3500","12","2019-10-1312:56:12","","1","2","1","1","","yes","yes"),
("67","Mercedes","Radney","04:95:E6:19:AC:40","829-8555-9527","829-221-15549","Come Pan Entrada Colmado de Ronngy","Entrada Colmado Ronny","1200","2018-12-08","2019-11-25","","no","001-1412342-5","CP2B3@Mercedes Radney","1521 ","5M","CP2B3","CP","190.16.11.30","3000","11","2019-10-1313:18:04","","1","2","1","1","","yes","yes"),
("68","Marino ","Gutierrez","C0:25:67:59:66:47","809-230-4661","","El Hospital Colmado Marino","Colmado Marino Pol la Entrada DEl Liceo","1500","2019-02-02","2019-12-25","","no","048-00215921-2","HPCS41@Marino Gutierre Collado","1521 ","5M","HPCS41","HP","190.16.11.31","3000","11","2019-10-1313:24:54","","1","2","1","1","","yes","yes"),
("69","Luis ","Miguel","C0:25:67:3A:22:34","849-356-5685","","Caño Seco Frente al Comedor","Frente al Comedor","1000","2017-09-09","2019-11-25","","no","071-0039783-0","CSCS62@Micher Guman","1521 ","3M","CSCS62","CSC","190.16.11.32","3000","11","2019-10-1313:41:25","","1","2","1","1","","yes","yes"),
("70","amor-Ana ","Julia","C0:25:67:31:FC:10","840-847-3589","","El Cacao Salon Amor","Salon Amor Frente ala Iglesia ","500","2017-05-08","2019-11-25","","no","135-0002763-0","CCNC31amor","1521 ","5M","CCNC41","CC","190.16.11.33","3500","11","2019-10-1313:45:24","","1","2","1","1","","yes","yes"),
("71","Ana  la Profe","Lidia Padilla","C0:25:67:41:4C:78","829-339-7357","809-749-4231","El Cacao Calle 16 Agosto","La Profe Frente al Colmado Camacho","800","2017-05-07","2019-10-25","","no","066-0014348-9","Ana","1521 ","5M","CEP51","CC","190.16.11.34","3500","11","2019-10-1314:03:14","","1","2","1","1","","yes","yes"),
("72","Enriqueta","Reinoso","CC:2D:21:3A:76:D0","829-558-8944","","Caño seco. Late-dar a la izquierda de la ferretería.","","1500","2018-03-08","2019-10-25","","yes","134-000056-2","CBCS1B@Enrriquesta Rernoso","1521 ","5M","CBCS1","CSC","190.16.11.35","3500","12","2019-10-1314:14:39","","1","1","1","1","","yes","yes"),
("73","Evelin Martinez","Maldonado","D8:32:14:CE:E6:98","829-715-61336","","El Cacao al Lado de la Iglesia Catolica","Al Lado de la Iglesia Catolica","1000","2019-09-21","2019-12-25","","no","402-3310256-1","CEP8A2@Evelyn Martinez Maldonado.","1521 ","3M","CEP82","CC","190.16.11.36","3000","12","2019-10-1314:23:13","","1","2","1","1","","yes","yes"),
("74","Maria ","Virgen Burgos","04:95:E6:54:40:48","829-527-2048","829-286-5596","El Hospital Callejon del Supermercado Lupez","El Hsoital por el Super de Lupez","1000","2018-08-09","2019-11-25","","no","134-0004481-7","PB91Maria Virgen Bulgos","1521 ","3M","HPCR1A1","HP","190.16.11.37","2200","12","2019-10-1314:35:14","","1","2","1","2","","yes","yes"),
("75","Virginia","Melendez","C0:A5:DD:1C:01:03","809-846-3960","","El Cacao Hotel el Cacao al lado","Al lado Hotel el Cacao","1500","2019-05-19","2019-12-25","","no","066-0017232-1","CEP4A1@Virginia Melendez","1521 ","5M","","CC","190.16.11.38","3000","12","2019-10-1314:42:17","","1","2","1","1","","yes","yes"),
("76","Alejandrina King","Kelly","CC:2D:21:3A:76:C8","809-978-5619","829-909-4912","El Cacao entrada Calle Duarte Ferreteria ","El Cacao entrada Calle Duarte Ferreteria ","1200","2019-03-13","2019-11-25","","no","065-0020425-7","CSCS6B2@Alejandrina king Kelly","1521 ","5M","","CC","190.16.11.39","3000","12","2019-10-1314:56:19","","1","2","1","1","","yes","yes"),
("77","Grabier","Vilgen","C0:25:67:41:3D:4C","809-240-6330","","Barrio Fino","Barrio Fino Encima Ferreteria Hermano Esteba","1700","2019-03-08","2019-11-25","","no","402-2669238-8","CD111@Grabier Vilgen","1521 ","10M","","BF","190.16.11.40","0","12","2019-10-1315:04:25","","1","2","1","1","","yes","yes"),
("78","Yerry","Castillo","C0:25:67:59:A6:2B","849-720-4033","","El Cacao en el Hotel RRJ Segundo Nivel","Segundo Nivel Hotel RRJ","800","2017-06-30","2019-11-25","","no","402-2452681-0","CEP123Yerriy Castillo","1521 ","3M","CEP121","CC","190.16.11.41","3000","12","2019-10-1315:11:42","","1","2","1","1","","yes","yes"),
("79","Daniel Albarado ","Durand","C0:25:67:20:E3:1C","809-958-7941","","Calle  Sanchez detrás del comedor ","Callejon del  Comedor ","1500","2017-05-07","2019-12-25","","no","402-3800864-9","daniel durant","1521 ","10M","HPCS51","HP","190.16.11.42","3500","11","2019-10-1315:56:52","0","1","2","1","1","","yes","yes"),
("80","Pedro Alfredo ","Padilla David ","CC:2D:21:3A:7A:78","829-907-3911","","El Pueblecito por  la  entrada  de  la tienda ","Por  la  entrada  de  los roperos","1000","2018-02-06","2019-12-15","","no","134-0004801-6","CP1Pedro Alfredo Padilla David","1521 ","3M","CP11","PBT","190.16.11.43","3000","11","2019-10-1316:09:53","0","1","2","1","1","","yes","yes"),
("81","Julian Alberto ","Merejildo Luna","CC:2D:21:3A:77:B0","829-923-0573","","El Cacao por la  entrada  frente  a  colmado  Camacho","Frente a  colmado  Camacho  ldo de la  Profesora  Ana","1000","2019-08-05","2019-12-25","","no","071-0026097-0","CEP53@Julian Alberto Merejildo Luna","1521 ","3M","CEP52","CC","190.16.11.44","3000","11","2019-10-1316:17:22","","1","2","1","1","","yes","yes"),
("82","Antonio Miguel ","Hernandez Vido","CC:2D:21:3A:77:10","829-589-5440","","Monte Adentro ","Monte Adentro ","1000","2018-07-09","2019-10-15","","no","134-0005358-5","MA3A1@Antonio Miguel Hernandez Bido.","1521 ","3M","MA3A1","MDT","190.16.11.45","3000","11","2019-10-1316:23:57","","1","2","1","1","","yes","yes"),
("83","Maria Altagracia","Andujal Garcias","C8:3A:35:36:85:50","809-865-5370","","bullebart monte andentro.","bullebart monte andentro.","1500","2018-03-14","2019-10-25","","yes","223-001-0399-5","MA61@Maria altagracias andujal garcias.","1521 ","5M","MT61","MDT","190.16.11.46","3500","12","2019-10-1316:30:49","","1","2","1","1","","yes","yes"),
("84","Luis Manuel","De Los Santos King","CC:2D:21:3A:77:00","8297271743","","Clle bullevar Monte Adentros serca de la bomba de gasolina","","1700","2019-03-06","2019-12-25","","no","402-2181497-9","CB11@Luis manuel de los santo","1521 ","10M","BC11","MDT","190.16.11.47","4500","12","2019-10-1316:36:31","","1","2","1","1","","yes","yes"),
("85","Rosa Elba","David","C0:25:67:22:45:04","8098473883","","Destra de la plaza padilla","","800","2018-03-09","2019-12-25","","no","066-0004588-1","CD2A1Rosa Erba David.","1521 ","2M","CD2A1","PBT","190.16.11.48","350","12","2019-10-1316:42:44","","1","1","1","1","","yes","yes"),
("86","Jacobo","Andujar Garcia","C0:25:67:28:CC:5C","8098480186","","El manantial caño seco","","1000","2017-06-08","2019-10-25","","no","066-0017431-9","cp8A@jacobo anduja garsia","1521 ","3M","MT2A1","EMT","190.16.11.49","3500","12","2019-10-1316:48:50","","1","2","1","1","","yes","yes"),
("87","Janiel David","Hernandez Beato","D8:32:14:89:49:C0","8099063749","","el cacao por la iglesias catolica.","","2000","2018-10-15","2019-12-25","","no","134-0005369-3","CCEP9A1Janiel David Hernandez Beato","1521 ","10M","CEP9A1","CC","190.16.11.50","350","12","2019-10-1321:57:15","","1","1","1","1","","yes","yes"),
("88","Jhakelis M.","Valdez Batista","D8:32:14:CE:E7:18","8097060550","","caño seco serca del hotel blut max","","800","2019-09-28","2019-11-25","","no","071-0048081-8","CSCS52@Jhakelis M. Valdez Batista","1521 ","3M","CSCS52","CSC","190.16.11.51","3500","12","2019-10-1322:12:56","","1","2","1","1","","yes","yes"),
("89","Cotorra Rosa Maria ","Garcia","C8:3A:35:9A:F6:E8","809-603-5400","","Calle ecilia pepin  ","El cacao segundo nivel  encima del centro medico ","500","2017-06-14","2019-11-25","","no","066-0006727-3","CEP22@Rosa Maria Garcia","1521 ","2M","Cep22","CC","190.16.11.52","3000","11","2019-10-2517:40:10","0","1","2","1","1","","yes","yes"),
("90","Andy","Ferreira","C0:A5:DD:1B:FD:25","8296858162","","Colmado frentes a la antenas de altice.","","1000","2019-09-09","2019-10-25","","yes","048-0109762-9","CEP32@Andy Colmado","1521 ","5M","CEP32","CC","190.16.11.53","3500","12","2019-10-2612:53:15","","1","2","1","1","","yes","yes"),
("91","Yori Francisco","Castillo","C0:25:67:59:77:53","829-979-0982","","El cacao entradas por la iglesia calle Nuñe de Cáceres","","1200","2019-04-17","2019-11-25","","no","402-3876986-9","CEP1A4@Fraile Catillo","1521 ","5M","CEP1A1","CC","190.16.11.54","3500","12","2019-10-2613:37:34","","1","2","1","1","","yes","yes"),
("92","00","00","C0:25:67:32:C3:94","00","00","00","","0","31-04-09","2020-01-01","","no","00","PRUEBA50","1521 "," ","00","CSC","190.16.11.55","0","12","2019-11-0116:28:32","","1","2","1","1","","yes","yes"),
("93","Isabel","Lora","C8:3A:35:A3:66:58","Oo","","El hospital","","0","2019-10-30","2022-07-05","","no","00","ISABER CASA","1521 ","10M","Hpcs4","HP","190.16.11.56","0","12","2019-11-0214:38:13","0","1","2","1","1","","",""),
("94","Alexis","Del Ormo","","8292824570","","Come pan , Alexi Braskel","Alexis Br@quer","800","2019-11-27","2019-11-25","","no","402 3607553 4","CP11@Alexis De ormo","1521 ","3M","Cp1","CP","190.16.11.57","3500","11","2019-11-0720:22:13","0","1","2","1","1","","yes","yes"),
("95","Prueba ","Prueba","","Prueba","","}rueba","","280","2019-10-01","2019-10-08","","retirado","Prueba","Prueba","1521 ","6M","Pruebas","CC","190.16.11.57","2666","12","2019-11-1011:56:55","","1","2","1","1","","yes","yes"),
("96","Prueba 1","Prueba 1","","829--453-7777","","Aquí ","Prueba ","800","2019-11-17","2020-12-01","","retirado","124-123345-1","Ahora ","1521 ","2M","Ahora ","BF","190.16.11.58","1000","11","2019-11-1012:11:35","","1","1","1","1","","yes","yes"),
("97","Prueba 2","Prueba 2","","1232343455","","","Publicidad ","0","2019-11-10","2019-11-11","","retirado","123-12345-1","Prueba 2","1521 ","2M","","BF","190.16.11.59","1888","11","2019-11-1012:15:37","","1","1","1","1","","yes","yes"),
("98"," Alexis","Del Ormo","","8292824570","","Come pan ","Lado izquierdo colmado en la mata de mango ","800","2019-06-06","2019-11-25","","no","402 3607553","Alexis come pan","1521 ","2M","Cp11","CP","190.16.11.60","3000","11","2019-11-1012:34:08","","1","2","1","1","","yes","yes"),
("99","Fabián","Castro Gabino","04:95:E6:11:9E:60","8293544673","","Puebrecito por los escalones","","800","2019-05-28","2019-12-15","","no","402-1127111-5","CSCS5B3@Fabian castro Gabino","1521 ","3M","Pb9","PBT","190.16.11.61","2000","12","2019-11-1016:18:38","","1","2","1","1","","yes","yes"),
("100","Jutina","García","C0:25:67:41:3B:50","8297621029","","Entrada por la ñaca","","600","2019-07-03","2019-11-25","","no","134-0000073-6","BCB@Jutina Garcia.","1521 ","2M","Bbc","ECHB","190.16.11.62","3500","12","2019-11-1017:45:13","","1","2","1","1","","yes","yes");
INSERT INTO clientesp VALUES
("101","Odelin ","Abestine","04:95:E6:11:93:00","8292636283","","Ante de llegar al hospital detrás de la banca loteka","","1000","2019-10-27","2019-11-25","","no","HD4080172","HPCL22@Odelin Abestine","1521 ","3M","HPCL22","HP","190.16.11.63","3500","12","2019-11-1115:23:47","","1","2","1","1","","yes","yes"),
("102","Melbelin ","Baltodomen ","C0:25:67:31:FC:14","8297041863","8296058201","Come pan al fondo por l@ iglesia haitiana","","1000","2019-11-13","2019-11-25","","no","134 000 4370-2","CP5@Merbelin Baltolome","1521 ","3M","Cp5","CP","190.16.11.64","3500","12","2019-11-1317:06:23","","1","2","1","1","","yes","yes"),
("103","Rafael ","Lora ","50:0F:F5:81:62:20","8497850342","","Restaurante el paimal ","","1000","2018-11-07","2019-11-25","","no","066-0016379-1","CC31Rafael Lora Garsia","1521 ","5M","CC21","CSC","190.16.11.65","3500","12","2019-11-2011:19:08","","1","2","1","1","","yes","yes"),
("104","Margarita ","García drullard ","50:0F:F5:81:52:70","829-534-2381","","Comé pan por la masa de mango al final","","800","2019-11-02","2031-06-12","","no","134-0005458-4","CP1A2@Margarita Garcia","1521 ","2M","CP1A2","CP","190.16.11.66","3500","12","2019-11-2014:42:35","","1","2","1","1","","yes","yes"),
("105","YoCarina ","Rodríguez ","D8:32:14:CE:FF:E0","809212-6966","","Come Pan, por la bajada. ","Ex-clientes AAA.","1000","2019-11-26","2019-12-25","","no","071-0057714-2","CP12@Yocarina Rodriguez","1521 ","5M","CP12","CP","190.16.11.67","3500","12","2019-11-2619:39:54","","1","1","1","1","","yes","yes");




CREATE TABLE `averias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;


INSERT INTO averias VALUES
("16","5755","2018-10-04","cable roto tiene 5 dias sin internet, vive en hato mayo calle 5 parte atras xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx","pendiente"),
("17","3902","2018-10-05","cajita mala","pendiente"),
("18","3902","2018-10-10","jmjh","pendiente");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;