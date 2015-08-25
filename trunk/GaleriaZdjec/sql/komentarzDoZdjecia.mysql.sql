-- phpMyAdmin SQL Dump
-- version 2.6.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Czas wygenerowania: 13 Lis 2005, 13:19
-- Wersja serwera: 3.23.58
-- Wersja PHP: 4.3.9

-- SET AUTOCOMMIT=0;
-- START TRANSACTION;

-- 
-- --------------------------------------------------------

-- 
-- Struktura tabeli dla  `komentarzdozdjecia`
-- 

DROP TABLE IF EXISTS `komentarzDoZdjecia`;
CREATE TABLE `komentarzDoZdjecia` (
  `numerKomentarza` int(11) NOT NULL auto_increment,
  `katalog` text NOT NULL,
  `nazwaPlikuZdjecia` varchar(255) NOT NULL,
  `podpis` varchar(255) default NULL,
  `tresc` text NOT NULL,
  `jestOpisem` tinyint NOT NULL default 0,
  `data` datetime NOT NULL,
  `wyswietlany` tinyint NOT NULL default 1,
  PRIMARY KEY  (`numerKomentarza`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Zrzut danych tabeli `komentarzaDoZdjecia`
-- 

INSERT INTO `komentarzDoZdjecia` VALUES (1, 'images/051029 sprzatanie grobow', 'PICT0064.JPG', 'haha', 'opis1', 0, '2005-11-13 00:00:00', 1);
INSERT INTO `komentarzDoZdjecia` VALUES (2, 'images/051029 sprzatanie grobow', 'PICT0064.JPG', 'd', 'dsf', 0, '2005-11-13 00:00:00', 1);
INSERT INTO `komentarzDoZdjecia` VALUES (4, 'images/051029 sprzatanie grobow', 'PICT0064.JPG', '', 'Ale grabie!', 1, '2005-11-13 00:00:00', 1);

-- COMMIT;
