DROP DATABASE IF EXISTS vulnblog;
CREATE DATABASE vulnblog;

DROP USER IF EXISTS 'vulnuser'@'localhost';
CREATE USER 'vulnuser'@'localhost';
SET PASSWORD FOR 'vulnuser'@'localhost' = PASSWORD('P@ssword');
GRANT ALL PRIVILEGES ON vulnblog.* TO 'vulnuser'@'localhost';

USE vulnblog;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    user_id INTEGER AUTO_INCREMENT NOT NULL,
    username TINYTEXT NOT NULL,
    password TINYTEXT NOT NULL,
    profile_picture TINYTEXT NULL,

    PRIMARY KEY (user_id)
);

DROP TABLE IF EXISTS blogposts;
CREATE TABLE blogposts (
    blogpost_id INTEGER AUTO_INCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    date_time DATETIME NOT NULL,
    heading TINYTEXT NOT NULL,
    blogpost MEDIUMTEXT NOT NULL,

    PRIMARY KEY(blogpost_id)
);

DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
    comment_id INTEGER AUTO_INCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    blogpost_id INTEGER NOT NULL,
    date_time DATETIME NOT NULL,
    comment MEDIUMTEXT NOT NULL,

    PRIMARY KEY(comment_id)
);

ALTER TABLE blogposts ADD CONSTRAINT fk_user_id_blogposts
FOREIGN KEY (user_id) REFERENCES users (user_id);

ALTER TABLE comments ADD CONSTRAINT fk_user_id_comments
FOREIGN KEY (user_id) REFERENCES users (user_id);

ALTER TABLE comments ADD CONSTRAINT fk_blogpost_id_comments
FOREIGN KEY (blogpost_id) REFERENCES blogposts (blogpost_id);

INSERT INTO users VALUES (0, "Admin", "admin", NULL);
INSERT INTO users VALUES (0, "Felix", "P@ssword", NULL);
INSERT INTO blogposts VALUES (0, 1, "2023-01-12 03:21:47", "University of Applied Sciences Technikum Wien", "University of Applied Sciences Technikum Vienna (German: Fachhochschule Technikum Wien) was founded in 1994 and became Vienna’s first university of applied sciences in 2000. It is the largest technical university of applied sciences in Austria and offers twelve bachelor's degree and eighteen master's degree programs. Since 2012, UAS Technikum has been a member of the European University Association (EUA). In October 2008, UAS Technikum opened a second location in the passive office building ENERGYbase in Floridsdorf, Vienna and following that, in 2013 a comprehensive expansion of the main location at Höchstädtplatz in Vienna's 20th district Brigittenau was completed. In December 2015, UAS Technikum was awarded the Erasmus+ Award 2015 in the category of Higher Education. It has also been awarded the first place in the annual UAS ranking conducted by the Austrian Industry Magazine, most notably in 2015 and 2021. With around 12,000 graduates and around 4,400 students, UAS Technikum is the largest provider of technical studies at universities of applied sciences in Austria. It is also a network partner of FEEI (Fachverband der Elektro- und Elektronikindustrie).");
INSERT INTO blogposts VALUES (0, 2, "2023-05-26 21:57:02", "Tyrannosaurus", "Tyrannosaurus is a genus of large theropod dinosaur. The species Tyrannosaurus rex (rex meaning 'king' in Latin), often called T. rex or colloquially T-Rex, is one of the best represented theropods. It lived throughout what is now western North America, on what was then an island continent known as Laramidia. Tyrannosaurus had a much wider range than other tyrannosaurids. Fossils are found in a variety of rock formations dating to the Maastrichtian age of the Upper Cretaceous period, 68 to 66 million years ago. It was the last known member of the tyrannosaurids and among the last non-avian dinosaurs to exist before the Cretaceous–Paleogene extinction event. Like other tyrannosaurids, Tyrannosaurus was a bipedal carnivore with a massive skull balanced by a long, heavy tail. Relative to its large and powerful hind limbs, the forelimbs of Tyrannosaurus were short but unusually powerful for their size, and they had two clawed digits. The most complete specimen measures up to 12.3–12.4 m (40.4–40.7 ft) in length; however, according to most modern estimates, T. rex could grow to lengths of over 12.4 m (40.7 ft), up to 3.66–3.96 m (12–13 ft) tall at the hips, and 8.87 metric tons (9.78 short tons) in body mass. Although other theropods rivaled or exceeded Tyrannosaurus rex in size, it is still among the largest known land predators and is estimated to have exerted the strongest bite force among all terrestrial animals. By far the largest carnivore in its environment, Tyrannosaurus rex was most likely an apex predator, preying upon hadrosaurs, juvenile armored herbivores like ceratopsians and ankylosaurs, and possibly sauropods. Some experts have suggested the dinosaur was primarily a scavenger. The question of whether Tyrannosaurus was an apex predator or a pure scavenger was among the longest debates in paleontology. Most paleontologists today accept that Tyrannosaurus was both an active predator and a scavenger.");
INSERT INTO blogposts VALUES (0, 1, "2023-08-03 13:36:28", "Cross-site scripting", "Cross-site scripting (XSS) is a type of security vulnerability that can be found in some web applications. XSS attacks enable attackers to inject client-side scripts into web pages viewed by other users. A cross-site scripting vulnerability may be used by attackers to bypass access controls such as the same-origin policy. Cross-site scripting carried out on websites accounted for roughly 84% of all security vulnerabilities documented by Symantec up until 2007. XSS effects vary in range from petty nuisance to significant security risk, depending on the sensitivity of the data handled by the vulnerable site and the nature of any security mitigation implemented by the site's owner network. OWASP considers the term cross-site scripting to be a misnomer. It initially was an attack that was used for breaching data across sites, but gradually started to include other forms of data injection attacks.");