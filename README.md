# php-login-system
Secure PHP login system with hash/salt

## Database Scheme

```
CREATE TABLE `users` (
	`username` varchar(255) NOT NULL,
	`password` TEXT NOT NULL,
	`tier` INT(255) NOT NULL,
	`ip` TEXT NOT NULL,
	PRIMARY KEY (`username`)
);
```
