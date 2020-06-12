To use the API,You need
Laravel
Passport for the auth;
Postman to test the endpoints.
Create a database named "migration" or you can just create one, then changed the name in the env file.Then you can go ahead and make your migrations.

The routes are in the routes/api.php file if you wish to check.

Using postman:
Make sure you append /api to your url i.e for example 127.0.0.1:8000/api/register
Create a User then log in,copy the access token generated and add it to the header,that monitors the session which gives you access as an authenticated user.
You can start testing the requests now, with the conventional POST,GET,PUT/PATCH and DELETE
