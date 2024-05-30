USE master;
IF DB_ID(N'IBTProject') IS NULL
CREATE DATABASE IBTProject;
--drop database IBTProject
Go
USE [IBTProject]
IF OBJECT_ID(N'Books', N'U') IS NULL
Create Table Books(
	Id int NOT NULL PRIMARY KEY IDENTITY(1, 1),
	BookName varchar(max) NOT NULL,
	Price money NOT NULL,
	ShortDescription varchar(max),
	FullDecription varchar(max),
	AmmountInStorage int NOT NULL,
	AmmountSold int
);

IF OBJECT_ID(N'Purchase', N'U') IS NULL
Create Table Purchase(
	Id int NOT NULL PRIMARY KEY IDENTITY(1, 1),
	BookId int NOT NULL,
	ClientName int NOT NULL,
	CardNumber varchar NOT NULL,
	ExpiryDate varchar NOT NULL,
	CVV varchar NOT NULL
);

IF OBJECT_ID(N'Reviews', N'U') IS NULL
Create Table Reviews(
	Id int NOT NULL PRIMARY KEY IDENTITY(1, 1),
	BookId int NOT NULL,
	ReviewerName varchar NOT NULL,
	ReviewText varchar NOT NULL
);

IF OBJECT_ID(N'Users', N'U') IS NULL
Create Table Users(
	Id int NOT NULL PRIMARY KEY IDENTITY(1, 1),
	UserType varchar NOT NULL,
	UserName varchar NOT NULL,
	[Password] varchar NOT NULL
);


IF NOT EXISTS ( SELECT  name
                FROM    sys.foreign_keys
                WHERE   name = 'fk_bookid' )
ALTER TABLE Purchase
ADD CONSTRAINT fk_bookid FOREIGN KEY (BookID) REFERENCES Books(Id)

IF NOT EXISTS ( SELECT  name
                FROM    sys.foreign_keys
                WHERE   name = 'fk_bookid' )
ALTER TABLE Reviews
ADD CONSTRAINT fk_bookid FOREIGN KEY (BookID) REFERENCES Books(Id)

SET ANSI_WARNINGS OFF;
IF (SELECT TOP 1 1 FROM Books) IS NULL
BEGIN
	INSERT INTO Books (BookName, Price, ShortDescription, FullDecription, AmmountInStorage, AmmountSold)
	SELECT 'And Then There Were None', 14.00, 'And Then There Were None is a mystery novel by Agatha Christie written in 1939',
	'And Then There Were None by Agatha Christie is a classic mystery novel where ten strangers are invited to a remote island under different pretexts. They soon discover that their host is absent, and they are trapped. One by one, they are murdered in a manner that parallels a nursery rhyme, and the survivors must figure out who among them is the killer before it''''s too late.',
	10, 0
	UNION SELECT ALL 'Chernobilska Molitva', 15.00, 'Chernobilska Molitva by Svetlana Alexievich is a poignant oral history of the Chernobyl nuclear disaster.',
	'Chernobilska Molitva by Svetlana Alexievich is a poignant oral history of the Chernobyl nuclear disaster. The book compiles personal testimonies from survivors, firefighters, soldiers, and their families, revealing the profound human and environmental impact of the catastrophe. Through these intimate and harrowing stories, Alexievich explores the emotional and psychological aftermath of the disaster, offering a powerful reflection on suffering, resilience, and the human condition.',
	15, 3
	UNION SELECT ALL 'I, Claudius', 10.50, 'I, Claudius by Robert Graves is a historical novel presented as the autobiography of Roman Emperor Claudius.',
	'I, Claudius by Robert Graves is a historical novel presented as the autobiography of Roman Emperor Claudius. It chronicles his life from childhood through his unexpected ascension to the throne. The novel explores the political intrigue, corruption, and power struggles of the Roman Empire, offering a vivid portrayal of its most infamous rulers and events through the eyes of the often overlooked and underestimated Claudius.',
	5, 1
	UNION SELECT ALL 'The Omen', 12.50, 'The Omen by David Seltzer is a horror novel about an American diplomat, who unknowingly adopts the Antichrist',
	'The Omen by David Seltzer is a horror novel about an American diplomat, Robert Thorn, who unknowingly adopts the Antichrist, Damien, after his own child is stillborn. As Damien grows, a series of mysterious and violent deaths occur around him, leading Robert to a horrifying revelation about his son''''s true identity. The novel delves into themes of prophecy, fate, and the battle between good and evil.',
	0, 12
	UNION SELECT ALL 'Vreme Razdelno', 18, 'Vreme Razdelno by Anton Donchev is a historical novel set in 17th century Bulgaria during the Ottoman rule.',
	'Vreme Razdelno by Anton Donchev is a historical novel set in 17th century Bulgaria during the Ottoman rule. The story centers on the forced Islamization of the Bulgarian Christian population, depicting the cultural and religious struggles, resistance, and suffering of the people. Through vivid storytelling and rich historical context, Donchev explores themes of identity, faith, and survival.',
	6, 2
END;
SET ANSI_WARNINGS OFF;

SELECT * FROM Books