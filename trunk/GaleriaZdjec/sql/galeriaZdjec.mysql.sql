-- phpMyAdmin SQL Dump
-- version 2.6.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Czas wygenerowania: 13 Lis 2005, 16:17
-- Wersja serwera: 3.23.58
-- Wersja PHP: 4.3.9
-- 
-- --------------------------------------------------------

-- 
-- Struktura tabeli dla  `galeriazdjec`
-- 

DROP TABLE IF EXISTS `galeriaZdjec`;
CREATE TABLE `galeriaZdjec` (
  `idGalerii` varchar(255) NOT NULL,
  `katalog` text NOT NULL,
  `tytulGalerii` varchar(255) NOT NULL,
  `data` date NOT NULL default '0000-00-00',
  `opisGalerii` text,
  `sposobPrzechowywaniaKomentarzy` varchar(255) NOT NULL,
  `dataUtworzenia` date NOT NULL default '0000-00-00',
  `nowa` tinyint NOT NULL default 0,
  `prawieNowa` tinyint NOT NULL default 0,
  PRIMARY KEY  (`idGalerii`)
) TYPE=MyISAM;
