CREATE TABLE quiz (
    id INT(6) PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    about VARCHAR(300) NOT NULL
);

SHOW TABLES;

CREATE TABLE quiz_question (
    id INT(6) PRIMARY KEY,
    quiz_id INT(6),
    FOREIGN KEY (quiz_id)
        REFERENCES quiz (id),
    question VARCHAR(300) NOT NULL
);

CREATE TABLE quiz_question_option (
    id INT(6) PRIMARY KEY,
    quiz_question_id INT(6) NOT NULL,
    FOREIGN KEY (quiz_question_id)
        REFERENCES quiz_question (id),
    answer VARCHAR(300) NOT NULL,
    is_correct BOOLEAN NOT NULL
);

INSERT INTO quiz VALUES (2, "Physics", "Units!?");
INSERT INTO quiz_question VALUES(3, 1, "Which country has the largest population?");
INSERT INTO quiz_question_option VALUES (7, 3, "Watt", 0);

UPDATE quiz_question_option
SET answer = "Južna Afrika" WHERE id=1;
DELETE FROM quiz WHERE id=1;
SELECT * FROM quiz;
SELECT * FROM quiz_question;
SELECT * FROM quiz_question_option;

ALTER TABLE quiz ADD COLUMN image VARCHAR(300);

DELETE FROM quiz_question_option WHERE quiz_question_id=666;
DELETE FROM quiz_question WHERE quiz_id=37;
DELETE FROM quiz WHERE id=37;
