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
Url: {api-base-path}/user/{userId}

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

#### Delete user
Method: Delete  
Url: {api-base-path}/user/{userId}

Response
  * Not found if user Id doesn't exist
  * If user has successfuly been deleted
    ```json
    {
      "success":"User have been deleted"
    }
    ```
    

## Group

#### Find group by Id
Method: get  
Url:{api-base-path}/group/{groupId}
  
Returns Json object of group
```json
{
  "id": "543bdc40-13e7-11e7-8cb7-080027564739",
  "name": "my group",
  "description": "description of my group",
  "city": "Lille",
  "admins": [
    "523398bd-13aa-11e7-8943-080027564739"
  ],
  "users": []
}
```
Admins and users are arrays of user ids.  
  * Admins contains group admins
  * Users contains group members

#### Get all groups
Method: Get  
Url:{api-base-path}/groups  

Returns Json array of groups

#### Add group
Method: Post  
Url:{api-base-path}/group 
  
Request body
```json
{
	"name":"my group",
	"description":"description of my group",
	"city":"Lille",
	"admins":["523398bd-13aa-11e7-8943-080027564739"]
}
```
admins must contain list of user Ids which are admins of group  

Returns json object of group
```json
{
  "id": "2ee486f6-1472-11e7-9923-080027564739",
  "name": "my group",
  "description": "description of my group",
  "city": "Lille",
  "admins": [
    "523398bd-13aa-11e7-8943-080027564739"
  ],
  "users": []
}
```
users is an array which contains list of group members, it will always be empty after creating group

#### Update group
Method: Put  
Url:{api-base-path}/group/{groupId}  

Request body
```json
{
	"name":"my group",
	"description":"description of my group",
	"city":"Lille",
	"admins":["523398bd-13aa-11e7-8943-080027564739"]
}
```
admins must contain list of user Ids which are admins of group  

Returns json object of group
```json
{
  "id": "2ee486f6-1472-11e7-9923-080027564739",
  "name": "my group",
  "description": "description of my group",
  "city": "Lille",
  "admins": [
    "523398bd-13aa-11e7-8943-080027564739"
  ],
  "users": []
}
```
users is an array which contains list of group members  

#### Delete group
Method: Delete  
Url:{api-base-path}/group/{groupId}  

Response
  * Not found if group Id doesn't exist
  * If group has successfuly been deleted
    ```json
    {
      "success":"group have been deleted"
    }
    ```
   

## Event
#### Find event by Id
Method: Get  
Url: {api-base-path}/event/{eventId}

returns json object of an event
```json
{
  "id": "3af3f336-1473-11e7-9923-080027564739",
  "name": "event name",
  "description": "event description",
  "dateStart": {
    "date": "2017-07-13 19:00:00.000000",
    "timezone_type": 3,
    "timezone": "Europe/Berlin"
  },
  "dateEnd": {
    "date": "2017-07-13 21:00:00.000000",
    "timezone_type": 3,
    "timezone": "Europe/Berlin"
  },
  "groupId": "c7cd95bc-13aa-11e7-8943-080027564739",
  "partiipantsId": []
}
```

#### Get all events
Method: Get  
Url: {api-base-path}/events  

Returns json array of events

#### Add event
Method: Post  
Url: {api-base-path}/event  

Request body
```json
{
	"name":"event name",
	"description":"event description",
	"dateStart":"13-07-2017 19:00:00",
	"dateEnd":"13-07-2017 21:00:00",
	"groupId":"c7cd95bc-13aa-11e7-8943-080027564739"
}
```

Returns json object of event

```json
{
  "id": "02e505a0-1474-11e7-9923-080027564739",
  "name": "event name",
  "description": "event description",
  "dateStart": {
    "date": "2017-07-13 19:00:00.000000",
    "timezone_type": 3,
    "timezone": "Europe/Berlin"
  },
  "dateEnd": {
    "date": "2017-07-13 21:00:00.000000",
    "timezone_type": 3,
    "timezone": "Europe/Berlin"
  },
  "groupId": "c7cd95bc-13aa-11e7-8943-080027564739",
  "partiipantsId": []
}
```

#### Update event
Method: Put  
Url: {api-base-path}/event/{eventId}  


Request body
```json
{
	"name":"event name",
	"description":"event description",
	"dateStart":"13-07-2017 19:00:00",
	"dateEnd":"13-07-2017 21:00:00",
	"groupId":"c7cd95bc-13aa-11e7-8943-080027564739"
}
```

Returns json object of the updated event

```json
{
  "id": "02e505a0-1474-11e7-9923-080027564739",
  "name": "event name",
  "description": "event description",
  "dateStart": {
    "date": "2017-07-13 19:00:00.000000",
    "timezone_type": 3,
    "timezone": "Europe/Berlin"
  },
  "dateEnd": {
    "date": "2017-07-13 21:00:00.000000",
    "timezone_type": 3,
    "timezone": "Europe/Berlin"
  },
  "groupId": "c7cd95bc-13aa-11e7-8943-080027564739",
  "partiipantsId": []
}
```

#### Delete event
Method: Delete  
Url: {api-base-path}/event/{eventId}  

Response
  * Not found if event Id doesn't exist
  * If event has successfuly been deleted
    ```json
    {
      "success":"event have been deleted"
    }
    ```
   

#### Add user to event
Method: Post  
Url: {api-base-path}/event/{event}/user/{user}  

No request body  

Returns json object of the updated event 
```json
{
  "id": "b0336a7a-1475-11e7-9923-080027564739",
  "name": "event name",
  "description": "event description",
  "dateStart": {
    "date": "2017-07-13 19:00:00.000000",
    "timezone_type": 3,
    "timezone": "Europe/Berlin"
  },
  "dateEnd": {
    "date": "2017-07-13 21:00:00.000000",
    "timezone_type": 3,
    "timezone": "Europe/Berlin"
  },
  "groupId": "a30b7c5c-1475-11e7-9923-080027564739",
  "partiipantsId": [
    "ccc09a6f-1475-11e7-9923-080027564739"
  ]
}
```