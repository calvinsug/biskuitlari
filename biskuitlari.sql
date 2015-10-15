-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2014 pada 15.46
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `biskuitlari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `msmember`
--

CREATE TABLE IF NOT EXISTS `msmember` (
  `Memberid` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` varchar(30) DEFAULT NULL,
  `LastLogin` datetime DEFAULT NULL,
  PRIMARY KEY (`Memberid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `msmember`
--

INSERT INTO `msmember` (`Memberid`, `Username`, `Password`, `Status`, `LastLogin`) VALUES
(1, 'calv', '62911ad86d6181442022683afb480067', 'player', '2014-06-17 15:04:18'),
(2, 'qwe4', '805bbf75b0741860d860dac3dad9ca49', 'admin', '2014-06-17 14:37:44'),
(3, 'qweqwe', '76d80224611fc919a5d54f0ff9fba446', 'player', '2014-06-11 09:35:46'),
(4, 'vengeance', '363667b9801b8a48e898a0795359a712', 'player', '2014-06-17 14:13:52'),
(5, 'jojon', '7b0469ea98b01e2323d2201e90dd67bf', 'player', '2014-06-17 14:19:01'),
(6, 'venggeance', '363667b9801b8a48e898a0795359a712', 'player', '2014-06-17 14:30:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `msmembercontact`
--

CREATE TABLE IF NOT EXISTS `msmembercontact` (
  `Memberid` int(11) NOT NULL AUTO_INCREMENT,
  `Address` varchar(200) DEFAULT NULL,
  `Phone` varchar(40) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Memberid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `msmembercontact`
--

INSERT INTO `msmembercontact` (`Memberid`, `Address`, `Phone`, `Email`) VALUES
(1, 'rawarawa', '123411', 'calsug@cal.com'),
(2, 'qweqwe', 'qweqwe', '123'),
(3, '', '', ''),
(4, '', '', 'venge@qw.com'),
(5, '', '', 'jojon@j.com'),
(6, 'vengeeee', '', 'venge@v.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `msmemberprofile`
--

CREATE TABLE IF NOT EXISTS `msmemberprofile` (
  `Memberid` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `RegisterDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Memberid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `msmemberprofile`
--

INSERT INTO `msmemberprofile` (`Memberid`, `Username`, `Fullname`, `DateOfBirth`, `RegisterDate`) VALUES
(1, 'calv', 'calvin sugianto', '1992-11-09', '2014-06-11 00:00:00'),
(2, 'qwe4', 'calsingu', '1997-02-17', '2014-06-11 09:14:21'),
(3, 'qweqwe', '', '1970-01-01', '2014-06-11 09:35:46'),
(4, 'vengeance', 'vevevee', '2008-01-03', '2014-06-17 14:13:52'),
(5, 'jojon', 'jojon', '1999-11-02', '2014-06-17 14:19:01'),
(6, 'venggeance', 'venge', '1999-10-09', '2014-06-17 14:30:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trscore`
--

CREATE TABLE IF NOT EXISTS `trscore` (
  `ScoreID` int(11) NOT NULL AUTO_INCREMENT,
  `Memberid` int(11) NOT NULL,
  `Score` int(11) DEFAULT NULL,
  `IsHighScore` varchar(20) DEFAULT NULL,
  `PlayTime` time DEFAULT NULL,
  PRIMARY KEY (`ScoreID`),
  KEY `Memberid` (`Memberid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `trscore`
--

INSERT INTO `trscore` (`ScoreID`, `Memberid`, `Score`, `IsHighScore`, `PlayTime`) VALUES
(1, 1, 621, 'yes', '00:01:00'),
(2, 2, 0, 'no', '00:00:00'),
(3, 4, 300, 'no', '00:02:31'),
(4, 5, 0, 'no', '00:00:00'),
(5, 6, 0, 'no', '00:00:00');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `msmembercontact`
--
ALTER TABLE `msmembercontact`
  ADD CONSTRAINT `msmembercontact_ibfk_1` FOREIGN KEY (`Memberid`) REFERENCES `msmemberprofile` (`Memberid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `msmemberprofile`
--
ALTER TABLE `msmemberprofile`
  ADD CONSTRAINT `msmemberprofile_ibfk_1` FOREIGN KEY (`Memberid`) REFERENCES `msmember` (`Memberid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `trscore`
--
ALTER TABLE `trscore`
  ADD CONSTRAINT `trscore_ibfk_1` FOREIGN KEY (`Memberid`) REFERENCES `msmember` (`Memberid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
