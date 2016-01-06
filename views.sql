-----------------------------------------------------
----------------- VWPOSTS ---------------------------

CREATE VIEW vwposts AS
SELECT
  posts.id AS post_id,
  posts.content AS post_content,
  posts.type AS post_type,
  posts.date AS post_date,
  posts.classification AS post_classification,
  posts.privacity AS post_privacity,
  posts.picture AS post_picture,
  user.id AS user_id,
  user.name AS user_name,
  user.picture AS user_picture,
  post_types.name AS post_type_name,
  post_types.id AS post_type_id,
  vwcommentcount.post_comment_count AS post_comments_count,
  vwgosteicount.post_gostei_count AS post_gostei_count
FROM posts
LEFT JOIN user
  ON posts.author_id = user.id
LEFT JOIN post_types
  ON posts.type = post_types.id
LEFT JOIN vwcommentcount
  ON vwcommentcount.post_id = posts.id
LEFT join vwgosteicount
  ON vwgosteicount.post_id = posts.id
GROUP By posts.id

----------------- VWPOSTS ---------------------------
-----------------------------------------------------

-----------------------------------------------------
-------------- VWNOTIFICATION -----------------------

CREATE VIEW vwnotification AS
select
	notification.id as notification_id,
	notification.date as notification_date,
	notification.status as notification_status,
	notification.post_id as notification_post_id,
	notification.post_author_id as notification_post_author_id,
	user.id as notification_author_id,
	user.name as notification_author_name,
	user.picture as notification_author_picture,
	notifications_types.name as notification_action_name,
	notifications_types.output as notification_action_output,
	notifications_types.icon as notification_action_icon
from notification
inner join user
	on user.id = notification.action_author_id
inner join notifications_types
	on notification.action_id = notifications_types.id

-------------- VWNOTIFICATION -----------------------
-----------------------------------------------------

-----------------------------------------------------
----------------- VWFOLLOWING -----------------------

CREATE VIEW following AS
select
	friend.user_id AS follower_id,
	user.id AS following_id,
    user.name AS following_name,
    user.username AS following_username,
    user.picture AS following_picture,
    user.email AS following_email
FROM user
LEFT JOIN friend
	on user.id = friend.friend_id
GROUP BY following_id

----------------- VWFOLLOWING -----------------------
-----------------------------------------------------

-----------------------------------------------------
----------------- VWFOLLOWERS -----------------------

CREATE VIEW followers AS
select
	friend.friend_id AS following_id,
	user.id AS follower_id,
    user.name AS follower_name,
    user.username AS follower_username,
    user.picture AS follower_picture,
    user.email AS follower_email
FROM user
Inner JOIN friend
	on user.id = friend.user_id
GROUP BY follower_id

----------------- VWFOLLOWERS -----------------------
-----------------------------------------------------

-------------------------------------------------------
----------------- VWGOSTEICOUNT -----------------------
CREATE VIEW vwgosteicount AS
SELECT
  posts.id AS post_id,
  COUNT(gostei.id) AS post_gostei_count
FROM posts
LEFT join gostei
  ON gostei.post_id = posts.id
GROUP By posts.id

----------------- VWGOSTEICOUNT -----------------------
-------------------------------------------------------

-------------------------------------------------------
----------------- VWCOMMENTCOUNT -----------------------

CREATE VIEW vwcommentcount AS
SELECT
  posts.id AS post_id,
  COUNT(comment.id) AS post_comment_count
FROM posts
LEFT join comment
  ON comment.post_id = posts.id
GROUP By posts.id

----------------- VWCOMMENTCOUNT -----------------------
-------------------------------------------------------

-------------------------------------------------------
-------------------- VWCOMMENT ------------------------

CREATE VIEW vwcomment AS
select
	comment.id as comment_id,
	comment.content as comment_content,
	comment.date as comment_date,
	comment.post_id as comment_post_id,
	user.id as comment_author_id,
	user.name as comment_author_name,
	user.picture as comment_author_picture
from comment
inner join user
	on user.id = comment.action_author_id

-------------------- VWCOMMENT ------------------------
-------------------------------------------------------
