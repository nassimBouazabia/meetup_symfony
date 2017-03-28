meetup
======

Project is a Restfull Api to organise meetups. It allows you to manage users, groups and events.

  * All requests are HTTP Requests

{Api-base-path}:
  * Dev : localhost:8000 if you start your server with bascal command "bin/console server:run"

# Api summury

#### User
  * Find user by Id
  * Get all users
  * Add user
  * Update user
  * Delete user

#### Group
  * Find group by Id
  * Get all groups
  * Add group
  * Update group
  * Delete group

#### Event
  * Find event by Id
  * Get all events
  * Add event
  * Update event
  * Delete event
  * Add user to event

## User

#### Find user by Id
Method: Get  
Url: {api-base-path}/user/{id}

return user as json object
```json
{
  "id": "6cf5f61f-13e4-11e7-8cb7-080027564739",
  "name": "user name",
  "mail": "mail@mail.com",
  "password": "password"
}
```

#### Get all users
Method: Get  
Url: {api-base-path}/users  
  
returns list of users as json array


#### Add user
Method: Post  
Url: {api-base-path}/user  
  
Request Body
```json
{
	"name":"name",
	"mail":"mail@mail.com",
	"password":"password"
}
```
As response you will have json object which contains the user id like following
```json
{
    "id": "6cf5f61f-13e4-11e7-8cb7-080027564739",
	"name":"name",
	"mail":"mail@mail.com",
	"password":"password"
}
```


#### Update user
Method: Put  
Url: {api-base-path}/user/{userId}  
  


#### Delete user

