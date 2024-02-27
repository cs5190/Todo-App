CREATE DATABASE TODO2024;

USE TODO2024;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `userId` int NOT NULL,
  `taskId` int NOT NULL,
  `label` varchar(30) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `isArchived` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`taskId`),
  KEY `userId` (`userId`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
