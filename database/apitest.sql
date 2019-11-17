CREATE TABLE IF NOT EXISTS `News` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ParticipantId` int(11) NOT NULL,
  `NewsTitle` varchar(255) NOT NULL,
  `NewsMessage` text NOT NULL,
  `LikesCounter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `News` (`ID`, `ParticipantId`, `NewsTitle`, `NewsMessage`, `LikesCounter`) VALUES
(1, 1, 'New agenda!', 'Please visit our site!', 0),
(2, 2, 'New agenda!', 'Please visit our site!', 0),
(3, 3, 'New agenda!', 'Please visit our site!', 0),
(4, 1, 'New agenda!', 'Please visit our site!', 0),
(5, 2, 'New agenda!', 'Please visit our site!', 0),
(6, 3, 'New agenda!', 'Please visit our site!', 0),
(7, 1, 'New agenda!', 'Please visit our site!', 0);

CREATE TABLE IF NOT EXISTS `Participant` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `Participant` (`ID`, `Email`, `Name`) VALUES
(1, 'airmail@code-pilots.com', 'The first user'),
(2, 'participant@gmail.com', 'The second user'),
(3, 'alexey-ringo@gmail.com', 'The third user');

CREATE TABLE IF NOT EXISTS `Session` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `TimeOfEvent` datetime NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `Session` (`ID`, `Name`, `TimeOfEvent`, `Description`) VALUES
(1, 'Annual report 1', '2016-12-15 16:00:00', 'Anuual report by CEO'),
(2, 'Annual report 2', '2016-12-15 16:00:00', 'Anuual report by CEO'),
(3, 'Annual report 3', '2016-12-15 16:00:00', 'Anuual report by CEO');

CREATE TABLE IF NOT EXISTS `Speaker` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SessionID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `Speaker` (`ID`, `SessionID`, `Name`) VALUES
(1, 1, 'Watson'),
(2, 1, 'Arnold'),
(3, 2, 'Steve'),
(4, 2, 'David'),
(5, 3, 'John'),
(6, 3, 'Bill');

CREATE TABLE IF NOT EXISTS `Subscribe` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SessionID` int(11) NOT NULL,
  `SubscribeID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;