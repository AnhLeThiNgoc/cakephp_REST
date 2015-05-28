/* First, create our phones table: */
CREATE TABLE phones (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
	manufacturer VARCHAR(50),
    description TEXT,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);

/* Then insert some phones for testing: */
INSERT INTO phones (name,manufacturer,description,created)
    VALUES ('iPhone 5s', 'Apple', 'The iPhone 5s may look a lot like its predecessor. But with a faster new processor, a fingerprint sensor, and an improved camera flash, it is a serious upgrade.', NOW());
INSERT INTO phones (name,manufacturer,description,created)
    VALUES ('Nexus 5','Google', 'Running the latest version of Android, the Nexus 5 really shows off the best aspects of Googles mobile OS. There are few reasons not to pick the Nexus 5 as your next Android phone.', NOW());
INSERT INTO phones (name,manufacturer,description,created)
    VALUES ('One','HTC', 'With its stellar design, great camera, and hardy processor, the HTC One is the phone to beat.', NOW());
INSERT INTO phones (name,manufacturer,description,created)
    VALUES ('Galaxy S4','Samsung', 'The Samsung Galaxy S4 is a stellar Android phone held back by boring design and half-baked features.', NOW());