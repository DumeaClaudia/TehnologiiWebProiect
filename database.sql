CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- drop table questions;

CREATE TABLE IF NOT EXISTS `questions`(
	`questionId` int(11) NOT NULL AUTO_INCREMENT,
    `questionImage` varchar(255) NOT NULL,
	`answer1` varchar(100) NOT NULL,
	`answer2` varchar(100) NOT NULL,
	`answer3` varchar(100) NOT NULL,
	`answer4` varchar(100) NOT NULL,
    `answerCorrect` int(2) NOT NULL,
	PRIMARY KEY (`questionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `answers`(
	`userId` int(11) NOT NULL,
    `answer` int(2) NOT NULL,
    `questionId` int(11) NOT NULL,
    FOREIGN KEY (`questionId`) REFERENCES questions(questionId),
	FOREIGN KEY (`userId`) REFERENCES users(userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

INSERT INTO questions (questionImage , answer1, answer2, answer3, answer4, answerCorrect) 
VALUES('BenedictCumberbatch.jpg', 'Denedict Cumberbatch', 'Benedict Cumberbatsh', 'Benedict Cumberbatck', 'Benedict Cumberbatch', 4);



INSERT INTO questions (questionImage , answer1, answer2, answer3, answer4, answerCorrect) 
VALUES('GuyPearce.jpg', 'Guy Pearcee', 'Guy Peace', 'Guy Pearce', 'Guy Peearce', 3);



INSERT INTO questions (questionImage , answer1, answer2, answer3, answer4, answerCorrect) 
VALUES('Kevin Spacey.jpg', 'Kevin Spacey', 'Kevin Spacey', 'Kevin Spacey', 'Kevin Spacey', 1);



INSERT INTO questions (questionImage , answer1, answer2, answer3, answer4, answerCorrect) 
VALUES('Nicole Kidman.jpg', 'Nicole Kidman', 'Nicole Kidman', 'Nicole Kidman', 'Nicole Kidman', 4);

INSERT INTO answers (userId, answer, questionId) VALUES(1, 2, 4);

INSERT INTO answers (userId, answer, questionId) VALUES(1, 3, 3);

INSERT INTO answers (userId, answer, questionId) VALUES(1, 1, 2);



-- punctaj pentru user1
SELECT count(*) 
from answers as a
join questions as q
on a.questionid = q.questionId
WHERE a.userId = 1 and a.answer = q.answerCorrect;

-- punctaj toti userii
SELECT userId, count(*) as points
from answers as a
join questions as q
on a.questionid = q.questionId
WHERE a.answer = q.answerCorrect
group by a.userId;

-- intrebarea urmatoare pentru user1
select q.questionId
from questions as q
on a.questionid = q.questionId
where a.userId IS NULL
order by rand()
limit 1;
