# Installation

### Download zip file or directly open terminal and type
```yaml
git clone https://github.com/codersangam/techblog.git
```

### Open projects using IDE like `VS Code` or Others.
### In terminal enter below command to update dependencies:
Note: Install [`composer`](https://getcomposer.org/) If you have not installed in your system.
```yaml
composer update
```

### Create new `database` or `schema` using `mysql workbench` or others.
### In main project folder, find `.env.example` file & rename that file to `.env`

### Setup `database name`, `database user` and `database password` in `.env file`

### Migrate all tables to DB.
```yaml
php artisan migrate
```
### Type below command in terminal to generate key.
```yaml
php artisan key:generate
```

### After that, to symlink the images.
```yaml
php artisan storage:link
```

### Finally, to run project:
```yaml
php artisan serve
```


# APIs

- Main Url: https://your-domain.com/api or http://localhost:8000/api

- Users Panel Endpoint Urls (These Urls doesnot need any tokens)
    - `/posts` GET Request : Fetch all posts

    '👇🏻┌------------------------------------------------------------------------------👨🏻‍💻'

                   REQUEST                     |            RESPONSE
        http://localhost:8000/api/posts        |            {
                                               |                 "status" : 1,
                                               |                  "all_posts" : [...],
                                               |                  "popular_posts" : [...],
                                               |            }

    '👆🏻└------------------------------------------------------------------------------👨🏻‍💻'
    
    - `/tags` GET Request : Fetch all tags

    '👇🏻┌------------------------------------------------------------------------------👨🏻‍💻'

                   REQUEST                     |            RESPONSE
        http://localhost:8000/api/tags         |            {
                                               |                 "status" : 1,
                                               |                  "tags_count" : 10,
                                               |                  "tags" : [...],
                                               |            }

    '👆🏻└------------------------------------------------------------------------------👨🏻‍💻'

    - `/categories` GET Request : Fetch all categories

    '👇🏻┌------------------------------------------------------------------------------👨🏻‍💻'

                   REQUEST                     |            RESPONSE
        http://localhost:8000/api/categories   |            {
                                               |                 "status" : 1,
                                               |                  "categories_count" : 10,
                                               |                  "categories" : [...],
                                               |            }

    '👆🏻└------------------------------------------------------------------------------👨🏻‍💻'

    - `/counts` GET Request : Fetch total counts of users, posts, tags and categories.

    '👇🏻┌------------------------------------------------------------------------------👨🏻‍💻'

                   REQUEST                     |            RESPONSE
        http://localhost:8000/api/counts       |            {
                                               |                 "status" : 1,
                                               |                  "total_tags_count" : 10,
                                               |                  "total_categories_count" : 10,
                                               |                  "total_posts_count : 10,
                                               |                  "total_users_count : 10,
                                               |            }

    '👆🏻└------------------------------------------------------------------------------👨🏻‍💻'

<br/>

- Admin Panel Endpoint Urls (These Urls need tokens to get all data)

    - `/register` POST Request To register new users/admins

    '👇🏻┌------------------------------------------------------------------------------👨🏻‍💻'

                   REQUEST                     |            RESPONSE
        http://localhost:8000/api/register     |            {
                                               |                 "data" : {
                                               |                                "name": "test user",
                                               |                                 "email": "testuser1@gmail.com",
                BODY                           |                                 "updated_at": "2023-04-16T18:38:49.000000Z",
            {                                  |                                 "created_at": "2023-04-16T18:38:49.000000Z",
                "name":"test user",            |                                 "id": 8,
                "email":"testuser1@gmail.com", |                                 "profile_photo_url": ""
                 "password":"12345678"         |                            },
            }                                  |                             "access_token": "",
                                               |                             "token_type": "Bearer"
                                               |              }     
                                               |           
    '👆🏻└------------------------------------------------------------------------------👨🏻‍💻'

    
    - `/login` POST Request : To login users/admins

    '👇🏻┌------------------------------------------------------------------------------👨🏻‍💻'

                   REQUEST                     |            RESPONSE
        http://localhost:8000/api/login        |            {
                                               |                 "message": "",
                                               |                 "access_token": "",              
                                               |                 "token_type":"Bearer"               
                BODY                           |             }                  
            {                                  |                                 
                "email":"testuser1@gmail.com", |                                
                "password":"12345678"          |                    
            }                                  |                                   
    '👆🏻└------------------------------------------------------------------------------👨🏻‍💻'

    - `/add-tags` POST Request : To add new tags
    - `/update-tags` POST Request : To update tags
    - `/delete-tags/id` POST Request : To delete tags
    - `/add-categories` POST Request : To add new categories
    - `/update-categories` POST Request : To update categories
    - `/delete-categories/id` POST Request : To delete categories
    - `/user-posts` GET Request : To Fetch User Posts
    - `/add-posts` POST Request : To add new posts
    - `/update-posts` POST Request : To update posts
    - `/delete-posts/id` POST Request : To delete posts
