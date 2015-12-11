DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `cap_first_letter_in_words`(INPUT VARCHAR(255) CHARSET utf8) RETURNS varchar(255) CHARSET utf8
    DETERMINISTIC
BEGIN
    DECLARE len INT;
    DECLARE i INT;

    SET len   = CHAR_LENGTH(INPUT);
    SET INPUT = LOWER(INPUT);
    SET i = 0;

    WHILE (i < len) DO
        IF (MID(INPUT,i,1) = ' ' OR i = 0) THEN
            IF (i < len) THEN
                SET INPUT = CONCAT(
                    LEFT(INPUT,i),
                    UPPER(MID(INPUT,i + 1,1)),
                    RIGHT(INPUT,len - i - 1)
                );
            END IF;
        END IF;
        SET i = i + 1;
    END WHILE;

    RETURN INPUT;
END$$
DELIMITER ;