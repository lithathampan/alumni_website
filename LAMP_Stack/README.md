This is the code for BirdsofFeathers Alumni Website for Maggotty High School
As a pre-requisite, build a LAMP (Linux, Apache, MySQL and PHP) stack

For deploying the code,

1. Run the Schema.sql to create the scehma and application user.
2. Run birdsoffeathers.sql on the newly created schema.
3. Unzip the birdsoffeathers.zip and copy  under /var/www/html folder 
4. Configure the sendmail and php.ini for php mailing.
5. Verify config.php with the database details and email details 
6. Use following credentials to test the website as http://localhost/birdsoffeathers

	username(Admin) : testadmin
	password 		: admin

	username(SuoerUser) : testsuperuser
	password			: superuser

	username(Member)	: testmember
	password			: member123