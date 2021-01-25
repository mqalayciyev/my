-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 13 Oca 2021, 13:36:17
-- Sunucu sürümü: 8.0.21
-- PHP Sürümü: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `zaqatalapfk`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `about`
--

DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rotate` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `about`
--

INSERT INTO `about` (`id`, `rotate`, `text`, `image`, `status`) VALUES
(2, '180deg', 'Zaqatala Peşəkar Futbol Klubu — Zaqatala rayonuna təmsil edir. Azərbaycan Birinci Divizionunda çıxış edən klublardan biridir. Klub 2015-ci ildə yaradılmışdır. Zaqatala Futbol Klubu ilkin olaraq Uniceff U-13, U-16, U-19 Qızlar liqasında Zaqatalanı təmsil edən komandaların bazasında yaradılıb. Məqsəd bu komandaların Azərbaycan çempionatında daha səmərəli fəaliyyətinə kömək etməkdir. Artıq Fan klubda yaradılmışdır. 2015-ci ildən etibarən oğlanlardan ibarət əsas komanda fəaliyyət göstərir.', 'img2.jpeg', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `status`) VALUES
(1, 'admin', 'qalayciyev@gmail.com', '123456', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `coming_games`
--

DROP TABLE IF EXISTS `coming_games`;
CREATE TABLE IF NOT EXISTS `coming_games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `liqa` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `stadium` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gorus` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `tarix` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `team_1` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `team_1_logo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `team_2` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `team_2_logo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ofis` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `stadium` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `map` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `facebook` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `instagram` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `twitter` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `youtube` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `contact`
--

