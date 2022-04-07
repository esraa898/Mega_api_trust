
# Tasks Api 

project to add tasks  and connect it with user and could upload files to his tasks using s3 cloud.
## API Reference


#### register

```http
Post   /api/register
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**. |
| `email`      | `string` | **Required - email *. |
| `passwoard`     | `string` | **Required**.min:6  |

#### login

```http
Post   /api/login
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required - email *. |
| `passwoard`     | `string` | **Required**.min:6  |

#### logout

```http
Post   /api/logout 
```


#### Get all tasks related to user 

```http
  GET /api/task/all
```


#### Get task details 

```http
  GET /api/task/details/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integar` | **Required**. Id of item to get task|

####  add task

```http
  Post /api/task/create
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `title`      | `string` | **Required**. |
| `description`      | `text` | **Required - max:250**. |
| `priority`      | `string` | **Required**. high or medium or low |
| `state`      | `integar` | **Required**. 1or 2 |
| `period`      | `datetime` | **Required**. |
| `attachement`      | `string` | **Required**.png-jpg or pdf|

####  add task

```http
  Post /api/task/update/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integar` | **Required**. task_id |
| `title`      | `string` | **Required**. |
| `description`      | `text` | **Required - max:250**. |
| `priority`      | `string` | **Required**. high or medium or low |
| `state`      | `integar` | **Required**. 1or 2 |
| `period`      | `datetime` | **Required**. |
| `attachement`      | `string` | **Required**.png-jpg or pdf|


####  delete task

```http
  Post  /api/task/delete/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integar` | **Required**. task_id |
| `title`      | `string` | **Required**. |
| `description`      | `text` | **Required - max:250**. |
| `priority`      | `string` | **Required**. high or medium or low |
| `state`      | `integar` | **Required**. 1or 2 |
| `period`      | `datetime` | **Required**. |
| `attachement`      | `string` | **Required**.png-jpg or pdf|

