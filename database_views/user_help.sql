SELECT users.id AS user_id , users.username ,  users.name , follower_table.followers , following_table.followings , book_table.books ,

CASE 
	WHEN (SELECT publishers.id from publishers WHERE publishers.user_id = users.id) 
    THEN 'publisher'
    WHEN (SELECT contributors.id from contributors WHERE contributors.user_id = users.id) 
    THEN 'contributor'
    WHEN (SELECT readers.id from readers WHERE readers.user_id = users.id) 
    THEN 'reader'
END
as type

from users 



LEFT JOIN 

(SELECT following as user_id , COUNT(follower) AS followers FROM follows GROUP BY following) AS follower_table

ON users.id = follower_table.user_id

LEFT JOIN 

(SELECT follower as user_id , COUNT(following) AS followings FROM follows GROUP BY follower) AS following_table

ON users.id = following_table.user_id

LEFT JOIN 

(SELECT user_id , COUNT(book_id) as books FROM book_user GROUP BY user_id) AS book_table

ON users.id = book_table.user_id


