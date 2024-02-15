# Hospital assistant management system

# Features

1. Consultation
2. Feedback
3. Payment
4. Record
5. Access Control (roles and permissions)
6. Users
7. User Profile
8. Settings (Application settings)
9. Application backup
10. Dashboard
11. Consultation notifications

# Installation
 Follow these steps to install the application.
1. Clone the Repository
```
git clone https://github.com/Hillary-cloud/hospital-assistant.git
```
2. Go to project directory

```
cd hospital-assistant
```

3. Install packages with composer

```
composer install
```

4. Install npm packages with 
```
npm install; npm run dev
```
5. Create your database 

6. Rename .env.example to .env Or copy it and paste at project root directory and name the file .env.You can also use this command.

```
cp .env.example ./.env
```
7. Generate app key with this command
```
php artisan key:generate
```

8. Set database connection to your database in the .env file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital_appointment
DB_USERNAME=root
DB_PASSWORD=
```
9. Import full database sql file in the database folder, or run migrations
Use this command to run migrations

```
php artisan migrate --seed
```
10. Start the local server and browser to your app.
This command will start the development server
```
php artisan serve
```

11. Open the address in the terminal in your browser.Usually address is usually like this:
```
http://127.0.0.1:8000
```
12. Enjoy and make sure to star the repo :).Report bugs,features and also send your pull requests.

# admin login credentials

```
 email: admin@admin.com
 password: admin
```

Theme: https://themeforest.net/item/doccure-doctor-appointment-booking-system-bootstrap-angular-template/28201296

# Usage

- Profile => 
	Each user has a profile of their own.
	You can update your profile credentials from this page by clicking on the edit button.
	You can also change your password by clicking on the password tab
	and choosing your new password.Also make sure you type your old password correctly

- Users => 
	list of all users in the system.
	You can add new user by clicking on the add user button on the users page.
	You can also edit user details by clicking on the edit button on the users page.
	You can easily delete a user by clicking on the delete button.
	You can export or print all the users data by clicking on the export data button dropdown.


- Access Control =>
	User roles and permissions are here.
	Every user in the system has a role and each role has some number of permissions in the system.
	You can create new roles and choose their permissions. 
	Click the add role button, and write the role name and choose some number of permissions you want 
	the user holding this role to have and submit.
	you can edit or delete roles by clicking on either the edit button or delete button.