INSERT INTO `contact` (`id`, `ofis`, `stadium`, `email`, `map`, `facebook`, `instagram`, `twitter`, `youtube`) VALUES
(1, 'Zaqatala şəhəri', 'Zaqatala şəhəri Qaladüzü meydanı', 'info@zaqatalapfk.az', 'https://maps.google.com/maps?q=zaqatala%20seher%20stadionu&t=&z=13&ie=UTF8&iwloc=&output=embed', 'https://www.facebook.com/ZaqatalaFK', 'https://www.instagram.com/zagatalafc/', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `developer`
--

DROP TABLE IF EXISTS `developer`;
CREATE TABLE IF NOT EXISTS `developer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad_soyad` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `instagram` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `facebook` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `youtube` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `site` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galeri`
--

DROP TABLE IF EXISTS `galeri`;
CREATE TABLE IF NOT EXISTS `galeri` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `video` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tarix` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `galeri`
--

INSERT INTO `galeri` (`id`, `image`, `video`, `tarix`, `status`) VALUES
(1, 'img1.jpeg', '', '2021-01-06 21:05:03', 1),
(2, 'img2.jpeg', '', '2021-01-06 21:08:59', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `liqa` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tarix` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gorus` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `stadium` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `team_1` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `team_1_logo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `team_1_qol` int NOT NULL,
  `team_2` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `team_2_logo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `team_2_qol` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `header`
--

DROP TABLE IF EXISTS `header`;
CREATE TABLE IF NOT EXISTS `header` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `home`
--

DROP TABLE IF EXISTS `home`;
CREATE TABLE IF NOT EXISTS `home` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `home`
--

INSERT INTO `home` (`id`, `kategori`, `image`, `status`) VALUES
(1, 'fotoalbom', 'img1.jpeg', 0),
(2, 'fotoalbom', 'img2.jpeg', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mail`
--

DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad_sayod` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `tarix` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `basliq` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `etiket` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `metn` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `tarix` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `baxis` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `news`
--

INSERT INTO `news` (`id`, `basliq`, `etiket`, `metn`, `image`, `tarix`, `baxis`, `status`) VALUES
(14, 'Onsuz da, “Zaqatala” hər mövsüm əziyyət çəkirdi', 'Futbol', '“Bütün komandalar kimi, biz də sentyabrın əvvəlindən bir araya gəlmişik“.\r\n\r\nSportinfo.az xəbər verir ki, bu sözlər “Zaqatala“nın baş məşqçisi Rüstəm Məmmədova məxsusdur.\r\n\r\nI Divizion təmsilçisinin çalışdırıcı bildirib ki, toplanışın ilk iki həftəsində daha çox seleksiyaya diqqət ayırıblar: “Tətbiq olunan limit bizə çox çətinlik yaradır.\r\n\r\n“Zaqatala”nın U-19 komandası olmadığından U-17-dən bəzi oyunçuları sıralarımıza dəvət etdik. Baxışa gələnləri də sınaqdan keçirdik. Artıq heyəti koplektləşdirmişik.\r\n\r\nBu günə kimi yalnız bir yoxlama görüşü keçirmişik. “Qəbələ” ilə qarşılaşmışıq. Əslində, həmin oyunu heç sınaq matçı da adlandırmaq düz olmaz. Çünki biz U-19 komandası ilə oynamaq istəyirdik.\r\n\r\nAncaq həmin vaxt “Qəbələ”nin həmin yaş qrupunun əksər üzvləri yığmanın toplanışına yollandığından bizə qarşı 16-17 yaşlı uşaqlar oynadı. Təbii ki, bu da istənilən effekti vermədi.\r\n\r\nZaqatala bir qədər uzaq bölgə olduğundan yoxlama görüşü üçün rəqib tapmaqda çətinlik çəkirik. Əvvəlki illərdə bu boşluğu Gürcüstan komandalarının sayəsində aradan qaldıra bilirdik.\r\n\r\nHər il qonşu ölkənin güclülər dəstəsində çıxış edən kollektivlərlə üz-üzə gəlirdik. Ancaq bu il pandemiya səbəbindən sərhədlər bağlı olduğundan ora yollana bilmədik. Əvəzində tez-tez ikitərəfli oyunlar keçirirdik.\r\n\r\nBəli, hazırlıq dönəmində bir yoxlama görüşü keçirmək çox azdır. Ancaq başqa çarəmiz yoxdu. Onsuz da, “Zaqatala” hər il mövsümün əvvəlində 3-4 tur əziyyət çəkir. Sonradan formaya düşərək oyunumuzu tapırıq. Yəqin bu il də eyni aqibəti yaşayacağıq. Məqsədimiz mükafatçılar sırasında yer almaqdır”.', 'img4.jpg', '2021-01-11 12:18:51', 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `news_media`
--

DROP TABLE IF EXISTS `news_media`;
CREATE TABLE IF NOT EXISTS `news_media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `news` int NOT NULL,
  `media` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `news` (`news`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `news_media`
--

INSERT INTO `news_media` (`id`, `news`, `media`, `type`, `status`) VALUES
(46, 14, 'img2.jpg', 'image', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stadium`
--

DROP TABLE IF EXISTS `stadium`;
CREATE TABLE IF NOT EXISTS `stadium` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `stadium`
--

INSERT INTO `stadium` (`id`, `image`, `text`, `status`) VALUES
(1, 'img1.jpeg', 'Çoxfunksiyalı stadion Zaqatala şəhərinin Qaladüzü ərazisində 2,3 hektar sahədə, tam yararsız vəziyyətə düşmüş keçmiş şəhər stadionunun yerində tikilmişdir. Stadionun işçi layihə sənədləri \"General Constuctions\" şirkətinin sifarişi ilə Bolqarıstanın \"Dyanamic Resorse\" şirkətinin mütəxəssisləri tərəfindən hazırlanmışdır. İnşaat işləri baş podratçı Xəzər Gənclərin Elmi–Texniki Yaradıcılıq Mərkəzi tərəfindən yerinə yetirilmişdir. Yerli və xarici subpodratçı şirkətlərin də iştirak etdikləri tikinti işlərinə 2006–cı ildə başlanılmış və 2008–ci ilin avqustunda başa çatdırılmışdır. Kompleksin tikintisinə 10 milyon manat vəsait xərclənmişdir. Çox da böyük olmayan ərazidə UEFA–nın tələblərinə uyğun olaraq, beynəlxalq səviyyəli oyunların keçirilməsi üçün 3500 yerlik, o cümlədən xüsusi qonaqlar üçün 181 yerlik birtərəfli tribunalar, ölçüləri 105×68 metr olan süni örtüklü əsas oyun, təbii örtüklü məşq meydançaları, müasir işıqlandırma qurğuları, elektron suvarma sistemləri, drenaj, yüngül atletika üçün qaçış yolları, elektron məlumat tablosu, əlillər üçün rampa və sanitariya qovşağı, biletlərin satış kassaları və yanğınsöndürmə maşınları üçün meydança, 300 kubmetrlik ehtiyat su anbarı, nasosxana və fərdi qazanxana tikilib istifadəyə verilmişdir. Kompleksin birinci mərtəbəsi yalnız komandalar, həkimlər və məşqçilər üçün nəzərdə tutulmuşdur. Burada hər bir komanda üçün soyunub–geyinmə otaqları, sanitariya qovşaqları, masaj, həkim otaqları, dopinq laboratoriyası və jurnalistlər üçün otaq vardır. İkinci mərtəbədə internet–kafe, bar, xüsusi qonaqlar üçün kafe, üçüncü mərtəbədə isə jurnalistlər üçün lojalar, şərhçi otaqları yerləşir.', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomre` int DEFAULT NULL,
  `avatar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'avatar.png',
  `movqe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Azərbaycan',
  `instagram` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitter` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `youtube` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `team`
--

INSERT INTO `team` (`id`, `name`, `nomre`, `avatar`, `movqe`, `date`, `country`, `instagram`, `facebook`, `twitter`, `youtube`, `status`) VALUES
(1, 'İsrail Həmzəyev', 0, 'İsrail Həmzəyev.jpeg', 'admin', '2021-01-13', 'Azerbaycan', 'İnstagram', 'Faceboook', 'Twitter', 'Youtube', 1),
(3, 'Roini İsmayılov', 8, 'Roini İsmayılov.jpeg', 'midfielder', '2021-01-13', 'Azerbaycanə', 'İnstagram', 'Faceboook', 'Twitter', 'Youtube', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `team_media`
--

DROP TABLE IF EXISTS `team_media`;
CREATE TABLE IF NOT EXISTS `team_media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `team` int NOT NULL,
  `media` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `team` (`team`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `turnir`
--

DROP TABLE IF EXISTS `turnir`;
CREATE TABLE IF NOT EXISTS `turnir` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `turnir`
--

INSERT INTO `turnir` (`id`, `url`, `status`) VALUES
(1, 'http://www.pfl.az/table/2', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `zaqatalatv`
--

DROP TABLE IF EXISTS `zaqatalatv`;
CREATE TABLE IF NOT EXISTS `zaqatalatv` (
  `id` int NOT NULL AUTO_INCREMENT,
  `video` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `zaqatalatv`
--

INSERT INTO `zaqatalatv` (`id`, `video`, `date`, `status`) VALUES
(1, 'video1.mp4', '2021-01-06 20:36:24', 1);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `news_media`
--
ALTER TABLE `news_media`
  ADD CONSTRAINT `news_media_ibfk_1` FOREIGN KEY (`news`) REFERENCES `news` (`id`);

--
-- Tablo kısıtlamaları `team_media`
--
ALTER TABLE `team_media`
  ADD CONSTRAINT `team_media_ibfk_1` FOREIGN KEY (`team`) REFERENCES `team` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
