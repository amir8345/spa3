SELECT users.id , name , follow_table.follower , book_table.book
FROM users
INNER JOIN publishers ON users.id = publishers.user_id
LEFT JOIN
(SELECT following , COUNT(follower) AS follower FROM follows GROUP BY following) AS follow_table
ON users.id = follow_table.following
LEFT JOIN
(SELECT user_id , COUNT(book_id) AS book FROM book_user WHERE action = 'publisher' GROUP BY user_id) AS book_table
ON users.id = book_table.user_id
