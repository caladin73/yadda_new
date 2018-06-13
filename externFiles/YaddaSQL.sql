/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Marianne
 * Created: 24-10-2017
 */

/*Se alle mine Yaddas*/
SELECT y.`YaddaID`,y.`Text`,y.`Username`,y.`DateAndTime` 
FROM `Yadda` y
where y.username = 'haffe'                                
ORDER BY `DateAndTime`, `YaddaID`

/**
 * Se alle Yaddas - ingen listener - ingen tags
 */
SELECT `YaddaID`,`Text`,`Username`,`DateAndTime` 
FROM `Yadda`
ORDER BY `DateAndTime`, `YaddaID`

/**
 * Se hvem jeg lytter på 'haffe'
 */
SELECT l.UsernameListensTo 
FROM Listener l 
where l.UsernameListener = 'haffe' 


/**
 * Se Yaddas med tag '¤historie'
 */
SELECT y.YaddaID,y.Text,y.Username,y.DateAndTime
FROM Yadda y                  
where y.YaddaID in (select t.YaddaID 
                   	from Tag t
                   	where t.Tagname = '¤historie')             
ORDER BY y.DateAndTime, y.YaddaID

/**
 * Reples til bestemt Yadda (1)
 */
SELECT y.YaddaID,y.Text,y.Username,y.DateAndTime
FROM Yadda y                  
where y.YaddaID in (select r.YaddaIDReply 
                   	from Reply r
                   	where r.YaddaID = 1)             
ORDER BY y.DateAndTime, y.YaddaID

/*************************** VIEWS ********************************/
if exists(select 1 from sys.views where name='view_yaddas_no_replies' and type='v')
drop view view_yaddas_no_replies;
go

/*oprettet*/
CREATE VIEW view_yaddas_no_replies 
AS 
SELECT y.*, (
        SELECT  COUNT(r.YaddaID)
        FROM    Reply r
        WHERE   r.YaddaID = y.YaddaID
        ) as replies
FROM Yadda y 
where y.YaddaID NOT in (select r.YaddaIDReply 
                        from Reply r) 
ORDER BY y.DateAndTime DESC, y.YaddaID

/*************************** FUNCTION *****************************/
/*oprettet*/
CREATE FUNCTION func_countReplies (yid int(16)) 
RETURNS int(16)
BEGIN
    DECLARE nums INT(16) DEFAULT 0;

    select COUNT(y.YaddaID) into nums
    FROM Yadda y                  
    where y.YaddaID = yaddaid AND
    	y.YaddaID in (select r.YaddaIDReply 
                    	from Reply r
                   		where r.YaddaID = yid);
    RETURN nums;
END

/*************************** SP *****************************/
/*oprettet*/
SELECT y.YaddaID,y.Text,y.Username,y.DateAndTime
FROM Yadda y                  
where y.YaddaID in (select t.YaddaID 
                   	from Tag t
                   	where t.Tagname = tname)             
ORDER BY y.DateAndTime, y.YaddaID




CREATE FUNCTION func_yaddasByUsername (   
    @username varchar(16)
)
SELECT y.`YaddaID`,y.`Text`,y.`Username`,y.`DateAndTime` 
FROM `Yadda` y
where y.username = @username                                
ORDER BY `DateAndTime`, `YaddaID`


CREATE FUNCTION func_username_listensto_ids (   
    @username varchar(16)
)
SELECT l.UsernameListensTo 
FROM Listener l 
where l.UsernameListener = @username


CREATE FUNCTION func_yadda_replies_to_id (   
    @yaddaid int(16)
)
SELECT y.YaddaID,y.Text,y.Username,y.DateAndTime
FROM Yadda y                  
where y.YaddaID in (select r.YaddaIDReply 
                   	from Reply r
                   	where r.YaddaID = @yaddaid)             
ORDER BY y.DateAndTime, y.YaddaID