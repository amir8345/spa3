
SELECT readers.user_id , follower_table.followers , library.library_books

FROM readers

LEFT JOIN 

(SELECT following as user_id , COUNT(follower) AS followers FROM follows GROUP BY following) AS follower_table

ON readers.user_id = follower_table.user_id

LEFT JOIN 

(SELECT library_table.user_id , COUNT(library_table.book_id) AS library_books
FROM 
(SELECT DISTINCT shelves.user_id  , book_shelf.book_id
FROM shelves  LEFT JOIN book_shelf
ON shelves.id = book_shelf.shelf_id) AS library_table
GROUP BY library_table.user_id) AS library

ON readers.user_id = library.user_id




