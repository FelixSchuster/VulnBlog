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

### Local File Inclusion
Try accessing:
```
http://127.0.0.1/vulnblog/index.php?page=../../../../../../../../etc/passwd
```

### Stored Cross-Site-Scripting
Create a blogpost including the following payload:
```
<script>
    alert("XSS");
</script>
```

### SQL Injection
Valid SQL injection queries:
```
' or 1=1 #
admin' #
```

## Database
For further information see `./database/db.sql`.

![Database Diagram](./database/db.drawio.png)
