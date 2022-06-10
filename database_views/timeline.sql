
SELECT shelves.user_id , 'book' as 'type' , book_shelf.book_id as 'type_id' ,
'book_shelf' as 'table' , book_shelf.id as 'id' , book_shelf.created_at
FROM book_shelf INNER JOIN shelves ON book_shelf.shelf_id = shelves.id

union all

SELECT user_id , 'book' as 'type' , book_id as 'type_id' , 'book_user' as 'table' , book_user.id as 'id' , created_at 
FROM book_user

union all

SELECT user_id , 

CASE
WHEN commented_type = 'post' OR commented_type = 'comment' THEN 'user'
WHEN commented_type = 'book' OR commented_type = 'user' THEN commented_type
END 
as 'type',

CASE
WHEN commented_type = 'post' OR commented_type = 'comment' THEN 
(SELECT user_id FROM comments WHERE id = commented_id)
WHEN commented_type = 'book' OR commented_type = 'user' THEN commented_id
END 
as 'type_id',
'comments' as 'table' , id , created_at

FROM comments

union all

SELECT user_id , posted_type as 'type' , posted_id as 'type_id' , 'posts' as 'table' , id , created_at
FROM posts

union all

SELECT follower , 'user' as 'type' , following as 'type_id' , 'follows' as 'table' , id , created_at
FROM follows

union all

SELECT user_id , 'user' as 'type' , 

CASE 
WHEN liked_type = 'post' THEN 
(SELECT user_id FROM posts WHERE id = likes.liked_id )
WHEN liked_type = 'comment' THEN 
(SELECT user_id FROM comments WHERE id = likes.liked_id )
END 
as 'type_id' , 'likes' as 'table' , id , created_at

FROM likes

union all

SELECT user_id , 'book' as 'type' , book_id as 'type_id' , 'scores' as 'table' , id , created_at 
FROM scores

union all

SELECT user_id , 
IF( public , 'book' , 'user' ) as 'type',
IF( public , book_id , receiver ) as 'type_id',
'suggestions' as 'table' , id , created_at
FROM suggestions