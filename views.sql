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
  COUNT(comment.id) AS post_comments_count,
  COUNT(gostei.id) AS post_gostei_count
FROM posts
INNER JOIN user
  ON posts.author_id = user.id
INNER JOIN post_types
  ON posts.type = post_types.id
LEFT JOIN comment
  ON comment.post_id = posts.id
LEFT join gostei
  ON gostei.post_id = posts.id
GROUP By posts.id

----------------- VWPOSTS ---------------------------
-----------------------------------------------------