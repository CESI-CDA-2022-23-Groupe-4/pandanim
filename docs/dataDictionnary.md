# Data Dictionnary

## Table: `user`
| Name       | Type              | Description       | Comment    |
|------------|-------------------| ----------------- |------------|
| id         | smallint unsigned | Unique identifier | auto increment |
| username   | varchar(30)       | Username          |            |
| first_name | varchar(40)       | First name        |            |
| last_name  | varchar(40)       | Last name         |            |
| email      | varchar(255)      | Email address     | unique     |
| password   | varchar(128)      | Password          | hashed (SHA-512) |
| roles      | varchar(60)       | Roles             |            |

## Table: `review`
| Name     | Type             | Description   | Comment |
| -------  | ---------------- | ------------- | ------- |
| score    | tinyint unsigned | Score         | 0 to 10 |
| comment  | text             | Comment       |         |
| created_at | DateTime             | Creation Date |         |
| updated_at | DateTime             | Editable Date |         |

## Table: `anime`

| Name            | Type              | Description       | Comment                               |
| --------------- | ----------------- | ----------------- | ------------------------------------- |
| id              | smallint unsigned | Unique identifier | not auto increment -> getted from API |
| updated_at      | datetime          | Last update       |                                       |
| image_url       | varchar(50)       | Image URL         |                                       |
| small_image_url | varchar(52)       | Small Image URL   |                                       |
| large_image_url | varchar(52)       | Large Image URL   |                                       |
| trailer         | varchar(12)       | Trailer           | Youtube id                            |
| title           | varchar(150)      | Title             |                                       |
| title_english   | varchar(150)      | English title     |                                       |
| title_japanese  | varchar(200)      | Japanese title    |                                       |
| type            | varchar(10)       | Type              |                                       |
| episodes        | smallint unsigned | Episodes          |                                       |
| status          | varchar(25)       | Status            |                                       |
| aired_from      | varchar(10)              | Aired from        |                                       |
| aired_to        | varchar(10)              | Aired to          |                                       |
| duration        | varchar(25)       | Duration          |                                       |
| mal_score       | decimal(4,2)      | MAL score         | Reviewer score from MyAnimeList       |
| mal_scored_by   | int unsigned      | MAL scored by     | Number of reviewer from MyAnimeList   |
| rating          | varchar(50)       | Rating            |                                       |
| synopsis        | text              | Synopsis          |                                       |

## Table: `genre`

| Name | Type              | Description       | Comment                               |
| ---- | ----------------- | ----------------- | ------------------------------------- |
| id   | smallint unsigned | Unique identifier | not auto increment -> getted from API |
| name | varchar(50)       | Name              |                                       |

## Table: `studio`

| Name | Type              | Description       | Comment                               |
| ---- | ----------------- | ----------------- | ------------------------------------- |
| id   | smallint unsigned | Unique identifier | not auto increment -> getted from API |
| name | varchar(50)       | Name              |                                       |
