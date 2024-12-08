-- Create the database
CREATE DATABASE twitter;

-- Use the newly created database
USE twitter;

CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'user',
    creationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create the Posts table
CREATE TABLE Posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    creationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);

-- Create the Comments table
CREATE TABLE Comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    creationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES Posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);

-- Dummy posts for user lolo (user_id 81)
INSERT INTO Posts (user_id, content) VALUES
(81, 'Exploring the beautiful landscapes of Venezuela!'),
(81, 'Just finished reading a fantastic book about AI.'),
(81, 'Enjoying a peaceful evening by the lake.'),
(81, 'Visited the local art gallery today. Highly recommend!');

-- Dummy posts for user luis (user_id 82)
INSERT INTO Posts (user_id, content) VALUES
(82, 'Had an amazing hike in the mountains.'),
(82, 'Cooking up some delicious Venezuelan cuisine!'),
(82, 'Attended a tech conference and learned a lot.'),
(82, 'Relaxing with some great music this evening.');

