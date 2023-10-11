-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Okt 12. 01:00
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `appworld_vizsga`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Hegedüs Cecília', 'hegeduscecilia@gmail.com', '$2y$10$ZFFeYHBty9Fq5yh6OdqA0.phazXGSaEK3O2BukqtM7uE3YemMjQUy');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cikkek`
--

CREATE TABLE `cikkek` (
  `id` int(11) NOT NULL,
  `cim` varchar(100) NOT NULL,
  `rovidismerteto` varchar(100) NOT NULL,
  `szerzo` varchar(100) NOT NULL,
  `tartalom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `cikkek`
--

INSERT INTO `cikkek` (`id`, `cim`, `rovidismerteto`, `szerzo`, `tartalom`) VALUES
(1, 'Túl nagy a szakadék az óvoda és az iskola között?', 'Ez egy teszt', 'Pusztai Krisztina', 'Unokaöcsém nagyon várta, hogy első osztályba mehessen, aztán hamar elmúlt a lelkesedése. Ő egyébként már majdnem 7 éves, tehát nem épphogy 6 évesen ült be a padba, mint sok másik gyerek. Pár héttel a sulikezdés után, amikor tőlem is megkapta a „hogy tetszik a suli?” kérdést, rávágta, hogy ő nem ilyennek képzelte az iskolát, vissza szeretne menni az óvodába.\r\n\r\nEzt elmeséltem Tóth Tímea gyógypedagógus, mozgásterapeuta ismerősömnek, aki korábban a nevelési tanácsadóban is dolgozott. Elkezdtünk beszélgetni, interjú lett belőle.\r\n\r\n Vajon miért múlik el sok elsősnél ilyen hamar a lelkesedés, lehet ennek köze ahhoz, hogy valaki hat vagy hét évesen kezdi az iskolát?\r\n\r\nÉn ezt nem a gyermek kora felől közelíteném meg, mert lehet egy 6 éves is érett arra, hogy tudjon figyelni, koncentrálni, és egy 7,5 évesnek is okozhat ez nehézséget, illetve a képességek alapján is lehetnek eltérések. Szerintem a gond az, hogy Magyarországon túl nagy a szakadék az óvoda és az iskola között.\r\n\r\n Ezt kifejtenéd?\r\n\r\nAmíg az óvodában játszik és szabadon mozog egy gyerek, és teszi ezt akár még augusztusban is, rá pár hétre már az iskolában kell ülnie. Nemcsak arról van szó, hogy a képességei alapján meg tud-e küzdeni a tanulással, hanem a bioritmusa is teljesen máshogy kell, hogy működjön.\r\n\r\nAz óvodában még délutáni alvás van, vagy legalábbis pihenő. Nagyon sokszor fél 12-kor ebédelnek, délben, negyed egykor már veszik elő a kiságyakat. Pár hét múlva pedig ugyanabban az időben még tart a negyedik vagy az ötödik órájuk.\r\n\r\nEz nagyon éles váltásnak tűnik.\r\n\r\nMert szerintem az is, persze vannak iskolák, ahol figyelnek arra, hogy legyen átmenet, de sok helyen nem. Tudok olyan intézményről, ahol már szeptember közepén össze kellett olvasniuk a gyerekeknek két betűt. A frontális oktatás-ami a legtöbb magyar iskolákban zajlik-nem segíti a kicsiket, hanem inkább hátráltatja.\r\n\r\n Ezt a tempót egy nagyon jó képességű gyereknek is nehéz tartani. Mi van a többiekkel?\r\n\r\nIgen. Az óvodapedagógusokon a nyomás, hogy készítsék fel a gyerekeket az iskolára, miközben egyre több az olyan gyermek, aki különleges figyelmet igényel. Nemcsak azok, akiknek van valamilyen diagnózisuk: SNI (speciális nevelési igényű) vagy mondjuk BTMN (beilleszkedési, tanulási, magatartási nehézséggel küzdő) hanem vannak olyanok is, akik nagyon sok energiát igényelnek.\r\n\r\nNincsen olyan óvodai csoport, és éppen ezért nem lesz olyan iskolai osztály sem, ahol nincsenek valamilyen nehézséggel küzdő gyerekek, és erre nagyon sok energia megy el. Közben pedig az a feladat, hogy a gyerekek ugyanolyan szintre fejlődjenek fel.\r\n\r\n Mondanál példát hogyan ütközhet ki, ha valakinek van valamilyen nehézsége?\r\n\r\nPéldául, ha azt mondja a tanár, hogy \"vegyétek elő a munkafüzetet, és nyissátok ki az ötödik oldalon, és a bal felső ábrával fogunk most foglalkozni\", akkor ez egy nagyon egyszerűnek tűnő mondat, gyorsan elhadarja, de ebben a mondatban számtalan buktató lehet.\r\n\r\nGondoljunk bele! Ha nem tudja végrehajtani az elsős miért nem tudta? A bal és a jobb közötti különbség okozott gondot? Nem tudja, hol van a felül, vagyis a tériránnyal van probléma? Vagy a hallási emlékezete nem megfelelő? Túl sok volt az információ egy feladatban? Tehát, olyan sok mindenen elbukhat egy ilyen utasítás alatt is, és ez csak egy példa volt.\r\n\r\n Mi lenne a megoldás?\r\n\r\nSzerintem az, ha megváltoztatnák az oktatási módszereket. Nem lehet 35 gyereket ugyanarra a tananyagra ugyanannyi idő alatt, ugyanolyan szinten megtanítani. Csak a változtatással tudnák a különbségeket elsimítani.\r\n\r\nMinden gyerek más egyéniség, más képességekkel, tehát nem is kellene, hogy ők teljesen ugyanazt tudják, nem szabad letörni a személyiségüket, de nyilván van egy alap elvárás, tanuljon meg olvasni, írni, számolni. Csoportmunkával,kooperatív tanulással, projekt munkával, differenciálassal nagyon jól lehetne ezt kezelni.\r\n\r\nEz nem azt jelenti, hogy 35 felé teljesen más feladatot adna ki a tanár, ezt lehetetlen lenne megoldani. Azonban az, hogy mondjuk három-négy felé dolgozzanak a gyerekek, már működőképes lenne. Kétségkívül nem könnyű a pedagógusoknak, hiszen nagy a feszültség jelenleg a szakmában, közben pedig a tanároknak kezelniük kell a gyerekek közötti eltéréseket. Mindenkinek különböző a képességprofilja.\r\n\r\n És az óvoda és az iskola közötti különbséget hogyan lehetne csökkenteni?\r\n\r\nKözelíteni kell, kellene egymáshoz az óvodát és az iskolát. Akár egy előkészítő évfolyamot is lehetne indítani. Ezt viszont csak olyan esetben lehet megvalósítani, ha ott az iskolában, az iskola épületében, olyan osztálytermekben történne ez a nulladik évfolyam, ami még hasonlít az óvodára. Ebből az előkészítő osztályból pedig egy olyan iskolai első osztályba kerülnének be a gyerekek, ahol nem a szokásos frontális módszerekkel történik az oktatás, hanem már az említett szisztéma szerint.\r\n\r\nLenne helye és ideje a játéknak, akkor ebédelnének, amikor az óvodában szoktak, járna a pihenőidő, lenne mesesarok, a tanórákat nem úgy szerveznék, mint egy iskolában, hanem inkább ovis módon. Persze közben fokozatosan hozzászoktatnák őket ahhoz, hogy mindenkinek ott kell lenni, figyelni kell, de lehetne ott egy trambulin, gyakrabban mehetnének ki a levegőre. Tehát vegyíteni kellene az óvodát az iskolával.\r\n\r\n Az, hogy ez a legtöbb magyar iskolában így legyen mennyire tűnik elérhetetlennek?\r\n\r\nEz nyilván nagyon nagy előkészítést igényelne, és a mai magyar iskolarendszerben megvalósíthatatlannak látom, de mint ötlet, nem tartom rossznak.\r\n\r\n Hogyan segíthetik a szülők a gyerekeket, abban, hogy könnyebb legyen nekik az óvoda és az iskola közötti váltás?\r\n\r\nA legfontosabb, hogy a pihenést, a játékot és a mozgást tegyék lehetővé nekik az iskola után, megértéssel forduljanak feléjük, folyamatosan kommunikáljanak velük és a pedagógussal is.');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `cikkek`
--
ALTER TABLE `cikkek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `cikkek`
--
ALTER TABLE `cikkek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
