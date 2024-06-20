CREATE TABLE posts (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug varchar(255) NOT NULL,
    content TEXT(650000) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    author_id INT UNSIGNED,
    status ENUM('published', 'draft') NOT NULL DEFAULT 'draft',
    PRIMARY KEY (id),
    CONSTRAINT fk_author
        FOREIGN KEY (author_id)
        REFERENCES users(id)
        ON DELETE SET NULL
);

CREATE TABLE categories (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    slug VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE posts_categories (
    post_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (post_id, category_id),
    CONSTRAINT fk_post
        FOREIGN KEY (post_id)
        REFERENCES posts(id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    CONSTRAINT fk_category
        FOREIGN KEY (category_id)
        REFERENCES categories(id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
);

CREATE TABLE comments (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    content VARCHAR(1000) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at DATETIME DEFAULT  CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    post_id INT UNSIGNED NOT NULL,
    author_id INT UNSIGNED,
    PRIMARY KEY (id),
    CONSTRAINT fk_post_id
        FOREIGN KEY (post_id)
        REFERENCES posts(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_author_id
        FOREIGN KEY (author_id)
        REFERENCES users(id)
        ON DELETE SET NULL
);

CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('author', 'admin', 'user') NOT NULL DEFAULT 'user',
    PRIMARY KEY (id)
);
