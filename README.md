# Flowchart

![](Untitled%20Diagram.drawio.svg)


```bash
sudo dnf -y install php  php-cli php-fpm php-mysqlnd php-zip php-devel php-gd php-mcrypt php-mbstring php-curl php-xml php-pear php-bcmath php-json
```

```bash
sudo apt -y install php php-{cli,gd,mysql,pdo,mbstring,tokenizer,bcmath,xml,fpm,curl,zip}
curl -sS https://getcomposer.org/installer | php 
sudo mv composer.phar /usr/bin/composer
```

# English
## Prerequisites

1. Create database `crud`
2. Create table `users`
```sql
CREATE TABLE `users` (
id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nama VARCHAR(255) NOT NULL,
alamat TEXT NOT NULL,
perkerjaan VARCHAR(255) NOT NULL
);
```

# Indonesia
## Persyaratan

1. Buat database `crud`
2. Buat tabel `users`
```sql
CREATE TABLE `users` (
id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nama VARCHAR(255) NOT NULL,
alamat TEXT NOT NULL,
perkerjaan VARCHAR(255) NOT NULL
);
```

